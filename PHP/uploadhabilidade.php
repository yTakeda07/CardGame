<?php
include "conecta.php";

$NM_HABILIDADE = $_POST["NM_HABILIDADE"];
$DS_HABILIDADE = $_POST["DS_HABILIDADE"];
$LV_HABILIDADE = $_POST["LV_HABILIDADE"];

$insert = "INSERT INTO tb_habilidade (`NM_HABILIDADE`, `DS_HABILIDADE`, LV_HABILIDADE) VALUES
(:NM, :DS,:LV);";
$stmt = $conn->prepare($insert);
$stmt->bindParam(':NM', $NM_HABILIDADE, PDO::PARAM_STR);
$stmt->bindParam(':DS', $DS_HABILIDADE, PDO::PARAM_STR);
$stmt->bindParam(':LV', $LV_HABILIDADE, PDO::PARAM_STR);
$stmt->execute();  
echo "Habilidade Criada com sucesso";