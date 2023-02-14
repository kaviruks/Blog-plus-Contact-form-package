<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComment extends Model
{
    use HasFactory;
    protected $fillable = [
        'post_id',
        'parent_id',
        'title',
        'published',
        'content',
        'published_at',
    ];
}
