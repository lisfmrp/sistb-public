<?php
/* Verifica se o usuário está logado */
if (!isset($_SESSION["cod_profissional"])) {
    die("<script> alert('window.location.href = 'index.html'; </script>");
}

/* Importa-se a classe Security */
require_once 'classes/Security.php';
$_GET = Security::filter($_GET);
$_POST = Security::filter($_POST);
 /* Importa-se o namespace (caminho do arquivo) da clase banco e 
    * cria-se um aliase (apelido) para ele */
    use Uteis\banco as banco;

    /* Importa-se a classe banco */
    require_once 'classes/banco.php';
    
    date_default_timezone_set('America/Sao_Paulo');
    //$data=date("dmY"); //aqui pegamos a data pois foi ela quem usamos como valor da sessao logado
    
    /* Cria um objeto da classe banco, voltado para o sistb 
        * e realiza a conexão */
        $db = banco::connectToTB();

?>
<!-- box with default header [begin] -->
<div class="box box-header-black">
    <h3 class="header"><span class="header-2"><span class="header-3"><span class="color">:: Dados do Paciente ::</span></span></span></h3>
    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
    <div class="box-1">
        <div class="box-2">
            <div class="box-3 header-on">

                <!-- box with gradient [begin] -->
                <div class="box box-gradient">
                    <div class="box-t1"><div class="box-t2"><div class="box-t3"></div></div></div>
                    <div class="box-1">
                        <div class="box-2">
                            <div class="box-3">

                                <?php
                                $cod = $conteudo[2];
                                
                                $select = "SELECT paciente.cod_paciente, paciente.nome, paciente.nro_prontuario, paciente.data_nascimento, paciente.sexo, 
                                 tratamento.forma_clinica1, tratamento.cod_paciente, tratamento.data_tratamento_atual, tratamento.data_alta_tratamento, tratamento.motivo_alta, tratamento.un_atendimento, tratamento.encerrado
                                FROM paciente, tratamento WHERE tratamento.cod_tratamento = '$cod' AND paciente.cod_paciente = tratamento.cod_paciente AND tratamento.encerrado= '2' ";

                                $infos = $db->selectQuery($select);
                                
                                //print_r($infos);
                                
                                $un_a = $infos[0]['un_atendimento'];
                                
                                $select2 = "SELECT cod_unidade, nome
                                FROM unidade WHERE cod_unidade = '$un_a' ";

                                $infos2 = $db->selectQuery($select2);

                                $nome = $infos[0]['nome'];
                                $nro_prontuario = $infos[0]['nro_prontuario'];
                                $data_nasc = $infos[0]['data_nascimento'];
                                $sexo = $infos[0]['sexo'];
                                
                                $fc1= $infos[0]['forma_clinica1'];;
                                $data_inicio = $infos[0]['data_tratamento_atual'];
                                $data_alta = $infos[0]['data_alta_tratamento'];
                                $alta = $infos[0]['motivo_alta'];
                                $unidade = $infos2[0]['nome'];

                                $sexo1 = "";
                                if ($sexo == "F") {
                                    $sexo1 = "Feminino";
                                } else {
                                    $sexo1 = "Masculino";
                                }

                                if ($data_nasc != NULL) {
                                    $data_nasc1 = implode("/", array_reverse(explode("-", $data_nasc)));
                                } else if ($data_nasc == "0000-00-00" || $data_nasc == NULL) {
                                    $data_nasc1 = "";
                                }
                                
                                if ($data_inicio != NULL) {
                                    $data_inicio1 = implode("/", array_reverse(explode("-", $data_inicio)));
                                } else if ($data_inicio == "0000-00-00" || $data_inicio == NULL) {
                                    $data_inicio1 = "";
                                }
                                
                                if ($data_alta != NULL) {
                                    $data_alta1 = implode("/", array_reverse(explode("-", $data_alta)));
                                } else if ($data_alta == "0000-00-00" || $data_alta == NULL) {
                                    $data_alta1 = "";
                                }
                                
                                ?>


                                <br/>
                                <h2 class="title">Informações Gerais</h2> 
                                <b>Nome paciente: </b><?= $nome; ?><br/>
                                <b>Número do Prontuário: </b><?= $nro_prontuario; ?><br/>
                                <b>Data de Nascimento: </b><?= $data_nasc1; ?><br/>
                                <b>Sexo: </b><?= $sexo1; ?><br/>
                                <b>Forma Clínica: </b><?= $fc1; ?><br/>
                                <b>Data início do Tratamento: </b><?= $data_inicio1; ?><br/>
                                <b>Data Alta: </b><?= $data_alta1; ?><br/>
                                <b>Tipo de Alta: </b><?= $alta; ?><br/>
                                <b>Unidade de Atendimento: </b><?= $unidade; ?><br/>
                                
                                <br/>


                            </div>
                        </div>
                    </div>
                    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
                </div>
                <!-- box with default header [end] -->	

                <p></p>

               

            </div>
        </div>
    </div>
    <div class="box-b1"><div class="box-b2"><div class="box-b3"></div></div></div>
</div>
<!-- box with default header [end] -->