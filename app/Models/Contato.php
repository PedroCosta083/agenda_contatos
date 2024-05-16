<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
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
     * Get Categoria attribute.
     *
     * @return string
     */
    public function getCategoriaAttribute()
    {
        return $this->categoriaRelationship;
    }
    /**
     * Set Categoria attribute.
     *
     * @return void
     */
    public function setCategoriaAttribute($value)
    {
        $this->categoriaRelationship()->sync($value);
    }
    /**
     * Get Endereco attribute.
     *
     * @return string
     */
    public function getEnderecoAttribute()
    {
        return $this->enderecoRelationship;
    }
    /**
     * Set the endereco's id.
     *
     * @return void
     */
    public function setEnderecoAttribute($value)
    {
        $this->attributes['contato_id'] = Endereco::where('id', $value)->first()->id;
    }
    /**
     * Get Telefone attribute.
     *
     * @return string
     */
    public function getTelefoneAttribute()
    {
        return $this->telefoneRelationship;
    }
    /**
     * Set the telefone's id.
     *
     * @return void
     */
    public function setTelefoneAttribute($value)
    {
        $this->attributes['contato_id'] = Telefone::where('id', $value)->first()->id;
    }


    /**
     * Get the Categoria that belong to the contato.
     *
     * @return Categoria
     */
    public function categoriaRelationship()
    {
        return $this->belongsToMany(Categoria::class, 'contatos_has_categorias', 'contato_id', 'categoria_id');
    }


    /**
     * Get the Endereco that owns the contato.
     *
     * @return Endereco
     */
    public function enderecoRelationship()
    {
        return $this->hasOne(Endereco::class, 'contato_id');
    }
    /**
     * Get the Telefone that belong to the contato.
     *
     * @return Telefone
     */
    public function telefoneRelationship()
    {
        return $this->hasMany(Telefone::class, 'contato_id');
    }





}
