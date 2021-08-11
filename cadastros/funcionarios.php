<?
$r = new Registro('funcionarios');

switch($_GET){
	case $_GET['add'] == true && $_POST['FUN_nome'] && empty($_POST['FUN_id']) :
            $_POST['FUN_nascimento'] = $r->filtroData($_POST['FUN_nascimento']);
            $_POST['FUN_adimissao'] = $r->filtroData($_POST['FUN_adimissao']);
            $_POST['FUN_permissao_area'] = json_encode($_POST['FUN_permissao_area']);
            $_POST['FUN_senha'] = md5($_POST['FUN_senha']);

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

	case $_GET['add'] == true && is_numeric($_POST['FUN_id']) :
		
            if(!empty($_POST['senha_antiga'])){
                $_POST['FUN_senha'] = md5($_POST['FUN_senha']);
                $r->_busca('FUN_id', $_POST['FUN_id']);

                if($r->_get('FUN_senha') != md5($_POST['senha_antiga'])){
                    unset($_POST['FUN_senha']);
                    Principal::Alert('A senha antiga não confere.');
                    Principal::Voltar();
                }
            }else if(empty($_POST['senha_antiga']) && empty($_POST['FUN_senha'])){
                unset($_POST['FUN_senha']);
            }else{
                Principal::Voltar();
            }

            unset($_POST['senha_antiga']);

            $_POST['FUN_nascimento']	 = $r->filtroData($_POST['FUN_nascimento']);
            $_POST['FUN_adimissao'] 	 = $r->filtroData($_POST['FUN_adimissao']);
            $_POST['FUN_permissao_area']     = json_encode($_POST['FUN_permissao_area']);

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
                    $linhas_afetadas = $r->_delete('FUN_id', $_GET['id']);

            // se hover um post remover, remove varios registros que foram selecionados na lista
            }else if(!isset($_GET['id']) && isset($_POST['remover'])){
                  foreach($_POST['checkRow'] as $valor){
                          $linhas_afetadas += $r->_delete('FUN_id',$valor);
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
            $r->_busca('FUN_id', $_GET['id']);
            $cliente = $r->_getReg();
            $cliente['FUN_nascimento'] = $r->filtroData($cliente['FUN_nascimento']);
            unset($cliente['FUN_senha']);
            $campos = json_encode($cliente);
            if($cliente['FUN_status'] == 1){
                    $jquery = '$(".usuario").slideDown().find(\'input\').removeAttr(\'disabled\');';
            }else{
                    $jquery = '$(".usuario").slideUp().find(\'input\').attr(\'disabled\',\'disabled\');';
            }
            break;		  
}
?>
<script>
    $(window).load(function(){
        var campos = <?=$campos?>;
		 
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
                <li><a href="">Funcionários</a>
                </li>
            </ul>
        </div>
        
        <div class="breadLinks">
            <ul>
                <li class="has">
                    <a title="">
                        <i class="icos-cog4"></i>
                        <span>Opções</span>
                        <span><img src="images/elements/control/hasddArrow.png" alt="" /></span>
                    </a>
                    <ul>
                        <li><a href="?cat=cadastros&pg=funcionarios&add=true" title=""><span class="icos-add"></span>Novo</a></li>
                        <li><a href="?cat=cadastros&pg=funcionarios&list=true" title=""><span class="icos-archive"></span>Lista</a></li>
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
                            $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['FUN_id'].'" />';
                            $colum[$i]['Nome'] = $reg[$i]['FUN_nome'];
                            $colum[$i]['CPF:'] = $reg[$i]['FUN_cpf'];
                            $colum[$i]['Endereço'] = $reg[$i]['FUN_rua'].", ".$reg[$i]['FUN_num'].".<br> ".$reg[$i]['FUN_bairro']." ".$reg[$i]['FUN_cidade']."/".$reg[$i]['FUN_uf']."<br> CEP: ".$reg[$i]['FUN_cep'].
                            $colum[$i]['Fone'] = $reg[$i]['FUN_tel1'];
                            $colum[$i]['Cel.'] = $reg[$i]['FUN_cel'];
                            $colum[$i]['E-mail'] = $reg[$i]['FUN_email'];
                            if($edit = true){
                              $colum[$i]['Opções'] = '
                                <ul class="btn-group toolbar">
                                        <li><a href="?cat=cadastros&pg=funcionarios&id='.$reg[$i]['FUN_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
                                        <li><a href="?cat=cadastros&pg=funcionarios&remove=true&id='.$reg[$i]['FUN_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
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
                                          <h6>Lista de Funcionários</h6>
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
	 }else{?>
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
				
				<?=$jquery?>
				
				$("[name=FUN_status]").change(function(){
					status = $(this).val();
					//se não for usuário
					if(status == 0){
						$(".usuario").slideUp().find('input').attr('disabled','disabled');
					// se for usuario
					}else{
						$(".usuario").slideDown().find('input').removeAttr('disabled');
					}
				})
				
				$(".categoria").change(function(){
					categoria = $(this).val();
					// se ja estiver checado
					if( $(this).attr('checked') == 'checked'){
						// então desmarcamos o input
						$("[name='FUN_permissao_area["+categoria+"][]']").attr('checked','checked').parent('span').addClass('checked')
					}else{
						// ou então marcamos o input
						$("[name='FUN_permissao_area["+categoria+"][]']").removeAttr('checked').parent('span').removeClass('checked')
					}
				})

				// validação do formulário
				$("#cadastro").validationEngine('attach', {
					onValidationComplete: function(form, status){
						alert("The form status is: " +status+", it will never submit");
					}
				});
			});
			
		</script>
        <div class="fluid">
            <form id="cadastro" class="formPessoa grid12" method="post"  action="?cat=cadastros&pg=funcionarios&add=true">
                <div class="widget">
                    <div class="whead"><h6>Cadastro - Novo Funcionário</h6><div class="clear"></div></div>
                        <?=$mensagem;?>
                        <!-- DADOS PESSOAIS !-->
                        <div  class="formRow">
                            <div class="grid3"><b>Informações pessoais:</b></div>
                            <div id="Endereco" class="grid9">
                                <div class="grid6">
                                    <span class="note">Nome</span>
                                    <input type="text" class="validate[required]" name="FUN_nome" id="nome"/>
                                    <input id="nomeTabela" type="hidden" value="funcionarios" />
                                    <?=(is_numeric($_GET['id']))?'<input type="hidden" name="FUN_id" value="'.$_GET['id'].'"/>':'';?>
                                    <img src="images/icons/usual/icon-admin.png" alt="" class="fieldIcon" style="top:30px;">
                                </div>
                                
                                <div class="clear"></div>   
                                <div class="grid2" style="margin-left:0px;">
                                    <span class="note">CPF:</span>
                                    <input type="text" name="FUN_cpf"  class="validate[required] maskCpf" />
                                </div>
                                <div class="grid2">
                                    <span class="note">RG:</span>
                                    <input type="text" name="FUN_rg"  class="validate[required]" />
                                </div>
                                <div class="grid2">
                                    <span class="note">Nascimento:</span>
                                    <input type="text" name="FUN_nascimento" class="validate[required] maskDate" />
                                </div>
                                <div class="grid2">
                                    <span class="note">Adimissão:</span>
                                    <input type="text" name="FUN_adimissao" class="validate[required] maskDate" />
                                </div>
                                <div class="grid2">
                                    <span class="note">CNH:</span>
                                    <input type="text" name="FUN_cnh" class="validate[required]" />
                                </div>
                                <div class="clear"></div>
                                <div class="grid6 searchDrop" style="margin-left:0px;">
                                <span class="note">Especificação de Cargo:</span>
                                     <select name="FUN_cargo" data-placeholder="Escolha um Cargo" class="select validate[required]"  tabindex="2" style="width:129px;">
                                     	<option value=""></option> 
                                     	<?
                                            $cargos = array(0=>'Técnico',1=>'Gestor',2=>'Consultor',3=>'Administrador');
                                            foreach($cargos as $key=>$cargo){
                                                if($key == $cliente['FUN_cargo']){
                                                        $select = 'selected="selected"';
                                                }else{
                                                        $select = '"';
                                                }
                                                echo '<option value="'.$key.'"  '.$select.'>'.$cargo.'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <!-- FIM DADOS PESSOAIS!-->
                        
                        <!-- Informações de Endereço !-->
                        <div  class="formRow">
                            <div class="grid3"><b>Informações para localização</b></div>
                            <div id="Endereco" class="grid9">
                                <div class="grid3">
                                    <span class="note">CEP</span>
                                    <input type="text" class="validate[required] maskCEP" name="FUN_cep" id="cep"/>
                                </div>
                                <div class="grid7">
                                    <span class="note">Cidade</span>
                                    <input type="text" class="validate[required]" name="FUN_cidade" id="cidade"/>
                                </div>
                                <div class="grid2">
                                    <span class="note">Uf</span>
                                    <input type="text" class="validate[required]" name="FUN_uf" id="uf"/>
                                </div>
                                
                                <div class="clear"></div>   
                                <div class="grid4" style="margin-left:0px;">
                                    <span class="note">Bairro</span>
                                    <input type="text" class="validate[required]" name="FUN_bairro" id="bairro"/>
                                </div>
                                <div class="grid6">
                                    <span class="note">Rua</span>
                                    <input type="text" class="validate[required]" name="FUN_rua" id="rua"/>
                                </div>
                                <div class="grid2">
                                    <span class="note">Nº</span>
                                    <input type="text" class="validate[required]" name="FUN_num" id="num"/>
                                </div>
                                <div class="grid4" style="margin-left:0px;">
                                    <span class="note">Email</span>
                                    <input type="text" class="validate[required,custom[email],ajax[existeEmail]]" name="FUN_email" id="email" />
                                </div>
                                <div class="grid2">
                                    <span class="note">Tel</span>
                                    <input type="text" name="FUN_tel1"  class="validate[required] grid4 maskPhone" />
                                </div>
                                <div class="grid2">
                                    <span class="note">Tel</span>
                                    <input type="text" name="FUN_tel2" class="grid4 maskPhone" />
                                </div>
                                <div class="grid2">
                                    <span class="note">Cel</span>
                                    <input type="text" name="FUN_cel" class="grid4 maskPhone" />
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <!-- Dados de Usuário !-->
                        <div  class="formRow">
                            <div class="grid3"><b>Dados de Usuário</b></div>
                            <div id="Usuario" class="grid9">
                                <div class="grid9">
                                    <span class="note grid3">É usuário?</span>
                                    <div class="radio" id="uniform-radio1">
                                    	<span><input type="radio" name="FUN_status" value="1" <?=($cliente['FUN_status'] == 1 )?'checked="checked"':'';?>></span></div>
                                    	<label for="radio1" class="mr20">Sim</label>
                                    <div class="radio" id="uniform-radio2">
                                        <span><input type="radio" name="FUN_status" value="0"  <?=($cliente['FUN_status'] == 0 || !isset($cliente))?'checked="checked"':'';?>></span></div>
                                        <label for="radio2" class="mr20">Nao</label>
                                </div>
                                <div class="clear"></div>
                                <?=!isset($_GET['id'])?'
                                                    <div class="grid5 usuario">
                                                            <span class="note">Senha</span>
                                                            <input type="password" class="validate[required]" id="senha" />
                                                    </div>
                                                    <div class="grid5 usuario">
                                                            <span class="note">Confirme a senha</span>
                                                            <input type="password" class="validate[required,equals[senha]]" name="FUN_senha" />
                                                    </div>
                                                    <div class="clear"></div>
               ':'
                                                    <div class="grid5 usuario">
                                                            <span class="note">Senha antiga</span>
                                                            <input type="password" name="senha_antiga" class="validate[required]"/>
                                                    </div>
                                                    <div class="grid5 usuario">
                                                            <span class="note">Nova senha</span>
                                                            <input type="password" class="validate[required,equals[senha]]"  id="senha" />
                                                    </div>
                                                    <div class="grid5 usuario">
                                                            <span class="note">Confirme a senha</span>
                                                            <input type="password" class="validate[required,equals[senha]]" name="FUN_senha" />
                                                    </div>
                                                    <div class="clear"></div>
                                               ';?>
                                <div class="grid12 usuario">
                                    <span class="note">Permissões</span>
                                    <div class="grid9 check">
                                        <input type="checkbox" class="categoria" value="cadastros" />
                                        <label class="mr20"><strong>Cadastros</strong></label>
                                        <div class="grid12 cadastros">
                                            <input type="checkbox" name="FUN_permissao_area[cadastros][]" value="funcionarios" />
                                            <label class="mr20">Funcionários</label>
                                        </div>
                                        <div class="grid12 cadastros">    
                                            <input type="checkbox" name="FUN_permissao_area[cadastros][]"  value="clientes"/>
                                            <label class="mr20">Clientes</label>
                                        </div>
                                    </div>
                                    <div class="clear"></div>

                                    <div class="grid9 check">
                                        <input type="checkbox"  class="categoria" value="relatorios" />
                                        <label class="mr20"><strong>Relatórios</strong></label>
                                        <div class="grid12 cadastros">
                                            <input type="checkbox" name="FUN_permissao_area[relatorios][]" value="funcionarios" />
                                            <label class="mr20">Funcionários</label>
                                        </div>
                                        <div class="grid12 cadastros">    
                                            <input type="checkbox" name="FUN_permissao_area[relatorios][]"  value="clientes"/>
                                            <label class="mr20">Clientes</label>
                                        </div>
                                    </div>
                                </div>
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
     <? }?>
    </div>

    