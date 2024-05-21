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
            align-content: center;
            justify-content: space-around;
            align-items: center;
            flex-direction: column;
        }
    </style>

</head>

<body>
    <form action="{{ route('contato.store') }}" method="POST">
        @csrf
        <div class="container">

            <div>
                <label for="nome">Nome</label>
                <input name='nome' id='nome' type="text">
            </div>

            <div>
                <label for="telefoneInput">Número de Telefone:</label>
                <input type="text" id="telefoneInput" placeholder="Digite o número de telefone">
                <button type="button" onclick="adicionarTelefone()">Adicionar</button>
            </div>
            <table id="tabelaTelefones">
                <thead>
                    <tr>
                        <th>Número de Telefone</th>
                        <th>Tipo</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody id="tbodyTelefones">

                </tbody>
            </table>


            @foreach ($categorias as $categoria)
                <input type="checkbox" name="categoria[]" value="{{ $categoria }}">{{ $categoria }}</input>
            @endforeach



            <div>
                <label for="logradouro">Logradouro</label>
                <input name='logradouro' required id='logradouro' type="text">
            </div>
            <div>
                <label for="ncasa">N° Casa</label>
                <input name='numero' required id ='numero' type="text">
            </div>
            <div>
                <label for="cidade">Cidade</label>
                <input name='cidade'required id='cidade' type="text">
            </div>
            <div>
                <label for="cep">Cep</label>
                <input name='cep' required id='cep' type="text">
            </div>
            <div>
                <input type="submit">
            </div>
        </div>
    </form>

    <script type="text/javascript">
        function adicionarTelefone() {
            console.log("foi");
            var telefone = document.getElementById("telefoneInput");
            if (telefone.value.trim() !== "") {
                var newRow = document.createElement("tr");
                var cellTelefone = document.createElement("td");
                var inputTelefoneTable = document.createElement("input");
                inputTelefoneTable.value = telefone.value;
                inputTelefoneTable.name = "telefone[]";
                cellTelefone.appendChild(inputTelefoneTable);
                var cellSelect = document.createElement("td");
                var select = document.createElement("select");
                select.name = "tipotelefone[]";
                var option1 = document.createElement("option");
                option1.text = "Celular";
                option1.value = "1";
                var option2 = document.createElement("option");
                option2.text = "Fixo";
                option2.value = "2";
                select.appendChild(option1);
                select.appendChild(option2);
                cellSelect.appendChild(select);
                var cellExcluir = document.createElement("td");
                var botaoExcluir = document.createElement("button");
                botaoExcluir.textContent = "Excluir";
                botaoExcluir.onclick = function() {
                    var row = this.parentNode.parentNode;
                    row.parentNode.removeChild(row);
                };
                cellExcluir.appendChild(botaoExcluir);

                newRow.appendChild(cellTelefone);
                newRow.appendChild(cellSelect);
                newRow.appendChild(cellExcluir);

                document.getElementById("tbodyTelefones").appendChild(newRow);

                document.getElementById("telefoneInput").value = "";
            } else {
                alert("Por favor, insira um número de telefone.");
            }
        }
    </script>
</body>

</html>
