<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'collections';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'name_en',
        'name_fr',
        'description',
        'description_en',
        'description_fr',
        'created_at',
        'updated_at',
        'main_post_id'
    ];

    public function posts()
    {
        return $this->hasMany(Post::class, "collection_id", "id");
    }
}
