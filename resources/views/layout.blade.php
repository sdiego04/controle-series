<!doctype html>
<html lang="en">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Series</title>
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light mb-2">
    <a class="navbar navbar-expand-lg" href="/listaSeries">Home</a>
    @auth()
    <a class="navbar navbar-expand-lg" href="/sair">sair</a>
    @endauth
    @guest()
    <a class="navbar navbar-expand-lg" href="/entrar">Entrar</a>
    @endguest
</nav>

<div class="container">
    <div class="jumbotron">
        <h1>@yield('cabecalho')</h1>
    </div>
    @yield('conteudo')
</div>

</body>
</html>
