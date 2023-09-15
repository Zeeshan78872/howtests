<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class mock extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'tagline',
        'desc',
        'meta_title',
        'meta_Keywords',
        'meta_description',
        'author',
        'question_per_ch',
        'title_image',
        'extra_image',
        'extra_image_1',
        'downloads',
        'shares'
    ];
    public function category()
    {
        return $this->hasMany(mock_category::class, 'mock_id');
    }
    public function getRouteKeyName()
    {
        return 'slug'; // Replace with the actual column name you want to use as the route key
    }
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($value);
    }
}
