<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_book extends Model
{
    use HasFactory;
    protected $fillable =[
        'book_id',
        'category_id',
        'select_question'
    ];
    public function category()
    {
        return $this->belongsTo(category::class);
    }
}