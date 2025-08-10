    <!DOCTYPE html>
    <html>
    <head>
        <title>Laporan Booking</title>
        <style>
            body { font-family: sans-serif; }
            table { width: 100%; border-collapse: collapse; }
            th, td { border: 1px solid #dddddd; text-align: left; padding: 8px; font-size: 12px; }
            th { background-color: #f2f2f2; }
            h1 { text-align: center; }
        </style>
    </head>
    <body>
        <h1>Laporan Booking HotelHebat</h1>
        <p>Periode: {{ $startDate->format('d M Y') }} - {{ $endDate->format('d M Y') }}</p>
        <table>
            <thead>
                <tr>
                    <th>Tamu</th>
                    <th>Kamar</th>
                    <th>Check-in</th>
                    <th>Check-out</th>
                    <th>Harga</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $booking)
                <tr>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->room->type }} ({{ $booking->room->room_number }})</td>
                    <td>{{ \Carbon\Carbon::parse($booking->check_in_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($booking->check_out_date)->format('d-m-Y') }}</td>
                    <td>Rp {{ number_format($booking->total_price) }}</td>
                    <td>{{ ucfirst($booking->status) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    </html>
    