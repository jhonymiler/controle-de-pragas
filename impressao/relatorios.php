<?
define('DS', DIRECTORY_SEPARATOR);
require_once dirname(dirname(__FILE__)) . DS . 'acesso.php';
require_once($_SESSION['RAIZ'].DS.'classes/phplot/phplot.php');
$ord = new ordemServico;
$orc = new orcamento;
//Inclui a classe.
                        

//Define o Objeto da Classe


                       
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
        
        $func = new Registro('funcionarios');
        $user = $func->_select('FUN_id',$vistoria['VIS_gestor_id']);
        $gestor = $user[0];
    }
    if (!is_array($os)) {
        $mensagem = getMsg('O número da OS é inválido!', 'erro');
        $id = '';
    } else {
        $id = "&ord_id=" . $_GET['ord_id'];
    }
}



// ATIVIDADES REALIZADAS
$ordem_servicos = new Registro('ordem_servico');
$ordens = $ordem_servicos->_query("SELECT * FROM ordem_servico WHERE ORD_id='".$primeiraOs."' or id_pai='".$primeiraOs."' and ORD_data_visita >= '".date('Y-m')."-01' and ORD_data_visita <= '".date('Y-m')."-31' ORDER BY ORD_data_visita ASC");
foreach($ordens as $ords){
	$ordensId[] = $ords['ORD_id'];
}



//REGISTRO DE OCORRÊNCIA DE PRAGAS</h3>
$ocorrencia_pragas = new Registro('ocorrencia_pragas');
$pragas = $ocorrencia_pragas->_query("SELECT * FROM ocorrencia_pragas WHERE OCO_data >= '".date('Y-m')."-01' and OCO_data <= '".date('Y-m')."-31' and ORD_id ='".implode(',',$ordensId)."' ORDER BY OCO_data ASC");




//DEFENSIVOS QUÍMICOS EMPREGADOS NO PERÍODO</h3>
if(count($ordens)>0){
    $pros = array();
    foreach($ordens as $o){
        $ps = json_decode($o['ORD_defensivos']);
        if(count($ps)){
            foreach($ps as $p){
                $produto['id'] = $p->id;
                $produto['produto'] = $p->produto;
                $produto['qtd'] = $p->qtd;
                $produto['med'] = $p->med;
                $produto['valor'] = $p->valor;
                $produto['valor_total'] += $p->valor*$p->qtd;

                $pros[$p->id] = $produto;
            }
        }

    }
    /*
     * Listar produtos
     */
    $produtos_usados = new Registro('produtos');
    foreach($pros as $pro_id => $pro_arr){
       $pro_select =  $produtos_usados->_select('PRO_id',$pro_id);
       $pro_detalhes_db = $pro_select[0];
       
       $pro_detalhes[$pro_id] = array_merge($pro_detalhes_db, $pro_arr);
    }
}                         



