<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $campos = ['nome','sobrenome','email','telefone','data_nasc','cpf','endereco','cidade','estado','cep'];
    $valores = [];
    $erros = [];

    foreach ($campos as $campo) {
        $valores[$campo] = trim($_POST[$campo]);
        $erros[$campo] = empty($valores[$campo]);
    }

    if (in_array(true, $erros)) {
        $valores_json = urlencode(json_encode($valores));
        $erros_json = urlencode(json_encode($erros));
        header("Location: index.php?erro=1&valores=$valores_json&erros=$erros_json");
        exit;
    }

    $linha = implode('|', $valores) . " _\n";
    file_put_contents("cadastros.txt", $linha, FILE_APPEND);

    header("Location: index.php?msg=ok");
    exit;
}
?>
