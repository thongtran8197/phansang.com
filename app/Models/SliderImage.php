<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SliderImage extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'slider_images';
    protected $primaryKey = 'id';
    protected $fillable = ['image', 'public_id', 'created_at', 'updated_at'];
}
