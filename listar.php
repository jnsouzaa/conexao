<?php
require "db.php";

$sql = "SELECT id, nome, email FROM usuarios ORDER BY id DESC";
$result = $conn->query($sql);

$usuarios = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $usuarios[] = $row;
    }
    $result->free();
}

$conn->close();
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Lista de usuários</title>
    <link rel="stylesheet" href="/conexao/src/css/style2.css">
    <link rel="stylesheet" href="/conexao/src/css/popup-style.css">
    <link rel="icon" href="/conexao/src/favicons/icon.ico">
</head>
<body>

    <h2>Usuários cadastrados</h2>
    <p><a href="form.html">Cadastrar novo</a></p>

    <?php if (empty($usuarios)): ?>
        <p>Ninguém cadastrado ainda.</p>
    <?php else: ?>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Ações</th>
        </tr>
        <?php foreach ($usuarios as $u): ?>
        <tr>
            <td><?=(int)$u['id']?></td>
            <td><?=htmlspecialchars($u['nome'])?></td>
            <td><?=htmlspecialchars($u['email'])?></td>
            <td>
                <a href="editar.php?id=<?=(int)$u['id']?>">Editar</a> |
                <a href="#" class="btn-excluir" data-id="<?=(int)$u['id']?>">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php endif; ?>

    <div id="modal-confirmacao" class="modal">
        <div class="modal-conteudo">
            <span class="fechar-modal">&times;</span>
            <h2>Confirmar Exclusão</h2>
            <p>Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.</p>
            <div class="botoes-modal">
                <a href="#" id="link-excluir" class="botao-confirmar">Confirmar</a>
                <button class="botao-cancelar">Cancelar</button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('modal-confirmacao');
        var botoesExcluir = document.querySelectorAll('.btn-excluir');
        var fecharModal = document.querySelector('.fechar-modal');
        var botaoCancelar = document.querySelector('.botao-cancelar');
        var linkExcluir = document.getElementById('link-excluir');

        botoesExcluir.forEach(function(botao) {
            botao.addEventListener('click', function(event) {
                event.preventDefault();
                var idUsuario = this.getAttribute('data-id');
                linkExcluir.href = 'excluir.php?id=' + idUsuario;
                modal.style.display = 'block';
            });
        });

        fecharModal.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        botaoCancelar.addEventListener('click', function() {
            modal.style.display = 'none';
        });

        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
            }
        });
    });
    </script>

</body>
</html>