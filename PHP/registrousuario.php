<?php

include 'conecta.php';
$senha = $_POST['senha'];
$nome = $_POST['nome'];



$inserir = "INSERT INTO `tb_usuario` (`NM_USUARIO`, `NR_SENHA`, TP_USUARIO) VALUES
('".$nome."', '".$senha."','USER');";



$consulta = "SELECT * FROM tb_usuario WHERE NM_USUARIO = :nome";
$stmt = $conn->prepare($consulta);
$stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
$stmt->execute();   

if ($stmt->rowCount() > 0) {
    echo "Nome de Usuario já cadastrado";
} else {
    $conn->query($inserir);
    echo "usuario cadastrado";
}

 
?>

