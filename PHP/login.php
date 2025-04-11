<?php 
    
    session_start();
    if(isset($_SESSION['IsLogadoCG'])){
    $senha =  $_SESSION['senhaCG'];
    $nome = $_SESSION['nomeCG'];
    $tipo = $_SESSION["tipoCG"];
    $IsLogado = $_SESSION['IsLogadoCG'];
    if($IsLogado == true){
    echo($nome." - ".$senha." - ".$tipo);





} else{ echo "<script>window.location.href = 'HTML/login.html';</script>";};
} else{ echo "<script>window.location.href = 'HTML/login.html';</script>";}