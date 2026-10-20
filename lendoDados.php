<?php

require("conexao.php");

$consulta = "SELECT * FROM sistemaacademico.matricula";

$matricula = mysqli_query($conexao, $consulta);

while ($array = mysqli_fetch_array($matricula)) {
    echo
    $array['idMatricula'] . " - " .
        "Aluno: " . $array['nome'] . " - " .
        "Curso: " . $array['curso'] . "<br>";
}

?>