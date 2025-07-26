<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\Service;
use App\Models\Room;
use App\Models\RoomType;
use App\Models\FilterOption;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class ReservationController extends Controller
{
    public function reservationform(Request $request)
    {
        $room_id = $request->input('room_id');
        $room = Room::with('roomType')->findOrFail($room_id);
        
        $roomTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type');
        })->get(['id', 'label', 'value', 'capacity']);

        // Set default capacity if not set in filter_options
        $roomTypes->each(function($type) use ($room) {
            if (empty($type->capacity)) {
                $type->capacity = $room->room_capacity ?? 2; // Default to 2 if not set
            }
        });

        $services = Service::all();
        $user = auth()->user();

        return view('user.reservations.create', compact('room', 'roomTypes', 'services', 'user'));
    }

    public function index(Request $request)
    {
            $search = $request->input('search');

            $groupedReservations = Reservation::with(['children', 'children.room'])
                ->where('user_id', auth()->id())
                ->where('is_parent', true)
                ->whereDate('check_out', '>=', now())
                ->when($search, function ($query) use ($search) {
                    $query->where('id', $search);
                })
                ->latest()
                ->get();

            $currentReservations = Reservation::with(['room'])
                ->where('user_id', auth()->id())
                ->where('is_parent', false)
                ->whereDate('check_out', '>=', now())
                ->when($search, function ($query) use ($search) {
                    $query->where('id', $search);
                })
                ->latest()
                ->paginate(10);

            $pastReservations = Reservation::with(['room'])
                ->where('user_id', auth()->id())
                ->whereDate('check_out', '<', now())
                ->when($search, function ($query) use ($search) {
                    $query->where('id', $search);
                })
                ->latest()
                ->paginate(10);

            return view('user.reservations.index', [
                'groupedReservations' => $groupedReservations,
                'currentReservations' => $currentReservations,
                'pastReservations' => $pastReservations,
            ]);
    }

    public function show($id)
    {
        $reservation = Reservation::with(['room', 'services', 'children'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

             $groupedReservations = Reservation::where('is_parent', true)
        ->where('user_id', auth()->id())
        ->with('children')
        ->get();

            $reservations = Reservation::where('user_id', auth()->id())->get();

            $pastReservations = Reservation::where('user_id', auth()->id())
            ->where('check_out', '<', now())
            ->paginate(10);


        return view('user.reservations.show', compact('reservation', 'groupedReservations', 'reservations', 'pastReservations'));
    }

     public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'rooms' => 'required|array|min:1',
            'rooms.*.room_type' => 'required|string',
            'rooms.*.guests' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            $totalRooms = 0;
            $roomGroups = [];

            // Calculate needed rooms for each room type
            foreach ($request->rooms as $index => $roomData) {
                $roomType = FilterOption::where('label', $roomData['room_type'])->first();
                $capacity = $roomType->capacity ?? 2; // Default capacity
                $guests = (int)$roomData['guests'];
                $roomsNeeded = ceil($guests / $capacity);

                $roomGroups[] = [
                    'type' => $roomData['room_type'],
                    'capacity' => $capacity,
                    'total_guests' => $guests,
                    'rooms_needed' => $roomsNeeded,
                    'service_id' => $roomData['service_id'] ?? null
                ];
                $totalRooms += $roomsNeeded;
            }

            // Create parent reservation
            $parentReservation = Reservation::create([
                'user_id' => auth()->id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'check_in' => $request->check_in,
                'check_out' => $request->check_out,
                'room_type' => $request->rooms[0]['room_type'], // Default to first room type
                'guests' => array_sum(array_column($request->rooms, 'guests')),
                'status' => 'pending',
                'is_parent' => true,
                'total_rooms' => $totalRooms
            ]);

            // Create child reservations
            $createdChildren = 0;
            foreach ($roomGroups as $group) {
                $remainingGuests = $group['total_guests'];
                
                for ($i = 0; $i < $group['rooms_needed']; $i++) {
                    $guestsInRoom = min($group['capacity'], $remainingGuests);
                    
                    $reservation = Reservation::create([
                        'parent_id' => $parentReservation->id,
                        'user_id' => auth()->id(),
                        'room_id' => null, // No room assigned yet
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'check_in' => $request->check_in,
                        'check_out' => $request->check_out,
                        'room_type' => $group['type'],
                        'guests' => $guestsInRoom,
                        'status' => 'pending',
                        'is_parent' => false
                    ]);

                    if ($group['service_id']) {
                        $reservation->services()->attach($group['service_id']);
                    }
                    
                    $remainingGuests -= $guestsInRoom;
                    $createdChildren++;
                }
            }

            DB::commit();

            return redirect()->route('user.reservations.index')
                ->with('success', 'Reservation created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()
                ->with('error', 'Reservation failed. Please try again.');
        }
    }

    public function edit($id)
    {
        $reservation = Reservation::with('room', 'services')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        if (Carbon::parse($reservation->check_out)->isPast()) {
            return redirect()->route('user.reservations.index')
                ->with('error', 'This reservation cannot be edited anymore.');
        }

        $roomTypes = FilterOption::whereHas('filter', function($q) {
            $q->where('slug', 'room-type');
        })->get();
        
        $services = Service::all();
        $user = auth()->user();

        return view('user.reservations.edit', compact('reservation', 'roomTypes', 'services', 'user'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'check_in'  => 'required|date',
            'check_out' => 'required|date|after:check_in',
        ]);

        $reservation = Reservation::where('user_id', auth()->id())->findOrFail($id);

        if (Carbon::parse($reservation->check_out)->isPast()) {
            return redirect()->route('user.reservations.edit', $id)
                ->with('error', 'This reservation cannot be edited anymore.');
        }

        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Only pending reservations can be edited.');
        }

        $reservation->update($validated);

        return redirect()->route('user.reservations.index')
            ->with('success', 'Reservation updated successfully!');
    }

    public function destroy($id)
    {
        $reservation = Reservation::where('user_id', auth()->id())->findOrFail($id);
        
        if ($reservation->status !== 'pending') {
            return back()->with('error', 'Only pending reservations can be cancelled.');
        }
        
        $reservation->delete();
        return redirect()->route('user.reservations.index')->with('success', 'Reservation cancelled successfully!');
    }

   

    public function myBookings()
    {
        $reservations = Reservation::where('user_id', auth()->id())
            ->orderBy('check_in', 'desc')
            ->get();
            
        return view('User.profile.show', compact('reservations'));
    }

     public function checkAvailability(Request $request)
    {
        $rooms = Room::where('room_type', $request->room_type)->get();
        $available = 0;

        foreach ($rooms as $room) {
            $overlap = Reservation::where('room_id', $room->id)
                ->where(function ($query) use ($request) {
                    $query->whereBetween('check_in', [$request->check_in, $request->check_out])
                        ->orWhereBetween('check_out', [$request->check_in, $request->check_out])
                        ->orWhere(function ($q) use ($request) {
                            $q->where('check_in', '<', $request->check_in)
                              ->where('check_out', '>', $request->check_out);
                        });
                })
                ->exists();

            if (!$overlap) $available++;
        }

        return response()->json(['available' => $available]);
    }

    // invoice generation
    public function invoice($id)
    {
        $reservation = Reservation::with(['room', 'services'])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('user.reservations.invoice', compact('reservation'));
    }

    // App\Http\Controllers\User\ReservationController.php

    public function downloadInvoice($id)
    {
        $reservation = Reservation::with('services', 'room')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        $roomTotal = $reservation->room->price ?? 0;
        $servicesTotal = $reservation->services->sum('price');
        $total = $roomTotal + $servicesTotal;

        $pdf = Pdf::loadView('user.reservations.invoice_pdf', [
            'reservation' => $reservation,
            'roomTotal' => $roomTotal,
            'servicesTotal' => $servicesTotal,
            'total' => $total,
        ]);

        return $pdf->download('invoice_' . $reservation->id . '.pdf');
    }


    // public function cancelReservation($id)
    // {
    //     $reservation = Reservation::where('user_id', auth()->id())->findOrFail($id);

    //     if ($reservation->status !== 'pending') {
    //         return back()->with('error', 'Only pending reservations can be cancelled.');
    //     }

    //     $reservation->update(['status' => 'cancelled']);

    //     return redirect()->route('user.reservations.index')
    //         ->with('success', 'Reservation cancelled successfully!');
    // }

    // public function reservationHistory()
    // {
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->orderBy('check_in', 'desc')
    //         ->paginate(10);

    //     return view('user.reservations.history', compact('reservations'));
    // }

    // public function reservationDetails($id)
    // {
    //     $reservation = Reservation::with(['room', 'services'])
    //         ->where('user_id', auth()->id())
    //         ->findOrFail($id);

    //     return view('user.reservations.details', compact('reservation'));
    // }

    // public function reservationStatus($id)
    // {
    //     $reservation = Reservation::where('user_id', auth()->id())->findOrFail($id);

    //     if ($reservation->status === 'pending') {
    //         return back()->with('error', 'This reservation is still pending.');
    //     }

    //     return view('user.reservations.status', compact('reservation'));
    // }

    // public function reservationPayment($id)
    // {
    //     $reservation = Reservation::where('user_id', auth()->id())->findOrFail($id);

    //     if ($reservation->status !== 'pending') {
    //         return back()->with('error', 'Only pending reservations can be paid.');
    //     }

    //     // Here you would typically integrate with a payment gateway
    //     // For now, we'll just simulate a successful payment

    //     $reservation->update(['status' => 'paid']);

    //     return redirect()->route('user.reservations.index')
    //         ->with('success', 'Payment successful! Reservation is now confirmed.');
    // }

    // public function reservationSummary($id)
    // {
    //     $reservation = Reservation::with(['room', 'services'])
    //         ->where('user_id', auth()->id())
    //         ->findOrFail($id);

    //     $roomTotal = $reservation->room->price ?? 0;
    //     $servicesTotal = $reservation->services->sum('price');
    //     $total = $roomTotal + $servicesTotal;

    //     return view('user.reservations.summary', compact('reservation', 'roomTotal', 'servicesTotal', 'total'));
    // }

    // public function reservationFeedback($id)
    // {
    //     $reservation = Reservation::where('user_id', auth()->id())->findOrFail($id);

    //     if ($reservation->status !== 'completed') {
    //         return back()->with('error', 'Only completed reservations can be reviewed.');
    //     }

    //     return view('user.reservations.feedback', compact('reservation'));
    // }

    // public function submitFeedback(Request $request, $id)
    // {
    //     $request->validate([
    //         'rating' => 'required|integer|min:1|max:5',
    //         'comments' => 'nullable|string|max:500',
    //     ]);

    //     $reservation = Reservation::where('user_id', auth()->id())->findOrFail($id);

    //     if ($reservation->status !== 'completed') {
    //         return back()->with('error', 'Only completed reservations can be reviewed.');
    //     }

    //     // Save feedback logic here (e.g., save to a Feedback model)

    //     return redirect()->route('user.reservations.index')
    //         ->with('success', 'Thank you for your feedback!');
    // }

    // public function reservationCancellationPolicy()
    // {
    //     // Return a view with cancellation policy details
    //     return view('user.reservations.cancellation_policy');
    // }

    // public function reservationTermsAndConditions()
    // {
    //     // Return a view with terms and conditions
    //     return view('user.reservations.terms_and_conditions');
    // }

    // public function reservationPrivacyPolicy()
    // {
    //     // Return a view with privacy policy details
    //     return view('user.reservations.privacy_policy');
    // }

    // public function reservationContactSupport()
    // {
    //     // Return a view with contact support details
    //     return view('user.reservations.contact_support');
    // }

    // public function reservationFAQs()
    // {
    //     // Return a view with frequently asked questions
    //     return view('user.reservations.faqs');
    // }

    // public function reservationNotifications()
    // {
    //     // Return a view with reservation notifications
    //     return view('user.reservations.notifications');
    // }

    // public function reservationSettings()
    // {
    //     // Return a view with reservation settings
    //     return view('user.reservations.settings');
    // }

    // public function reservationHelp()
    // {
    //     // Return a view with reservation help and support
    //     return view('user.reservations.help');
    // }
    // public function reservationHistoryDetails($id)
    // {
    //     $reservation = Reservation::with(['room', 'services'])
    //         ->where('user_id', auth()->id())
    //         ->findOrFail($id);

    //     return view('user.reservations.history_details', compact('reservation'));
    // }

    // public function reservationUpcoming()
    // {
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->whereDate('check_in', '>=', now())
    //         ->orderBy('check_in', 'asc')
    //         ->paginate(10);

    //     return view('user.reservations.upcoming', compact('reservations'));
    // }

    // public function reservationPast()
    // {
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->whereDate('check_out', '<', now())
    //         ->orderBy('check_out', 'desc')
    //         ->paginate(10);

    //     return view('user.reservations.past', compact('reservations'));
    // }

    // public function reservationPending()
    // {
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->where('status', 'pending')
    //         ->orderBy('check_in', 'asc')
    //         ->paginate(10);

    //     return view('user.reservations.pending', compact('reservations'));
    // }

    // public function reservationConfirmed()
    // {
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->where('status', 'confirmed')
    //         ->orderBy('check_in', 'asc')
    //         ->paginate(10);

    //     return view('user.reservations.confirmed', compact('reservations'));
    // }

    // public function reservationCancelled()
    // {
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->where('status', 'cancelled')
    //         ->orderBy('check_in', 'asc')
    //         ->paginate(10);

    //     return view('user.reservations.cancelled', compact('reservations'));
    // }

    // public function reservationCheckedOut()
    // {
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->where('status', 'checked_out')
    //         ->orderBy('check_in', 'asc')
    //         ->paginate(10);

    //     return view('user.reservations.checked_out', compact('reservations'));
    // }

    // public function reservationDetailsByStatus($status)
    // {
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->where('status', $status)
    //         ->orderBy('check_in', 'asc')
    //         ->paginate(10);

    //     return view('user.reservations.details_by_status', compact('reservations', 'status'));
    // }

    // public function reservationSearch(Request $request)
    // {
    //     $search = $request->input('search');
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->where(function ($query) use ($search) {
    //             $query->where('room_name', 'like', "%{$search}%")
    //                 ->orWhere('status', 'like', "%{$search}%");
    //         })
    //         ->orderBy('check_in', 'asc')
    //         ->paginate(10);

    //     return view('user.reservations.search_results', compact('reservations', 'search'));
    // }
    // public function reservationFilter(Request $request)
    // {
    //     $status = $request->input('status');
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->when($status, function ($query) use ($status) {
    //             $query->where('status', $status);
    //         })
    //         ->orderBy('check_in', 'asc')
    //         ->paginate(10);

    //     return view('user.reservations.filter_results', compact('reservations', 'status'));
    // }

    // public function reservationSort(Request $request)
    // {
    //     $sortBy = $request->input('sort_by', 'check_in');
    //     $sortOrder = $request->input('sort_order', 'asc');

    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->orderBy($sortBy, $sortOrder)
    //         ->paginate(10);

    //     return view('user.reservations.sort_results', compact('reservations', 'sortBy', 'sortOrder'));
    // }

    // public function reservationExport(Request $request)
    // {
    //     $format = $request->input('format', 'csv');
    //     $reservations = Reservation::where('user_id', auth()->id())
    //         ->orderBy('check_in', 'asc')
    //         ->get();

    //     if ($format === 'csv') {
    //         $filename = 'reservations_' . now()->format('Y_m_d_H_i_s') . '.csv';
    //         $handle = fopen('php://output', 'w');
    //         fputcsv($handle, ['ID', 'Room Name', 'Check In', 'Check Out', 'Status']);

    //         foreach ($reservations as $reservation) {
    //             fputcsv($handle, [
    //                 $reservation->id,
    //                 $reservation->room->name ?? 'N/A',
    //                 $reservation->check_in->format('Y-m-d'),
    //                 $reservation->check_out->format('Y-m-d'),
    //                 $reservation->status,
    //             ]);
    //         }

    //         fclose($handle);
    //         return response()->stream(
    //             function () use ($handle) {
    //                 fclose($handle);
    //             },
    //             200,
    //             [
    //                 'Content-Type' => 'text/csv',
    //                 'Content-Disposition' => "attachment; filename=\"$filename\"",
    //             ]
    //         );
    //     } elseif ($format === 'pdf') {
    //         // Generate PDF logic here
    //     }

    //     return back()->with('error', 'Invalid export format selected.');
    // }

    

}