<!DOCTYPE html>
<html lang="pt_br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <form action="{{ Route(contato_store) }}" method="POST">
        @csrf
        <div>
            <div>
                <label for=""></label>
                <input type="text">
            </div>
        </div>
    </form>
</body>

</html>