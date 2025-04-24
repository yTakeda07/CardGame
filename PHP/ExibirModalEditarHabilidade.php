<?php

include "conecta.php";
$id = $_POST["id"];

$exibir = "SELECT * FROM tb_habilidade WHERE CD_HABILIDADE = " . $id . ";";
$stmt = $conn->query($exibir);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$estrelaSelecionada = $row["LV_HABILIDADE"];

if ($row) {
    echo "
    <div>
        <button class='close-button' onclick='closemodal(this)'>✖</button>
        <h2>Criar Habilidade</h2>
        <br><br>

        <label>Nome: ".$row["NM_HABILIDADE"]."</label>
        <input type='text' name='nome' id='NM_HABILIDADE' oninput='alterar(this)' required placeholder='Nome da Habilidade' value='".$row["NM_HABILIDADE"]."'>
        <br><br>

        <textarea name='DS_HABILIDADE' maxlength='200' id='DS_HABILIDADE' required placeholder='Descrição'>".$row["DS_HABILIDADE"]."</textarea>
        <br><br>

        <label>Nível: </label> 
        <select name='LV_HABILIDADE' id='LV_HABILIDADE'>
            <option value='1' " . ($estrelaSelecionada == '1' ? 'selected' : '') . ">1 ESTRELA</option>
            <option value='2' " . ($estrelaSelecionada == '2' ? 'selected' : '') . ">2 ESTRELAS</option>
            <option value='3' " . ($estrelaSelecionada == '3' ? 'selected' : '') . ">3 ESTRELAS</option>
            <option value='4' " . ($estrelaSelecionada == '4' ? 'selected' : '') . ">4 ESTRELAS</option>
            <option value='5' " . ($estrelaSelecionada == '5' ? 'selected' : '') . ">5 ESTRELAS</option>
        </select>
        <br><br>

        <button id='".$row["CD_HABILIDADE"]."' onclick='EditarHabilidade(this)'>Editar habilidade</button>
        <div class='respmodal'></div>
    </div>
    ";
}
?>
