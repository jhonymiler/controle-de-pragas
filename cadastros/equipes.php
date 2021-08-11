<?
	require_once $_SESSION['RAIZ'].'acesso.php';
	$equipe = new registro('equipes');

	if(count($_POST)>0){
		
		// tramatento JSON
		if(is_array($_POST['FUN_id'])){
			$_POST['FUN_id'] = '['.implode(',',$_POST['FUN_id']).']';
		}
		// atualiza
		if(isset($_GET['equ_id'])){
			$_POST['EQU_id'] = $_GET['equ_id'];
			if( is_array($equipe->_load($_POST)) ){
				if($equipe->_atualiza()>0){
					$note['tipo'] = 'nSuccess';
					$note['msg']  = 'Atualizado com sucesso!';
				}else{
					$note['tipo'] = 'nFailure';
					$note['msg'] = 'Erro: Os dados não puderam ser atualizados.';
				}
			}		
		}elseif(!$_GET['remover']){
			if( is_array($equipe->_load($_POST)) ){
				if($id = $equipe->_grava()){
					$note['tipo'] = 'nSuccess';
					$note['msg']  = 'Gravado com sucesso!';
				}else{
					$note['tipo'] = 'nFailure';
					$note['msg'] = 'Erro: Os dados não puderam ser gravados.';
				}
			}
		}
		
		if(isset($_GET['remover'])){
			if($equipe->_delete('EQU_id',$_POST['checkRow'])){
				$note['tipo'] = 'nSuccess';
				$note['msg']  = 'Excluídos com sucesso!';
			}else{
				$note['tipo'] = 'nFailure';
				$note['msg'] = 'Erro: Os dados não puderam ser excluídos.';
			}
		}
		$mensagem = '
			<div class="nNote '.$note['tipo'].'">
				<p>'.$note['msg'].'</p>
			</div>                    
		';
	}

	
	if(is_numeric($_GET['remover'])){
		if($equipe->_delete('EQU_id',$_GET['remover'])){
			$note['tipo'] = 'nSuccess';
			$note['msg']  = 'Gravado com sucesso!';
		}else{
			$note['tipo'] = 'nFailure';
			$note['msg'] = 'Erro: Os dados não puderam ser gravados.';
		}
	}


	
	if(is_numeric($_GET['equ_id'])){
		$equ = $equipe->_select('EQU_id',$_GET['equ_id']);
		$equipes = $equ[0];
		$integrantes = json_decode($equipes['FUN_id']);
		if(is_array($integrantes))
		foreach($integrantes as $integr){
			$integrantes[] = $integr->id;
		}
		
	}else{
		$integrantes = array();
	}
	

	
?>
<script>
    $(window).load(function(){
        var campos = <?=$equipes?>;
		 
		 preencer(campos)
    })
