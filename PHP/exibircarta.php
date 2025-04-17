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
        
echo "
            <div class='card'>
            <div class='info'>
             <button class='close-button' onclick='apagarMateria(this)' id='".$row['CD_DISCIPLINA']."'>✖</button>
              <p>Nome: " . $row['NM_DISCIPLINA'] . "</p>
              <p>Carga Anual: " . $row['QT_CARGA_ANUAL'] . "</p>
              <p>Carga Semanal: " . $row['QT_CARGA_SEMANAL'] . "</p>
              <p>Avaliações por Bimestre: " . $row['NR_AVALIACAO'] . "</p>
              <p>Periodo: " . $row['TP_DISCIPLINA'] . "</p>
            </div>
            <br>
            <button class='details-button' onclick='detalhesCliques(this)' id='".$row['CD_DISCIPLINA']."'>Ver Detalhes</button>
        



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