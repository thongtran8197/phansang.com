<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    protected $table = 'about_me';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image_about',
        'image_event',
        'image_book',
        'image_about_1',
        'image_about_2',
        'image_about_3',
        'description',
        'description_en',
        'description_fr',
        'created_at',
        'updated_at'
    ];
}
