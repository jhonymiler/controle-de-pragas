<?
    require_once $_SESSION['RAIZ'].'acesso.php';
    $ord = new ordemServico;
    $orc = new orcamento;
   
    if(empty($_GET['ord_id'])){
        $mensagem = getMsg('Informe o número da OS','alerta');
    }else{    
        
       $os = $ord->getOs($_GET['ord_id']);
       if(is_array($os)){
           $orcamento = $orc->getOrcamento($os['ORC_id']);
           $cliente = $orc->getCliente($orcamento['CLI_id']);
           
           $primeiraOs = ($os['id_pai'] == 0)?$os['ORD_id']:$os['id_pai'];
       }
       if(!is_array($os)){
           $mensagem = getMsg('O número da OS é inválido!','erro');
           $id = '';
       }else{
           $id = "&ord_id=".$_GET['ord_id'];
       }
    }

    
$oco = new Registro('ocorrencia_pragas');    
    


if(is_numeric($_GET['remove'])){
    if($oco->_query('DELETE FROM ocorrencia_pragas WHERE OCO_id IN ('.$_GET['remove'].')')  )
    $msg = getMsg('Excluido com sucesso!','sucesso');
}

if(count($_POST['checkRow']) > 0){
    $id =  implode(',',$_POST['checkRow']);
    if($oco->_query('DELETE FROM ocorrencia_pragas WHERE OCO_id IN ('.$id.')')) $msg = getMsg('Excluido com sucesso!','sucesso');
}else{
    if(isset($_POST['OCO_id'])){
        $_POST['OCO_data'] = date('Y-m-d');
        $oco->_load($_POST);
        if($_GET['oco_id'] != ''){
            if($oco->_atualiza()){
                $msg = getMsg('Atualizado com sucesso!','sucesso');
            }else{
                $msg = getMsg('Não foi possível atualizar os dados!','erro');
            }
        }else{
            if($oco->_grava()){
                $msg = getMsg('Gravado com sucesso!','sucesso');
            }else{
                $msg = getMsg('Não foi possível gravar os dados!','erro');
            }
        }
    }
}

if(isset($_GET['oco_id'])){
    $dados = $oco->_select('OCO_id',$_GET['oco_id']);
    $dados = $dados[0];
}


echo $msg;

