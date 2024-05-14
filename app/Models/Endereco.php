<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $hidden = [];
    protected $appends = [];
    public function contatoRelationship(){
        return $this->hasOne(Contato::class,'contato_id');
    }
}
