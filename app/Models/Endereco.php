<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
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


    /*****  Setters *****/


    /** Set the endereco's id.     *
     * @return void
     */
    public function setContatoAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['contato_id'] = Contato::where('id', $value)->first()->id;
        }
    }
}
