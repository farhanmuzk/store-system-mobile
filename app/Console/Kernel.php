<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Notification;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Jadwalkan pembersihan notifikasi rejected
        $schedule->call(function () {
            Notification::where('type', 'notification_order')
                ->where('status', 'rejected')
                ->where('updated_at', '<=', now()->subDays(2))
                ->delete();
        })->daily(); // atau ->hourly() jika ingin lebih cepat
    }
}
