<?php

include "conecta.php";

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
                            <textarea name='descrição' maxlength='200' id='DS_CARTA' oninput='alterartextarea(this)' required placeholder='Descrição'></textarea>
                            <br><br>
                            <button id='uploadcarta'>Enviar</button>

                    </div>
                </div>
";