<?php 

include "conecta.php";
// Arquivo base de exibição na tela (ser usado no include)

$exibir = "SELECT * from tb_universo;";
    //comando sql para exibir colunas da tabela


$stmt = $conn->query($exibir);
    //prepara o exibir e o guarda no $stmt
if ($stmt->rowCount() > 0) {
    //se existir mais de 0 linhas na coluna, vai executar
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
echo "
            <div class='card'>
            <div class='info'>
             <button class='close-button' onclick='apagarUniverso(this)' id='".$row['CD_UNIVERSO']."'>✖</button>
              <p>Nome: " . $row['NM_UNIVERSO'] . "</p>
            <img id='img-universo' src='../PHP/".$row["CAMINHO_IMG_UNIVERSO"]."'>
            </div>
            <br>
            <button class='details-button' onclick='ModalEditarUniverso(this)' id='".$row['CD_UNIVERSO']."'>Editar universo</button>
        



          </div>


";
        //echo que contem os cards

 


       
    }
// fim do while
} else {
    echo "Nenhum universo existente no sistema";
    //cado as linhas nao sejam maiores que 0, exibe
}







?>
