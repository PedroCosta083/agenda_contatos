<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen">
    <div class="container mx-auto p-6 h-screen">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Meus Contatos</h1>
            <a href="{{ route('contato.create') }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Novo Contato</a>
        </div>
        <table class="table-auto w-full">
            <thead>
                <tr class="border-b border-gray-200 text-left">
                    <th class="px-4 py-2">Nome</th>
                    <th class="px-4 py-2">Categoria</th>
                    <th class="px-4 py-2">Endereço</th>
                    <th class="px-4 py-2">Telefones</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contatos as $contato)
                    <tr class="border-b border-gray-200">
                        <td class="px-4 py-2 text-left">{{ $contato->nome }}</td>
                        <td class="px-4 py-2 text-left">
                            {{ $contato->categoria->isNotEmpty() ? $contato->categoria->pluck('titulo')->implode(', ') : '' }}
                        </td>
                        <td class="px-4 py-2 text-left">{{ $contato->endereco->logradouro }},
                            {{ $contato->endereco->numero }} -
                            {{ $contato->endereco->cidade }}</td>
                        <td class="px-4 py-2 text-left">{{ $contato->telefone->pluck('numero')->implode(' - ') }}</td>
                        <td class="px-4 py-2">
                            <a href="{{ route('contato.edit', $contato->id) }}"
                                class="text-blue-500 hover:text-blue-700 mr-2">Editar</a>
                            <a href="{{ route('contato.show', $contato->id) }}"
                                class="text-blue-500 hover:text-blue-700 mr-2">Exibir</a>
                            <form action="{{ route('contato.destroy', $contato->id) }}" method="POST"
                                onsubmit="return confirm('Tem certeza que deseja excluir este contato?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="text-red-600 hover:text-red-700 focus:outline-none">Excluir</button>
                            </form>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="5" class="bg-gray-100 h-1"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @vite('resources/js/app.js')
</body>

</html>
