<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'information';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'phone_number', 'gmail', 'address', 'link_fb', 'link_instagram', 'link_twitter', 'birthday', 'country', 'graduation', 'created_at', 'updated_at'];
}
