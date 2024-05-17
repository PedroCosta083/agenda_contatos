<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    /**
     * The attributes that should be hidden for arrays
     *
     * @var string
     */
    protected $hidden = ['tipotelefoneRelationship', 'created_at', 'updated_at'];
    /**
     * The accessors to append to the model's array from.
     *
     * @var array
     */
    protected $appends = ['tipotelefone'];



    /*****  Getters *****/

    /**
     * Get TipoTelefone attribute.
     *
     * @return string
     */
    public function getTipoTelefoneAttribute()
    {
        return $this->tipotelefoneRelationship;
    }



    /*****  Setters *****/

    /** Set the telefones's id.     *
     * @return void
     */
    public function setContatoAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['contato_id'] = Contato::where('id', $value)->first()->id;
        }
    }

    public function setTipoTelefoneAttribute($value)
    {
        if (isset($value)) {
            $this->attributes['tipo_telefone_id'] = TipoTelefone::where('id', $value)->first()->id;
        }

    }

    /*****  Relationships *****/


    /**
     * Get the TipoTelefone that owns the telefone.
     *
     * @return TipoTelefone
     */

    public function tipotelefoneRelationship()
    {
        return $this->belongsTo(TipoTelefone::class, 'tipos_telefone_id');
    }

}
