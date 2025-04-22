<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeaderReview extends Model
{
    protected $table = 'headers';

    protected $fillable = ['title', 'description', 'image'];
}
