<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contacts';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'phone_number', 'message', 'email'];
}
