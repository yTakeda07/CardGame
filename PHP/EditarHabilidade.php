<?php
include "conecta.php";

$id = $_POST["id"];
$NM_HABILIDADE = $_POST["NM_HABILIDADE"];
$DS_HABILIDADE = $_POST["DS_HABILIDADE"];
$LV_HABILIDADE = $_POST["LV_HABILIDADE"];

$update = "UPDATE tb_habilidade 
           SET NM_HABILIDADE = :NM, 
               DS_HABILIDADE = :DS, 
               LV_HABILIDADE = :LV 
           WHERE CD_HABILIDADE = :ID";

$stmt = $conn->prepare($update);
$stmt->bindParam(':NM', $NM_HABILIDADE, PDO::PARAM_STR);
$stmt->bindParam(':DS', $DS_HABILIDADE, PDO::PARAM_STR);
$stmt->bindParam(':LV', $LV_HABILIDADE, PDO::PARAM_STR);
$stmt->bindParam(':ID', $id, PDO::PARAM_INT);

$stmt->execute();

echo "<script>alert('Habilidade atualizada com sucesso')</script>";
