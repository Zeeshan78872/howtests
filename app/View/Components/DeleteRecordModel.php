<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteRecordModel extends Component
{
    public $action, $model_id;
    /**
     * Create a new component instance.
     */
    public function __construct($action, $model_id)
    {
        $this->action = $action;
        $this->model_id = $model_id;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-record-model');
    }
}
