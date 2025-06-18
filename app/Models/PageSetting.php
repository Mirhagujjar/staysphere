<?php

// app/Models/PageSetting.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageSetting extends Model
{
    use HasFactory;

    protected $table = 'blog_page_settings'; // Specify your custom table name

    protected $fillable = [
        'page_name',
        'settings'
    ];

    protected $casts = [
        'settings' => 'array'
    ];
}
