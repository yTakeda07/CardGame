<?php

include "conecta.php";

$exibir = "SELECT * from tb_universo;";
    //comando sql para exibir colunas da tabela


$stmt = $conn->query($exibir);

$exibir = "SELECT * from tb_habilidade;";

$stmt2 = $conn->query($exibir);


echo "
                <div class='conteudoeditarmodal'>
                    <button class='close-button' onclick='closemodal(this)'>✖</button>
        
                    <div class='lado-esquerdo'>
                        <!-- Preview da imagem -->
                       <p id='previewtexto'>Nome: </p>
                        <img id='preview-imagem' src='' alt='Prévia' style='max-width: 100%; height: auto;'>
                    </div>
        
                    <div class='lado-direito'>
               
                            <input type='file' name='imagem' id='arquivo' required onchange='previewImagem(this)'>
                            <br><br>
                            <input type='text' name='nome' id='NM_CARTA' oninput='alterar(this)' required placeholder='Nome do personagem'>
                            <br><br>
                            <textarea name='descrição' maxlength='200' id='DS_CARTA' required placeholder='Descrição'></textarea>
                            <br><br>
                               <label>Raridade: </label> <select name='' id='TP_CARTA' onchange='raridadecartapreview(this)'>
                                    <option style='color:gray;' value='Comum'>Comum</option>
                                    <option style='color:green;' value='Incomum'>Incomum</option>
                                    <option style='color:blue;' value='Rara'>Rara</option>
                                    <option style='color:purple;' value='Épica'>Épica</option>
                                    <option style='color:yellow;' value='Lendária'>Lendária</option>
                                    <option style='color:red;' value='Mítica'>Mítica</option>
                                </select>
                                <br><br>

                                <fieldset class='fieldsetatributo'><legend>Atributos</legend>
                                <div class='atributos'>
                                  <div class='range-container'>
                                    <label class='range-label' for='customRange'>Força: </label><div class='range-value' id='rangeValueForca'>20</div>
                                        <input type='range' class='rangeValueForca' id='customRange' min='1' max='100' value='20' oninput='mudargrafico(this), rangeValueForca.textContent = this.value'>
                                        <br><br>
                                        
                                    <label class='range-label' for='customRange'>Velocidade</label><div class='range-value' id='rangeValueVelocidade'>20</div>
                                        <input type='range' class='rangeValueVelocidade' id='customRange' min='1' max='100' value='20' oninput='mudargrafico(this), rangeValueVelocidade.textContent = this.value'>
                                        <br><br>
                                        
                                    <label class='range-label' for='customRange'>Inteligencia</label><div class='range-value' id='rangeValueInteligencia'>20</div>
                                        <input type='range' class='rangeValueInteligencia' id='customRange' min='1' max='100' value='20' oninput='mudargrafico(this), rangeValueInteligencia.textContent = this.value'>
                                        <br><br>
                                        
                                    <label class='range-label' for='customRange'>Vitalidade</label><div class='range-value' id='rangeValueVitalidade'>20</div>
                                        <input type='range' class='rangeValueVitalidade' id='customRange' min='1' max='100' value='20' oninput='mudargrafico(this), rangeValueVitalidade.textContent = this.value'>
                                        <br><br>
                                        
                                    <label class='range-label' for='customRange'>Resistencia</label><div class='range-value' id='rangeValueResistencia'>20</div>
                                        <input type='range' class='rangeValueResistencia' id='customRange' min='1' max='100' value='20' oninput='mudargrafico(this), rangeValueResistencia.textContent = this.value'>
                                        

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

                                   if ($stmt->rowCount() > 0) {
                                    //se existir mais de 0 linhas na coluna, vai executar
                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                        echo "
                                        <label style='display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;'>
                                        <input type='radio' id='".$row["CD_UNIVERSO"]."' name='universo' value='".$row["NM_UNIVERSO"]."' style='margin-right: 10px;'>
                                        <img src='../PHP/".$row["CAMINHO_IMG_UNIVERSO"]."' alt='universo' style='width: 50px; height: 50px; object-fit: cover; margin-right: 10px;'>
                                        ".$row["NM_UNIVERSO"]."
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
                                    while ($row = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                                        echo "
                                        <label style='display: flex; align-items: center; margin-bottom: 10px; cursor: pointer;'>
                                        <input type='checkbox' id='".$row["CD_HABILIDADE"]."' name='habilidade' value='".$row["NM_HABILIDADE"]."' style='margin-right: 10px;'>
                                        ".$row["NM_HABILIDADE"]."
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