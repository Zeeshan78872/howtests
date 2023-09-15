<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\DeleteOldRecords;
use Carbon\Carbon;
use App\Models\category;
use App\Models\question;
use App\Models\mock;
use App\Models\mock_category;
use App\Models\book;
use App\Models\category_book;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            // $schedule->job(new DeleteOldRecords())->monthlyOn(Carbon::now()->day, '00:00');
            $threeMonthsAgo = Carbon::now()->subMonths(3);

            category::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
            question::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
            mock::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
            mock_category::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
            book::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
            category_book::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
        })->daily();
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
