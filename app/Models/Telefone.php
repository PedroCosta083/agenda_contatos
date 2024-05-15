<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Telefone extends Model
{
    protected $hidden = [];
    protected $appends = [];

    public function contatoRelationship()
    {
        return $this->belongsTo(Contato::class, 'contato_id');
    }
    public function tipotelefoneRelationship()
    {
        return $this->belongsTo(TipoTelefone::class, 'tipo_telefone_id');
    }
}
