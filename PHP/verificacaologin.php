<?php

include 'conecta.php';
$senha = $_POST['senha'];
$nome = $_POST['nome'];



$consulta = "SELECT * FROM tb_usuario WHERE NM_USUARIO = :nome";
$stmt = $conn->prepare($consulta);
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->execute();   

if ($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($senha == $row['NR_SENHA']) {

        session_start();
        $_SESSION['senhaCG'] = $senha;
        $_SESSION['nomeCG'] = $nome;
        $_SESSION['tipoCG'] = $row['TP_USUARIO'];
        $_SESSION['IsLogadoCG'] = true;

        echo "<script>window.location.href = '../index.html';</script>";
        exit();
    } else {
        echo "Senha incorreta.";
    }
} else {
    echo "Usuário não encontrado.";
}

 
?>