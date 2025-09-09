<?php
$valores = ['nome'=>'','sobrenome'=>'','email'=>'','telefone'=>'','data_nasc'=>'','cpf'=>'','endereco'=>'','cidade'=>'','estado'=>'','cep'=>''];
$erros = ['nome'=>false,'sobrenome'=>false,'email'=>false,'telefone'=>false,'data_nasc'=>false,'cpf'=>false,'endereco'=>false,'cidade'=>false,'estado'=>false,'cep'=>false];
$msgSucesso = false;

if (isset($_GET['erro']) && $_GET['erro'] == 1) {
    if (isset($_GET['valores'])) {
        $valores = json_decode($_GET['valores'], true);
    }
    if (isset($_GET['erros'])) {
        $erros = json_decode($_GET['erros'], true);
    }
}

if (isset($_GET['msg']) && $_GET['msg'] == 'ok') {
    $msgSucesso = true;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro de Pessoa</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<style>
    body {
        background-color: #f0f8ff;
    }
    .form-control {
        border-radius: 0.5rem;
    }
    .is-invalid {
        border-color: red;
    }
</style>
</head>
<body>

<div class="container mt-5 d-flex justify-content-center">
  <div class="card shadow p-4" style="width: 600px; background-color: #ffffff;">
    <h2 class="mb-4 text-center">Formulário de Cadastro</h2>

    <?php if ($msgSucesso): ?>
      <div class="alert alert-success text-center fw-bold">Cadastro salvo com sucesso!</div>
    <?php endif; ?>

    <?php if (isset($_GET['erro']) && $_GET['erro']==1): ?>
      <div class="alert alert-danger text-center fw-bold">Preencha todos os campos corretamente!</div>
    <?php endif; ?>

    <form action="processa.php" method="post" class="row g-3">
        <?php
        $campos = [
            'nome'=>'Nome', 'sobrenome'=>'Sobrenome', 'email'=>'Email', 'telefone'=>'Telefone',
            'data_nasc'=>'Data de Nascimento', 'cpf'=>'CPF', 'endereco'=>'Endereço',
            'cidade'=>'Cidade', 'estado'=>'Estado', 'cep'=>'CEP'
        ];
        foreach ($campos as $name=>$label):
            $type = 'text';
            if ($name=='email') $type='email';
            if ($name=='data_nasc') $type='date';
        ?>
        <div class="col-md-6">
            <label class="form-label"><?= $label ?></label>
            <input type="<?= $type ?>" 
                   name="<?= $name ?>" 
                   value="<?= htmlspecialchars($valores[$name]) ?>" 
                   class="form-control <?= $erros[$name]? 'is-invalid':'' ?>">
        </div>
        <?php endforeach; ?>
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
        </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>
