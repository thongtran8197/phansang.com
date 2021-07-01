<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewAboutMe extends Model
{
    protected $table = 'new_about_mes';
    protected $primaryKey = 'id';
    protected $fillable = [
        'logo_image',
        'image',
        'title',
        'title_en',
        'title_fr',
        'content',
        'content_en',
        'content_fr',
        'created_at',
        'updated_at'
    ];
}
