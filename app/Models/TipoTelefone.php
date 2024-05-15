<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class TipoTelefone extends Model
{
    protected $hidden = [];
    protected $appends = [];

    public function telefoneRelationship()
    {
        return $this->hasMany(Telefone::class, 'tipo_telefone_id');
    }
}
