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
    protected $hidden = ['categoriaRelationship', 'enderecoRelationship', 'telefoneRelationship', 'created_at', 'updated_at'];
    /**
     * The accessors to append to the model's array from.
     *
     * @var array
     */
    protected $appends = ['categoria', 'endereco', 'telefone'];

    protected $fillable = ["nome"];



    /***** Getters ******/


    /**   Get Categoria attribute.   *
     * @return string
     */
    public function getCategoriaAttribute()
    {
        return $this->categoriaRelationship;
    }

    /**   Get Endereco attribute.     *
     * @return string
     */
    public function getEnderecoAttribute()
    {
        return $this->enderecoRelationship;
    }

    /** Get Telefone attribute.    *
     * @return string
     */

    public function getTelefoneAttribute()
    {
        return $this->telefoneRelationship;
    }

    /***** Setters ******/

    public function setCategoriaAttribute($value)
    {
        $this->categoriaRelationship()->sync($value);
    }

    /***** Relationships ******/

    /** Get the Categoria that belong to the contato.   *
     * @return Categoria
     */
    public function categoriaRelationship()
    {
        return $this->belongsToMany(Categoria::class, 'contatos_has_categorias', 'contato_id', 'categoria_id');
    }


    /** Get the Endereco that owns the contato.     *
     * @return Endereco
     */
    public function enderecoRelationship()
    {
        return $this->hasOne(Endereco::class, 'contato_id');
    }
    /** Get the Telefone that belong to the contato.   *
     * @return Telefone
     */
    public function telefoneRelationship()
    {
        return $this->hasMany(Telefone::class, 'contato_id');
    }





}
