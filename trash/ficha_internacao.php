<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Ficha de Interna��o ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
                            <?php						
								$cod_internacao = $conteudo[2];
                                $cod = $conteudo[3];							
							
                                $aut = "SELECT un_supervisao, un_atendimento FROM tratamento WHERE cod_paciente = '$cod' AND (un_supervisao = '$_SESSION[cod_unidade]' OR un_atendimento = '$_SESSION[cod_unidade]')";
                                $auts = $db->selectQuery($aut);
							
								if (empty($auts[0])) {
									echo "Acesso restrito. Apenas profissionais da unidade de supervis�o do paciente podem acessar essa �rea.";									
								} else {
								
                                $select = "SELECT cod_internacao, internacao.cod_unidade,
									data, motivo, data_alta,tipo_alta,
									internacao.observacoes, internacao.cod_paciente, paciente.nome, unidade.nome as nome_unidade,
									internacao.cod_profissional_alta as nome_profissional_alta
								   FROM internacao LEFT JOIN paciente ON internacao.cod_paciente = paciente.cod_paciente
								   LEFT JOIN unidade ON internacao.cod_unidade = unidade.cod_unidade
								   
								   
								   WHERE cod_internacao = '$cod_internacao'
								  ";

								$consultas = $db->selectQuery($select);
								
								$cod_internacao = $consultas[0]['cod_internacao'];
								$cod_unidade = $consultas[0]['cod_unidade'];
								$data_internacao = $consultas[0]['data'];
								$motivo = $consultas[0]['motivo'];
								$data_alta= $consultas[0]['data_alta'];
								$tipo_alta = $consultas[0]['tipo_alta'];
								$observacoes = $consultas[0]['observacoes'];
								$cod_paciente = $consultas[0]['cod_paciente'];
								
								//$cod_profissional = $consultas[0]['cod_profissional'];
								$nome_paciente= $consultas[0]['nome'];
								$nome_unidade = $consultas[0]['nome_unidade'];
								
								$nome_profissional_alta = $consultas[0]['nome_profissional_alta'];


                                if ($data_internacao == "0000-00-00" || $data_internacao == NULL || $data_internacao == "") {
                                    $data_internacao1 = "";
                                } else {
                                    $data_internacao1 = implode("/", array_reverse(explode("-", $data_internacao)));
                                }

                                if ($data_alta == "0000-00-00" || $data_alta == NULL || $data_alta == "") {
                                    $data_alta1 = "";
                                } else
                                if ($data_alta != NULL) {
                                    $data_alta1 = implode("/", array_reverse(explode("-", $data_alta)));
                                }
                                ?>



                                <br/>
                                <h2 class="title">Interna��o - Informa��es</h2> 
                                <b>Nome do paciente: </b><?= $nome_paciente; ?><br/>
                                <b>Hospital: </b><?= $nome_unidade; ?><br/>
                                <b>Data interna��o: </b><?= $data_internacao1; ?><br/>
                                <b>Motivo: </b><?= $motivo; ?><br/>
                                <b>Data alta: </b><?= $data_alta1; ?><br/>
                                <b>Tipo sa�da hospitalar: </b><?= $tipo_alta; ?><br/>
                                <b>Profissional respons�vel pela alta: </b><?= $nome_profissional_alta; ?><br/>
                                <b>Observa��es: </b><?= $observacoes; ?><br/>

                                <br/>

                                <br/>


                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>

                <div class="box box-gradient">    
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3 header-on">
                                <h2 class="title">Alta do Paciente</h2>
                                <form method="POST" class="validar" action="internacao_post.php">
                                    <p>
                                        <input type="hidden" name="cod_internacao" value= "<?= $cod_internacao; ?>" /> </p>
                                        <input type="hidden" name="cod_paciente" value= "<?= $cod; ?>" /> </p>
                                    <p>
                                        <label>Nome paciente:</label><br/>
                                        <input type="text" value="<?= $nome_paciente; ?>" class="text small" name="nome_paciente" readonly="readonly" /> 
                                    </p>

                                    <p>
                                        <label>Hospital:</label><br/>
                                        <input type="text" value="<?= $nome_unidade; ?>" class="text small" name="nome_unidade" readonly="readonly" /> 
                                    </p>



                                    <p>
                                        <label>Data alta (dd/mm/aaaa):</label><br/>
                                        <input type="text" value="<?= $data_alta1; ?>" class="text small data" name="data_alta" /> 
                                    </p>

                                    <p>
                                        <label>Tipo da alta:</label><br/>
                                        <select name="saida"> 
                                            <option selected ="" value="" ></option>
                                            <option value="Cura">Cura</option>
                                            <option value="A pedido">A pedido</option>
                                            <option value="Disciplinar">Disciplinar</option>
                                            <option value="Mudan�a de diagn�stico">Mudan�a de diagn�stico</option> 
                                            <option value="Alta para tratamento ambulatorial">Alta para tratamento ambulatorial</option>
                                            <option value="Transferencia de hospital">Transferencia de hospital</option>
                                            <option value="�bito por TB">�bito por TB</option>
                                            <option value="�bito por outra causa">�bito por outra causa</option>
                                            <option value="Evadiu-se">Evadiu-se</option> 
                                            <option value="�bito TB+AIDS">�bito TB+AIDS</option>
                                            <option value="Sem informa��o">Sem informa��o</option>
                                        </select>
                                    </p>


                                    <p>
                                        <label>Profissional respons�vel pela alta:</label><br/>
                                       <input type="text" class="text small" name="profissional_alta" /> 
                                    </p> 									


                                    <p>
                                        <label>Observa��es:</label><br/>
                                        <input type="text" value="<?= $observacoes; ?>" class="text small" name="observacoes" /> 
                                    </p>


                                    <p>
                                        <button  class="classy" onclick="return confirm('Tem certeza que deseja atualizar os dados deste paciente?');"><span>Salvar altera��es</span></button>
                                    </p>

                                </form>
                                <!-- form elements [end] -->


							<?php } ?>


                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
                <!-- box with gradient [end] --> 


            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<!-- box with default header [end] -->