<?php
include "conecta.php";

$NM_CARTA = $_POST["NM_CARTA"];
$DS_CARTA = $_POST["DS_CARTA"];
$TP_CARTA = $_POST["TP_CARTA"];
$ATB_FORCA = $_POST["ATB_FORCA"];
$ATB_VELOCIDADE = $_POST["ATB_VELOCIDADE"];
$ATB_INTELIGENCIA = $_POST["ATB_INTELIGENCIA"];
$ATB_VITALIDADE = $_POST["ATB_VITALIDADE"];
$ATB_RESISTENCIA = $_POST["ATB_RESISTENCIA"];
$CD_UNIVERSO = $_POST["CD_UNIVERSO"];
$CD_HABILIDADE = json_decode($_POST["CD_HABILIDADE"], true);
$arquivo = $_FILES["arquivo"];

if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] === UPLOAD_ERR_OK) {
    // Informações do arquivo
    $fileTmpPath = $_FILES['arquivo']['tmp_name']; // path temporario do arquivo 
    $fileName = $_FILES['arquivo']['name']; // nome do arquivo
    // Pega a extenção do arquivo
    $extencao = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    // cria um nome novo pro arquivo dentro do server para não sobrescrever arquivos com nome igual
    $newNameFile = uniqid();
    // Diretório para onde o arquivo será movido
    $pasta_server = 'uploads_personagens/';
    
    // Verifica se a pasta de uploads existe, se não cria
    if (!file_exists($pasta_server)) {
        mkdir($pasta_server, 0777, true);
    }

    // Caminho completo do arquivo final
    $destPath = $pasta_server . $newNameFile .".". $extencao;

    // Move o arquivo para o diretório de destino
    if (move_uploaded_file($fileTmpPath, $destPath)) {
        

        $salvar = $conn->prepare('INSERT INTO tb_carta(NM_CARTA, CAMINHO_IMG_CARTA, DS_CARTA, TP_CARTA, ATB_FORCA, ATB_VELOCIDADE, ATB_INTELIGENCIA, ATB_VITALIDADE, ATB_RESISTENCIA, CD_UNIVERSO) 
        VALUES(:NM_CARTA,:path_caminho,:DS_CARTA,:TP_CARTA,:ATB_FORCA,:ATB_VELOCIDADE,:ATB_INTELIGENCIA,:ATB_VITALIDADE,:ATB_RESISTENCIA,:CD_UNIVERSO)');
        $salvar->execute(array(
            ":NM_CARTA" => $NM_CARTA,
            ":path_caminho" => $destPath,
            ":DS_CARTA" => $DS_CARTA,
            ":TP_CARTA" => $TP_CARTA,
            ":ATB_FORCA" => $ATB_FORCA,
            ":ATB_VELOCIDADE" => $ATB_VELOCIDADE,
            ":ATB_INTELIGENCIA" => $ATB_INTELIGENCIA,
            ":ATB_VITALIDADE" => $ATB_VITALIDADE,
            ":ATB_RESISTENCIA" => $ATB_RESISTENCIA,
            ":CD_UNIVERSO" => $CD_UNIVERSO
        ));

        // Pegando o último ID da carta criada
$lastIdCarta = $conn->lastInsertId();

// Agora vamos inserir as habilidades associadas a essa carta
if (!empty($CD_HABILIDADE)) {
    foreach ($CD_HABILIDADE as $idHabilidade) {
        $insertHabilidade = $conn->prepare('INSERT INTO tb_habilidade_carta (CD_HABILIDADE, CD_CARTA) VALUES (:CD_HABILIDADE, :CD_CARTA)');
        $insertHabilidade->execute(array(
            ':CD_HABILIDADE' => $idHabilidade,
            ':CD_CARTA' => $lastIdCarta
        ));
    }
}
echo "<script>alert('Personagem criado');</script>";

    } else {
        echo "Ocorreu um erro ao mover o arquivo para o diretório de upload.";
    }
} else {
    echo "Nenhum arquivo foi enviado ou ocorreu um erro no upload.";
}