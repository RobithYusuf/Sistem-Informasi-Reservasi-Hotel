<?php

namespace App\Console;

use App\Models\Pembayaran;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->call(function () {
        //     $this->checkPendingPayments();
        // })->hourly();
    }

    protected function checkPendingPayments()
    {
        // $pendingPayments = Pembayaran::where('status', 'unpaid')->get(); // Sesuaikan query sesuai kebutuhan

        // foreach ($pendingPayments as $payment) {
        //     // Periksa status pembayaran di Midtrans
        //     $status = \Midtrans\Transaction::status($payment->kode_reservasi);

        //     if ($status->transaction_status == 'settlement') {
        //         $payment->status = 'Paid';
        //         // Lainnya, update sesuai dengan status Midtrans
        //     } elseif ($status->transaction_status == 'cancel' || $status->transaction_status == 'expire') {
        //         $payment->status = 'Cancelled';
        //     }
        //     // Lainnya, biarkan sebagai 'unpaid' atau sesuaikan

        //     $payment->save();
        // }
    }
    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
