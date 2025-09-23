<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Cadastros</title>
    <link rel="stylesheet" href="src/css/style2.css">
</head>
<body>
   <?php
 require "db.php";
 $result = mysqli_query($conn, "SELECT id, nome, email FROM usuarios ORDER BY id DESC");

 echo "<h2>Usuários cadastrados</h2>";
 if (!$result || mysqli_num_rows($result) === 0) {
    echo "<p>Ninguém cadastrado ainda.</p>";
     echo '<p><a href="form.html">Cadastrar</a></p>';
     exit;
 }

 while ($row = mysqli_fetch_assoc($result)){
    echo (int)$row["id"] . " - " . htmlspecialchars($row["nome"]) . " (" . htmlspecialchars($row["email"]) . ")<br>";
 }

  echo '<p><a href="form.html">Cadastrar</a></p>';

  mysqli_free_result($result);
  mysqli_close($conn);
?> 
</body>
</html>
