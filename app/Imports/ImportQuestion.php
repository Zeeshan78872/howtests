<?php

namespace App\Imports;

use App\Models\question;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ImportQuestion implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $category_id;

    public function __construct($category_id)
    {
        $this->category_id = $category_id;
    }
    public function model(array $row)
    {
        if (
            isset($row['question'])
            && isset($row['opt_a'])
            && isset($row['opt_b'])
            || isset($row['opt_c'])
            || isset($row['opt_d'])
            && isset($row['answer'])
            || isset($row['explanation'])

        ) {
            return new question([
                'category_id' => $this->category_id,
                'question' => $row['question'],
                'opt_a' => $row['opt_a'],
                'opt_b' => $row['opt_b'],
                'opt_c' => $row['opt_c'],
                'opt_d' => $row['opt_d'],
                'answer' => $row['answer'],
                'explanation' => $row['explanation'],
            ]);
        } else {
            \Log::debug('Row Data with Missing Keys:', $row);
            return null;
        }
    }
}
