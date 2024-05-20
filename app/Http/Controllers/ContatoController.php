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
        return view('contato', compact('contatos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        dd($request);
        $categorias = $this->categorias;
        $enderecos = $this->enderecos;
        $telefones = $this->telefones;
        return view('contato_create', compact('categorias', 'telefones', 'enderecos'));
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
            'logadouro' => $request->logadouro,
            'numero' => $request->numero,
            'cidade' => $request->cidade,
            'contato_id' => $contato_id,
        ]);

        for ($i = 0; $i < count($request->telefone); $i++) {
            $this->telefones->create([
                'numero' => $request->telefone[$i],
                'contato_id' => $contato_id,
                'tipo_telefone_id' => $request->tipotelefone[$i],
            ]);
        }
        /*
          foreach ($request->telefones as $telefone_data) {
            $this->telefones->create([
                'contato_id' => $contato_id,
                'numero' => $telefone_data['numero'],
                'tipo_telefone_id' => 0,
            ]);
        }
        */


        $contato->categoria()->attach($request->categorias);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
