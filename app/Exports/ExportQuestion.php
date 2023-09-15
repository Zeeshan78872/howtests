<?php

namespace App\Exports;

use App\Models\question;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportQuestion implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return question::all();
    }
}
