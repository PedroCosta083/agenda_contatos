<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TipoTelefone extends Model
{
    /**
     * The attributes that should be hidden for arrays
     *
     * @var string
     */
    protected $hidden = ['created_at', 'updated_at'];
    /**
     * The accessors to append to the model's array from.
     *
     * @var array
     */
    protected $appends = [];

}
