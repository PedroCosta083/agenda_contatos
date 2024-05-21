<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Models\Contato;
use App\Models\Endereco;
use App\Models\Telefone;
use App\Models\TipoTelefone;

class ContatoController extends Controller
{
    public function __construct(Contato $contatos)
    {
        $this->contatos = $contatos;
        $this->categorias = Categoria::all()->pluck('titulo', 'id');
        $this->enderecos = new Endereco;
        $this->telefones = new Telefone;
        $this->tipos_telefones = TipoTelefone::all()->pluck('titulo', 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contatos = $this->contatos->all();
        return view('contato.index', compact('contatos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = $this->categorias;
        $enderecos = $this->enderecos;
        $telefones = $this->telefones;
        return view('contato.form', compact('categorias', 'telefones', 'enderecos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contato = $this->contatos->create([
            'nome' => $request->nome,
        ]);

        $contato_id = $contato->id;
        $this->enderecos->create([
            'logradouro' => $request->logradouro,
            'numero' => $request->numero,
            'cidade' => $request->cidade,
            'cep' => $request->cep,
            'contato_id' => $contato_id,
        ]);

        for ($i = 0; $i < count($request->telefone); $i++) {
            $this->telefones->create([
                'numero' => $request->telefone[$i],
                'contato_id' => $contato_id,
                'tipo_telefone_id' => $request->tipotelefone[$i],
            ]);
        }
        for ($i = 0; $i < count($request->categoria); $i++) {
            $contato->categoriaRelationship()->attach($request->categorias[$i]);
        }

        return redirect()->route('contato.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = 'disabled';
        $contato = $this->contatos->find($id);
        $categorias = $this->categorias;
        $tipos_telefones = $this->tipo_telefone;
        return view('contato.form', compact('categorias', 'tipo_telefone', 'form', 'contato'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contato = $this->contatos->find($id);
        $categorias = $this->categorias;
        $tipos_telefones = $this->tipos_telefones;

        return view('contato.form', compact('categorias', 'tipos_telefones', 'contato'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contato = $this->contatos->find($id);
        $contato->update([
            'nome' => $request->nome,
            // de forma usual poderiamos utilizar apenas tap($contato->endereco,update({...}))
            tap($this->enderecos->find($contato->endereco->id))->update([
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'cidade' => $request->cidade,
                'cep' => $request->cep,
                'contato_id' => $request->$id,
            ])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contato = $this->contatos->find($id);
        $contato->telefone->delete();
        $contato->endereco->delete();
        $contato->categoria->delete();
        $contato->delete();
        return redirect()->route('contato.index');
    }
}
