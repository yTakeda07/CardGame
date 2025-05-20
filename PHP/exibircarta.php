<?php 

include "conecta.php";
// Arquivo base de exibição na tela (ser usado no include)

$exibir = "SELECT * from tb_carta;";
    //comando sql para exibir colunas da tabela


$stmt = $conn->query($exibir);
    //prepara o exibir e o guarda no $stmt
if ($stmt->rowCount() > 0) {
    //se existir mais de 0 linhas na coluna, vai executar
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $TP_CARTA = $row["TP_CARTA"];
        
echo "
            <div class='card'>
            <div class='info'>
             <button class='close-button' onclick='apagarCarta(this)' id='".$row['CD_CARTA']."'>✖</button>
              <p>Nome: " . $row['NM_CARTA'] . "</p>
            <img id='img-carta' src='../PHP/".$row["CAMINHO_IMG_CARTA"]."'>
            </div>
            <br>
            <button class='details-button' onclick='ModalEditarCarta(this)' id='".$row['CD_CARTA']."'>Editar carta</button>
        



          </div>


";
        //echo que contem os cards

 


       
    }
// fim do while
} else {
    echo "Nenhuma carta existente no sistema";
    //cado as linhas nao sejam maiores que 0, exibe
}


?>