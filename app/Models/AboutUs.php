<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
     protected $fillable = [
        'banner_title', 'banner_subtitle', 'banner_image',
        'history_title', 'history_subtitle', 'history_content',
        'main_image', 'overlay_image', 'team_section_title',
        'team_section_subtitle', 'faq_section_title',
        'faq_section_subtitle', 'faq_contact_text'
    ];
}





