<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image',
        'name',
        'name_en',
        'name_fr',
        'description',
        'description_en',
        'description_fr',
        'link',
        'created_at',
        'updated_at'
    ];
}
