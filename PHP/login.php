<?php 
    
session_start();
    if(isset($_SESSION['IsLogadoCG'])){ // verifica se existe a sessão
        $senha =  $_SESSION['senhaCG'];
        $nome = $_SESSION['nomeCG'];
        $tipo = $_SESSION["tipoCG"];
        $IsLogado = $_SESSION['IsLogadoCG'];

        header('Content-Type: application/json'); // <-- importante!
        echo json_encode([
            "islogado" => $IsLogado,
            "nome" => $nome,
            "senha" => $senha,
            "tipo" => $tipo
        ]);
       


    } else {
        echo json_encode([
            "islogado" => false,
            "mensagem" => "Usuário não está logado"
        ]);
    };
    exit;
?>