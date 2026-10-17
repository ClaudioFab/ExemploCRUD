<?php

require("conexao.php");

if (isset($_POST['atualizar'])) {
    $idMatricula = $_POST['idMatricula'];
    $nome        = $_POST['nome'];
    $curso       = $_POST['curso'];

    $atualizar = "UPDATE matricula SET nome = '$nome', curso = '$curso' WHERE idMatricula = '$idMatricula' ";

    if (mysqli_query($conexao, $atualizar)) {
        echo "<script>
            alert('Dados atualizados com sucesso!');
            window.location='atualizarDados.php';
        </script>";
        exit();
    } else {
        echo "Erro ao atualizar!" . mysqli_error($conexao);
    }
}

$editaAluno = null;

if (isset($_GET['editar'])) {

    $idEditar = $_GET['editar'];

    $resultado = mysqli_query($conexao, "SELECT * FROM matricula WHERE idMatricula = $idEditar");

    $editaAluno = mysqli_fetch_assoc($resultado);
}

$alunos = mysqli_query($conexao, "SELECT * FROM matricula");

if (isset($_GET['apagar'])) {
    $idMatricula = $_GET['apagar'];

    $deletar = "SELECT FROM matricula WHERE idMatricula = $idMatricula";

    if (mysqli_query($conexao, $deletar)) {
        echo "<script>
            alert('Dados excluidos com sucesso!');
            window.location='atualizarDados.php';
        </script>";
        exit();
    } else {
        echo "Erro ao deletar!" . mysqli_error($conexao);
    }



}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Dados</title>
</head>

<body>
    <main>
        <h2>Listagem de Alunos</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Curso</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($aluno = mysqli_fetch_assoc($alunos)): ?>
                    <tr>
                        <td><?= $aluno['idMatricula'] ?></td>
                        <td><?= $aluno['nome'] ?></td>
                        <td><?= $aluno['curso'] ?></td>
                        <td>
                            <a href="?editar=<?= $aluno['idMatricula'] ?>">Editar</a>
                        </td>
                        <td>
                            <a href="?apagar=<?= $aluno['idMatricula'] ?>">Apagar</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php

        if ($editaAluno): ?>
            <h3>Editar Aluno</h3>

            <form method="POST">

                <!-- ID Aluno -->
                <label>ID:</label><br>
                <input type="text" name="idMatricula" value="<?= $editaAluno['idMatricula'] ?>">
                <br><br>
                <label>Nome: </label><br>
                <input type="text" name="nome" value="<?= $editaAluno['nome'] ?>">
                <br><br>
                <label>Curso: </label><br>
                <input type="text" name="curso" value="<?= $editaAluno['curso'] ?>">
                <br><br>
                <button type="submit" name="atualizar">Atualizar</button>
                <br><br>
                <button type="submit" name="apagar">Deletar</button>
                <br><br>
                <button type="button" onclick="window.location.href='atualizarDados.php'">Cancelar</button>

            </form>
        <?php endif; ?>



    </main>
</body>

</html>