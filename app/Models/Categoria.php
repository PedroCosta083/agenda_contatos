<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $hidden = [];
    protected $appends = [];

    public function contatoRelationship(){
         return $this->belongsToMany(Contato::class,'contatos_has_categorias','categoria_id','contato_id');
    }
}
