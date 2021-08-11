<?
$r = new Registro('fornecedor');
switch($_GET){
	
	// ADICIONA UM REGISTRO
	case $_GET['add'] == true && $_POST['FOR_nome'] && empty($_POST['FOR_id']) :

		$r->_load($_POST);
		if($r->_grava()){
			$note['tipo'] = 'nSuccess';
			$note['msg']  = 'Gravado com sucesso!';
		}else{
			$note['tipo'] = 'nFailure';
			$note['msg'] = $r->_getErro();
		}
		$mensagem = '
				<div class="nNote '.$note['tipo'].'">
					<p>'.$note['msg'].'</p>
				</div>                    
		';
		break;
	// ATUALIZA UM REGISTRO
	case $_GET['add'] == true && is_numeric($_POST['FOR_id']) :
		$r->_load($_POST);
		if($r->_atualiza()>0){
			$note['tipo'] = 'nSuccess';
			$note['msg'] = 'Atualizado com sucesso!';
		}else{
			$note['tipo'] = 'nFailure';
			$note['msg'] = $r->_getErro();
		}
		$mensagem = '
				<div class="nNote '.$note['tipo'].'">
					<p>'.$note['msg'].'</p>
				</div>                    
		';
		break;
	
	// REMOVE UM OU VÁRIOS REGISTROS
	case ($_GET['remove'] == true) && (is_numeric($_GET['id']) || isset($_POST['remover'])):
	
			// se houver um get id, remove apenas um registro
		  if(is_numeric($_GET['id']) && !isset($_POST['remover'])){
			  $linhas_afetadas = $r->_delete('FOR_id', $_GET['id']);
			  
		  // se hover um post remover, remove varios registros que foram selecionados na lista
		  }else if(!isset($_GET['id']) && isset($_POST['remover'])){
		  	foreach($_POST['checkRow'] as $valor){
				$linhas_afetadas += $r->_delete('FOR_id',$valor);
			}
		  }
		  // verifica as linhas afetadas
		  if($linhas_afetadas > 0){
			  $note['tipo'] = 'nSuccess';
			  $note['msg'] = 'Excluido com Sucesso!';
			  Principal::Voltar();
		  }else{
			  $note['tipo'] = 'nFailure';
			  $note['msg'] = $r->_getErro();
		  }
		  $mensagem = '
				  <div class="nNote '.$note['tipo'].'">
					  <p>'.$note['msg'].'</p>
				  </div>                    
		  ';
		  break;
		  
	// SELECIONA UM REGISTRO PARA EDIÇÃO
	case is_numeric($_GET['id']):
		 $r->_busca('FOR_id', $_GET['id']);
		 $cliente = $r->_getReg();
		 $cliente['FOR_nascimento'] = $r->filtroData($cliente['FOR_nascimento']);
		 $campos = json_encode($cliente);
		 break;		  
}
?>
<script>
    $(window).load(function(){
        var campos = <?=$campos?>;
        preencer(campos);
	})
