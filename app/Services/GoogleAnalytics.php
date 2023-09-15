<?php

namespace App\Services;

use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Str;

class Trending
{
    protected $analytics;
    public function __construct(Analytics $analytics)
    {
        $this->analytics = $analytics;
    }

    protected function getResults($days, $limit = 15)
    {
        return $this->analytics->fetchMostVisitedPages(Period::days($days), $limit);
    }
}
