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
    protected $hidden = [];
    /**
     * The accessors to append to the model's array from.
     *
     * @var array
     */
    protected $appends = [];

    /**
     * Get the TipoTelefone that owns the telefone.
     *
     * @return TipoTelefone
     */
    public function tipotelefoneRelationship()
    {
        return $this->belongsTo(TipoTelefone::class, 'tipo_telefone_id');
    }
}
