<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Cadastro de Paciente ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">
                                <form method="post" class="validar" action="paciente_inserir.php">                                                                     
                                    <p>
                                        <label>Campos com (*) são obrigatórios!</label><br/>
                                    </p>                                
                                    <p>
                                        <label for="nome">Nome do Paciente: (*)</label><br/>
                                        <input style='text-transform:uppercase' type="text" class="text small required" name="nome" id="nome"/> 
                                    </p>                                    
                                    <p>
                                        <label for="cpf">CPF:</label><br/>
                                        <input type="text" class="text small cpf" name="cpf" id="cpf"/>
                                    </p>                                    
                                        <label f>Cartão Nacional de Saúde:</label><br/>
                                    <p>
                                        <input type="text" class="text small cns" name="cns" id="cns"/> 
                                    </p>                                    
                                    <p>
                                        <label>Número do Prontuário:</label><br/>
                                        <input type="text" class="text small" name="nro_prontuario" /> 
                                    </p>                                   
                                    <p>
                                        <label>Número Hygia:</label><br/>
                                        <input type="text" class="text small" name="nro_hygia" /> 
                                    </p>                                   
                                    <p>
                                        <label>Data de Nascimento (dd/mm/aaaa): (*)</label><br/>
                                        <input type="text" class="text small data required" name="data_nascimento" /> 
                                    </p>                                    
                                    <p>
                                        <label>Idade: (*)</label><br/>
                                        <input type="text" class="text small required" name="idade"/> 
                                    </p>
                                    <p>
                                        <label>Sexo: (*)</label><br/>
                                        <select name="sexo" class="required" onChange="verificaSexo(this.value)"> > 
                                            <option></option>
                                            <option value="M">Masculino</option> 
                                            <option value="F">Feminino</option> 
                                        </select>				
                                    </p>                                       
                                    <p>                                       
                                        <label id="labelselect1" style="display:none">Gestante:</label><br/>
                                        <select id="select1" name="gestante" style="display:none"> 
                                            <option></option>
                                            <option selected="Não" value="N">Não</option> 
                                            <option value="S">Sim</option> 
                                        </select>				
                                    </p>                                     
                                    <p>
                                        <label>Nome da mãe (*): </label><br/>
                                        <input type="text" class="text small required" name="mae" />
                                    </p>  
                                    <p>
                                        <label>Etnia:</label><br/>
                                        <select name="etnia"> 
                                            <option selected =""value=""></option>
                                            <option value="Amarelo">Amarelo</option>
                                            <option value="Branco">Branco</option>                                                         
                                            <option value="Indigena">Indígena</option>
                                            <option value="Negro">Negro</option> 
                                            <option value="Pardo">Pardo</option>
                                        </select>				
                                    </p>
                                    <p>
                                        <label>Naturalidade:</label><br/>
                                        <input type="text" class="text small" name="naturalidade"/> 
                                    </p>                                    
                                    <p>
                                        <label>Endereço:</label><br/>
                                        <input type="text" class="text small" name="endereco"/> 
                                    </p>                                    
                                    <p>
                                        <label>CEP: </label><br/>
                                        <input type="text" class="text small" name="cep" />
                                    </p>                                   
                                    <p>
										<label id="labeltel">Telefone:</label><br/> 
										<input type="text"  class="text small" name="telefone"/> 
                                    </p>                                     
                                    <p>
                                        <label>Cidade: (*)</label><br/>
                                        <input type="text" class="text small required" value="Ribeirão Preto" name="cidade" /> 
                                    </p>
                                    <p>
                                        <label for="estado">Estado:</label><br/>
                                        <select name="estado" id="estado">                                             
                                            <option value="AC">AC</option>
                                            <option value="AL">AL</option> 
                                            <option value="AM">AM</option>
                                            <option value="AP">AP</option> 
                                            <option value="BA">BA</option> 
                                            <option value="CE">CE</option> 
                                            <option value="DF">DF</option> 
                                            <option value="ES">ES</option> 
                                            <option value="GO">GO</option> 
                                            <option value="MA">MA</option> 
                                            <option value="MG">MG</option>
                                            <option value="MS">MS</option> 
                                            <option value="MT">MT</option>
                                            <option value="PA">PA</option>
                                            <option value="PB">PR</option> 
                                            <option value="PE">PE</option>
                                            <option value="PI">PE</option>
                                            <option value="PR">PR</option> 
                                            <option value="RJ">RJ</option> 
                                            <option value="RN">RN</option> 
                                            <option value="RS">RS</option> 
                                            <option value="RO">RO</option>  
                                            <option value="RR">RR</option> 
                                            <option value="SC">SC</option> 
                                            <option value="SE">SE</option>
                                            <option value="SP">SP</option> 
                                            <option value="TO">TO</option> 
                                        </select>				
                                    </p>	
                                    <p>
                                        <label>Escolaridade (anos concluídos):</label><br/>
                                        <input type="text" class="text small" name="escolaridade" /> 
                                    </p>                                                                                                                                              
                                    <p>
                                        <label>Tipo de Ocupação:</label><br/>
                                        <select name="tipo_ocupacao" onChange="verificaOpcao(this.value)"> 
                                            <option selected ="" value="" ></option>
                                            <option value="Prof. de Saúde">Prof. de Saúde</option>
                                            <option value="Prof. Sistema Presidiário">Prof. Sistema Presidiário</option>
                                            <option value="Desempregado">Desempregado</option>
                                            <option value="Aposentado">Aposentado</option> 
                                            <option value="Dona de Casa">Dona de Casa</option>
                                            <option value="Detento">Detento</option> 
                                            <option value="Outra">Outra</option>
                                        </select>				
                                    </p>
                                    <p>
                                        <label id="labelocup" style="display:none">Outra Ocupação:</label><br/>
                                        <input id="ocup" type="text" class="text small" name="ocupacao" style="display:none"/> 
                                    </p>
                                    <p>
                                        <label>Observações:</label><br/>
                                        <textarea class="text small" rows="5" cols="40" name="observacoes"></textarea> 
                                    </p>                               
                                    <p>
                                        <label>Número SINAN:</label><br/>
                                        <input type="text" class="text small" name="sinan" id="sinan" /> 
                                    </p>                 
                                    <p>
                                        <button class="classy" type="submit"><span>Salvar</span></button>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<script type="text/javascript">
	function verificaOpcao(value){
		if( value == "Outra"){
			document.getElementById("labelocup").style.display = "";
			document.getElementById("ocup").style.display = "";
		} else if(value != "Outra") {
			document.getElementById("labelocup").style.display = "None";
			document.getElementById("ocup").style.display = "None";            
		}	   
	}   
	function verificaSexo( value ){
		if( value == "F"){
			document.getElementById("labelselect1").style.display = "";
			document.getElementById("select1").style.display = "";
		} else if(value == "M") {
			document.getElementById("labelselect1").style.display = "None";
			document.getElementById("select1").style.display = "None";
		 }     
	}	
</script>