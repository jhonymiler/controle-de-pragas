<?
	require_once $_SESSION['RAIZ'].'acesso.php';
	$ord = new ordemServico;
	$ORC = new orcamento;
	$ordemServico = array();
	
	if(count($_POST)){
            if(isset($_GET['ord_id'])){
                    $_POST['ORD_id'] = $_GET['ord_id'];
            }

            foreach ($_POST as $key => $value) {
                if(is_array($value)){
                    foreach($value as $c=>$va){
                        if($va != "null"){
                            $value[$c] = ($va);
                        }
                    }
                    $_POST[$key] = '['.implode(',',$value).']';
                }
            }
            
            // grava recursos materiais na tabela com id_pai se for filho ou ORD_id
//            $rec = new Registro('recursos_materiais')){
//                $id = $rec->grava($_POST)
//            }
   
    //exibe($_POST);
            if(($id = $ord->grava($_POST)) > 0){
                $note['tipo'] = 'nSuccess';
                $note['msg']  = 'Gravado com sucesso!';
                $ordemServico['ORD_id'] = (is_numeric($id) && $id > 1)?$id:$_GET['ord_id'];
                 if(is_numeric($_GET['ord_id'])){

                    $ordem = $ord->getOs($_GET['ord_id']);
                    if($ordem['id_pai'] != 0 && $_POST['subistitui'] == 1){
                        $ordemId = $ordem['id_pai'];
                        $campo = 'id_pai';
                        $ord->db->_query(" UPDATE ordem_servico SET 
                            ORD_defensivos='".($ordem['ORD_defensivos'])."',
                            ORD_detalhes_tratamento='".($ordem['ORD_detalhes_tratamento'])."' 
                                WHERE ".$campo."='".$ordemId."'
                                and ORD_data_visita > '".$ord->db->filtroData($ordem['ORD_data_visita'])."'
                        ");
                    }

                }
            }else{
                $note['tipo'] = 'nFailure';
                $note['msg'] = 'Erro: Os dados não puderam ser gravados.';
            }
            $mensagem = '
                <div class="nNote '.$note['tipo'].'">
                        <p>'.$note['msg'].'</p>
                </div>                    
            ';
	    array_push($ordemServico,$_POST);
            
            
            if($_POST['cronograma'] == 1) {
                include $_SESSION['RAIZ'].'cronograma'.DS.'gerar.php';// inclui o gerador de cronograma
                
            }else{
            
            }
            
	}
	
	if(is_numeric($_GET['ord_id'])){
            $ordemServico = $ord->getOs($_GET['ord_id']);
	}
	
	function _gera_Tabela_Recursos($edit = false) {
                if($edit != false){
		  $reg = CJSON::decode($edit);
                }  
		 if(!is_array($reg)){
                    
                    $reg[0]['ambiente'] = '';
                    $reg[0]['ep']['nome'] = 0;
                    $reg[0]['ve'] = 0;
                    $reg[0]['ni'] = '';
                    $reg[0]['te'] = '';
			 
		 }
		for ($i = 0; $i < count($reg); $i++) {
		
                   
			$recursos = $reg[$i];
                        
			$colum[$i][''] = '';
			$colum[$i]['Ambientes'] = $recursos['ambiente'];
			$colum[$i]['EP'] = array('nome'=>  utf8_encode($recursos['ep']['nome']));
			$colum[$i]['VE'] = $recursos['ve'];
			$colum[$i]['NI'] = $recursos['ni'];
			$colum[$i]['TE'] = $recursos['te'];
                       
                          $json = '{
                                "ambiente":"'.$recursos['ambiente'].'",
                                "ep":{"nome":"'.$recursos['ep']['nome'].'"},
                                "ve":"'.$recursos['ve'].'",
                                "ni":"'.$recursos['ni'].'",
                                "te":"'.$recursos['te'].'",
                                
                           }';
                        
			$colum[$i]['Op'] = '
				<textarea name="ORD_detalhes_tratamento[]" style="display:none;">' . $json . '</textarea>
				<ul class="btn-group toolbar">
					<li><a href="#" onclick="return removeLinha(\'linha_' . $i . '\')" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
				</ul>
                        ';
                        
                        if($recursos['ep']['nome'] > 0){
                            $especie_db = new Registro('pragas');
                            $id = explode(' - ',$recursos['ep']['nome']);
                            $especie = $especie_db->_select('PRA_id',$id[0]);
                            $especie = $especie[0];
                            $colum[$i]['EP'] = '('.$especie['PRA_sigla'].') '.$especie['PRA_nome'];
                        }
                        
                    
                    
		   
		}
	
        
        if (count($reg) > 0) {
            // constroi a tabela
            $tab = new tabela($colum);
            $tab->addAttr('tDefault');
            echo '

                <div class="widget check">
                  <div class="whead">
                    <h6>Lista</h6>
                    <div class="clear"></div>
                  </div>
                  <div  class="dyn hiddenpars recursos_tab1">
                ';
            if (is_object($tab)) {
                $tab->show();
            }
            echo '
                        </div>
                </div>
              ';
        }
        if (count($reg) > 0) {
            // constroi a tabela
            $tab = new tabela($colum);

            return $tab;
        } else {
            return false;
        }
    }
    
        function _gera_Tabela_Recursos_produtos($reg) {
	$reg = json_decode($reg);
         if(!is_array($reg)){
                $objNeutro = new stdClass();
                $objNeutro->id = '';
                $objNeutro->qtd = 0;
                $objNeutro->valor = 0;
                $objNeutro->disp = '';
                $objNeutro->med = '';
                $objNeutro->ni = '';
                $reg[] = $objNeutro;

        }else{
           
        }
		
        for ($i = 0; $i < count($reg); $i++) {

            $recursos = ($reg[$i]);

            // seleciona produto
            $pro = new Registro('produtos');
            $PRODUTO = $pro->_select('PRO_id',$recursos->id);
            
            $colum[$i]['Prod'] = $PRODUTO[0]['PRO_nome'];
            $colum[$i]['Qtd'] = $recursos->qtd;
            $colum[$i]['Med'] = $recursos->med;
            $colum[$i]['Valor und'] = $recursos->valor;
            $colum[$i]['Valor total'] = $recursos->valor*$recursos->qtd;
            $REC_dados_recursos_produtos += $colum[$i]['Valor total'];
            
            $colum[$i]['Op'] = '';
            $colum[$i]['Op'] .= '<textarea name="ORD_defensivos[]" style="display:none;">' . json_encode($recursos) . '</textarea>';
            $colum[$i]['Op'] .= '
                <ul class="btn-group toolbar">
                        <li><a href="#" onclick="return removeLinha(\'linha3_' . $i . '\')" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
                </ul>
          ';

        }

        
        if (count($reg) > 0) {
            // constroi a tabela
            $tab = new tabela($colum,'linha3');
            $attr = array(
                'cellpadding' => 0,
                'cellspacing' => 0,
                'width'       => "100%",
                'class'       => "tDefault"
            );
            $tab->addAttr($attr);
            echo '
                <div class="widget">
                  <div class="whead">
                    <h6>Lista</h6>
                    <div class="clear"></div>
					<script>$(document).ready(function(){formar_preco(valor);})</script>
                  </div>
                  <div  class="recursos_tab3">
                ';
            if (is_object($tab)) {
                $tab->show();
            }
            echo '
                        </div>
                </div>
				<div>
					<span style="float:right;font-size:16px !important;" id="total_recursos" class="green">Total <b>'.(($REC_dados_recursos_produtos > 0)?$REC_dados_recursos_produtos:"0.00").'</b><input type="hidden" value="'.$REC_dados_recursos_produtos.'" /></span>
					<div class="clear"></div> 
				</div>
              ';
        }
        if (count($reg) > 0) {
            // constroi a tabela
            $tab = new tabela($colum);

            return $tab;
        } else {
            return false;
        }
    }
	
