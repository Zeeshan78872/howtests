<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class files extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'desc',
        'QperCh',
        'image',
    ];

    public function question()
    {
        return $this->hasMany(question::class, 'file_id');
    }
}