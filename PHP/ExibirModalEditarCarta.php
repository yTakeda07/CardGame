<?php

include "conecta.php";
$id = $_POST["id"];

$exibir = "SELECT * FROM tb_carta WHERE CD_CARTA = " . $id . ";";
$stmt = $conn->query($exibir);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$TP_CARTA = $row["TP_CARTA"];
$CD_UNIVERSO_CARTA = $row["CD_UNIVERSO"];

$exibir = "SELECT * from tb_habilidade;";

$stmt2 = $conn->query($exibir);

$exibir = "SELECT * from tb_universo;";
    //comando sql para exibir colunas da tabela


$stmt3 = $conn->query($exibir);

$exibir = "SELECT * FROM tb_habilidade_carta WHERE CD_CARTA = " . $id . ";";

$stmt4 = $conn->query($exibir);
$row4 = $stmt4->fetchAll(PDO::FETCH_ASSOC);
$CD_HABILIDADES = array_column($row4, "CD_HABILIDADE");


if ($row) {
    echo "
                <div class='conteudoeditarmodal'>
                    <button class='close-button' onclick='closemodal(this)'>✖</button>
        
                    <div class='lado-esquerdo'>
                        <!-- Preview da imagem -->
                       <p id='previewtexto'>Nome: ".$row["NM_CARTA"]."</p>
                        <img id='preview-imagem' src='../PHP/".$row["CAMINHO_IMG_CARTA"]."' alt='Prévia' style='max-width: 100%; height: auto;'>
                    </div>
        
                    <div class='lado-direito'>
               
                            <input type='file' name='imagem' id='arquivo' required onchange='previewImagem(this)'>
                            <br><br>
                            <input type='text' value='".$row["NM_CARTA"]."' name='nome' id='NM_CARTA' oninput='alterar(this)' required placeholder='Nome do personagem'>
                            <br><br>
                            <textarea name='descrição' maxlength='200' id='DS_CARTA' required placeholder='Descrição'>".$row["DS_CARTA"]."</textarea>
                            <br><br>
                               <label>Raridade: </label> <select name='' id='TP_CARTA' onchange='raridadecartapreview(this)'>
                                    <option style='color:gray;' " . ($TP_CARTA == 'Comum' ? 'selected' : '') . " value='Comum'>Comum</option>
                                    <option style='color:green;' " . ($TP_CARTA == 'incomum' ? 'selected' : '') . " value='Incomum'>Incomum</option>
                                    <option style='color:blue;' " . ($TP_CARTA == 'Raro' ? 'selected' : '') . " value='Raro'>Rara</option>
                                    <option style='color:purple;' " . ($TP_CARTA == 'Épica' ? 'selected' : '') . " value='Épica'>Épica</option>
                                    <option style='color:yellow;' " . ($TP_CARTA == 'Lendária' ? 'selected' : '') . " value='Lendária'>Lendária</option>
                                    <option style='color:red;' " . ($TP_CARTA == 'Mítica' ? 'selected' : '') . " value='Mítica'>Mítica</option>
                                </select>
                                <br><br>

                                <fieldset class='fieldsetatributo'><legend>Atributos</legend>
                                <div class='atributos'>
                                  <div class='range-container'>
                                    <label class='range-label' for='customRange'>Força: </label><div class='range-value' id='rangeValueForca'>".$row["ATB_FORCA"]."</div>
                                        <input type='range' class='rangeValueForca' id='customRange' min='1' max='100' value='".$row["ATB_FORCA"]."' oninput='mudargrafico(this), rangeValueForca.textContent = this.value'>
                                        <br><br>
                                        
                                    <label class='range-label' for='customRange'>Velocidade</label><div class='range-value' id='rangeValueVelocidade'>".$row["ATB_VELOCIDADE"]."</div>
                                        <input type='range' class='rangeValueVelocidade' id='customRange' min='1' max='100' value='".$row["ATB_VELOCIDADE"]."' oninput='mudargrafico(this), rangeValueVelocidade.textContent = this.value'>
                                        <br><br>
                                        
                                    <label class='range-label' for='customRange'>Inteligencia</label><div class='range-value' id='rangeValueInteligencia'>".$row["ATB_INTELIGENCIA"]."</div>
                                        <input type='range' class='rangeValueInteligencia' id='customRange' min='1' max='100' value='".$row["ATB_INTELIGENCIA"]."' oninput='mudargrafico(this), rangeValueInteligencia.textContent = this.value'>
                                        <br><br>
                                        
                                    <label class='range-label' for='customRange'>Vitalidade</label><div class='range-value' id='rangeValueVitalidade'>".$row["ATB_VITALIDADE"]."</div>
                                        <input type='range' class='rangeValueVitalidade' id='customRange' min='1' max='100' value='".$row["ATB_VITALIDADE"]."' oninput='mudargrafico(this), rangeValueVitalidade.textContent = this.value'>
                                        <br><br>
                                        
                                    <label class='range-label' for='customRange'>Resistencia</label><div class='range-value' id='rangeValueResistencia'>".$row["ATB_RESISTENCIA"]."</div>
                                        <input type='range' class='rangeValueResistencia' id='customRange' min='1' max='100' value='".$row["ATB_RESISTENCIA"]."' oninput='mudargrafico(this), rangeValueResistencia.textContent = this.value'>
                                        

                                  </div>
                                        <div class='grafico'>
                                            <canvas id='grafico'>

                                            </canvas>
                                        </div>
                                  </div>
                                  </fieldset>
                                <br><br>
                                <fieldset class='fieldsetuniversos'><legend>Universos</legend>
                                <div class='universos-container'>"; 

                                   if ($stmt3->rowCount() > 0) {
                                    //se existir mais de 0 linhas na coluna, vai executar
                                    while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                                        
                                        echo "
                                        <label style='display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;'>
                                        <input type='radio' id='".$row3["CD_UNIVERSO"]."' name='universo' value='".$row3["NM_UNIVERSO"]."' " . ($CD_UNIVERSO_CARTA == $row3["CD_UNIVERSO"] ? 'checked' : '') . " style='margin-right: 10px;'>
                                        <img src='../PHP/".$row3["CAMINHO_IMG_UNIVERSO"]."' alt='universo' style='width: 50px; height: 50px; object-fit: cover; margin-right: 10px;'>
                                        ".$row3["NM_UNIVERSO"]."
                                      </label>";
                                    }
                                }     else{
                                    echo "nenhum universo encontrado, <a href='universo.html'>Crie um</a>";}                           

                                   echo " 
                                   <a href='universo.html'>Crie um</a>
                                </div>
                                </fieldset>
                                <br><br>
                                <fieldset class='fieldsethabilidades'><legend>Habilidades</legend>
                                <div class='habilidades-container'>"; 

                                   if ($stmt2->rowCount() > 0) {
                                    //se existir mais de 0 linhas na coluna, vai executar
                                while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                    $checked = in_array($row2["CD_HABILIDADE"], $CD_HABILIDADES) ? 'checked' : '';
                    echo "
                        <label style='display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;'>
                        <input type='checkbox' id='".$row2["CD_HABILIDADE"]."' name='habilidade[]' value='".$row2["CD_HABILIDADE"]."' $checked style='margin-right: 10px;'> ".$row2["NM_HABILIDADE"]."
                            </label>";
}
                                }     else{
                                    echo "nenhuma habilidade encontrada, <a href='habilidades.html'>Crie uma</a>";}                           

                                   echo " 
                                   <a href='habilidades.html'>Crie uma</a>
                                </div>
                                </fieldset>
                                <br><br>
                            <button id='uploadcarta' onclick='uploadcarta(this)'>Enviar</button>

                    </div>
                </div>
";
}
?>
