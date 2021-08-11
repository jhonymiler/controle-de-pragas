                <?
					$r = new Registro('tratamentos');
					switch($_GET){
						
						// ADICIONA UM REGISTRO
						case $_GET['add'] == true && $_POST['tratamentos'] && empty($_POST['TRA_id']) :
					
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
						case $_GET['add'] == true && $_POST['tratamentos'] && is_numeric($_POST['TRA_id']) :
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
								  $linhas_afetadas = $r->_delete('TRA_id', $_GET['id']);
								  
							  // se hover um post remover, remove varios registros que foram selecionados na lista
							  }else if(!isset($_GET['id']) && isset($_POST['remover'])){
								foreach($_POST['checkRow'] as $valor){
									$linhas_afetadas += $r->_delete('TRA_id',$valor);
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
						case is_numeric($_GET['id']) && ($_GET['tab'] == 'tratamentos'):
							 $r->_busca('TRA_id', $_GET['id']);
							 $cliente = $r->_getReg();
							 break;		  
					}
					?>
                    <form id="cadastro-tratamentos" class="formPessoa grid6" method="post" action="?cat=cadastros&pg=produtos&add=true&tab=tratamentos">
                        <div class="widget">
                            <div class="whead"><h6>Cadastro - Tratamentos de Produtos</h6><div class="clear"></div></div>
                                <?=$mensagem;?>
                                <?=(is_numeric($_GET['id']))?'<input type="hidden" name="TRA_id" value="'.(int)$_GET['id'].'"/>':'';?>
                                <!--DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                                 <div  class="formRow">
                                        <div id="sigla" class="grid3"><label>Sigla:<span class="req">*</span></label></div>
                                        <div class="grid2"><input type="text" name="TRA_sigla" value="<?=$cliente['TRA_sigla']?>"  class="validate[required]" /></div><div class="clear"></div>
                                </div>
                                 <div  class="formRow">
                                        <div id="razao-social" class="grid3"><label>Nome:<span class="req">*</span></label></div>
                                        <div class="grid9"><input type="text" name="TRA_nome" value="<?=$cliente['TRA_nome']?>"  class="validate[required] grid4" /></div><div class="clear"></div>
                                </div>
                                
                                 <div  class="formRow">
                                        <div id="cpf-cnpj" class="grid3"><label>Descricao:<span class="req">*</span></label></div>
                                        <div class="grid9"><input type="text" name="TRA_descricao" value="<?=$cliente['TRA_descricao']?>"  class="validate[required] grid4" /></div><div class="clear"></div>
                                </div>
                                <div class="formRow">
                                     <div class="clear"></div>
                                     <div class="divider"><span></span></div>
                                    
                                    <div class="floatR">
                                        <input type="submit" name="tratamentos" value="Submit" class="buttonM grid6 bGreen formSubmit">
                                        <input type="button" class="buttonM grid6 bRed" value="Cancel">
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                          </div>
                                <div class="clear"></div>
                        </div>
                    </form>
				 <? 
                        $reg = $r->_select();
                        for ($i = 0;$i < count($reg);$i++) {
                              $columTRA[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['TRA_id'].'" />';
                              $columTRA[$i]['Nome'] = $reg[$i]['TRA_nome'];
                              $columTRA[$i]['Descricao'] = $reg[$i]['TRA_descricao'];
                              if($edit = true){
                                  $columTRA[$i]['Editar ou Excluir'] = '
                                        <ul class="btn-group toolbar">
                                            <li><a href="?cat=cadastros&pg=produtos&tab=tratamentos&id='.$reg[$i]['TRA_id'].'&tab=tratamentos" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
                                            <li><a href="?cat=cadastros&pg=produtos&tab=tratamentos&remove=true&id='.$reg[$i]['TRA_id'].'&tab=tratamentos" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
                                        </ul> 
                                  ';
                                       
                              }
                        }
                        if(count($reg)>0){
                            // constroi a tabela
                            $tab = new tabela($columTRA);
							// adiciona atributos
							$tab->addAttr();
                              echo '
                                  <div class="widget grid6 check">
                                    <div class="whead"> 
                                      <span class="titleIcon">
                                      <input type="checkbox" id="titleCheck" name="titleCheck" />
                                      </span>
                                      <h6>Lista de Tratamentos Específicos</h6>
                                      <div class="clear"></div>
                                    </div>
                                    <div class="dyn"> 
                                        <a class="tOptions" title="Options">
                                            <img src="images/icons/options.png" alt="" />
                                        </a>
                                        <form id="remover"  method="post" action="?cat=cadastros&pg=produtos&tab=tratamentos&remove=true&tab=tratamentos">
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
                 ?>
                    