?>
    


  <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .linha:hover{
            background-color:#f2f2f2;
        }
    </style>
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Técnico</span>
        
        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="?cat=os&pg=lista">Ordens de Serviço</a></li>
                <li><a href="?cat=os&pg=monitoramento&ord_id=<?=$_GET['ord_id']?>">Monitoramento</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper"> 
       <?=$mensagem;?>
      <div class="fluid">
         <div class="widget grid12"> 
            <form class=" grid3" style="margin-left:0px;" method="get" action="index.php">
              <div  class="formRow fluid">
                <div class="grid9">
                    <input type="hidden"  name='cat' value="<?=$_GET['cat']?>">
                    <input type="hidden"  name='pg'  value="<?=$_GET['pg']?>">
                    <input type="text"    name='ord_id'  placeholder='Nº OS'  value="<?=$_GET['ord_id']?>" >
                </div>
                 <div class="grid3">
                     <input id='buscarOS' type="submit" value="Buscar" class="buttonM bGreen " >
                </div> 

              </div>
          </form>
         <? if(is_array($cliente)){ ?>
            <div class="grid9">
                 <h5><?=$cliente['CLI_nome'];?></h5>
                 <span class="myRole">Visita: <?=$os['ORD_data_visita']?> - <?=$os['ORD_hora_visita'];?></span>
                 <span class="followers">Primeira OS deste cronograma: <?=$primeiraOs;?></span>
             </div>
         <? } ?>
        </div>
         <? if(is_numeric($_GET['ord_id'])){ ?> 
          <div class="clear"></div>
         <div class="widget check">
            <div class="whead"> 
              <span class="titleIcon">
              <input type="checkbox" id="titleCheck" name="titleCheck" />
              </span>
              <h6>Lista de Ocorrências</h6>
              <div class="clear"></div>
            </div>
            <div  class="dyn hiddenpars"> 
                <a class="tOptions" title="Options">
                        <img src="images/icons/options.png" alt="" />
                </a>
                <form id="remover"  method="post" action="index.php?cat=os&pg=ocorrencia_pragas&ord_id=<?=$_GET['ord_id']?>">
            
                    <?
                       $registros = $oco->_select('ORD_id',$_GET['ord_id']);
                       if(count($registros) > 0){
                            $i = 0;
                            $colum = array();
                            foreach($registros as $item){
                                $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$item['OCO_id'].'" />';
                                $colum[$i]['Data'] =  $oco->filtroData($item['OCO_data']);
                                $colum[$i]['Especie'] =  $item['OCO_especie'];
                                $colum[$i]['Vestígio'] = $item['OCO_vestigio'];
                                $colum[$i]['Nível'] = $item['OCO_nivel'];

                                $colum[$i]['Tratamento'] = $item['OCO_tratamento'];
                                $colum[$i]['Ambiente'] = $item['OCO_ambiente'];
                                $colum[$i]['Opções'] = '
                                    <ul class="btn-group toolbar">
                                        <li>
                                                <a href="?cat=os&pg=ocorrencia_pragas&ord_id='.$_GET['ord_id'].'&oco_id='.$item['OCO_id'].'" class="tablectrl_small bDefault">
                                                        <span class="iconb" data-icon="&#xe1db;"></span>
                                                </a>
                                        </li>
                                        <li>
                                                <a href="?cat=os&pg=ocorrencia_pragas&ord_id='.$_GET['ord_id'].'&remove='.$item['OCO_id'].'" class="tablectrl_small bDefault">
                                                        <span class="iconb" data-icon="&#xe136;"></span>
                                                </a>
                                        </li>
                                    </ul> 
                                ';
                                $i++;
                              }
                        }
                        if(count($colum) > 0){
                            ob_start();
                            $tab = new tabela($colum);
                            $tab->addAttr();
                            if(is_object($tab)){
                                $tab->show();
                             }
                             $html = ob_get_contents();
                             ob_clean();
                        }
                        
                        echo $html;
                    ?>
                   <input type="submit" name="remover"  value="Remover Selecionados" class="buttonM  bRed floatR">
                </form>


              </div>
          </div>
          <div class="divider"><span></span></div>
          
          
        
        <div class="widget grid12" style="margin-left:0px;"> 
            <div class="whead">
                <h6>Ocorrência de Pragas</h6>
                <div class="clear"></div>
             </div>
            <!-- Recursos Materiais !-->
            <form method="post">
                <div  class="formRow">
                    <div class="grid9">
                       <span class="note"><b><b>Ambiente</b></b></span>
                       <input type="hidden" name="OCO_id" value="<?=isset($_GET['oco_id'])?$_GET['oco_id']:''?>" />
                       <input type="hidden" name="ORD_id" value="<?=isset($_GET['ord_id'])?$_GET['ord_id']:''?>" />
                       <input type="hidden" name="CLI_id" value="<?=$cliente['CLI_id']?>" />
                       <input type="text" name="OCO_ambiente" value="<?=$dados['OCO_ambiente']?>" id="ambiente" />
                   </div>
                    <div class="clear"></div>
                </div>
                <div  class="formRow">
                    <div class="grid12 ">
                        <div class="grid6 searchDrop">
                            <span class="note"><b>Especie</b></span>
                             <select id="ep" name="OCO_especie" data-placeholder="Escolha uma especie" 
                              class="select ep grid12 validate[required]" tabindex="2">
                                   <option value=""></option> 
                                   <?
                                    $PRA = new Registro('pragas');
                                    $select_pragas = $PRA->_select();
                                    $_praga = explode(' - ',$dados['OCO_especie']);
                                     if(is_array($select_pragas)){
                                        foreach($select_pragas as $praga){

                                            
                                            if($praga['PRA_id'] == $_praga[0]){
                                                $select = 'selected="selected"';
                                            }else{
                                                $select = '';
                                            }
                                            echo '<option value="'.$praga['PRA_id'].' - '.$praga['PRA_nome'].'" '.$select.'>'.$praga['PRA_sigla'].' - '.$praga['PRA_nome'].'</option> ';
                                        }
                                    }
                                  ?>
                            </select>
                         </div>
                        <div class="grid6 searchDrop">
                            <span class="note"><b>Vestígio</b></span>
                             <select id="ve" name="OCO_vestigio" data-placeholder="Escolha um vestígio" 
                              class="select grid12 validate[required]" tabindex="2">
                                   <option value=""></option> 
                                   <option value="(DN) Danos" <?=  preg_match('/DN/', $dados['OCO_vestigio'])?' selected="selected"':'';?>>(DN) Danos</option> 
                                   <option value="(FE) Fezes" <?=preg_match('/FE/', $dados['OCO_vestigio'])?' selected="selected"':'';?>>(FE) Fezes</option> 
                                   <option value="(IN) Informação" <?=preg_match('/IN/', $dados['OCO_vestigio'])?' selected="selected"':'';?>>(IN) Informação</option> 
                                   <option value="(OD) Odor" <?=preg_match('/OD/', $dados['OCO_vestigio'])?' selected="selected"':'';?>>(OD) Odor</option> 
                                   <option value="(PF) Presença" <?=preg_match('/PF/', $dados['OCO_vestigio'])?' selected="selected"':'';?>>(PF) Presença</option> 
                                   <option value="(TU) Túneis" <?=preg_match('/TU/', $dados['OCO_vestigio'])?' selected="selected"':'';?>>(TU) Túneis</option> 

                            </select>
                         </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <div  class="formRow">
                    <div class="grid12 ">
                        <div class="grid6 searchDrop">
                            <span class="note"><b>Nível</b></span>
                             <select id="ni" name="OCO_nivel" data-placeholder="Escolha um Nível" 
                              class="select grid12 validate[required]" tabindex="2">
                                   <option value=""></option> 
                                   <option value="(AL) Alto" <?=preg_match('/AL/', $dados['OCO_nivel'])?' selected="selected"':'';?>>(AL) Alto</option> 
                                   <option value="(BX) Baixo" <?=preg_match('/BX/', $dados['OCO_nivel'])?' selected="selected"':'';?>>(BX) Baixo</option> 
                                   <option value="(PR) Preventivo" <?=preg_match('/PR/', $dados['OCO_nivel'])?' selected="selected"':'';?>>(PR) Preventivo</option> 

                            </select>
                         </div>
                        <div class="grid6 searchDrop">
                            <span class="note"><b>Tratamento</b></span>
                             <select id="te" name="OCO_tratamento" data-placeholder="Escolha um produto" 
                              class="select tratamento grid12 validate[required]" tabindex="2">
                                   <option value=""></option> 
                                   <?
                                    $TRA = new Registro('tratamentos');
                                    $select_tratamento = $TRA->_select();
                                    $_TRA = explode(' - ',$dados['OCO_tratamento']);
                                     if(is_array($select_tratamento)){
                                        foreach($select_tratamento as $tratamento){

                                            if($tratamento['TRA_id'] == intval($_TRA[0])){
                                                $select = 'selected="selected"';
                                            }else{
                                                $select = '';
                                            }
                                          echo '<option value="'.$tratamento['TRA_id'].' - '.$tratamento['TRA_nome'].'" '.$select.'>'.$tratamento['TRA_sigla'].' - '.$tratamento['TRA_nome'].'</option> ';
                                        }
                                    }
                                  ?>
                            </select>
                         </div>
                    </div>
                    <div class="clear"></div>
                </div>

                <!-- Cálculo de preço !-->
                 <div class="formRow">
                        <div class="grid12" align="right">
                            <input type="submit"  value="Salvar" class="buttonM  bGreen floatR">
                        </div>

                        <div class="clear"></div>
                    </div> 
                <!-- FIM Cálculo de preço !--> 
            </form>
        </div>          
        <? }?>
          
          
      </div>
        
    </div>
	
    