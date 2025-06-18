<?php

// TeamMember.php model

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class TeamMember extends Model
{
    protected $fillable = [
        'name', 'position', 'description', 'image',
        'facebook', 'twitter', 'linkedin', 'order'
    ];
}
