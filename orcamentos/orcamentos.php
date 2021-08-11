<?
	require_once $_SESSION['RAIZ'].'acesso.php';
        
        //$_SESSION['orcamento'] = $_POST['orcamento'];
        
        //$_POST['orcamento'] = $_SESSION['orcamento'];
        if(is_numeric($_GET['orc_id'])){
            $orcId = $_GET['orc_id'];
            // ORÇAMENTO
            $orc = new orcamento();
            $orcamento = $orc->getOrcamento($orcId);
            $orcamento['ORC_data_criacao'] = $orc->filtroData($orcamento['ORC_data_criacao']);

            //VISTORIA 
            $vistoria = $orc->getVistoria($orcamento['VIS_id']);
            $numOrcamento = '<div class="grid2">
                                <span class="note">Nº do Orcamento</span>
                                <b>'.$orcamento['ORC_id'].'</b>
                            </div>';

            $contrato = $orc->getContrato($orcamento['CON_id']);
            $recursos = $orc->getRecursos($orcamento['REC_id']);
            $preco = $orc->getPreco($orcamento['FOR_id']);
        }

		
		
        if(is_array($_POST['orcamento'])){
            $gravado['CLI_id'] = $_POST['orcamento']['CLI_id'];
            
            unset($_POST['orcamento']['CLI_id']);
            unset($_POST['orcamento']['DataTables_Table_0_length']);
            unset($_POST['orcamento']['DataTables_Table_1_length']);
            unset($_POST['orcamento']['DataTables_Table_2_length']);
           
            //tratamentos
             $_POST['orcamento']['contrato']['CON_inicio'] = Registro::filtroData($_POST['orcamento']['contrato']['CON_inicio']);
             $_POST['orcamento']['contrato']['CON_termino'] = Registro::filtroData($_POST['orcamento']['contrato']['CON_termino']);
             $_POST['orcamento']['contrato']['CON_prorrogacao'] = Registro::filtroData($_POST['orcamento']['contrato']['CON_prorrogacao']);
			 $_POST['orcamento']['ORC_data_criacao'] = Registro::filtroData($_POST['orcamento']['ORC_data_criacao']);
            
             $reg['vistoria'] = new Registro('vistoria');
             $reg['contrato'] = new Registro('contrato');
             $reg['recursos_materiais'] = new Registro('recursos_materiais');
             $reg['formacao_preco'] = new Registro('formacao_preco');
             
            $orcamentos = $_POST['orcamento'];
			  
            foreach ($orcamentos as $tab=>$campos) {
                if(is_array($orcamentos[$tab])){
                    foreach ($campos as $key => $value) {
                        if(is_array($value)){
                            foreach($value as $c=>$va){
                                if($va != "null"){
                                        $value[$c] = utf8_decode($va);
                                }
                            }
                            $campos[$key] = '['.implode(',',$value).']';
                        }else{
                            $campos[$key] = utf8_decode($value);
                        }
                    }

                    /*echo "<h1>$tab</h1><pre>";
                    print_r($campos);
                    echo "</pre>*****************";    */
                    if(!$orcId){
                            if(is_array($reg[$tab]->_load($campos))){
                                $keyId = $reg[$tab]->_addPrefixo('id');
                                $gravado[ $keyId ] = $reg[$tab]->_grava();
                            } 
                    }else{

                            $campos[$reg[$tab]->_addPrefixo('id')] = $orcamento[$reg[$tab]->_addPrefixo('id')];
                            $reg[$tab]->_load($campos);
                            $reg[$tab]->_atualiza();

                    }
                }else{
                        $gravado[$tab] = $campos;
                        unset($campos);
                }
               	   
            }
            
			/*echo "<pre>-----------------";
			print_r($gravado);
			echo "</pre>";     */
			         
            $orcamento = new Registro('orcamentos');
			if(is_numeric($orcId)){
				$gravado['ORC_id'] = $orcId;
				if(is_array($orcamento->_load($gravado))){
					$orcamento->_atualiza();
				}
			}else{
				if(is_array($orcamento->_load($gravado))){
					$orcId = $orcamento->_grava();
				}
			}
			
			
            if(isset($orcId)){
				$url = 'index.php?cat=orcamentos&pg=orcamentos&orc_id='.$orcId;
				if($gravado['ORC_status'] == 2){
					$url = "index.php?cat=os&pg=registro&orc_id=".$orcId;
				}
				$redir = 'document.location.href="'.$url.'";';
			}
            
       }
	   
	
?>
<script type="text/javascript" src="js/orcamento.js"></script>
<script>
    <?=$redir?>
	
	$(document).ready(function() {
	<? if($_GET['orc_id']){ ?>
		   $.ajax({
				type: "GET",
				url: "orcamentos/functions.php",
				async: false,
				data: {valores:'true'},
				dataType: "json",
				success:function(retorno){
					/*
					var valor = {
						refeicao       : VAL_refeicao;
						hora_operador  : VAL_dia_operador;
						dia_hotel      : VAL_hotel;
						hora_gestor    : VAL_dia_gestor;
						km             : VAL_km;
						mat_escritorio : VAL_material_escritorio;
						lucro          : VAL_lucro;
					};
					 */
		
				   valor = retorno;
				}
			});
			formar_preco(valor);
		<? }?>

		 jQuery(".orcamento").validationEngine('attach', {
			onValidationComplete: function(form, status){
				if (status == true) {
					form.submit();
				}else{
					alert('Há campos que ainda não foram preenchidos');
					return false;
				}
			 }
		 });
		 
		 $(".orcEnviarEmail").click(function(){
		 	action = $(".orcamento").attr('action')+'&enviarEmail=true';
			$(".orcamento").attr('action',action).submit();
			
		 });
		 
        var baseUrl = window.location.href;
		$("ul.tabs li a").click(function(){
			tab = $(this).attr('href');
			tb = tab.split("#");

			hreff = baseUrl+'&tab='+tb[1];
			window.history.pushState(baseUrl, tb[1], hreff);
				
		})        
		
        <? if(!empty($_GET['tab'])){?>
			//===== Tabs =====//
			$("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
			$li = $(".<?=$_GET['tab']?>");
			$li.addClass("activeTab"); //Add "active" class to selected tab
			$li.parent().parent().find(".tab_content").hide(); //Hide all tab content
			activeTab = $li.find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).show(); //Fade in the active content
		<? }?>
	})
  
