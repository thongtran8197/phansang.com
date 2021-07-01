<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'studios';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'name_en',
        'name_fr',
        'link_studio',
        'public_id',
        'type',
        'created_at',
        'updated_at'
    ];
}
