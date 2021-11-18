<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
  <title>TP de PHP</title>
</head>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    width: fit-content;
  }

  body {
    display: flex;
    flex-flow: column nowrap;
    align-items: center;
    min-height: 100vh;
    width: 100vw;
    max-width: 100vw;
  }

  body>* {
    width: 100%;
  }

  body>*:not(header, footer) {
    flex: 1;
  }

  main,
  footer {
    padding: 10px 0.75rem !important;
  }

  nav {
    width: 100%;
  }

  h1,
  h2,
  h3,
  h4,
  h5,
  h6 {
    margin: 0.75rem auto !important;
  }

  .container-footer {
    display: flex;
    flex-flow: row wrap;
  }
</style>

<body>
  <header>
    <nav class="ui stackable menu">
      <a href="/Views/index.php" class="item">Página Inicial</a>
      <a href="/Views/Carros/carros-index.php" class="item">Carros</a>
    </nav>
  </header>