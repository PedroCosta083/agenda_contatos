<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($contato) ? 'Editar Contato' : 'Adicionar Contato' }}</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-blue-200 flex flex-col justify-center items-center gap-4 ">

    <div>
        @if (isset($contato))
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-xl"
                action="{{ route('contato.update', [$contato->id]) }}" method="POST">
                @method('put')
            @else
                <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-full max-w-xl"
                    action="{{ route('contato.store') }}" method="POST">
        @endif
        @csrf
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nome">Nome</label>
            <input {{ isset($form) ? $form : '' }}
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ $contato->nome ?? '' }}" name='nome' id='nome' type="text" required>
        </div>

        @unless (isset($form))
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="telefoneInput">Número de Telefone:</label>
                <div class="flex flex-row items-center">
                    <input {{ isset($form) ? $form : '' }}
                        class="shadow appearance-none border rounded w-1/2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        type="number" id="telefoneInput" placeholder="Digite o número de telefone">
                    <button {{ isset($form) ? $form : '' }}
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" type="button"
                        onclick="adicionarTelefone()">Adicionar</button>
                </div>
            </div>
        @endunless

        <table class="w-full mb-4" id="tabelaContatos">
            <thead>
                <tr>
                    <th class="px-4 py-2">Número de Telefone</th>
                    <th class="px-4 py-2">Tipo</th>
                    <th class="px-4 py-2">Excluir</th>
                </tr>
            </thead>
            <tbody id="tbodyTelefones">
                @isset($contato->telefone)
                    @foreach ($contato->telefone as $telefone)
                        <tr>
                            <td><input {{ isset($form) ? $form : '' }}
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    type="number" name="telefone[]" value="{{ $telefone->numero }}" required></td>
                            <td>
                                <select {{ isset($form) ? $form : '' }}
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    name="tipotelefone[]" required>
                                    @foreach ($tipos_telefones as $key => $tipoTelefone)
                                        <option value="{{ $key }}"
                                            {{ $telefone->tipotelefone->id == $key ? 'selected' : '' }}>
                                            {{ $tipoTelefone }}
                                        </option>
                                    @endforeach

                                </select>
                            </td>
                            <td>
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"
                                    type="button"
                                    onclick="excluirTelefone({{ isset($form) ? null . ',' : $telefone->id . ',' }} this)">Excluir</button>
                            </td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>

        <div class="mb-4">
            @foreach ($categorias as $key => $categoria)
                <label class="inline-flex items-center">
                    <input {{ isset($form) ? $form : '' }} type="checkbox" class="form-checkbox h-5 w-5 text-blue-600"
                        name="categoria[]" value="{{ $key }}"
                        {{ $checked = (isset($contato->categoria) ? $contato->categoria->contains($key) : false) ? 'checked' : '' }}
                        {{ isset($form) ? 'disabled' : '' }}>
                    <span class="ml-2 text-gray-700">{{ $categoria }}</span>
                </label>
            @endforeach
        </div>

        <div class="mb-4">
            <label {{ isset($form) ? $form : '' }}class="block text-gray-700 text-sm font-bold mb-2"
                for="logradouro">Logradouro</label>
            <input {{ isset($form) ? $form : '' }}
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ $contato->endereco->logradouro ?? '' }}" name='logradouro' id='logradouro' type="text"
                required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="ncasa">N° Casa</label>
            <input {{ isset($form) ? $form : '' }}
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ $contato->endereco->numero ?? '' }}" name='numero' id ='numero' type="text" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="cidade">Cidade</label>
            <input {{ isset($form) ? $form : '' }}
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                value="{{ $contato->endereco->cidade ?? '' }}" name='cidade' id='cidade' type="text" required>
        </div>
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="cep">Cep</label>
            <input {{ isset($form) ? $form : '' }}
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus
            focus
            "
                value="{{ $contato->endereco->cep ?? '' }}" name='cep' id='cep' type="text" required>
        </div>
        <div class="flex items-center justify-between">
            <button {{ isset($form) ? $form : '' }}
                class="bg-blue-500 hover
            text-white font-bold py-2 px-4 rounded" type="submit"
                {{ isset($form) ? $form : null }}>Enviar</button>
            @if (isset($form))
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"
                    href="{{ isset($contato) ? route('contato.edit', $contato->id) : null }}">Editar</a>
            @endif
            <a class="bg-blue-500 hover text-white font-bold py-2 px-4 rounded" href="{{ route('contato.index') }}"
                {{ isset($form) ? $form : null }}>Voltar</a>

        </div>
        </form>
        @if (isset($contato))
            <form action="{{ route('contato.destroy', [$contato->id]) }}" method="POST">
                @csrf
                @method('delete')
                <button class="bg-red-500 hover text-white font-bold py-2 px-4 rounded" type="submit"
                    {{ isset($form) ? $form : null }}>Excluir Contato</button>
            </form>
        @endif
        <form id = "formExcluirTelefone" action = "" method = "POST" style = "display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>

    <script>
        function adicionarTelefone() {
            var tabela = document.getElementById("tbodyTelefones");
            var rowCount = tabela.rows.length;
            if (rowCount >= 2) {
                alert("Você já adicionou o número máximo de telefones.");
                return;
            }
            var telefoneInput = document.getElementById("telefoneInput");
            var telefone = telefoneInput.value.trim();
            if (telefone != '' && !verificarNumero(telefone)) {
                var newRow = document.createElement("tr");
                newRow.innerHTML = `
            <td><input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" type="number" name="telefone[]" value="${telefone}" required></td>
            <td>
                <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="tipotelefone[]" required>
                    @foreach ($tipos_telefones as $key => $tipoTelefone)
                        <option value="{{ $key }}"> {{ $tipoTelefone }}</option>
                    @endforeach
                </select>
            </td>
            <td><button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" type="button" onclick="excluirTelefone(${null},this)">Excluir</button></td>
        `;
                document.getElementById("tbodyTelefones").appendChild(newRow);
                telefoneInput.value = "";
            } else {
                alert("Por favor, insira um número de telefone");
            }
        }


        function verificarNumero(numero) {
            var tabela = document.getElementById("tabelaContatos");
            var inputs = tabela.querySelectorAll("input[name='telefone[]']");
            for (var i = 0; i < inputs.length; i++) {
                if (inputs[i].value.trim() === numero.trim()) {
                    alert('O número já existe.');
                    return true;
                }
            }
            return false;
        }

        function excluirTelefone(id, object) {
            console.log('id', id)
            console.log('object', object)
            if (id != null) {
                if (confirm("Tem certeza de que deseja excluir este telefone?")) {
                    document.getElementById("formExcluirTelefone").action = "{{ route('telefone.destroy', ':id') }}"
                        .replace(':id', id);
                    document.getElementById("formExcluirTelefone").submit();
                }
            } else {
                var row = object.closest("tr");
                row.remove();
            }
        }
    </script>

    @vite('resources/js/app.js')
</body>

</html>
