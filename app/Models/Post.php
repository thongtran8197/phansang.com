<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'image',
        'collection_id',
        'public_id',
        'description',
        'description_en',
        'description_fr',
        'detail',
        'detail_en',
        'detail_fr',
        'content_qr',
        'created_at',
        'updated_at',
        'name',
        'name_en',
        'name_fr'
    ];
}
