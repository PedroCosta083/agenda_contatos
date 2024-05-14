<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    protected $hidden = [];
    protected $appends = [];
    public function contatoRelationship(){
        return $this->belongsTo(Contato::class,'contato_id');
    }
}