</script>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Fornecedores</span>
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
                <li><a href="?cat=cadastros&pg=fornecedor">Fornecedores</a>
                </li>
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
                        <li><a href="?cat=cadastros&pg=fornecedor&add=true" title=""><span class="icos-add"></span>Novo</a></li>
                        <li><a href="?cat=cadastros&pg=fornecedor&list=true" title=""><span class="icos-archive"></span>Lista</a></li>
                    </ul>
                </li>
            </ul>
             <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
     <? if($_GET['list'] == true){
		 	$reg = $r->_select();
			for ($i = 0;$i < count($reg);$i++) {
				  $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['FOR_id'].'" />';
				  $colum[$i]['Nome'] = $reg[$i]['FOR_nome'];
				  $colum[$i]['CNPJ'] = $reg[$i]['FOR_cnpj'];
				  $colum[$i]['Endereço'] = $reg[$i]['FOR_rua'].", ".$reg[$i]['FOR_num'].".<br> ".$reg[$i]['FOR_bairro']." ".$reg[$i]['FOR_cidade']."/".$reg[$i]['FOR_uf']."<br> CEP: ".$reg[$i]['FOR_cep'].
				  $colum[$i]['Fone'] = $reg[$i]['FOR_tel1'];
				  $colum[$i]['Cel.'] = $reg[$i]['FOR_cel'];
				  $colum[$i]['E-mail'] = $reg[$i]['FOR_email'];
				  if($edit = true){
					  $colum[$i]['Opções'] = '
							<ul class="btn-group toolbar">
								<li><a href="?cat=cadastros&pg=fornecedor&id='.$reg[$i]['FOR_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
								<li><a href="?cat=cadastros&pg=fornecedor&remove=true&id='.$reg[$i]['FOR_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
							</ul> 
					  ';
						   
				  }
			}
			if(count($reg)>0){
				// constroi a tabela
				$tab = new tabela($colum);
				// adiciona atributos
				$tab->addAttr();
				  echo '
					  <div class="widget check">
						<div class="whead"> 
						  <span class="titleIcon">
						  <input type="checkbox" id="titleCheck" name="titleCheck" />
						  </span>
						  <h6>Lista de Clientes</h6>
						  <div class="clear"></div>
						</div>
						<div  class="dyn hiddenpars"> 
							<a class="tOptions" title="Options">
								<img src="images/icons/options.png" alt="" />
							</a>
							<form id="remover"  method="post" action="?cat=cadastros&pg=fornecedor&remove=true">
				  ';
				 if(is_object($tab)){
					 $tab->show();
				  }
				echo '
							    <input type="submit" name="remover"  value="Remover Selecionados" class="buttonM grid6 bRed formSubmit">
						  </form>
						</div>
					</div>
				';

			}
	 }else{?>
     	<script language="javascript">
		
			$(document).ready(function(){
				
				// validação do formulário
				jQuery("#cadastro").validationEngine('attach',{
					onAjaxFormComplete: function(status, form, json, options){
						if (status === true) {
							form.submit();
						}else{
							return false
						}
					}
				});
				
			});
			
		</script>
        <div class="fluid">
        <form id="cadastro" class="formPessoa grid12" method="post" action="?cat=cadastros&pg=fornecedor&add=true">
            <div class="widget">
                <div class="whead"><h6>Cadastro - Fornecedores</h6><div class="clear"></div></div>
					<?=$mensagem;?>
                    <div id="Nome" class="formRow">
                        <div class="grid3">
                          <label>Nome Fantasia:<span class="req">*</span></label>
                        </div>
                        <div class="grid9">
                            <input id="nomeTabela" type="hidden" value="fornecedor" />

                            <input type="text" class="validate[required]" name="FOR_nome" id="nome"/>
                            <?=(is_numeric($_GET['id']))?'<input type="hidden" name="FOR_id" value="'.$_GET['id'].'"/>':'';?>
                            <img src="images/icons/usual/icon-admin.png" alt="" class="fieldIcon">
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <!--DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                     <div  class="formRow">
                            <div id="razao-social" class="grid3"><label>Razao Social:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="FOR_razao_social"  class="validate[required] grid4" /></div><div class="clear"></div>
                    </div>
                    
                     <div  class="formRow">
                            <div id="cpf-cnpj" class="grid3"><label>CNPJ:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="FOR_cnpj"  class="validate[required] maskCnpj grid4" /></div><div class="clear"></div>
                    </div>
                    
                     <div  class="formRow">
                            <div id="cpf-cnpj" class="grid3"><label>IE:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="FOR_ie"  class="validate[required] grid4" /></div><div class="clear"></div>
                    </div>
                    
                    <!-- Informações de Endereço !-->
                    <div  class="formRow">
                        <div class="grid3"><b>Endereço</b></div>
                        <div id="Endereco" class="grid9">
                            <div class="grid3">
                                <span class="note">CEP</span>
                                <input type="text" class="validate[required] maskCEP" name="FOR_cep" id="cep"/>
                            </div>
                            <div class="grid7">
                                <span class="note">Cidade</span>
                                <input type="text" class="validate[required]" name="FOR_cidade" id="cidade"/>
                            </div>
                            <div class="grid2">
                                <span class="note">Uf</span>
                                <input type="text" class="validate[required]" name="FOR_uf" id="uf"/>
                            </div>
                            
                            <div class="clear"></div>   
                            <div class="grid4" style="margin-left:0px;">
                                <span class="note">Bairro</span>
                                <input type="text" class="validate[required]" name="FOR_bairro" id="bairro"/>
                            </div>
                            <div class="grid6">
                                <span class="note">Rua</span>
                                <input type="text" class="validate[required]" name="FOR_rua" id="rua"/>
                            </div>
                            <div class="grid2">
                                <span class="note">Nº</span>
                                <input type="text" class="validate[required]" name="FOR_num" id="num"/>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>E-mail:<span class="req">*</span></label></div>
                        <div class="grid9"><input type="text" class="validate[required,custom[email],ajax[existeEmail]]" name="FOR_email" id="email" /></div><div class="clear"></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="grid3"><label>TEL:<span class="req">*</span></label></div>
                        <div class="grid9"><input type="text" name="FOR_tel1"  class="validate[required] grid4 maskPhone" /></div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>TEL :</label></div>
                        <div class="grid9"><input type="text" name="FOR_tel2" class="grid4 maskPhone" /></div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>CEL :</label></div>
                        <div class="grid9"><input type="text" name="FOR_cel" class="grid4 maskPhone" /></div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Fax :</label></div>
                        <div class="grid9"><input type="text" name="FOR_fax" class="grid4 maskPhone" /></div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                         <div class="clear"></div>
                         <div class="divider"><span></span></div>
                        
                        <div class="floatR">
                            <input type="submit"  value="Submit" class="buttonM grid6 bGreen formSubmit">
                            <input type="submit" class="buttonM grid6 bRed" value="Cancel">
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
              </div>
                    <div class="clear"></div>
            </div>
        </form>
          </div>  
     <? }?>
    </div>

    