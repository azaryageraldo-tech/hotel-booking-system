<?php

    namespace App\Exports;

    use App\Models\Booking;
    use Maatwebsite\Excel\Concerns\FromCollection;
    use Maatwebsite\Excel\Concerns\WithHeadings;
    use Maatwebsite\Excel\Concerns\WithMapping;
    use Carbon\Carbon;

    class BookingsExport implements FromCollection, WithHeadings, WithMapping
    {
        protected $startDate;
        protected $endDate;

        public function __construct($startDate, $endDate)
        {
            $this->startDate = $startDate;
            $this->endDate = $endDate;
        }

        /**
        * @return \Illuminate\Support\Collection
        */
        public function collection()
        {
            // Ambil data booking sesuai rentang tanggal
            return Booking::with(['user', 'room'])
                ->whereIn('status', ['confirmed', 'checked-in', 'completed'])
                ->whereBetween('check_in_date', [$this->startDate, $this->endDate])
                ->get();
        }

        /**
         * Mendefinisikan header untuk setiap kolom di Excel.
         */
        public function headings(): array
        {
            return [
                'ID Booking',
                'Nama Tamu',
                'Email Tamu',
                'Tipe Kamar',
                'No. Kamar',
                'Check-in',
                'Check-out',
                'Total Harga',
                'Status',
            ];
        }

        /**
         * Memetakan data dari collection ke format yang diinginkan.
         */
        public function map($booking): array
        {
            return [
                $booking->id,
                $booking->user->name,
                $booking->user->email,
                $booking->room->type,
                $booking->room->room_number,
                Carbon::parse($booking->check_in_date)->format('d-m-Y'),
                Carbon::parse($booking->check_out_date)->format('d-m-Y'),
                $booking->total_price,
                ucfirst($booking->status),
            ];
        }
    }
    