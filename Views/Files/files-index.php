<?php
spl_autoload_register(function ($class_name) {
  include '..\\..\\' . $class_name . '.php';
});
?>

<?php include '..\header.php'; ?>

<style>
  form {
    display: flex;
    flex-flow: column nowrap;
    justify-content: center;
    align-items: center;
    justify-self: center;
    align-self: center;
    width: 100%;
    max-width: 800px !important;
  }

  form * {
    width: 100%;
  }

  .fields-divided {
    display: flex;
    flex-flow: row wrap;
    gap: 1rem;
  }

  .fields-divided>div {
    flex: 1;
  }

  input[type=submit] {
    margin: 0 auto;
    max-width: fit-content;
  }
</style>
<main>
  <h1>Upload de arquivos</h1>
  <form class="ui form" method="post" enctype="multipart/form-data" action="GravarDados.php">
    <div class="required field">
      <label>Clientes</label>
      <input type="file" name="arq1" value="" id="idArq1" required />
    </div>
    <div class="required field">
      <label>Veiculos</label>
      <input type="file" name="arq2" value="" id="idArq2" required />
    </div>
    <div class="required field">
      <label>Enderecos</label>
      <input type="file" name="arq3" value="" id="idArq3" required />
    </div>
    <div class="required field">
      <label>Pagamentos</label>
      <input type="file" name="arq4" value="" id="idArq4" required />
    </div>
    <input type="submit" class="ui submit button" value="Enviar">
  </form>
</main>

<!-- Muda o titulo da página -->
<script>
  document.title = "Upload de arquivos";
</script>

<?php include '..\footer.php'; ?>