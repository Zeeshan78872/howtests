<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserDetailModel extends Component
{
    public $ModelID, $DownloadBy, $id;
    /**
     * Create a new component instance.
     */
    public function __construct($ModelID, $DownloadBy)
    {
        $this->ModelID = $ModelID;
        $this->DownloadBy = $DownloadBy;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-detail-model');
    }
}