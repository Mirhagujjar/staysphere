<?php

// Faq.php model

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Faq extends Model
{
    protected $fillable = ['question', 'answer', 'order'];
}
