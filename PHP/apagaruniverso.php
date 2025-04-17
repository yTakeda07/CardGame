<?php

include 'conecta.php';
    //inclui o codigo da conexão com o banco

$id = $_POST['id'];
    //define que $id é igual ao id enviado pelo ajax na funcão apagarMateria

    
    $exibir = "SELECT * from tb_universo WHERE CD_UNIVERSO=".$id.";";
    $delete = "DELETE FROM tb_universo WHERE CD_UNIVERSO = '".$id."';";

        //comandos sql que apagam as tabelas no banco que correspondem à o botao X clicado

   
    $stmt = $conn->query($exibir);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row){
    $imgatual= $row["CAMINHO_IMG_UNIVERSO"];
    if (file_exists($imgatual)) {
        unlink($imgatual); // Apaga o arquivo
    }

};
        //executa os comandos sql
 $conn->query($delete);
include 'exibiruniversos.php';
        //inclui o codigo que carrega a pagina principal com os cards das disciplinas
    
     
    ?>