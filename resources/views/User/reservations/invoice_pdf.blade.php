<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice #{{ $reservation->id }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            line-height: 1.6;
        }
        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 40px;
        }
        .hotel-name {
            font-size: 24px;
            font-weight: bold;
            color: #4f46e5;
            margin-bottom: 5px;
        }
        .invoice-title {
            font-size: 20px;
            margin: 20px 0;
            color: #333;
        }
        .status-badge {
            font-size: 0.8rem;
            padding: 0.4rem 0.9rem;
            border-radius: 50px;
            font-weight: 500;
            display: inline-block;
            margin-bottom: 10px;
        }
        .status-confirmed {
            background-color: #e6f7ee;
            color: #28a745;
        }
        .section {
            margin-bottom: 30px;
        }
        .section-title {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 5px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        .row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }
        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .total-table {
            width: 60%;
            margin-left: auto;
            border: 1px solid #ddd;
        }
        .total-table td {
            padding: 8px 15px;
        }
        .total-table tr:last-child td {
            font-weight: bold;
            font-size: 1.1em;
            border-top: 2px solid #333;
        }
        .text-right {
            text-align: right;
        }
        .footer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="hotel-name">Your Hotel Name</div>
            <div>123 Hotel Street, City, Country</div>
            <div>Phone: +123 456 7890 | Email: info@hotel.com</div>
            
            <h2 class="invoice-title">
                @if($reservation->is_parent)
                    Group Reservation Invoice #{{ $reservation->id }}
                @else
                    Reservation Invoice #{{ $reservation->id }}
                @endif
            </h2>
            
            <span class="status-badge status-{{ str_replace(' ', '_', $reservation->status) }}">
                {{ ucfirst($reservation->status) }}
            </span>
            
            <div>Invoice Date: {{ now()->format('d M Y') }}</div>
        </div>

        <!-- Guest and Reservation Info -->
        <div class="section">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="section-title">Guest Information</h3>
                    <p><strong>Name:</strong> {{ $reservation->name }}</p>
                    <p><strong>Email:</strong> {{ $reservation->email }}</p>
                    <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                </div>
                <div class="col-md-6">
                    <h3 class="section-title">Reservation Dates</h3>
                    <p><strong>Check-in:</strong> {{ $reservation->check_in->format('d M Y, h:i A') }}</p>
                    <p><strong>Check-out:</strong> {{ $reservation->check_out->format('d M Y, h:i A') }}</p>
                    <p><strong>Duration:</strong> {{ $reservation->check_in->diffInDays($reservation->check_out) }} nights</p>
                </div>
            </div>
        </div>

        <!-- Room Details -->
        <div class="section">
            <h3 class="section-title">Room Details</h3>
            @if($reservation->is_parent)
                <!-- Group Reservation Rooms -->
                <table>
                    <thead>
                        <tr>
                            <th>Room Type</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Room Name</th>
                            <th>Price/Night</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reservation->children as $child)
                        <tr>
                            <td>{{ $child->room_type }}</td>
                            <td>{{ $child->guests }}</td>
                            <td>
                                @if($child->room)
                                    <span style="color: #28a745;">Assigned</span>
                                @else
                                    <span style="color: #ffc107;">Pending</span>
                                @endif
                            </td>
                            <td>{{ $child->room->room_name ?? '-' }}</td>
                            <td>Rs {{ number_format($child->room->price ?? 0, 2) }}</td>
                            <td>Rs {{ number_format(($child->room->price ?? 0) * $reservation->check_in->diffInDays($reservation->check_out), 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <!-- Single Reservation Room -->
                <table>
                    <thead>
                        <tr>
                            <th>Room Type</th>
                            <th>Guests</th>
                            <th>Status</th>
                            <th>Room Name</th>
                            <th>Price/Night</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $reservation->room_type }}</td>
                            <td>{{ $reservation->guests }}</td>
                            <td>
                                @if($reservation->room)
                                    <span style="color: #28a745;">Assigned</span>
                                @else
                                    <span style="color: #ffc107;">Pending</span>
                                @endif
                            </td>
                            <td>{{ $reservation->room->room_name ?? '-' }}</td>
                            <td>Rs {{ number_format($reservation->room->price ?? 0, 2) }}</td>
                            <td>Rs {{ number_format(($reservation->room->price ?? 0) * $reservation->check_in->diffInDays($reservation->check_out), 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>

        <!-- Services -->
        @if($reservation->services->count() > 0)
        <div class="section">
            <h3 class="section-title">Additional Services</h3>
            <table>
                <thead>
                    <tr>
                        <th>Service</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reservation->services as $service)
                    <tr>
                        <td>{{ $service->title }}</td>
                        <td>Rs {{ number_format($service->price, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- Pricing Summary -->
        <div class="section">
            <h3 class="section-title">Pricing Summary</h3>
            <table class="total-table">
                @if($reservation->is_parent)
                    @php
                        $roomTotal = $reservation->children->sum(function($child) use ($reservation) {
                            return ($child->room ? $child->room->price : 0) * $reservation->check_in->diffInDays($reservation->check_out);
                        });
                    @endphp
                @else
                    @php
                        $roomTotal = ($reservation->room ? $reservation->room->price : 0) * $reservation->check_in->diffInDays($reservation->check_out);
                    @endphp
                @endif
                
                @php
                    $servicesTotal = $reservation->services->sum('price');
                    $subtotal = $roomTotal + $servicesTotal;
                    $tax = $subtotal * 0.10;
                    $grandTotal = $subtotal + $tax;
                @endphp
                
                <tr>
                    <td>Room Charges:</td>
                    <td class="text-right">Rs {{ number_format($roomTotal, 2) }}</td>
                </tr>
                <tr>
                    <td>Services:</td>
                    <td class="text-right">Rs {{ number_format($servicesTotal, 2) }}</td>
                </tr>
                <tr>
                    <td>Subtotal:</td>
                    <td class="text-right">Rs {{ number_format($subtotal, 2) }}</td>
                </tr>
                <tr>
                    <td>Tax (10%):</td>
                    <td class="text-right">Rs {{ number_format($tax, 2) }}</td>
                </tr>
                <tr>
                    <td><strong>Total:</strong></td>
                    <td class="text-right"><strong>Rs {{ number_format($grandTotal, 2) }}</strong></td>
                </tr>
            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Thank you for choosing our hotel! We look forward to serving you.</p>
            <p>For any inquiries, please contact us at info@hotel.com or +123 456 7890.</p>
            <p class="text-muted">Invoice generated on: {{ now()->format('d M Y H:i') }}</p>
        </div>
    </div>
</body>
</html>