?>
<script>
	
	$(document).ready(function() {
            $("#linha_0,#linha3_0,#linha2_0").hide()
            $("#orcamento").submit(function(){
                r = confirm("Deseja que as proximas visitas sejam redefinidas com as listas de DETALHES DO TRATAMENTO, DEFENSIVOS E ACESSÓRIOS desta OS? !");
                if (r == true){
                  $("#subistitui").val(1)
                }
            });
            var i_list = $('.linha').length;
            $(".addRecurso_tab1").click(function(){
                    rec = {
                        ambiente: $("#ambiente").val(),
                        ep : {id:$("#ep").attr('data-valor'),nome:$("#ep").val()},
                        ve : $("#ve").val(),
                        ni : $("#ni").val(),
                        te : $("#te").val()
                    };
                    json = JSON.stringify(rec);

                    linha = '<tr id="linha_'+i_list+'" class="linha odd">'+
                            '<td class="sorting_1 noBorderB"></td>'+
                            '<td class="noBorderB">'+rec.ambiente+'</td>'+
                            '<td class="noBorderB">'+rec.ep.nome+'</td>'+
                            '<td class="noBorderB">'+rec.ve+'</td>'+
                            '<td class="noBorderB">'+rec.ni+'</td>'+
                            '<td class="noBorderB">'+rec.te+'</td>'+
                            '<td class="noBorderB">'+
                                    '<textarea name="ORD_detalhes_tratamento[]" style="display:none;">'+json+'</textarea>'+
                                    '<ul class="btn-group toolbar">'+
                                                                    '<li><a href="#"  onclick="return removeLinha(\'linha_'+i_list+'\')" class="tablectrl_small bDefault"><span class="iconb" data-icon=""></span></a></li>'+
                                    '</ul>'+ 
                            '</td>'+
                    '</tr>';

                    $(".recursos_tab1 tbody").append(linha);
                    i_list++;
                    return false
            })
            var rec_material = new Array;
            var i_list3 = $('.linha3').length;
            $(".addRecurso_tab3").click(function(){
			
			estoque  =  $('#recursos_materiais_PRO_id').find('option:selected').attr('estoque');
			cliente  =  $('#recursos_materiais_PRO_id').find('option:selected').attr('cliente');
			unid     =  $('#recursos_materiais_PRO_id').find('option:selected').attr('unid');
			valor_material  =  $('#recursos_materiais_PRO_id').find('option:selected').attr('valor');
			rec = {
				id: $('#recursos_materiais_PRO_id').find('option:selected').attr('proId'),
				produto: $("#recursos_materiais_PRO_id").val(),
				qtd : $("#REC_qtd_produto").val(),
				med: (estoque*cliente)+' '+unid,
				valor: valor_material
			};
			json = JSON.stringify(rec);
			
			rec_material.push(rec);
			v = Number(rec.valor);
			vT =(rec.valor*rec.qtd);
			linha = '<tr id="linha3_'+i_list3+'" class="linha3 odd">'+
                                '<td class="noBorderB">'+rec.produto+'<input type="hidden" name="id[]" value="'+rec.id+'"/></td>'+
                                '<td class="noBorderB" class="rec_qtd">'+rec.qtd+'</td>'+
                                '<td class="noBorderB">'+rec.med+'</td>'+
                                '<td class="noBorderB" class="rec_valor">'+v.toFixed(2)+'</td>'+
                                '<td class="noBorderB" class="">'+vT.toFixed(2)+'</td>'+
                                '<td class="noBorderB">'+
                                                '<textarea name="ORD_defensivos[]" style="display:none;">'+json+'</textarea>'+
                                                '<ul class="btn-group toolbar">'+
                                                                '<li><a href="#"  onclick="return removeLinha(\'linha3_'+i_list3+'\')" class="tablectrl_small bDefault"><span class="iconb" data-icon=""></span></a></li>'+
                                                '</ul>'+ 
                                '</td>'+
                        '</tr>';
			$(".recursos_tab3 tbody").append(linha);
			i_list3++;
			
			return false
		})
	})
        
        
  
