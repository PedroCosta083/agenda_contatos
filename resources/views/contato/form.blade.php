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

        .buttons {
            display: flex;
            flex-direction: row;
            gap: 10px;
        }
    </style>
</head>

<body>
    @if (isset($contato))
        <form action="{{ route('contato.update', [$contato->id]) }}" method="POST">
            @method('put')
        @else
            <form action="{{ route('contato.store') }}" method="POST">
    @endif
    @csrf
    <div class="container">
        <div>
            <label for="nome">Nome</label>
            <input {{ isset($form) ? $form : null }} value="{{ $contato->nome ?? '' }}" name='nome' id='nome'
                type="text" required>
        </div>

        @unless (isset($form))
            <div>
                <label for="telefoneInput">Número de Telefone:</label>
                <input {{ isset($form) ? $form : null }} type="number" id="telefoneInput"
                    placeholder="Digite o número de telefone">
                <button {{ isset($form) ? $form : null }} type="button" onclick="adicionarTelefone()">Adicionar</button>
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
                            <td><input {{ isset($form) ? $form : null }} type="number" name="telefone[]"
                                    value="{{ $telefone->numero }}" required></td>
                            <td>
                                <select {{ isset($form) ? $form : null }} name="tipotelefone[]" required>
                                    <option value="1" {{ $telefone->tipotelefone->id == 1 ? 'selected' : '' }}>
                                        Celular</option>
                                    <option value="2" {{ $telefone->tipotelefone->id == 2 ? 'selected' : '' }}>
                                        Fixo
                                    </option>
                                </select>
                            </td>
                            <td><button {{ isset($form) ? $form : null }} type="button"
                                    onclick="excluirTelefone(this)">Excluir</button></td>
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
            <input {{ isset($form) ? $form : null }} value="{{ $contato->endereco->logradouro ?? '' }}"
                name='logradouro' id='logradouro' type="text" required>
        </div>
        <div>
            <label for="ncasa">N° Casa</label>
            <input {{ isset($form) ? $form : null }} value="{{ $contato->endereco->numero ?? '' }}" name='numero'
                id ='numero' type="text" required>
        </div>
        <div>
            <label for="cidade">Cidade</label>
            <input {{ isset($form) ? $form : null }} value="{{ $contato->endereco->cidade ?? '' }}" name='cidade'
                id='cidade' type="text" required>
        </div>
        <div>
            <label for="cep">Cep</label>
            <input {{ isset($form) ? $form : null }} value="{{ $contato->endereco->cep ?? '' }}" name='cep'
                id='cep' type="text" required>
        </div>
        <div class="buttons">
            <div>
                <button type="submit" {{ isset($form) ? $form : null }}>Enviar</button>
            </div>
            @if (isset($form))
                <div>
                    <a href="{{ isset($contato) ? route('contato.edit', $contato->id) : null }}">Editar</a>
                </div>
            @endif
            @if (Route::currentRouteName() == 'contato.edit')
                <div>
                    <a href="{{ isset($contato) ? route('contato.show', $contato->id) : null }}"
                        {{ isset($form) ? $form : null }}>Voltar</a>
                </div>
            @endif
        </div>

    </div>
    </form>

    @isset($contato)
        <form action="{{ isset($contato) ? route('contato.destroy', [$contato->id]) : null }}" method="POST">
            @csrf
            @method('delete')
            <button {{ isset($form) ? $form : null }} type="submit">Excluir</button>
        </form>
    @endisset
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
