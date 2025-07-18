<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPageSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'banner_heading',
    'breadcrumb',
    'left_section_text',
    'right_section_address',
    'right_section_phone',
    'right_section_email',
    'half_page_image',
    'contact_section_image',
    'contact_info_heading',
    ];
}
