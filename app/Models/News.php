<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $fillable = [
        'title',
        'title_en',
        'title_fr',
        'description',
        'description_en',
        'description_fr',
        'image',
        'link',
        'created_at',
        'updated_at'
    ];
}
