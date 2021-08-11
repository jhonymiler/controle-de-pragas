<?
$r = new Registro('clientes');

switch($_GET){
	case $_GET['add'] == true && $_POST['CLI_nome'] && empty($_POST['CLI_id']) :
		$_POST['CLI_nascimento'] = dataFiltro($_POST['CLI_nascimento']);
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

	case $_GET['add'] == true && is_numeric($_POST['CLI_id']) :
		$_POST['CLI_nascimento'] = $r->filtroData($_POST['CLI_nascimento']);
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
			  $linhas_afetadas = $r->_delete('CLI_id', $_GET['id']);
			  
		  // se hover um post remover, remove varios registros que foram selecionados na lista
		  }else if(!isset($_GET['id']) && isset($_POST['remover'])){
		  	foreach($_POST['checkRow'] as $valor){
				$linhas_afetadas += $r->_delete('CLI_id',$valor);
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
	case is_numeric($_GET['id']):
		 $r->_busca('CLI_id', $_GET['id']);
		 $cliente = $r->_getReg();
		 $cliente['CLI_nascimento'] = $r->filtroData($cliente['CLI_nascimento']);
		 $campos = json_encode($cliente);
		 break;		  
}
?>
<script>
    $(window).load(function(){
        var campos = <?=$campos?>;
        var tipo = '<?=$cliente['CLI_tipo']?>';
        
        delete campos['CLI_tipo'];
        
        switch(tipo.length > 0){
            case tipo == "fisica":
                    $("#Nome").find('label').html('Nome:')

                    $(".formPessoa #rg-ie label").html('RG:')

                    $(".juridica").fadeOut();
                    $(".fisica").fadeIn(200)

                    $(".formPessoa #cpf-cnpj label").html('CPF:');
                    $(".formPessoa input[name=CLI_cpf_cnpj]").removeClass('maskCnpj').addClass('maskCpf');
                    $(".maskCpf").mask("999.999.999-99");
                    preencer(campos);
                    break;

            case tipo == "juridica":
                    $("#Nome").find('label').html('Nome Fantasia:')

                    $(".formPessoa #rg-ie label").html('IE:')

                    $(".formPessoa #cpf-cnpj label").html('CNPJ:');
                    $(".formPessoa  input[name=CLI_cpf_cnpj]").removeClass('maskCpf').addClass('maskCnpj');
                    $(".maskCnpj").mask("99.999.999/9999-99");

                    // exposicao
                    $(".fisica").fadeOut();
                    $(".juridica").fadeIn(200);
                    preencer(campos);
                    break;
        }
        
    })
    function preencer(json){
        for(var key in json){
            $("[name="+key+"]").val(json[key]);
        }
    }
</script>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Clientes</span>
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
                <li><a href="?cat=cadastros&pg=clientes">Clientes</a>
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
                        <li><a href="?cat=cadastros&pg=clientes&add=true" title=""><span class="icos-add"></span>Novo</a></li>
                        <li><a href="?cat=cadastros&pg=clientes&list=true" title=""><span class="icos-archive"></span>Lista</a></li>
                    </ul>
                </li>
            </ul>
             <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
     <? if($_GET['list'] == true){
		 
		 // gera a tabela 
		  $clientes = new cliente;
		  $clientes->_geraTabela();
	/*	  $reg = $pessoa->_select();
			for ($i = 0;$i < count($reg);$i++) {
				  $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['CLI_id'].'" />';
				  $colum[$i]['Nome'] = $reg[$i]['CLI_nome'];
				  $colum[$i]['CPF:'] = $reg[$i]['CLI_cpf'];
				  $colum[$i]['Endereço'] = $reg[$i]['CLI_rua'].", ".$reg[$i]['CLI_num'].".<br> ".$reg[$i]['CLI_bairro']." ".$reg[$i]['CLI_cidade']."/".$reg[$i]['CLI_uf']."<br> CEP: ".$reg[$i]['CLI_cep'].
				  $colum[$i]['Fone'] = $reg[$i]['CLI_tel1'];
				  $colum[$i]['Cel.'] = $reg[$i]['CLI_cel'];
				  $colum[$i]['E-mail'] = $reg[$i]['CLI_email'];
				  if($edit = true){
					  $colum[$i]['Opções'] = '
							<ul class="btn-group toolbar">
								<li><a href="?cat=cadastros&pg=funcionarios&id='.$reg[$i]['CLI_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
								<li><a href="?cat=cadastros&pg=funcionarios&remove=true&id='.$reg[$i]['CLI_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
							</ul> 
					  ';
						   
				  }
			}
			if(count($reg)>0){
				// constroi a tabela
				$tab = new tabela($colum);
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
							<form id="remover"  method="post" action="?cat=cadastros&pg=funcionarios&remove=true">
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
		  
		  $tab = $pessoa->_geraTabela();
		  echo '
		  <div class="widget check">
			<div class="whead"> 
			  <span class="titleIcon">
			  <input type="checkbox" id="titleCheck" name="titleCheck" />
			  </span>
			  <h6>Lista de Clientes</h6>
			  <div class="clear"></div>
			</div>
			<div class="dyn hiddenpars"> 
				<a class="tOptions" title="Options">
					<img src="images/icons/options.png" alt="" />
				</a>
				<form id="remover"  method="post" action="?cat=cadastros&pg=clientes&remove=true">
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
*/	 }else{?>
     	<script language="javascript">
		
			$(document).ready(function(){
				$('#add-Contato').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Nice stuff": function () {
							$(this).dialog("close");
						},
						"Cancel": function () {
							$(this).dialog("close");
						}
					}
				});
					// Dialog Link
				$('#addContato').click(function () {
					$('#add-Contato').dialog('open');
					return false;
				});

				
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
				
				$(".fisica").hide()
				
				
				//===== Seleciona Pessoa Fisica ou Jurídica =====//
				$('[name=CLI_tipo]').click(function(){
					  // update the text based on the status of the checkbox
					  //alert($input.val())
					  $input = $(this);
					 switch($input.val().length > 0){
						case $input.val() == "fisica":
							$("#Nome").find('label').html('Nome:')
							
							$(".formPessoa #rg-ie label").html('RG:')
							
							$(".juridica").fadeOut();
							$(".fisica").fadeIn(200)
							
							$(".formPessoa #cpf-cnpj label").html('CPF:');
							$(".formPessoa #cpf-cnpj input")
							.removeClass('maskCnpj')
							.addClass('maskCpf')
							$(".maskCnpj").mask("999.999.999-99");
							break;
							
						case $input.val() == "juridica":
							$("#Nome").find('label').html('Nome Fantasia:')
							
							$(".formPessoa #rg-ie label").html('IE:')
							
							$(".formPessoa #cpf-cnpj label").html('CNPJ:');
							$(".formPessoa #cpf-cnpj input")
							.removeClass('maskCpf')
							.addClass('maskCnpj')
							$(".maskCnpj").mask("99.999.999/9999-99");
							
							// exposicao
							$(".fisica").fadeOut();
							$(".juridica").fadeIn(200);
							break;
					 }
				});
			
			});
			
		</script>
        <div class="fluid">
        
        <form id="cadastro" class="formPessoa grid12" method="post" action="?cat=cadastros&pg=clientes&add=true">
            <div class="widget">
                <div class="whead"><h6>Cadastro - Novo usuário</h6><div class="clear"></div></div>
                <?=$mensagem;?>
                <input id="nomeTabela" type="hidden" value="clientes" />
                <div class="formRow">
                        <div class="grid3">
                          <label><b>Pessoa: </b></label></div>
                        <div id="" class="grid9 cliente">
                            <div class="floatL mr10">
                                Física: 
                                <input type="radio"  name="CLI_tipo" value="fisica"  <?=($cliente['CLI_tipo'] == 'fisica')?'checked="checked"':'';?>/>
                            </div>
                            <div class="floatL mr10">
                                Jurídica:
                                <input type="radio"  name="CLI_tipo"  value="juridica" <?=($cliente['CLI_tipo'] == 'juridica')?'checked="checked"':'';?>/>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div id="Nome" class="formRow">
                        <div class="grid3">
                          <label>Nome Fantasia:<span class="req">*</span></label>
                        </div>
                        <div class="grid9">
                            <input type="text" class="validate[required]" name="CLI_nome" id="nome"/>
                            <?=(is_numeric($_GET['id']))?'<input type="hidden" name="CLI_id" value="'.$_GET['id'].'"/>':'';?>
                            <img src="images/icons/usual/icon-admin.png" alt="" class="fieldIcon">
                        </div>
                        <div class="clear"></div>
                    </div>
                    
                    
                    <!--DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                     <div  class="formRow">
                            <div id="cpf-cnpj" class="grid3"><label>CNPJ:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="CLI_cpf_cnpj"  class="validate[required] maskCnpj grid4" /></div><div class="clear"></div>
                    </div>
                    
                    <div id="rg-ie" class="formRow">
                        <div class="grid3"><label>IE:<span class="req">*</span></label></div>
                        <div class="grid9"><input type="text" name="CLI_rg_ie"  class="validate[required] grid4" /></div><div class="clear"></div>
                    </div>
                    
                    <!-- FIM DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                   
                   
                    <!--DADOS DA PESSOA FISICA OU JURIDICA!-->
                    <div class="formRow fisica">
                        <div class="grid3"><label>Nascimento:<span class="req">*</span></label></div>
                        <div class="grid9"><input type="text" name="CLI_nascimento" class="validate[required] maskDate grid3" /></div><div class="clear"></div>
                    </div>
                    <!-- FIM DADOS DA PESSOA FISICA OU JURIDICA!-->
                    
                    <!-- Informações de Endereço !-->
                    <div  class="formRow">
                        <div class="grid3"><b>Endereço</b></div>
                        <div id="Endereco" class="grid9">
                            <div class="grid3">
                                <span class="note">CEP</span>
                                <input type="text" class="validate[required] maskCEP" name="CLI_cep" id="cep"/>
                            </div>
                            <div class="grid7">
                                <span class="note">Cidade</span>
                                <input type="text" class="validate[required]" name="CLI_cidade" id="cidade"/>
                            </div>
                            <div class="grid2">
                                <span class="note">Uf</span>
                                <input type="text" class="validate[required]" name="CLI_uf" id="uf"/>
                            </div>
                            
                            <div class="clear"></div>   
                            <div class="grid4" style="margin-left:0px;">
                                <span class="note">Bairro</span>
                                <input type="text" class="validate[required]" name="CLI_bairro" id="bairro"/>
                            </div>
                            <div class="grid6">
                                <span class="note">Rua</span>
                                <input type="text" class="validate[required]" name="CLI_rua" id="rua"/>
                            </div>
                            <div class="grid2">
                                <span class="note">Nº</span>
                                <input type="text" class="validate[required]" name="CLI_num" id="num"/>
                            </div>
                        </div>
                        <div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>E-mail:<span class="req">*</span></label></div>
                        <div class="grid9"><input type="text" class="validate[required,custom[email],ajax[existeEmail]]" name="CLI_email" id="email" /></div><div class="clear"></div>
                    </div>
                    
                    <div class="formRow">
                        <div class="grid3"><label>TEL:<span class="req">*</span></label></div>
                        <div class="grid9"><input type="text" name="CLI_tel1"  class="validate[required] grid4 maskPhone" /></div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>TEL :</label></div>
                        <div class="grid9"><input type="text" name="CLI_tel2" class="grid4 maskPhone" /></div><div class="clear"></div>
                    </div>
                    <div class="formRow">
                        <div class="grid3"><label>Fax :</label></div>
                        <div class="grid9"><input type="text" name="CLI_fax" class="grid4 maskPhone" /></div><div class="clear"></div>
                    </div>
                   <!-- <div class="formRow">
                        <div class="grid9"><a href="#" class="buttonM bDefault ml10" id="addContato">Add Contato</a></div><div class="clear"></div>
                    </div>-->
                    <div class="formRow">
                        <div class="grid3"><label>Classificação :</label></div>
                        <div class="grid9 on_off">
                            <label for="cassif1" class="mr20">A</label>
                            <div class="floatL mr10">
                                <input id="cassif1"  name="CLI_classificacao" type="radio" value="A" <?=($cliente['CLI_classificacao'] == 'A')?'checked="checked"':'';?>/>
                            </div>
                            <!--!-->
                            <label for="cassif2" class="mr20">B</label>
                            <div class="floatL mr10">
                                <input id="cassif2"  name="CLI_classificacao" type="radio" value="B" <?=($cliente['CLI_classificacao'] == 'B')?'checked="checked"':'';?>/>
                            </div>
                            <!--!-->
                            <label for="cassif3" class="mr20">C</label>
                            <div class="floatL mr10">
                                <input id="cassif3"  name="CLI_classificacao" type="radio" value="C"  <?=($cliente['CLI_classificacao'] == 'C')?'checked="checked"':'';?>/>
                            </div>
                            <!--!-->
                            <label for="cassif4" class="mr20">D</label>
                            <div class="floatL mr10">
                               <input id="cassif4"  name="CLI_classificacao" type="radio" value="D" <?=($cliente['CLI_classificacao'] == 'D')?'checked="checked"':'';?>/>
                            </div>
                            <!--!-->
                            <label for="cassif5" class="mr20">E</label>
                            <div class="floatL mr10">
                                <input id="cassif5"  name="CLI_classificacao" type="radio" value="E" <?=($cliente['CLI_classificacao'] == 'E')?'checked="checked"':'';?>/>
                            </div>
                            <div class="clear"></div>
                        </div>
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
        
        <!-- Dialog content -->
        <!--<div id="add-Contato" class="dialog" title="Adiciona informações de contato para o cliente">
            <form id="contato" class="grid6" method="post" action="">
                <div class="widget">
                   <div class="whead"><h6>+ Contato</h6><div class="clear"></div></div>
                      <div class="formRow">
                        <div class="grid3"><label>Nome:</label></div>
                        <div class="grid9"><input type="text" name="CON_nome" class=" grid3" /></div><div class="clear"></div>
                        <div class="clear"></div>
                      </div>
                      <div class="formRow">
                        <div class="grid3"><label>Email:</label></div>
                        <div class="grid9"><input type="text" name="CON_email" id="emailContato" class="validate[custom[emailContato],ajax[existeEmail]] grid3"  /></div><div class="clear"></div>
                        <div class="clear"></div>
                      </div>
                      <div class="formRow">
                        <div class="grid3"><label>Fone:</label></div>
                        <div class="grid9"><input type="text" name="CON_tel" class="maskPhone grid3" /></div><div class="clear"></div>
                        <div class="clear"></div>
                      </div>
                      <div class="formRow">
                        <div class="grid3"><label>Cel:</label></div>
                        <div class="grid9"><input type="text" name="CON_cel" class="maskPhoneExt grid3" /></div><div class="clear"></div>
                        <div class="clear"></div>
                      </div>
                      
                      <div class="formRow">
                        LISTA
                        <div class="clear"></div>
                      </div>
                    </div>
                </form>   
          	 </div>  -->
          </div>  
     <? }?>
    </div>

    