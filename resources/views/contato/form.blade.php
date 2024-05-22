<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Adicionar Contato</title>
    <style>
        .container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .container-checkbox {
            display: grid;
            grid-template-columns: repeat(7, 3fr);
        }
    </style>
</head>

<body>

    <form action="{{ isset($contato) ? route('contato.update', $contato->id) : route('contato.store') }}"
        method="{{ isset($contato) ? 'PUT' : 'POST' }}">
        @csrf

        <div class="container">
            <div>
                <label for="nome">Nome</label>
                <input value="{{ $contato->nome ?? '' }}" name='nome' id='nome' type="text"
                    {{ $form ?? null }}>
            </div>
            @if (!isset($form))
                <div>
                    <label for="telefoneInput">Número de Telefone:</label>
                    <input type="text" id="telefoneInput" placeholder="Digite o número de telefone"
                        {{ $form ?? null }}>
                    <button type="button" onclick="adicionarTelefone()">Adicionar</button>
                </div>
            @endif
            <table id="tabelaTelefones">
                <thead>
                    <tr>
                        <th>Número de Telefone</th>
                        <th>Tipo</th>
                        <th>Excluir</th>
                    </tr>

                </thead>
                <tbody id="tbodyTelefones">
                    @foreach ($contato->telefone ?? [] as $telefone)
                        <tr>
                            <td>{{ $telefone->numero }}</td>
                            <td>{{ $telefone->tipotelefone->titulo }}</td>
                            <td><button type="button" onclick="excluirTelefone(this)">Excluir</button></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @isset($form)
                <div class="container-checkbox">
                    @foreach ($categorias as $key => $categoria)
                        <input type="checkbox" name="categoria[]" value="{{ $key }}">{{ $categoria }}</input>
                    @endforeach
                </div>
            @endisset
            <div class="container-checkbox">
                @foreach ($contato->categoria ?? [] as $categoria)
                    <input type="checkbox" name="categoria[]" value="{{ $categoria->id }}"
                        {{ $form ?? null }}>{{ $categoria->titulo }}</input>
                @endforeach
            </div>
            <div>
                <label for="logradouro">Logradouro</label>
                <input value="{{ $contato->endereco->logradouro ?? '' }}" name='logradouro' required id='logradouro'
                    type="text" {{ $form ?? null }}>
            </div>
            <div>
                <label for="ncasa">N° Casa</label>
                <input value="{{ $contato->endereco->numero ?? '' }}" name='numero' required id ='numero'
                    type="text" {{ $form ?? null }}>
            </div>
            <div>
                <label for="cidade">Cidade</label>
                <input value="{{ $contato->endereco->cidade ?? '' }}" name='cidade' required id='cidade'
                    type="text" {{ $form ?? null }}>
            </div>
            <div>
                <label for="cep">Cep</label>
                <input value="{{ $contato->endereco->cep ?? '' }}" name='cep' required id='cep'
                    type="text" {{ $form ?? null }}>
            </div>
            @if (!isset($form))
                <div>
                    <input type="submit">
                </div>
            @endif
            @isset($form)
                <div>
                    <button>Editar</button>
                </div>
            @endisset
        </div>
    </form>
    <script>
        function adicionarTelefone() {
            var telefoneInput = document.getElementById("telefoneInput");
            var telefone = telefoneInput.value.trim();
            if (telefone) {
                var newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td><input type="text" name="telefone[]" value="${telefone}" {{ $form ?? null }}></td>
                    <td>
                        <select name="tipotelefone[]" {{ $form ?? null }}>
                            <option value="1">Celular</option>
                            <option value="2">Fixo</option>
                        </select>
                    </td>
                    <td><button type="button" onclick="excluirTelefone(this)">Excluir</button></td>
                `;
                document.getElementById("tbodyTelefones").appendChild(newRow);
                telefoneInput.value = "";
            } else {
                alert("Por favor, insira um número de telefone.");
            }
        }

        function excluirTelefone(button) {
            var row = button.closest("tr");
            row.remove();
        }
    </script>
</body>

</html>
