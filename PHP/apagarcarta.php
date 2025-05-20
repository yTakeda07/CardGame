<?php

include 'conecta.php';
    //inclui o codigo da conexão com o banco

$id = $_POST['id'];
    //define que $id é igual ao id enviado pelo ajax na funcão apagarMateria

    
    $exibir = "SELECT * from tb_carta WHERE CD_CARTA=".$id.";";
    $delete = "DELETE FROM tb_carta WHERE CD_CARTA = '".$id."';";
    $delete2 = "DELETE FROM tb_habilidade_carta WHERE CD_CARTA = '".$id."';";

        //comandos sql que apagam as tabelas no banco que correspondem à o botao X clicado

   
    $stmt = $conn->query($exibir);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

if($row){
    $imgatual= $row["CAMINHO_IMG_CARTA"];
    if (file_exists($imgatual)) {
        unlink($imgatual); // Apaga o arquivo
    }

};
        //executa os comandos sql
 $conn->query($delete2);
 $conn->query($delete);
include 'exibircarta.php';
        //inclui o codigo que carrega a pagina principal com os cards das disciplinas
    
     
    ?>