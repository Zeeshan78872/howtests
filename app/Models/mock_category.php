<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mock_category extends Model
{
    use HasFactory;
    protected $fillable =[
        'mock_id',
        'category_id',
        'select_question'
    ];
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}