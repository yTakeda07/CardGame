<?php

include "conecta.php";
$id=$_POST["id"];

$exibir = "SELECT * from tb_universo WHERE CD_UNIVERSO=".$id.";";
    //comando sql para exibir colunas da tabela


$stmt = $conn->query($exibir);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if($row){
echo "
                <div class='conteudoeditarmodal'>
                    <button class='close-button' onclick='closemodal(this)'>✖</button>
        
                    <div class='lado-esquerdo'>
                        <!-- Preview da imagem -->
                       <p id='previewtexto'>Nome: ".$row["NM_UNIVERSO"]."</p>
                        <img id='preview-imagem' src='../PHP/".$row["CAMINHO_IMG_UNIVERSO"]."' alt='Prévia' style='max-width: 100%; height: auto;'>
                    </div>
        
                    <div class='lado-direito'>
               
                            <input class='".$row["CAMINHO_IMG_UNIVERSO"]."' type='file' name='imagem' id='arquivo' required onchange='previewImagem(this)'>
                            <br><br>
                            <input type='text' name='nome' id='NM_UNIVERSO' oninput='alterar(this)' value='".$row["NM_UNIVERSO"]."' required placeholder='Nome do universo'>
                            <br><br>
                            <button id='".$row["CD_UNIVERSO"]."' onclick='EditarUniverso(this)'>Editar</button>

                    </div>
                </div>
";
};