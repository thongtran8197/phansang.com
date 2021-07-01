<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudioInfo extends Model
{
    protected $table = 'studio_info';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image',
        'description',
        'description_en',
        'description_fr',
        'created_at',
        'updated_at'
    ];
}
