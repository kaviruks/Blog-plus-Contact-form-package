<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id',
        'parent_id',
        'title',
        'meta_title',
        'image_path',
        'slug',
        'summary',
        'published',
        'content',
        'published_at',
    ];

}
