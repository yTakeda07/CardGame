<?php

include 'conecta.php';
    //inclui o codigo da conexão com o banco

$id = $_POST['id'];
    //define que $id é igual ao id enviado pelo ajax na funcão apagarMateria

    
  
    $delete = "DELETE FROM tb_HABILIDADE WHERE CD_HABILIDADE = '".$id."';";

        //comandos sql que apagam as tabelas no banco que correspondem à o botao X clicado


        //executa os comandos sql
 $conn->query($delete);
include 'exibirhabilidades.php';
        //inclui o codigo que carrega a pagina principal com os cards das disciplinas
    
     
    ?>