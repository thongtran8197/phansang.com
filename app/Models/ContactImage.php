<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactImage extends Model
{
    protected $table = 'contact_image';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image',
    ];
}