</script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Funcionários</span>
        <ul class="quickStats">
            <li>
                <a href="" class="blueImg"><img src="images/icons/quickstats/plus.png" alt="" /></a>
                <div class="floatR"><strong class="blue">5489</strong><span>Visitas realizadas</span></div>
            </li>
            <li>
                <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
                <div class="floatR"><strong class="blue">4658</strong><span>Funcionários</span></div>
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
                <li><a href="">Painel de Controle</a></li>
                <li><a href="">Cadastro de equipes</a>
                </li>
            </ul>
        </div>
        
    </div>
    <script>
		$(document).ready(function(){
			// validação do formulário
			$("form#cadastros").validationEngine('attach', {
				onValidationComplete: function(form, status){
					if(status == true){
						form.submit();
					}else{
						return false
					}
				}
			});
			
			$("#FUN_id option").click(function(){
				$(this).toggle(function(){
					$(this).attr('selected','selected');
				},function(){
					$(this).removeAttr('selected');
				})
			})
		});
		
	</script>
    <!-- Main content -->
    <div class="wrapper">
        <div class="fluid">
                
            <form id="cadastros" class="grid12" method="post"  action="?cat=cadastros&pg=equipes<?=is_numeric($equipes['EQU_id'])?"&equ_id=".$equipes['EQU_id']:"";?>">
                <div class="widget">
                    <div class="whead"><h6>Cadastro - Equipes técnicas</h6><div class="clear"></div></div>
					<?=$mensagem;?>
                    <!-- DADOS PESSOAIS !-->
                    <div  class="formRow">
                        <div class="grid3"><b>Nome da equipe:</b></div>
                        <div id="Endereco" class="grid9">
                            <div class="grid6">
                                <span class="note">Nome ou Numero</span>
                                <input type="text" class="validate[required]" name="EQU_nome" id="nome" value="<?=$equipes['EQU_nome']?>"/>
                            </div>
                         </div>
                    </div>
                    <!-- FIM DADOS PESSOAIS!-->
                    <div class="formRow">
                        <div class="grid3"><b>Selecione os Técnicos</b></div>
                        <div class="grid9">
                         	<span class="note">Segure Ctrl e clique para selecionar vários :</span>
                            <select id="FUN_id" name="FUN_id[]" multiple="multiple" class="multiple validate[required]" title="Selecione os Técnicos">
                                <?
								 $fun = new Registro("funcionarios");
								 $funcionarios = $fun->_busca("FUN_cargo",0);
								 foreach($funcionarios as $func){
									 if( in_array($func['FUN_id'],$integrantes)){
									 	$select = 'selected="selected"';
									 }else{
									 	$select ='';
									 }
								 	echo "<option value='{\"id\":".$func['FUN_id'].",\"nome\":\"".$func['FUN_nome']."\"}'".$select.">".$func['FUN_nome']."</option>";
								 }
                                    
                                ?>
                            </select>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="floatR">
                            <input type="submit"  value="Gravar" class="buttonM grid6 bGreen formSubmit">
                            <input type="submit" class="buttonM grid6 bRed" value="Cancel">
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
          </div> 
            
           	<? 
				$listEquipes = new Registro("equipes");
				$reg = $listEquipes->_select();
				if(is_array($reg)){
					for ($i = 0;$i < count($reg);$i++) {
						  $integ = json_decode($reg[$i]['FUN_id']);
						  
						  if(is_array($integ)){
							  $IntegrantesNomes = '';
							  foreach($integ as $int){
								 $IntegrantesNomes .= $int->nome."<br>";
							  }
						  }
						  
						  $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['EQU_id'].'" />';
						  $colum[$i]['Nome ou Num'] = $reg[$i]['EQU_nome'];
						  $colum[$i]['Integrantes'] = '<div style="text-align:left:margin-left:10px;">'.$IntegrantesNomes.'</div>';
						  if($edit = true){
							  $colum[$i]['Opções'] = '
									<ul class="btn-group toolbar">
										<li><a href="?cat=cadastros&pg=equipes&equ_id='.$reg[$i]['EQU_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
										<li><a href="?cat=cadastros&pg=equipes&remover='.$reg[$i]['EQU_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
									</ul> 
							  ';
								   
						  }
					}
					// constroi a tabela
					$tab = new tabela($colum);
					$tab->addAttr();
					  echo '
						  <div class="widget check">
							<div class="whead"> 
							  <span class="titleIcon">
							  <input type="checkbox" id="titleCheck" name="titleCheck" />
							  </span>
							  <h6>Lista de Equipes</h6>
							  <div class="clear"></div>
							</div>
							<div  class="dyn hiddenpars"> 
								<a class="tOptions" title="Options">
									<img src="images/icons/options.png" alt="" />
								</a>
								<form id="remover"  method="post" action="?cat=cadastros&pg=equipes&remover=true">
					  ';
					 if(is_object($tab)){
						 $tab->show();
					  }
					echo '
									<input type="submit" name="remover"  value="Remover Selecionados" class="buttonM  bRed floatR">
							  </form>
							</div>
						</div>
					';
				}
		  ?>


    </div>
    