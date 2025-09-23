<?php
 $host = "localhost";
 $user = "root";
 $pass = "";
 $db = "cadastro_simples";

 $conn = mysqli_connect($host, $user, $pass, $db);

 if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
 }

 mysqli_set_charset($conn, "utf8mb4");
?>