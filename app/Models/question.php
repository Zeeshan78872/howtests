<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'question',
        'opt_a',
        'opt_b',
        'opt_c',
        'opt_d',
        'answer',
        'explanation'
    ];

    public function category()
    {
        return $this->belongsTo(category_book::class);
    }
    public function categories()
    {
        return $this->belongsTo(category::class,'category_id');
    }
}