//PPE EMPREGADO NO PERIODO
if(count($ordens)>0){
    $pros = array();
    foreach($ordens as $ordem){
        $pontos = json_decode($ordem['ORD_pontos']);
        if(count($pontos)){
			$monitoramento = new Registro('ppe');
            foreach($pontos as $pont){
                if($pont->tipo_dispositivo == 'ppe'){
                        $Instalados  = count($monitoramento->_query('SELECT * FROM ppe WHERE ORD_id="'.$ordem['ORD_id'].'"'));
                        $Monitorados = count($monitoramento->_query('SELECT * FROM ppe WHERE ORD_id="'.$ordem['ORD_id'].'" and PPE_baixa="1"'));
                        $Consumidos  = count($monitoramento->_query('SELECT * FROM ppe WHERE ORD_id="'.$ordem['ORD_id'].'" and PPE_isca="1" '));
                        $Extraviados = count($monitoramento->_query('SELECT * FROM ppe WHERE ORD_id="'.$ordem['ORD_id'].'" and PPE_porta_isca="2" '));
                        $Substituido = count($monitoramento->_query('SELECT * FROM ppe WHERE ORD_id="'.$ordem['ORD_id'].'" and PPE_porta_isca_substituido > 0 or PPE_isca_substituida > 0 '));

                        $linhaPPE[$ordem['ORD_id']]['data'] = $ord->filtroData($ordem['ORD_data_visita']);
                        $linhaPPE[$ordem['ORD_id']]['instalados'] = intval($Instalados);
                        $linhaPPE[$ordem['ORD_id']]['monitorados'] = intval($Monitorados);
                        $linhaPPE[$ordem['ORD_id']]['porc_monitorados'] = intval( ($Instalados > 0)?($Monitorados*100)/$Instalados:0 );

                        $linhaPPE[$ordem['ORD_id']]['consumido'] = intval($Consumidos);
                        $linhaPPE[$ordem['ORD_id']]['porc_consumido'] = intval( ($Instalados > 0)?($Consumidos*100)/$Instalados:0);

                        $linhaPPE[$ordem['ORD_id']]['extraviado'] = intval($Extraviados);
                        $linhaPPE[$ordem['ORD_id']]['porc_extraviado'] = intval(($Instalados > 0)?($Extraviados*100)/$Instalados:0);

                        $linhaPPE[$ordem['ORD_id']]['substituido'] =  intval($Substituido);
                        $linhaPPE[$ordem['ORD_id']]['porc_substituido'] =  intval(($Instalados > 0)? (($Substituido*100)/$Instalados):0 );

                }
            }
        }
    }
}



