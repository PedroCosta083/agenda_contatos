<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($contato) ? 'Editar Contato' : 'Adicionar Contato' }}</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .container-checkbox {
            display: grid;
            grid-template-columns: repeat(7, 3fr);
        }
    </style>
</head>

<body>
    @if (isset($contato))
        <form action="{{ route('contato.update', $contato->id) }}" method="PUT">
            @method('PUT')
        @else
            <form action="{{ route('contato.store') }}" method="POST'">
    @endif
    @csrf



    <div class="container">
        <div>
            <label for="nome">Nome</label>
            <input value="{{ $contato->nome ?? '' }}" name='nome' id='nome' type="text" required>
        </div>

        @unless (isset($form))
            <div>
                <label for="telefoneInput">Número de Telefone:</label>
                <input type="number" id="telefoneInput" placeholder="Digite o número de telefone">
                <button type="button" onclick="adicionarTelefone()">Adicionar</button>
            </div>
        @endunless

        <table id="tabelaContatos">
            <thead>
                <tr>
                    <th>Número de Telefone</th>
                    <th>Tipo</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody id="tbodyTelefones">
                @isset($contato->telefone)
                    @foreach ($contato->telefone as $telefone)
                        <tr>
                            <td><input type="number" name="telefone[]" value="{{ $telefone->numero }}" required></td>
                            <td>
                                <select name="tipotelefone[]" required>
                                    <option value="1" {{ $telefone->tipotelefone->id == 1 ? 'selected' : '' }}>
                                        Celular</option>
                                    <option value="2" {{ $telefone->tipotelefone->id == 2 ? 'selected' : '' }}>Fixo
                                    </option>
                                </select>
                            </td>
                            <td><button type="button" onclick="excluirTelefone(this)">Excluir</button></td>
                        </tr>
                    @endforeach
                @endisset
            </tbody>
        </table>

        <div class="container-checkbox">
            @foreach ($categorias as $key => $categoria)
                <input type="checkbox" name="categoria[]" value="{{ $key }}"
                    {{ $checked = (isset($contato->categoria) ? $contato->categoria->contains($key) : false) ? 'checked' : '' }}
                    {{ isset($form) ? 'disabled' : '' }}>{{ $categoria }}
            @endforeach
        </div>



        <div>
            <label for="logradouro">Logradouro</label>
            <input value="{{ $contato->endereco->logradouro ?? '' }}" name='logradouro' id='logradouro' type="text"
                required>
        </div>
        <div>
            <label for="ncasa">N° Casa</label>
            <input value="{{ $contato->endereco->numero ?? '' }}" name='numero' id ='numero' type="text"
                required>
        </div>
        <div>
            <label for="cidade">Cidade</label>
            <input value="{{ $contato->endereco->cidade ?? '' }}" name='cidade' id='cidade' type="text"
                required>
        </div>
        <div>
            <label for="cep">Cep</label>
            <input value="{{ $contato->endereco->cep ?? '' }}" name='cep' id='cep' type="text" required>
        </div>

        @unless (isset($form))
            <div>
                <button type="submit">Enviar</button>
            </div>
        @else
            <div>
                <a href="{{ route('contato.edit', $contato->id) }}">Editar</a>
            </div>
        @endunless

        @if (Route::currentRouteName() == 'contato.edit')
            @method('PUT')
            <div>
                <a href="{{ route('contato.show', $contato->id) }}">Voltar</a>
            </div>
        @endif
    </div>
    </form>
    @isset($contato)
        <form action="{{ route('contato.destroy', [$contato->id]) }}" method="POST">
            @csrf
            @method('delete')
            <button type="submit">Excluir</button>
        </form>
    @endisset
    <script>
        function adicionarTelefone() {
            var telefoneInput = document.getElementById("telefoneInput");
            var telefone = telefoneInput.value.trim();

            if (telefone != '' && !verificarNumero(telefone)) {
                var newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td><input type="number" name="telefone[]" value="${telefone}" required></td>
                    <td>
                        <select name="tipotelefone[]" required>
                            <option value="1">Celular</option>
                            <option value="2">Fixo</option>
                        </select>
                    </td>
                    <td><button type="button" onclick="excluirTelefone(this)">Excluir</button></td>
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

        function excluirTelefone(button) {
            var row = button.closest("tr");
            row.remove();
        }
    </script>


</body>

</html>
