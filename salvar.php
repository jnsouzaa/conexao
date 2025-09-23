<?php
require "db.php";

$name = trim($_POST["nome"] ?? "");
$email = trim($_POST["email"] ?? "");

// validações simples
if ($name === "" || $email === "") {
    die("Preencha nome e e-mail.");
}

$sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    die("Erro ao preparar: " . mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ss", $name, $email);

if (mysqli_stmt_execute($stmt)) {
    echo "Usuário cadastrado com sucesso!<br>";
    echo '<a href="form.html">Voltar</a> | <a href="listar.php">Listar</a>';
} else {
    echo "Erro ao inserir: " . mysqli_stmt_error($stmt);
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
