<?php

include "conecta.php";

$exibir = "SELECT * FROM tb_universo;";


$stmt = $conn->query($exibir); 

    //executa o codigo sql
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ($row) {
   
    echo "
<div>Adicionar Universo</div>
<button class='close-button' onclick='closemodal(this)'>✖</button>


    <input type='file' id='arquivo' name='Imagem Universo' required>
    <button onclick='uploadArquivo(this)' class='".$row["CD_ID_SEMANA"]." ".$row["CD_DISCIPLINA"]."' >Enviar</button>
<br><br>
        <label>Arquivo da semana:</label> 
        <a href='baixar.php?CD_ID_SEMANA=".$row["CD_ID_SEMANA"]."&CD_DISCIPLINA=".$row["CD_DISCIPLINA"]."'>".$row["NM_ARQUIVO"]."</a>
        <br><br>
    


<div id='resultado'></div>



    <textarea id='textInput ".$row["CD_ID_SEMANA"]."' class='merdadeinput' maxlength='200'>".$row["DS_SEMANA"]."</textarea>
    <button onclick='updatedescricao(this)' class='".$row["CD_DISCIPLINA"]."' id='".$row["CD_ID_SEMANA"]."'>Adicionar Conteudo</button>
    
        
        ";
    };
    




?>
