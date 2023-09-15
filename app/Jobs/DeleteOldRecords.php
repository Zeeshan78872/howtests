<?php

namespace App\Jobs;

use App\Models\book;
use App\Models\category;
use App\Models\category_book;
use App\Models\mock;
use App\Models\mock_category;
use App\Models\question;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DeleteOldRecords implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $threeMonthsAgo = Carbon::now()->subMonths(3);

        category::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
        question::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
        mock::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
        mock_category::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
        book::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
        category_book::where('delete', 1)->where('updated_at', '<', $threeMonthsAgo)->delete();
        Log::info('Deleted records older than three months.');
    }
}
