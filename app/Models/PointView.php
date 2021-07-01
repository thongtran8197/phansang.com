<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointView extends Model
{
    protected $table = 'point_views';
    protected $primaryKey = 'id';
    protected $fillable = ['point_view', 'point_view_en', 'point_view_fr', 'created_at', 'updated_at'];
}
