<?
	require_once $_SESSION['RAIZ'].'acesso.php';
	$equipe = new registro('veiculos');

	if(count($_POST)>0){
		
		// atualiza
		if(isset($_GET['vei_id'])){
			$_POST['VEI_id'] = $_GET['vei_id'];
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
			if($equipe->_delete('VEI_id',$_POST['checkRow'])){
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
		if($equipe->_delete('VEI_id',$_GET['remover'])){
			$note['tipo'] = 'nSuccess';
			$note['msg']  = 'Gravado com sucesso!';
		}else{
			$note['tipo'] = 'nFailure';
			$note['msg'] = 'Erro: Os dados não puderam ser gravados.';
		}
	}


	
	if(is_numeric($_GET['vei_id'])){
		$equ = $equipe->_select('VEI_id',$_GET['vei_id']);
		$veiculos = $equ[0];
	}
	

	
?>
<script>
    $(window).load(function(){
        var campos = <?=$veiculos?>;
		 
		 preencer(campos)
    })
</script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
<div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Funcionários</span>
        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="">Painel de Controle</a></li>
                <li><a href="">Cadastro de veiculos</a>
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
                
            <form id="cadastros" class="grid12" method="post"  action="?cat=cadastros&pg=veiculos<?=is_numeric($veiculos['VEI_id'])?"&vei_id=".$veiculos['VEI_id']:"";?>">
                <div class="widget">
                    <div class="whead"><h6>Cadastro - Veículos</h6><div class="clear"></div></div>
					<?=$mensagem;?>
                    <!-- DADOS PESSOAIS !-->
                    <div  class="formRow">
                        <div class="grid3"><b>Código do veículo</b></div>
                        <div id="Endereco" class="grid9">
                                <input type="text" class="validate[required] validNum" name="VEI_codigo" id="nome" value="<?=$veiculos['VEI_codigo']?>"/>
                         </div>
                         <div class="clear"></div>
                    </div>
                    <div  class="formRow">
                        <div class="grid3"><b>Veículo</b></div>
                        <div id="Endereco" class="grid9">
                                <input type="text" class="validate[required]" name="VEI_veiculo" id="nome" value="<?=$veiculos['VEI_veiculo']?>"/>
                         </div>
                         <div class="clear"></div>
                    </div>
                    <div  class="formRow">
                        <div class="grid3"><b>Modelo</b></div>
                        <div id="Endereco" class="grid9">
                                <input type="text" class="validate[required]" name="VEI_modelo" id="nome" value="<?=$veiculos['VEI_modelo']?>"/>
                         </div>
                         <div class="clear"></div>
                    </div>
                    <div  class="formRow">
                        <div class="grid3"><b>Ano</b></div>
                        <div id="Endereco" class="grid9">
                                <input type="text" class="validate[required]" name="VEI_ano" id="nome" value="<?=$veiculos['VEI_ano']?>"/>
                         </div>
                         <div class="clear"></div>
                    </div>
                    <div  class="formRow">
                        <div class="grid3"><b>Placa</b></div>
                        <div id="Endereco" class="grid9">
                                <input type="text" class="validate[required]" name="VEI_placa" id="nome" value="<?=$veiculos['VEI_placa']?>"/>
                        </div>
                         <div class="clear"></div>
                    </div>
                    <div  class="formRow">
                        <div class="grid3"><b>Quilometragem de aquisição:</b></div>
                        <div id="Endereco" class="grid9">
                                <input type="text" class="validate[required]" name="VEI_km_aquisicao" id="nome" value="<?=$veiculos['VEI_km_aquisicao']?>"/>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <!-- FIM DADOS PESSOAIS!-->
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
				$listEquipes = new Registro("veiculos");
				$reg = $listEquipes->_select();
				if(is_array($reg)){
					for ($i = 0;$i < count($reg);$i++) {
						  
						  $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['VEI_id'].'" />';
						  $colum[$i]['Código'] = $reg[$i]['VEI_codigo'];
						  $colum[$i]['Veículo'] = $reg[$i]['VEI_veiculo'];
						  $colum[$i]['Modelo'] = $reg[$i]['VEI_modelo'];
						  $colum[$i]['Ano'] = $reg[$i]['VEI_ano'];
						  $colum[$i]['Placa'] = $reg[$i]['VEI_placa'];
						  $colum[$i]['Km'] = $reg[$i]['VEI_km_aquisicaoo'];
						  if($edit = true){
							  $colum[$i]['Opções'] = '
									<ul class="btn-group toolbar">
										<li><a href="?cat=cadastros&pg=veiculos&vei_id='.$reg[$i]['VEI_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
										<li><a href="?cat=cadastros&pg=veiculos&remover='.$reg[$i]['VEI_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
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
								<form id="remover"  method="post" action="?cat=cadastros&pg=veiculos&remover=true">
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
    