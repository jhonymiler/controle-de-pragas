<?
define('DS', DIRECTORY_SEPARATOR);
require_once dirname(dirname(__FILE__)) . DS . 'acesso.php';
$ord = new ordemServico;
$orc = new orcamento;


if (empty($_GET['ord_id'])) {
    $mensagem = getMsg('Informe o número da OS', 'alerta');
} else {

    $os = $ord->getOs($_GET['ord_id']);
    if (is_array($os)) {
        $orcamento = $orc->getOrcamento($os['ORC_id']);
        $cliente = $orc->getCliente($orcamento['CLI_id']);
        $vistoria = $orc->getVistoria($orcamento['VIS_id']);
        $primeiraOs = ($os['id_pai'] == 0) ? $os['ORD_id'] : $os['id_pai'];
        
        $servicos  = new Registro('servicos');
        $servico = $servicos->_select('SER_id',$vistoria['SER_id']);
        $servico = $servico[0];
    }
    if (!is_array($os)) {
        $mensagem = getMsg('O número da OS é inválido!', 'erro');
        $id = '';
    } else {
        $id = "&ord_id=" . $_GET['ord_id'];
    }
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>ordem de Serviço nº: <?= $_GET['ord_id'] ?></title>
		<script src="http://code.jquery.com/jquery-1.7.2.js"></script>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.css" rel="stylesheet">

        <!-- Add custom CSS here -->
        <style>
            #cabecalho{
                border-bottom: 1px dashed #999;
            }
            #cabecalho #logo{
                padding-top:30px;
            }
            .container{
                width:21cm;
                font-size:12px;

            }
			#execucao_servicos tbody > tr > td {
				padding:2px !important;
			}
			#ass{
				list-style:none;
			}
			#ass li{
				display:inline-block;
				border-top:1px solid #333;
				padding-top:10px;
				margin-top:35px;
				text-align:center;
				
			}
        </style>
		<script>
        	function imprimir(el){
				
				$("#"+el).print()
			}
        </script>
    </head>

    <body>

        <div id="content" class="container">
            <div class="row">
                <?
                if (!empty($mensagem)) {
                    echo $mensagem;
                } else {
                    ?>
                    
                    <? if(!isset($_GET['branco']) && !isset($_GET['dispositivos'])){ ?>
                        <a href="<?=$_SESSION['URL']?>impressao/ppi.php?ord_id=<?=$_GET['ord_id']?>&branco" target="_blank">Imprimir página em branco.</a>
                        <a href="<?=$_SESSION['URL']?>impressao/ppi.php?ord_id=<?=$_GET['ord_id']?>&dispositivos" target="_blank">Imprimir Dispositivos.</a>
					<? }?>
                    
                    <table  id="cabecalho" class="table">
                        <thead>
                            <tr>
                                <th colspan="2" align="center"><h3 align="center">Planilha de Avaliação de Dispositivos</h3></th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="73%" align="left"><strong style="font-size:13px">PPI - Ponto Permanente de Iscagem para Roedores</strong><br>
                                  são dispositivos de captura, numerados e/ou fixos ao piso, contendo cola em seu interior. Não contém nenhum composto tóxico.</td>
                                <td width="27%" align="left" valign="top"><h3>os: <?=$os['ORD_id']?></h3></td>
                            </tr>
                            <tr>
                              <td colspan="2">


                                <p></p>

                                  <table border="1" class="table">
                                      <thead>
                                          <tr>
                                            <th width="46%"><h4><?=$cliente['CLI_nome']?></h4>
                                            <strong>Critério de Avaliação:</strong> Captura ou vestigios de roedores na placa adesiva.<br></th>
                                            <th width="20%" colspan="5">&nbsp;</th>
                                            <th width="16%" colspan="5">&nbsp;</th>
                                            <th width="18%" align="center" valign="top"></th>
                                          </tr>
                                          <tr>
                                              <th>LOCAL INSTALADO</th>
                                              <th colspan="5" align="center">PORTA PLACA</th>
                                              <th colspan="5" align="center">PLACA ADESIVA</th>
                                              <th>&nbsp;</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                          <tr>
                                              <td>&nbsp;</td>
                                              <td align="center">MN</td>
                                              <td align="center">AI</td>
                                              <td align="center">DN</td>
                                              <td align="center">EX</td>
                                              <td align="center">DS</td>
                                              <td align="center">PC</td>
                                              <td align="center">PI</td>
                                              <td align="center">PD</td>
                                              <td align="center">EX</td>
                                              <td align="center">PS</td>
                                              <td>&nbsp;</td>
                                          </tr>
                                          
                                          <?
                                                if(!isset($_GET['branco'])){
                                                        $pontos = json_decode($os['ORD_pontos']);
                                                        foreach ($pontos as $value) {
                                                            if($value->tipo_dispositivo == 'ppi'){
                                                                $ppis[] = $value;
                                                            }
                                                        }
                                                }
						
                                                if(count($ppis) > 35){
                                                    $indice = count($ppis);
                                                }else{
                                                    $indice = 30;
                                                }
                                                $i = 0;
                                                while($i < $indice){
                                                    
                                          ?>
                                          <tr>
                                            <td><?=$ppis[$i]->num." ".$ppis[$i]->local;?></td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td>&nbsp;</td>
                                          </tr>
                                          
                                          <?	
                                                $i++;
                                            }
                                          ?>
                                          <tr>
                                            <td align="right"><h5>Resultado:</h5></td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td align="center">&nbsp;</td>
                                            <td>&nbsp;</td>
                                        </tr>
                                          <tr>
                                            <td colspan="12" align="left"> MN = MONITORADO, AI = ACESSO INPEDIDO, DN = DANIFICADO, EX = EXTRAVIADO, DS = PORTA PLACA SUBISTITUIDO, PC = PLACA COM CAPTURA, PI = PLACA INTÁCTA, PD = PLACA DANIFICADA, PS = PLACA SUBSTITUIDA</td>
                                          </tr>
                                      </tbody>
                                  </table>
                                  <p>&nbsp;</p>
                                  <hr>
                                  <div align="center"><h5>Técnico Responsável</h5></div>





                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-lg-12">

                    </div>
                </div>
                <? }?>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>