//PPI EMPREGADO NO PERIODO
if(count($ordens)>0){
    $pros = array();
    foreach($ordens as $ordem){
        $pontos = json_decode($ordem['ORD_pontos']);
        if(count($pontos)){
			$monitoramento = new Registro('ppi');
            foreach($pontos as $pont){
                if($pont->tipo_dispositivo == 'ppi'){
                        $Instalados  = count($monitoramento->_query('SELECT * FROM ppi WHERE ORD_id="'.$ordem['ORD_id'].'"'));
                        $Monitorados = count($monitoramento->_query('SELECT * FROM ppi WHERE ORD_id="'.$ordem['ORD_id'].'" and PPI_dispositivo="1"'));
                        $Consumidos  = count($monitoramento->_query('SELECT * FROM ppi WHERE ORD_id="'.$ordem['ORD_id'].'" and PPI_placa="1" '));
                        $Danificado  = count($monitoramento->_query('SELECT * FROM ppi WHERE ORD_id="'.$ordem['ORD_id'].'" and PPI_porta_placa="2" '));
                        $Extraviados = count($monitoramento->_query('SELECT * FROM ppi WHERE ORD_id="'.$ordem['ORD_id'].'" and PPI_placa="3" '));
                        $Substituido = count($monitoramento->_query('SELECT * FROM ppi WHERE ORD_id="'.$ordem['ORD_id'].'" and PPI_placa_substituida > 0 '));

                        $linhaPPI[$ordem['ORD_id']]['data'] = $ord->filtroData($ordem['ORD_data_visita']);
                        $linhaPPI[$ordem['ORD_id']]['instalados'] = intval($Instalados);
                        $linhaPPI[$ordem['ORD_id']]['monitorados'] = intval($Monitorados);
                        $linhaPPI[$ordem['ORD_id']]['porc_monitorados'] = intval( ($Instalados > 0)?($Monitorados*100)/$Instalados:0 );

                        $linhaPPI[$ordem['ORD_id']]['consumido'] = intval($Consumidos);
                        $linhaPPI[$ordem['ORD_id']]['porc_consumido'] = intval( ($Instalados > 0)?($Consumidos*100)/$Instalados:0);
                        
                        $linhaPPI[$ordem['ORD_id']]['danificado'] = intval($Consumidos);
                        $linhaPPI[$ordem['ORD_id']]['porc_danificado'] = intval( ($Instalados > 0)?($Consumidos*100)/$Instalados:0);

                        $linhaPPI[$ordem['ORD_id']]['extraviado'] = intval($Extraviados);
                        $linhaPPI[$ordem['ORD_id']]['porc_extraviado'] = intval(($Instalados > 0)?($Extraviados*100)/$Instalados:0);

                        $linhaPPI[$ordem['ORD_id']]['substituido'] =  intval($Substituido);
                        $linhaPPI[$ordem['ORD_id']]['porc_substituido'] =  intval(($Instalados > 0)? (($Substituido*100)/$Instalados):0 );

                }
            }
        }
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
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
	
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
                page-break-after: always; 
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
<?
                if (!empty($mensagem)) {
                    echo $mensagem;
                } else {
			$data = new Data;
					
                    ?>
        <div class="container">
            <div class="row">
                
                    <table  id="cabecalho" class="table">
                        <thead>
                            <tr>
                                <th width="28%"><img src="../images/logo.png" class="img-rounded"/></th>
                                <th width="72%"><h3>Relatório Técnico</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h4><?= $data->nomedomes; ?> de <?= $data->ano; ?></h4>
                                    <strong style="font-weight:bold;">Data Emissão:</strong><span><?=date('d/m/Y')?></span><br>
                                    <strong style="font-weight:bold;">Gestor:</strong><b style="border-bottom:1px solid #000"> <span><?=$gestor['FUN_nome']?></span></b>
                                </td>
                                <td><h6>Cliente:</h6> <h4> <?= $cliente['CLI_nome'] ?></h4>
                                  <?=$cliente['CLI_rua']?>
                                  ,
                                  <?=$cliente['CLI_num']?>
                                  <br>
                                  <?=$cliente['CLI_bairro']?>
                                  ,
                                  <?=$cliente['CLI_cidade']?>
                                  /
                                  <?=$cliente['CLI_uf']?>
                                  <br>
                                    Contatos:
                                    <?=$cliente['CLI_tel1']?>
                                    /
                                    <?=$cliente['CLI_tel2']?>
                                    /
                                    <?=$cliente['CLI_tel3']?>
                                    <br>
                                    CPF/CNPJ:
                                    <?=$cliente['CLI_cpf_cnpj']?>
                                </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          
                        </tbody>
                    </table>
                    <h5>Presado(a) Cliente,</h5>
                    <p> Apresentamos nosso RELATÓRIO TÉCNICO MENSAL, com os levantamentos estatísticos necessários referente as atividades do CONTROLE INTEGRADO DE PRAGAS realizadas no período informado acima.</p>
                   
          </div>
                <div class="row">


                  <h6 align="center" style="color:#069;font-family:Verdana, Geneva, sans-serif;font-size:12px;">Rua Joaquim Avelar Campos, 303 - CEP 187060-000 Cerqueira Cesar/SP
Contatos: (14) 3714-1785 / asseio.avare@asseio.com.br
CNPJ: 07.684.801/0001-62 Nº CEVS: 351140901-812-000001-1-6
RESP Técnico: Antônio Gabriel S. Filho CRSIo: 40964/01-D
IBAMA: 4470586 - 11/10/2011 </h6>
                 
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        <!-- ATIVIDADES REALIZADAS NO PERIODO !-->
        <div class="container">
            <div class="row">
               
                    <table  id="cabecalho" class="table">
                        <thead>
                            <tr>
                                <th width="28%"><img src="../images/logo.png" class="img-rounded"/></th>
                                <th width="72%"><h3>Relatório Técnico</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h4><?= $data->nomedomes; ?> de <?= $data->ano; ?></h4>
                                    <strong style="font-weight:bold;">Data Emissão:</strong><span><?=date('d/m/Y')?></span><br>
                                    <strong style="font-weight:bold;">Gestor:</strong><b style="border-bottom:1px solid #000"> <span><?=$gestor['FUN_nome']?></span></b>
                                </td>
                                <td><h6>Cliente:</h6> <h4> <?= $cliente['CLI_nome'] ?></h4>
                                  <?=$cliente['CLI_rua']?>
                                  ,
                                  <?=$cliente['CLI_num']?>
                                  <br>
                                  <?=$cliente['CLI_bairro']?>
                                  ,
                                  <?=$cliente['CLI_cidade']?>
                                  /
                                  <?=$cliente['CLI_uf']?>
                                  <br>
                                    Contatos:
                                    <?=$cliente['CLI_tel1']?>
                                    /
                                    <?=$cliente['CLI_tel2']?>
                                    /
                                    <?=$cliente['CLI_tel3']?>
                                    <br>
                                    CPF/CNPJ:
                                    <?=$cliente['CLI_cpf_cnpj']?>
                                </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          
                        </tbody>
                    </table>
                    <h3>ATIVIDADES REALIZADAS NO PERÍODO</h3>
                    <?
                         
                            if(count($ordens)>0){
                    ?>
                    
                    <table width="100%" border="1" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="6%"><h5>&nbsp;</h5></td>
                            <td colspan="2" align="center"><h5>HORA</h5></td>
                            <td width="14%"><h5>&nbsp;</h5></td>
                            <td width="6%"><h5>&nbsp;</h5></td>
                            <td width="20%"><h5>&nbsp;</h5></td>
                            <td colspan="2" align="center"><h5>TÉRMINO</h5></td>
                            <td width="11%"><h5>&nbsp;</h5></td>
                            </tr>
                          <tr>
                            <td align="center"><h5>DATA</h5></td>
                            <td width="6%" align="center"> <h5>Inicio</h5></td>
                            <td width="7%" align="center"> <h5>Término</h5></td>
                            <td align="center"><h5>TIPO DE VISITA</h5></td>
                            <td align="center"><h5>Nº OS</h5></td>
                            <td align="center"><h5>ATIVIDADE REALIZADA</h5></td>
                            <td width="11%" align="center"><h5>DATA</h5></td>
                            <td width="9%" align="center"><h5>HORA</h5></td>
                            <td align="center"><h5>STATUS</h5></td>
                            </tr>
                         <?
                            foreach($ordens as $ords){
                         ?>
                          <tr>
                              <td align="center"><?=$ord->filtroData($ords['ORD_data_visita'])?></td>
                            <td align="center"><?=$ords['ORD_chegada_hora']?></td>
                            <td align="center"><?=$ords['ORD_inicio_servico']?></td>
                            <td align="center"><?=$ord->tipoVisita[$ords['ORD_tipo_visita']]?></td>
                            <td align="center"><?=$ords['ORD_id']?></td>
                            <td align="center"><?=$ord->tipoAtividade[$ords['ORD_atividade']]?></td>
                            <td align="center"><?=$ord->filtroData($ords['ORD_termino'])?></td>
                            <td align="center"><?=$ords['ORD_termino_hora']?></td>
                            <td align="center"><?=$ord->status[$ords['ORD_status']]?></td>
                            </tr>
                            <? }?> 
                           
                        </table> <? }else{echo "<h5 align='center'>Nenhuma atividade encontrada para este mês</h5>";}?>
                        sdf
                        <h3>REGISTRO DE OCORRÊNCIA DE PRAGAS</h3>
                        <?
                            if(count($pragas)>0){
                    ?>
                        <table width="100%" border="1" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10%" align="center"><h5>DATA</h5></td>
                            <td width="15%" align="center"><h5>VESTÍGIO</h5></td>
                            <td width="17%" align="center"><h5>PRAGA</h5></td>
                            <td width="13%" align="center"><h5>NÍVEL</h5></td>
                            <td width="24%" align="center"><h5>AMBIENTE</h5></td>
                            <td width="21%" align="center"><h5>AÇÃO</h5></td>
                          </tr>
                          <?
                            foreach($pragas as $pra){
                         ?>
                          <tr>
                            <td align="center"><?=$ord->filtroData($pra['OCO_data'])?></td>
                            <td align="center"><?=$pra['OCO_vestigio']?></td>
                            <td align="center"><?=$pra['OCO_especie']?></td>
                            <td align="center"><?=$pra['OCO_nivel']?></td>
                            <td align="center"><?=$pra['OCO_ambiente']?></td>
                            <td align="center"><?=$pra['OCO_tratamento']?></td>
                          </tr>
                          <? }?>
                        </table>
                        <? }else{echo "<h5 align='center'>Nenhuma OCORRÊNCIA DE PRAGA foi registrada este mês</h5>";}?>
                        <br>
                        <br>
                        <h3>DEFENSIVOS QUÍMICOS EMPREGADOS NO PERÍODO</h3>
                        <?
                            if(count($pro_detalhes)>0){
                    ?>
                        <table width="100%" border="1" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10%" align="center"><h5>NOME</h5></td>
                            <td width="15%" align="center"><h5>GRUPO QUIM.</h5></td>
                            <td width="17%" align="center"><h5>PRINCÍPIO ATIVO</h5></td>
                            <td width="13%" align="center"><h5>REG. MS</h5></td>
                            <td width="24%" align="center"><h5>DILUIÇÃO</h5></td>
                            <td width="21%" align="center"><h5>QTD APLICADA</h5></td>
                          </tr>
                          <?
                            foreach($pro_detalhes as $pro_det){
                         ?>
                          <tr>
                            <td align="center"><?=$pro_det['PRO_nome']?></td>
                            <td align="center"><?=$pro_det['PRO_grupo_quimico']?></td>
                            <td align="center"><?=$pro_det['PRO_princ_ativo']?></td>
                            <td align="center"><?=$pro_det['PRO_num_registro']?></td>
                            <td align="center"><?=$pro_det['PRO_diluicao_fispq']?></td>
                            <td align="center"><?=$pro_det['valor_total']." ".$pro_det['PRO_unid_cliente']?></td>
                          </tr>
                          <? }?>
                        </table>
                        <? }else{echo "<h5 align='center'>Nenhum PRODUTO foi usado neste mês</h5>";}?>
                        <br>
                        <br>
                        <br>

                    
          </div>
                <div class="row">


                  <h6 align="center" style="color:#069;font-family:Verdana, Geneva, sans-serif;font-size:12px;">Rua Joaquim Avelar Campos, 303 - CEP 187060-000 Cerqueira Cesar/SP
Contatos: (14) 3714-1785 / asseio.avare@asseio.com.br
CNPJ: 07.684.801/0001-62 Nº CEVS: 351140901-812-000001-1-6
RESP Técnico: Antônio Gabriel S. Filho CRSIo: 40964/01-D
IBAMA: 4470586 - 11/10/2011 </h6>
            </div>
        </div>
        
        
        
        
        
        
        
        
        
        
        
        
        <div class="container">
            <div class="row">
               
                    <table  id="cabecalho" class="table">
                        <thead>
                            <tr>
                                <th width="28%"><img src="../images/logo.png" class="img-rounded"/></th>
                                <th width="72%"><h3>Relatório Técnico</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h4><?= $data->nomedomes; ?> de <?= $data->ano; ?></h4>
                                    <strong style="font-weight:bold;">Data Emissão:</strong><span><?=date('d/m/Y')?></span><br>
                                    <strong style="font-weight:bold;">Gestor:</strong><b style="border-bottom:1px solid #000"> <span><?=$gestor['FUN_nome']?></span></b>
                                </td>
                                <td><h6>Cliente:</h6> <h4> <?= $cliente['CLI_nome'] ?></h4>
                                  <?=$cliente['CLI_rua']?>
                                  ,
                                  <?=$cliente['CLI_num']?>
                                  <br>
                                  <?=$cliente['CLI_bairro']?>
                                  ,
                                  <?=$cliente['CLI_cidade']?>
                                  /
                                  <?=$cliente['CLI_uf']?>
                                  <br>
                                    Contatos:
                                    <?=$cliente['CLI_tel1']?>
                                    /
                                    <?=$cliente['CLI_tel2']?>
                                    /
                                    <?=$cliente['CLI_tel3']?>
                                    <br>
                                    CPF/CNPJ:
                                    <?=$cliente['CLI_cpf_cnpj']?>
                                </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          
                        </tbody>
                    </table>
                    
                    <br>
                    <br>
                    <h3>PPE - Ponto Permanente de Envenenamento</h3><h5>DISPOSITIVOS E INSUMOS EMPREGADOS NO PERÍODO</h5>
                    <?
                            if(count($linhaPPE)>0){
                    ?>
                    <table width="100%" border="1" cellspacing="0" cellpadding="5">
                      <tr>
                        <td width="8%" align="center"><h7>Data</h7></td>
                        <td width="11%" align="center"><h7>Instalados.</h7></td>
                        <td width="12%" align="center"><h7>Monitorados</h7></td>
                        <td width="4%" align="center"><h7>%</h7></td>
                        <td width="10%" align="center"><h7>Consumidos</h7></td>
                        <td width="5%" align="center"><h7>%</h7></td>
                        <td width="13%" align="center"><h7>Extraviados</h7></td>
                        <td width="4%" align="center"><h7>%</h7></td>
                        <td width="12%" align="center"><h7>Substituídos</h7></td>
                        <td width="5%" align="center"><h7>%</h7></td>
                      </tr>
                      <?
                      
                      
                      
                            foreach($linhaPPE as $lin){
								$cat[] = $lin['data'];
								$dados[] = array('name'=>'Instalados','data'=>array($lin['instalados']));
								$dados[] = array('name'=>'Monitorados','data'=>array($lin['monitorados']));
								$dados[] = array('name'=>'Monitorados %','data'=>array($lin['porc_monitorados']));
								$dados[] = array('name'=>'Consumido','data'=>array($lin['consumido']));
								$dados[] = array('name'=>'Consumido %','data'=>array($lin['porc_consumido']));
								$dados[] = array('name'=>'Substituido','data'=>array($lin['substituido']));
								$dados[] = array('name'=>'Substituido %','data'=>array($lin['porc_substituido']));
								$dados[] = array('name'=>'Extraviado','data'=>array($lin['extraviado']));
								$dados[] = array('name'=>'Extraviado %','data'=>array($lin['porc_extraviado']));
                         ?>
                      <tr>
                        <td align="center"><?=$lin['data']?></td>
                        <td align="center"><?=$lin['instalados']?></td>
                        <td align="center"><?=$lin['monitorados']?></td>
                        <td align="center"><?=$lin['porc_monitorados']?></td>
                        <td align="center"><?=$lin['consumido']?></td>
                        <td align="center"><?=$lin['porc_consumido']?></td>
                        <td align="center"><?=$lin['substituido']?></td>
                        <td align="center"><?=$lin['porc_substituido']?></td>
                        <td align="center"><?=$lin['extraviado']?></td>
                        <td align="center"><?=$lin['porc_extraviado']?></td>
                      </tr>
                      <? }?>
                    </table>
                    	<script type="text/javascript">
							$(function ($) {
									$('#ppe_grafico').highcharts({
										chart: {
											type: 'column'
										},
										title: {
											text: 'GRÁFICO PPE'
										},
										subtitle: {
											text: 'Análise deste mês'
										},
										xAxis: {
											categories: <?=json_encode($cat);?>
										},
										yAxis: {
											min: 0,
											title: {
												text: ''
											}
										},
										tooltip: {
											headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
											pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
												'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
											footerFormat: '</table>',
											shared: true,
											useHTML: true
										},
										plotOptions: {
											column: {
												pointPadding: 0.2,
												borderWidth: 0
											}
										},
										series: <?=json_encode($dados);?>
									});
								});
					
				
						</script>
                    <div id="ppe_grafico"></div>
                    <?  }else{echo "<h5 align='center'>Nenhum PRODUTO foi usado neste mês</h5>";}?>
                    <br>
            </div>
            <div class="row">


                  <h6 align="center" style="color:#069;font-family:Verdana, Geneva, sans-serif;font-size:12px;">Rua Joaquim Avelar Campos, 303 - CEP 187060-000 Cerqueira Cesar/SP
Contatos: (14) 3714-1785 / asseio.avare@asseio.com.br
CNPJ: 07.684.801/0001-62 Nº CEVS: 351140901-812-000001-1-6
RESP Técnico: Antônio Gabriel S. Filho CRSIo: 40964/01-D
IBAMA: 4470586 - 11/10/2011 </h6>
            </div>
        </div>
            
            
            
            
            
   <div class="container">
            <div class="row">
                
                    <table  id="cabecalho" class="table">
                        <thead>
                            <tr>
                                <th width="28%"><img src="../images/logo.png" class="img-rounded"/></th>
                                <th width="72%"><h3>Relatório Técnico</h3></th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <h4><?= $data->nomedomes; ?> de <?= $data->ano; ?></h4>
                                    <strong style="font-weight:bold;">Data Emissão:</strong><span><?=date('d/m/Y')?></span><br>
                                    <strong style="font-weight:bold;">Gestor:</strong><b style="border-bottom:1px solid #000"> <span><?=$gestor['FUN_nome']?></span></b>
                                </td>
                                <td><h6>Cliente:</h6> <h4> <?= $cliente['CLI_nome'] ?></h4>
                                  <?=$cliente['CLI_rua']?>
                                  ,
                                  <?=$cliente['CLI_num']?>
                                  <br>
                                  <?=$cliente['CLI_bairro']?>
                                  ,
                                  <?=$cliente['CLI_cidade']?>
                                  /
                                  <?=$cliente['CLI_uf']?>
                                  <br>
                                    Contatos:
                                    <?=$cliente['CLI_tel1']?>
                                    /
                                    <?=$cliente['CLI_tel2']?>
                                    /
                                    <?=$cliente['CLI_tel3']?>
                                    <br>
                                    CPF/CNPJ:
                                    <?=$cliente['CLI_cpf_cnpj']?>
                                </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                              <td>&nbsp;</td>
                            </tr>
                          
                        </tbody>
                    </table>
                    
                    <br>
                    <br>
                    <h3>PPI - Ponto Permanente de Iscagem</h3><h5>DISPOSITIVOS E INSUMOS EMPREGADOS NO PERÍODO</h5>
                    <?
                            if(count($linhaPPI)>0){
                    ?>
                    <table width="100%" border="1" cellspacing="0" cellpadding="5">
                      <tr>
                        <td width="8%" align="center"><h7>Data</h7></td>
                        <td width="11%" align="center"><h7>Instalados.</h7></td>
                        <td width="12%" align="center"><h7>Monitorados</h7></td>
                        <td width="4%" align="center"><h7>%</h7></td>
                        <td width="10%" align="center"><h7>Frequêntados</h7></td>
                        <td width="5%" align="center"><h7>%</h7></td>
                        <td width="13%" align="center"><h7>Danificados</h7></td>
                        <td width="4%" align="center"><h7>%</h7></td>
                        <td width="12%" align="center"><h7>Extraviados</h7></td>
                        <td width="5%" align="center"><h7>%</h7></td>
                        <td width="12%" align="center"><h7>Substituídos</h7></td>
                        <td width="5%" align="center"><h7>%</h7></td>
                      </tr>
                      <?
                      
                      
                      
                            foreach($linhaPPI as $lin){
                                $cat2[] = $lin['data'];
                                $dados2[] = array('name'=>'Instalados','data'=>array($lin['instalados']));
                                $dados2[] = array('name'=>'Monitorados','data'=>array($lin['monitorados']));
                                $dados2[] = array('name'=>'Monitorados %','data'=>array($lin['porc_monitorados']));
                                $dados2[] = array('name'=>'Consumido','data'=>array($lin['consumidos']));
                                $dados2[] = array('name'=>'Consumido %','data'=>array($lin['porc_consumidos']));
                                $dados2[] = array('name'=>'Danificados','data'=>array($lin['danificados']));
                                $dados2[] = array('name'=>'Danificados %','data'=>array($lin['porc_danificados']));
                                $dados2[] = array('name'=>'Extraviado','data'=>array($lin['extraviado']));
                                $dados2[] = array('name'=>'Extraviado %','data'=>array($lin['porc_extraviado']));
                                $dados2[] = array('name'=>'Substituido','data'=>array($lin['substituido']));
                                $dados2[] = array('name'=>'Substituido %','data'=>array($lin['porc_substituido']));
                         ?>
                              <tr>
                                <td align="center"><?=$lin['data']?></td>
                                <td align="center"><?=$lin['instalados']?></td>
                                <td align="center"><?=$lin['monitorados']?></td>
                                <td align="center"><?=$lin['porc_monitorados']?></td>
                                <td align="center"><?=$lin['consumido']?></td>
                                <td align="center"><?=$lin['porc_consumido']?></td>
                                <td align="center"><?=$lin['danificado']?></td>
                                <td align="center"><?=$lin['porc_danificado']?></td>
                                <td align="center"><?=$lin['extraviado']?></td>
                                <td align="center"><?=$lin['porc_extraviado']?></td>
                                <td align="center"><?=$lin['substituido']?></td>
                                <td align="center"><?=$lin['porc_substituido']?></td>
                              </tr>
                      <? }?>
                    </table>
                    	<script type="text/javascript">
							$(function ($) {
									$('#ppi_grafico').highcharts({
										chart: {
											type: 'column'
										},
										title: {
											text: 'GRÁFICO PPI'
										},
										subtitle: {
											text: 'Análise deste mês'
										},
										xAxis: {
											categories: <?=json_encode($cat2);?>
										},
										yAxis: {
											min: 0,
											title: {
												text: ''
											}
										},
										tooltip: {
											headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
											pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
												'<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
											footerFormat: '</table>',
											shared: true,
											useHTML: true
										},
										plotOptions: {
											column: {
												pointPadding: 0.2,
												borderWidth: 0
											}
										},
										series: <?=json_encode($dados2);?>
									});
								});
					
				
						</script>
                    <div id="ppi_grafico"></div>
                    <?  }else{echo "<h5 align='center'>Nenhum PRODUTO foi usado neste mês</h5>";}?>
                    <br>
            </div>            
            
            
            
            
                <div class="row">


                  <h6 align="center" style="color:#069;font-family:Verdana, Geneva, sans-serif;font-size:12px;">Rua Joaquim Avelar Campos, 303 - CEP 187060-000 Cerqueira Cesar/SP
Contatos: (14) 3714-1785 / asseio.avare@asseio.com.br
CNPJ: 07.684.801/0001-62 Nº CEVS: 351140901-812-000001-1-6
RESP Técnico: Antônio Gabriel S. Filho CRSIo: 40964/01-D
IBAMA: 4470586 - 11/10/2011 </h6>
            </div>
        </div>
        <script src="js/bootstrap.js"></script>
        <script src="js/highcharts.js"></script>
<script src="js/modules/exporting.js"></script>

 <? } ?>
    </body>
</html>

