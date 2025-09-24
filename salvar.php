<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="src/css/style3.css?v=1.0">
    <link rel="icon" href="/conexao/src/favicons/icon.ico">
</head>
<body>
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
    echo "<span>Usuário cadastrado com sucesso!</span><br>";
    echo '<div class="link-container">';
    echo '<a href="form.html">Voltar</a>';
    echo '<a href="listar.php">Listar</a>';
    echo '</div>';
} else {
    echo '<span>Erro ao inserir: ' . mysqli_stmt_error($stmt) . '</span>';
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>  
</body>
</html>

