<?php

include "conecta.php";

echo "
                <div>
                    <button class='close-button' onclick='closemodal(this)'>✖</button>
                        <!-- Preview da imagem -->

                        <h2>Criar Habilidade</h2>
                        <br><br>

                            <label>Nome: </label><input type='text' name='nome' id='NM_HABILIDADE' oninput='alterar(this)' required placeholder='Nome da Habilidade'>
                            <br><br>
                            <textarea name='DS_HABILIDADE' maxlength='200' id='DS_HABILIDADE' required placeholder='Descrição'></textarea>
                            <br><br>
                               <label>Nivel: </label> <select name='LV_HABILIDADE' id='LV_HABILIDADE'>
                                    <option value='1'>1 ESTRELA</option>
                                    <option value='2'>2 ESTRELAS</option>
                                    <option value='3'>3 ESTRELAS</option>
                                    <option value='4'>4 ESTRELAS</option>
                                    <option value='5'>5 ESTRELAS</option>
                                </select>
                                <br><br>
                            <button id='uparhabilidade' onclick='uparhabilidade(this)'>Criar Habilidade</button>
                        <div class='respmodal'></div>

                </div>
";