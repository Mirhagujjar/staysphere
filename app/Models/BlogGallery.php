<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogGallery extends Model
{
     use HasFactory;

    protected $fillable = ['blog_id', 'image_path', 'alt_text', 'order'];
}