</script>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .linha:hover{
            background-color:#f2f2f2;
        }
    </style>
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Técnico</span>
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
                <li><a href="?cat=os&pg=lista">Ordens de Serviço</a></li>
                <li><a href="?cat=os&pg=registro">Nova</a></li>
            </ul>
        </div>
        
    </div>
    
    <? if(is_numeric($_GET['ord_id'])){ ?>
    <!-- Main content -->
        <div class="fluid">
           <div class="widget grid12" style="margin-left:0px;"> 
                <div  class="formRow grid3">
                    
                    <a href="<?=$_SESSION['URL']?>impressao/os.php?ord_id=<?=$_GET['ord_id']?>" class="buttonL bDefault" target="_blank"><div class="fs1 iconb" data-icon="">&ensp;Imprimir Os</div></a>
                </div>
                <div  class="formRow grid9" align="right">
                   <a href="<?=$_SESSION['URL']?>impressao/ppe.php?ord_id=<?=$_GET['ord_id']?>" target="_blank" class="buttonL bDefault">PPE</a>
                   <a href="<?=$_SESSION['URL']?>impressao/ppi.php?ord_id=<?=$_GET['ord_id']?>" target="_blank" class="buttonL bDefault">PPI</a>
                   <a href="<?=$_SESSION['URL']?>impressao/biologica.php?ord_id=<?=$_GET['ord_id']?>" target="_blank" class="buttonL bDefault">BIOLÓGICA</a>
                </div>
            </div>  
        </div>
     <? }?> 
        <form id="orcamento" class=" grid12 orcamento" style="margin-left:0px;" method="post" action="?cat=os&pg=registro<?=is_numeric($ordemServico['ORD_id'])?"&ord_id=".$ordemServico['ORD_id']:"";?>">
            <div class="fluid">
              <!--Abas de cadastros-->
              <div class="widget grid12"> 
                <?=$mensagem;?>
                
                 <div  class="formRow">
                    <div class="grid6 ambientes">
                        <?=$numOrcamento;?>
                        <div class="grid5 searchDrop">
                            <span class="note">Orçamento</span>
                            <input id="subistitui" type="hidden" name="subistitui" value="0">
                             <select name="ORC_id" data-placeholder="Escolha um Orçamento" class="select validate[required]"  tabindex="2">
                                 <option value=""></option> 
									<?
                                    
                                    $orcamentos = $ORC->listOrcamento();
                                     if(is_array($orcamentos)){
                                        foreach($orcamentos as $orcamento){
					  $cliente = $ORC->getCliente($orcamento['CLI_id']);
                                          if( ($ordemServico['ORC_id'] == $orcamento['ORC_id']) || ($_GET['orc_id'] == $orcamento['ORC_id']) ){
                                            $select = 'selected="selected"';
                                          }else{
                                            $select = "";
                                          }
                                          echo '<option value="'.$orcamento['ORC_id'].'" '.$select.'>'.$cliente['CLI_nome'].' ( Nº '.$orcamento['ORC_id'].' )</option> ';
                                        }
                                    }
                                   ?>
                            </select>
                        </div>
                    </div>
                     <div class="grid6 ">
                        <div class="grid5">
                            <span class="note">GERAR CRONOGRAMA?</span>
                             <input type="radio" id="" name="cronograma" value="1" />
                             <label for="radio1"  class="mr20">SIM</label>
                             <input type="radio" id="" name="cronograma" value="0" checked="checked" />
                             <label for="radio2"  class="mr20">NÃO</label>
                             
                        </div>
                    </div>
                     
                    <div class="clear"></div>
                </div>
            	<div  class="formRow fluid">
                	<div class="grid3">
                    	<span class="note">Data da visita</span>
                        <input type="text" name="ORD_data_visita"  value="<?=$ordemServico['ORD_data_visita']?>" class="datepicker" >
                        <input type="hidden" name="id_pai"  value="<?=empty($ordemServico['id_pai'])?0:$ordemServico['id_pai']?>" >
                    </div>
                	<div class="grid2">
                    	<span class="note">Hora</span>
                        <input type="text" name="ORD_hora_visita"  value="<?=$ordemServico['ORD_hora_visita']?>" class="horaMeia" >
                    </div>
                	<div class="grid3">
                    	<span class="note">Procurar por</span>
                        <input type="text" name="ORD_aguardando"  value="<?=$ordemServico['ORD_aguardando']?>"  >
                    </div>
                	<div class="grid3">
                    	<span class="note">Agendado por:</span>
                        <input type="text" name="ORD_agendado"  value="<?=$ordemServico['ORD_agendado']?>"  >
                    </div>
                </div>
                
            	<div  class="formRow fluid">
                	<div class="grid3 searchDrop">
                        <span class="note">Tipo de Visita</span>
                         <select name="ORC_tipo_visita" data-placeholder="Escolha um tipo" class="select validate[required]"  tabindex="2" style="width:100%;">
                             <option value=""></option> 
                             <?
                                    foreach($ord->tipoVisita as $key=>$tipo){
                                            $select = '';
                                            if($key == $ordemServico['ORC_tipo_visita']){$select = 'selected="selected"';}
                                            echo '<option value="'.$key.'" '.$select.'>'.$tipo.'</option> ';
                                    }
                             ?>
                        </select>
                    </div>
                	<div class="grid3 searchDrop">
                        <span class="note">Atividade</span>
                         <select name="ORC_atividade" data-placeholder="Escolha uma atividade" class="select validate[required]"  tabindex="2" style="width:100%;">
                             <option value=""></option> 
                             <?
                                    foreach($ord->tipoAtividade as $key=>$atividade){
                                            $select = '';
                                            if($key == $ordemServico['ORC_atividade']){$select = 'selected="selected"';}
                                            echo '<option value="'.$key.'" '.$select.'>'.$atividade.'</option> ';
                                    }
                             ?>
                        </select>
                    </div>
                	<div class="grid3 searchDrop">
                        <span class="note">Equipe de técnicos</span>
                         <select name="EQU_id" data-placeholder="Escolha uma equipe" class="select "  tabindex="2" style="width:100%;">
                             <option value=""></option> 
                             <?
                                    $equipes = new Registro('equipes');
                                    foreach($equipes->_select() as $key=>$equipe){
                                            $select = '';
                                            if($equipe['EQU_id'] == $ordemServico['EQU_id']){$select = 'selected="selected"';}
                                            echo '<option value="'.$equipe['EQU_id'].'" '.$select.'>'.$equipe['EQU_nome'].'</option> ';
                                    }
                             ?>
                        </select>
                    </div>
                	<div class="grid3 searchDrop">
                        <span class="note">Veículo</span>
                         <select name="VEI_id" data-placeholder="Escolha um veículo" class="select"  tabindex="2" style="width:100%;">
                             <option value=""></option> 
                             <?
                                    $veiculos = new Registro('veiculos');
                                    foreach($veiculos->_select() as $key=>$veiculo){
                                            $select = '';
                                            if($veiculo['VEI_id'] == $ordemServico['VEI_id']){$select = 'selected="selected"';}
                                            echo '<option value="'.$veiculo['VEI_id'].'" '.$select.'>('.$veiculo['VEI_codigo'].') - '.$veiculo['VEI_veiculo'].'</option> ';
                                    }
                             ?>
                        </select>
                    </div>
                </div>
               
            </div>  
       </div>
       
            
        <?
          $r = new Registro('recursos_materiais');
          //$ultimo_id = $r->_select('WHERE REC_id ORDER BY DESC LIMIT 0,1');
        ?>
        <div class="fluid">
            <div class="grid12">
                <div class="widget grid6">
                    <div class="whead">
                        <h6>Detalhes do Tratamento</h6>
                        <div class="clear"></div>
                     </div>
                    <!-- Recursos Materiais !-->
                    <div  class="formRow">
                        <div class="grid9">
                           <span class="note"><b><b>Ambiente</b></b></span>
                           <input type="text" id="ambiente" />
                       </div>
                        <div class="clear"></div>
                    </div>
                    <div  class="formRow">
                        <div class="grid12 ">
                            <div class="grid6 searchDrop">
                                <span class="note"><b>Especie</b></span>
                                 <select id="ep" data-placeholder="Escolha uma especie" 
                                  class="select ep grid12 validate[required]" tabindex="2">
                                       <option value=""></option> 
                                       <?
                                        $PRA = new Registro('pragas');
                                        $select_pragas = $PRA->_select();
                                         if(is_array($select_pragas)){
                                            foreach($select_pragas as $praga){
                                                echo '<option value="'.$praga['PRA_id'].' - '.$praga['PRA_nome'].'" '.$select.'>'.$praga['PRA_sigla'].' - '.$praga['PRA_nome'].'</option> ';
                                            }
                                        }
                                      ?>
                                </select>
                             </div>
                            <div class="grid6 searchDrop">
                                <span class="note"><b>Vestígio</b></span>
                                 <select id="ve" data-placeholder="Escolha um vestígio" 
                                  class="select grid12 validate[required]" tabindex="2">
                                       <option value=""></option> 
                                       <option value="(DN) Danos">(DN) Danos</option> 
                                       <option value="(FE) Fezes">(FE) Fezes</option> 
                                       <option value="(IN) Informação">(IN) Informação</option> 
                                       <option value="(OD) Odor">(OD) Odor</option> 
                                       <option value="(PF) Presença">(PF) Presença</option> 
                                       <option value="(TU) Túneis">(TU) Túneis</option> 

                                </select>
                             </div>
                        </div>
                        <div class="clear"></div>
                    </div>

                    <div  class="formRow">
                        <div class="grid12 ">
                            <div class="grid6 searchDrop">
                                <span class="note"><b>Nível</b></span>
                                 <select id="ni" data-placeholder="Escolha um Nível" 
                                  class="select grid12 validate[required]" tabindex="2">
                                       <option value=""></option> 
                                       <option value="(AL) Alto">(AL) Alto</option> 
                                       <option value="(BX) Baixo">(BX) Baixo</option> 
                                       <option value="(PR) Preventivo">(PR) Preventivo</option> 

                                </select>
                             </div>
                            <div class="grid6 searchDrop">
                                <span class="note"><b>Tratamento</b></span>
                                 <select id="te" data-placeholder="Escolha um produto" 
                                  class="select tratamento grid12 validate[required]" tabindex="2">
                                       <option value=""></option> 
                                       <?
                                        $TRA = new Registro('tratamentos');
                                        $select_tratamento = $TRA->_select();
                                         if(is_array($select_tratamento)){
                                            foreach($select_tratamento as $tratamento){

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
                     <div  class="formRow">
                            <div class="grid12">
                                <a href="#" class="tablectrl_large bGreen floatR addRecurso_tab1"><span class="iconb" data-icon="&#xe078;"></span></a>
                            </div>
                            <?
                             //echo $ord->getTratamentos($_GET['ord_id']);
                             _gera_Tabela_Recursos($ord->getTratamentos($_GET['ord_id']));
                           ?>
                            <div class="clear"></div> 

                    </div> 
                    <!-- FIM Cálculo de preço !--> 

                </div>
                <div class="widget grid6">
                    <div class="whead">
                        <h6>Defensivos, Dispositivos, Acessórios e Equipamentos</h6>
                        <div class="clear"></div>
                     </div>
                    <!-- Atividades complementáres !-->
                     <div  class="formRow">
                         <div class="grid12 searchDrop">
                            <span class="note"><b>Produto</b></span>
                             <select id="recursos_materiais_PRO_id"  data-placeholder="Escolha um produto" class="select pro grid12 validate[required]" tabindex="2">
                                   <option value=""></option> 
                                   <?
                                    $PRO = new Registro('produtos');
                                    $select_produtos = $PRO->_select();
                                     if(is_array($select_produtos)){
                                        foreach($select_produtos as $produtos){
                                         if(strtoupper(substr($produtos['PRO_nome'], 0, 3)) == strtoupper(substr($produtos['PRO_nome'], 0, 3))){
                                            $select = 'selected="selected"';
                                          }else{
                                            $select = "";
                                          }
                                          $qtdUsada = $produtos['PRO_conver_estoque']*$produtos['PRO_conver_cliente'];
                                          //echo ($produtos['PRO_medida_produto']*$produtos['PRO_conver_cliente']);
                                          $PRO_preco_final = ($produtos['PRO_preco_final']*$qtdUsada)/($produtos['PRO_medida_produto']*$produtos['PRO_conver_cliente']);


                                          echo '<option value="'.$produtos['PRO_nome'].'" estoque="'.$produtos['PRO_conver_estoque'].'" cliente="'.$produtos['PRO_conver_cliente'].'" unid="'.$produtos['PRO_unid_cliente'].'" proId="'.$produtos['PRO_id'].'" valor="'.$PRO_preco_final.'" '.$select.'>'.$produtos['PRO_nome'].' ('.$produtos['PRO_unid_cliente'].')</option> ';
                                        }
                                    }
                                  ?>
                            </select>
                         </div>

                        <div class="clear"></div>
                    </div> 
                     <div class="formRow">
                        <!-- Transformação de medida !-->
                        <div class="grid12">
                            <div class="grid6">
                                <span class="note">Quantidade</span>
                                <input id="REC_qtd_produto" type="text" class="validate[required] validNum" value="0" />
                            </div>
                            <div class="grid6">
                                <span class="note">Nº Aplicação</span>
                                <input id="REC_nAplic_produto" type="text" class="validate[required] validNum" value="0"/>
                            </div>

                         </div>
                         <div class="clear"></div>
                     </div>
                    <!-- Cálculo de preço !-->
                    <div  class="formRow">
                        <div class="grid12">
                            <a href="#" class="tablectrl_large bGreen floatR addRecurso_tab3"><span class="iconb" data-icon="&#xe078;"></span></a>
                        </div>
                       <?
                             
                         _gera_Tabela_Recursos_produtos(utf8_encode($ord->getRecursos($_GET['ord_id'])));
                       ?>

                        <div class="clear"></div> 
                    </div> 
                     <div class="clear"></div> 
                
                    
                    <!-- FIM Atividades complementáres !--> 
                </div>
            </div>
            <div class="floatR" style="margin-right:15px;">
                <input type="submit" name="controle-orcamento"  value="Salvar" class="buttonM bGreen " >
                <div class="clear"></div>
            </div>
            <div class="clear"></div> 
            <br />

        </div>
                       
        </form> 

    </div>
	


