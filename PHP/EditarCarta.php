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
$CD_CARTA = $_POST["CD_CARTA"];
$temimg = $_POST["temimg?"];
$imgatual = $_POST["imgatual"];

if ($temimg == "true") {
    // Novo arquivo de imagem foi selecionado
    if (isset($_FILES['fileInput']) && $_FILES['fileInput']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['fileInput']['tmp_name'];
        $fileName = $_FILES['fileInput']['name'];
        $extencao = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $newNameFile = uniqid();
        $pasta_server = 'uploads_personagens/';
        
        if (!file_exists($pasta_server)) {
            mkdir($pasta_server, 0777, true);
        }

        $destPath = $pasta_server . $newNameFile . "." . $extencao;

        if (move_uploaded_file($fileTmpPath, $destPath)) {
            if (file_exists($imgatual)) {
                unlink($imgatual); // Remove imagem antiga
            }
        } else {
            echo "Erro ao mover o novo arquivo.";
            exit;
        }
    } else {
        echo "Erro no upload da nova imagem.";
        exit;
    }
} else {
    // Manter imagem atual
    $destPath = $imgatual;
}

$editar = $conn->prepare('UPDATE tb_carta SET 
    NM_CARTA=:NM_CARTA,
    CAMINHO_IMG_CARTA=:path_caminho, 
    DS_CARTA=:DS_CARTA, 
    TP_CARTA=:TP_CARTA, 
    ATB_FORCA=:ATB_FORCA, 
    ATB_VELOCIDADE=:ATB_VELOCIDADE, 
    ATB_INTELIGENCIA=:ATB_INTELIGENCIA, 
    ATB_VITALIDADE=:ATB_VITALIDADE, 
    ATB_RESISTENCIA=:ATB_RESISTENCIA, 
    CD_UNIVERSO=:CD_UNIVERSO 
    WHERE CD_CARTA = :CD_CARTA');
$editar->execute(array(
    ":NM_CARTA" => $NM_CARTA,
    ":path_caminho" => $destPath,
    ":DS_CARTA" => $DS_CARTA,
    ":TP_CARTA" => $TP_CARTA,
    ":ATB_FORCA" => $ATB_FORCA,
    ":ATB_VELOCIDADE" => $ATB_VELOCIDADE,
    ":ATB_INTELIGENCIA" => $ATB_INTELIGENCIA,
    ":ATB_VITALIDADE" => $ATB_VITALIDADE,
    ":ATB_RESISTENCIA" => $ATB_RESISTENCIA,
    ":CD_UNIVERSO" => $CD_UNIVERSO,
    ":CD_CARTA" => $CD_CARTA
));

// Deletar habilidades anteriores da carta
$deletehabilidade = $conn->prepare("DELETE FROM tb_habilidade_carta WHERE CD_CARTA = :CD_CARTA");
$deletehabilidade->execute(array(':CD_CARTA' => $CD_CARTA));

// Inserir novas habilidades selecionadas
if (!empty($CD_HABILIDADE)) {
    foreach ($CD_HABILIDADE as $idHabilidade) {
        $insertHabilidade = $conn->prepare('INSERT INTO tb_habilidade_carta (CD_HABILIDADE, CD_CARTA) VALUES (:CD_HABILIDADE, :CD_CARTA)');
        $insertHabilidade->execute(array(
            ':CD_HABILIDADE' => $idHabilidade,
            ':CD_CARTA' => $CD_CARTA
        ));
    }
}

echo "<script>alert('Personagem editado com sucesso!');</script>";
?>
