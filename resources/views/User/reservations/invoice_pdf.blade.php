<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $reservation->id }}</title>
    <style>
        body { 
            font-family: DejaVu Sans, sans-serif; 
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #eee;
            padding-bottom: 20px;
        }
        .invoice-title {
            color: #2c3e50;
            margin-bottom: 5px;
        }
        .invoice-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            background-color: #f8f9fa;
            padding: 8px 15px;
            border-left: 4px solid #2c3e50;
            margin-bottom: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            margin-bottom: 30px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 12px;
        }
        td {
            padding: 10px 12px;
        }
        .total-section {
            margin-top: 30px;
            text-align: right;
        }
        .total-row {
            font-size: 1.1em;
            font-weight: bold;
        }
        .grand-total {
            font-size: 1.3em;
            color: #2c3e50;
            border-top: 2px solid #2c3e50;
            padding-top: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="invoice-title">INVOICE</h1>
            <p>Hotel Management System</p>
        </div>

        <div class="invoice-info">
            <div>
                <p><strong>Invoice #:</strong> {{ $reservation->id }}</p>
                <p><strong>Date:</strong> {{ now()->format('d M Y') }}</p>
            </div>
            <div>
                <p><strong>Guest Name:</strong> {{ $reservation->name }}</p>
                <p><strong>Phone:</strong> {{ $reservation->phone }}</p>
                <p><strong>Email:</strong> {{ $reservation->email }}</p>
            </div>
        </div>

        <div class="section">
            <h3 class="section-title">Reservation Details</h3>
            <table>
                <tr>
                    <th>Room</th>
                    <th>Type</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Nights</th>
                    <th>Price/Night</th>
                    <th>Subtotal</th>
                </tr>
                <tr>
                    <td>{{ $reservation->room->room_name }}</td>
                    <td>{{ $reservation->room->roomType->label ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->check_in)->format('d M Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($reservation->check_out)->format('d M Y') }}</td>
                    <td>{{ $days = \Carbon\Carbon::parse($reservation->check_in)->diffInDays($reservation->check_out) }}</td>
                    <td>Rs {{ $reservation->room->price }}</td>
                    <td>Rs {{ $roomTotal = $days * $reservation->room->price }}</td>
                </tr>
            </table>
        </div>

        <div class="section">
            <h3 class="section-title">Additional Services</h3>
            @if($reservation->services->count() > 0)
            <table>
                <tr>
                    <th>Service</th>
                    <th>Price</th>
                </tr>
                @foreach($reservation->services as $service)
                <tr>
                    <td>{{ $service->name }}</td>
                    <td>Rs {{ $service->price }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td>Services Total</td>
                    <td>Rs {{ $servicesTotal = $reservation->services->sum('price') }}</td>
                </tr>
            </table>
            @else
            <p>No additional services were selected.</p>
            @endif
        </div>

        <div class="total-section">
            <p><strong>Room Total:</strong> Rs {{ $roomTotal }}</p>
            <p><strong>Services Total:</strong> Rs {{ $servicesTotal }}</p>
            <p class="grand-total">Grand Total: Rs {{ $total = $roomTotal + $servicesTotal }}</p>
        </div>

        <div class="footer">
            <p>Thank you for choosing our hotel!</p>
            <p>For any inquiries, please contact us at support@hotelmanagement.com</p>
            <p>Invoice generated on: {{ now()->format('d M Y H:i') }}</p>
        </div>
    </div>
</body>
</html>