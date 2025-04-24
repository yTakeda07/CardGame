<?php 

include "conecta.php";
// Arquivo base de exibição na tela (ser usado no include)

$exibir = "SELECT * from tb_habilidade;";
    //comando sql para exibir colunas da tabela


$stmt = $conn->query($exibir);
    //prepara o exibir e o guarda no $stmt
if ($stmt->rowCount() > 0) {
    //se existir mais de 0 linhas na coluna, vai executar
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
echo "
            <div class='card'>
            <div class='info'>
             <button class='close-button' onclick='apagarHabilidade(this)' id='".$row['CD_HABILIDADE']."'>✖</button>
              <p>Nome: " . $row['NM_HABILIDADE'] . "</p>
            <p>Nivel: ".$row["LV_HABILIDADE"]."</p>
            <p class='descricao-habilidade'>".$row["DS_HABILIDADE"]."</p>


            </div>
            <br>
            <button class='details-button' onclick='ModalEditarHabilidade(this)' id='".$row['CD_HABILIDADE']."'>Editar Habilidade</button>
        



          </div>


";
        //echo que contem os cards

 


       
    }
// fim do while
} else {
    echo "Nenhuma habilidade existente no sistema";
    //cado as linhas nao sejam maiores que 0, exibe
}







?>
