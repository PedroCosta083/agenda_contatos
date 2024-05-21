<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            margin: 10px;
            width: 300px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }

        .card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <h1>Meus Contatos</h1>
    <div class="container">
        @foreach ($contatos as $contato)
            <div class="card">
                <h3>
                    Nome: {{ $contato->nome }}
                </h3>
                <p><strong>Categoria:</strong>
                    {{ $add = $contato->categoria->isNotEmpty() ? $contato->categoria->pluck('titulo')->implode(', ') : '' }}
                </p>
                <p><strong>Endereço:</strong> {{ $contato->endereco->logradouro }},
                    {{ $contato->endereco->numero }} - {{ $contato->endereco->cidade }}</p>
                <p><strong>Telefone:</strong> {{ $contato->telefone->pluck('numero')->implode(',') }}</p>

            </div>
        @endforeach
    </div>
</body>

</html>
