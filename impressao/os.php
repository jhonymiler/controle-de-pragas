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

    </head>

    <body>

        <div class="container">
            <div class="row">
                <?
                if (!empty($mensagem)) {
                    echo $mensagem;
                } else {
                    ?>
                    <table  id="cabecalho" class="table">
                        <thead>
                            <tr>
                                <th width="26%"><img src="../images/logo.png" class="img-rounded"/></th>
                                <th width="74%"><h3>Terra Ambiental Controle de Pragas</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><h4>OS Nº: <?= $_GET['ord_id'] ?></h4></td>
                                <td>Rua Joaquim Avelar Campos, 303 - CEP 187060-000 Cerqueira Cesar/SP<br>
                                    Contatos: (14) 3714-1785  / asseio.avare@asseio.com.br<br>
                                    CNPJ: 07.684.801/0001-62 Nº CEVS: 351140901-812-000001-1-6<br>
                                    RESP Técnico: Antônio Gabriel S. Filho CRSIo: 40964/01-D<br>
                                    IBAMA: 4470586 - 11/10/2011 </td>
                            </tr>
                            <tr>
                                <td colspan="2">




                                    <table  class="table">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Hora</th>
                                                <th>Aguardando no Local</th>
                                                <th>Tipo de Visita</th>
                                                <th>Tipo de Ativ.</th>
                                                <th>Confirmado Por</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?=$os['ORD_data_visita']?></td>
                                                <td><?=$os['ORD_hora_visita']?></td>
                                                <td><?=$os['ORD_aguardando']?></td>
                                                <td><?=$ord->tipoVisita[$os['ORD_tipo_visita']]?></td>
                                                <td><?=$ord->tipoAtividade[$os['ORD_atividade']]?></td>
                                                <td><?=$os['ORD_agendado']?></td>
                                            </tr>
                                        </tbody>
                                    </table>            





                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="col-lg-12">

                    </div>
                </div>
                <div class="row">

                    <table  id="cabecalho" class="table">
                        <thead>
                            <tr>
                                <th width="50%">Empresa </th>
                                <th width="50%">Informações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <br>
                                    <?=$cliente['CLI_nome']?><br>
                                    <?=$cliente['CLI_rua']?>,<?=$cliente['CLI_num']?><br>
                                    <?=$cliente['CLI_bairro']?>, <?=$cliente['CLI_cidade']?>/<?=$cliente['CLI_uf']?><br>
                                    Contatos: <?=$cliente['CLI_tel1']?>  / <?=$cliente['CLI_tel2']?> / <?=$cliente['CLI_tel3']?><br>
                                    CPF/CNPJ: <?=$cliente['CLI_cpf_cnpj']?>
                                  <br>
                                  <br>
                                <td>
                                    
                                    <b>Serviço:</b><?=$servico['SER_nome']?><BR>
                                    <b>Descrição:</b> <?=$servico['SER_descricao']?><BR>
                                    <b>Atividade:</b> <?=$ord->tipoAtividade[$os['ORD_atividade']]?></td>
                            </tr>
                            <tr>
                                <td colspan="2"><table  class="table">
                                  <thead>
                                    <tr>
                                      <th>Local</th>
                                      <th>Especie</th>
                                      <th>Vestigio</th>
                                      <th>Nível</th>
                                      <th>Tratamento</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?
                                                $tratamento =  CJSON::decode($os['ORD_detalhes_tratamento']);
                                                if(is_array($tratamento))
                                                foreach($tratamento as $tra){
                                           ?>
                                    <tr>
                                      <td><?=$tra['ambiente'];?></td>
                                      <td><?=$tra['ep']['nome'];?></td>
                                      <td><?=$tra['ve'];?></td>
                                      <td><?=$tra['ni'];?></td>
                                      <td><?= ($tra['te']);?></td>
                                    </tr>
                                    <? }?>
                                  </tbody>
                                </table>
                                
                                <p style="font-size:11px;">Produtos, dispositivos e insumos utilizados. Os campos "Lote" e "Validade" não se aplicam aos dispositivos e insumos. O campo "Quantidade de Calda" não se aplica para produtos prontos. Consultar tabela de produtos. </p>
                                
                                
                                  <table width="100%" border="1" cellspacing="0" cellpadding="1">
                                    <tr>
                                      <td width="6%" rowspan="3" align="center">Cod</td>
                                      <td width="37%" rowspan="3" align="center">Produto</td>
                                      <td width="8%" rowspan="3" align="center">Qtd. Prod</td>
                                      <td colspan="3" align="center">Unid de Medida</td>
                                      <td width="8%" rowspan="3" align="center">Qtd. Calda</td>
                                      <td width="14%" rowspan="3" align="center">Lote</td>
                                      <td width="12%" rowspan="3" align="center">Validade</td>
                                    </tr>
                                    <tr>
                                    </tr>
                                    <tr>
                                      <td width="5%" align="center">ML</td>
                                      <td width="5%" align="center">Grs</td>
                                      <td width="5%" align="center">Unid</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                   
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                  
                                  <table  class="table">
                                    <thead>
                                      <tr>
                                        <th colspan="5" align="center"><P style="font-size:11px;">&nbsp;</P></th>
                                      </tr>
                                      <tr>
                                        <th width="16%">Eq. Técnica:<br><br></th>
                                        <th width="20%">Cel:<br><br></th>
                                        <th width="15%">Nº Veic.:<br><br></th>
                                        <th width="31%">Consultor Técnico:<br><br></th>
                                        <th width="18%">Celular<br><br></th>
                                      </tr>
                                      
                                    </thead>
                                    <tbody>
                                   
                                       <tr>
                                        <td colspan="5">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td>
                                                    <table id="execucao_servicos" width="100%" border="1" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                        <td width="15%" align="center"></td>
                                                        <td width="25%" align="center">Horário</td>
                                                        <td width="60%" align="center">Quilometragem</td>
                                                      </tr>
                                                       <tr>
                                                        <td align="center">Partida</td>
                                                        <td align="center"></td>
                                                        <td align="center"></td>
                                                      </tr>
                                                     
                                                       <tr>
                                                        <td align="center">Chegada</td>
                                                        <td align="center"></td>
                                                        <td align="center"></td>
                                                      </tr>
                                                     
                                                       <tr>
                                                        <td align="center">Início</td>
                                                        <td align="center"></td>
                                                        <td rowspan="2" align="center"></td>
                                                      </tr>
                                                     
                                                       <tr>
                                                        <td align="center">Término</td>
                                                        <td align="center"></td>
                                                      </tr>
                                                   </table>
                                                </td>
                                                <td>
                                                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                        <td>&nbsp; <input type="checkbox" name="checkbox" id="checkbox">
                                                          <label for="checkbox"></label>
                                                        Executado</td>
                                                        <td>&nbsp;
                                                          <input type="checkbox" name="checkbox2" id="checkbox2">
                                                        Não Executado</td>
                                                      </tr>
                                                       <tr>
                                                        <td>&nbsp;
                                                          <input type="checkbox" name="checkbox4" id="checkbox4">
                                                         Incompleto</td>
                                                        <td>&nbsp;
                                                          <input type="checkbox" name="checkbox3" id="checkbox3">
                                                         Análise Crítica do gestor</td>
                                                       
                                                      </tr>
                                                     
                                                      
                                                   </table>
                                                    <p>&nbsp;Obs:</p>
                                                </td>
                                              </tr>
                                            </table>

                                        
                                        </td>
                                      </tr>
                                     
                                    </tbody>
                                </table></td>
                            </tr>
                        </tbody>
                    </table><br>

                  <p>Aceitamos os serviços descritos nesta CEG - Certificado de Execução e Garantia</p>
                   
                    <table  class="table">
                      <thead>
                        <tr>
                          <th colspan="4" align="center"><P style="font-size:11px;">&nbsp;</P></th>
                        </tr>
                        <tr>
                          <th width="29%">Nome Cliente:<br>
                            <br></th>
                          <th width="18%">Cargo:<br>
                            <br></th>
                          <th width="20%">Departamento:<br>
                            <br></th>
                          <th width="33%">Ass.<br>
                          <br></th>
                        </tr>
                        <tr>
                          <th>Data:&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;</th>
                          <th colspan="3"><br>
                          Técnico:</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                   
                <? } ?>
            </div>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>