</script>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .linha:hover{
            background-color:#f2f2f2;
        }
    </style>
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Orçamentos</span>
        <ul class="quickStats">
            <li>
                <a href="" class="blueImg"><img src="images/icons/quickstats/plus.png" alt="" /></a>
                <div class="floatR"><strong class="blue">5489</strong><span>Visitas realizadas</span></div>
            </li>
            <li>
                <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
                <div class="floatR"><strong class="blue">4658</strong><span>Clientes</span></div>
            </li>
            <li>
                <a href="" class="greenImg"><img src="images/icons/quickstats/money.png" alt="" /></a>
                <div class="floatR"><strong class="blue">1289</strong><span>Produtos</span></div>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="?pg=home">Painel de Controle</a></li>
                <li><a href="?cat=orcamentos&pg=orcamentos">Orçamentos</a></li>
            </ul>
        </div>
        
        <div class="breadLinks">
            <ul>
                <!--<li><a href="#" title=""><i class="icos-list"></i><span>Lista clientes</span> <strong>(+58)</strong></a></li>-->
                <li class="has">
                    <a title="">
                        <i class="icos-cog4"></i>
                        <span>Opções</span>
                        <span><img src="images/elements/control/hasddArrow.png" alt="" /></span>
                    </a>
                    <ul>
                        <li><a href="?cat=orcamentos&pg=orcamentos&tab=relatorio-vistoria" title=""><span class="icos-add"></span>Novo</a></li>
                        <li><a href="?cat=orcamentos&pg=lista" title=""><span class="icos-archive"></span>Lista</a></li>
                    </ul>
                </li>
            </ul>
             <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper"> 
        <?
           // EXIBE O CÓDIGO DO POST PARA DEBUG
           //echo wgCode($_SESSION['POST']);
        ?>      
       <div class="fluid">
          <form id="orcamento" class=" grid12 orcamento" style="margin-left:0px;" method="post" action="?cat=orcamentos&pg=orcamentos<?=is_numeric($_GET['orc_id'])?"&orc_id=".$_GET['orc_id']:"";?>">
              
                  <!--Abas de cadastros-->
              <div class="widget grid12"> 
                      
                <ul class="tabs">
                    <li class="relatorio-vistoria"><a href="#relatorio-vistoria" class="activeTab">Relatório de Vistoria</a></li>
                    <li class="dados-do-contrato"><a href="#dados-do-contrato" class="activeTab">Dados do contrato</a></li>
                    <li class="recursos-materiais"><a href="#recursos-materiais">Recursos Materiais</a></li>
                    <li class="formacao-preco"><a href="#formacao-preco" >Formação de Preço</a></li>
                    <li class="ptc-aprovacao"><a href="#ptc-aprovacao">PTC e Aprovação</a></li>
                </ul>
                <?=$mensagem;?>
                
                 <div  class="formRow">
                    <div class="grid12 ambientes">
                        <?=$numOrcamento;?>
                        <div class="grid5 searchDrop">
                            <span class="note">Cliente</span>
                             <select name="orcamento[CLI_id]" data-placeholder="Escolha um Cliente" class="select validate[required]"  tabindex="2">
                                 <option value=""></option> 
                                <?
                                $CLI = new Registro('clientes');
                                    $select_func = $CLI->_select();
                                     if(is_array($select_func)){
                                        foreach($select_func as $clientes){
                                          if($orcamento['CLI_id'] == $clientes['CLI_id']){
                                            $select = 'selected="selected"';
                                          }else{
                                            $select = "";
                                          }
                                          echo '<option value="'.$clientes['CLI_id'].'" '.$select.'>'.$clientes['CLI_nome'].'</option> ';
                                        }
                                    }
                                   ?>
                            </select>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
                
                
                <div class="tab_container" style="overflow:visible;">
                    <div id="relatorio-vistoria" class="tab_content">
                      <? include "relatorio-vistoria.php";?>
                    </div>
                    <div id="dados-do-contrato" class="tab_content">
                      <? include "dados-do-contrato.php";?>
                    </div>
                    <div id="recursos-materiais" class="tab_content">
                      <? include "recursos-materiais.php";?>        
                    </div>
                    <div id="formacao-preco" class="tab_content">
                       <? include "formacao-preco.php";?>        
                    </div>
                    <div id="ptc-aprovacao" class="tab_content">
                      <? include "ptc-aprovacao.php";?>        
                    </div>
                    <div class="clear"></div>		 
                </div>
                
                <div class="divider"><span></span></div>
                <div class="floatR" style="margin-right:15px;">
                    <input type="submit" name="controle-orcamento"  value="Salvar" class="buttonM bGreen " >
                    <input type="submit"  value="Salvar e enviar por E-Mail" class="buttonM bBlue orcEnviarEmail" >
                    <div class="clear"></div>
                </div>
                <div class="clear"></div> 
                <br />
            </div>  
          </form> 
       </div>
    </div>
	

    