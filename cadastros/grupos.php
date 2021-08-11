                <?
					$r = new Registro('grupo');
					switch($_GET){
						
						// ADICIONA UM REGISTRO
						case $_GET['add'] == true && $_POST['grupos'] && empty($_POST['GRU_id']) :
					
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
						case $_GET['add'] == true && $_POST['grupos'] && is_numeric($_POST['GRU_id']) :
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
								  $linhas_afetadas = $r->_delete('GRU_id', $_GET['id']);
								  
							  // se hover um post remover, remove varios registros que foram selecionados na lista
							  }else if(!isset($_GET['id']) && isset($_POST['remover'])){
								foreach($_POST['checkRow'] as $valor){
									$linhas_afetadas += $r->_delete('GRU_id',$valor);
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
						case is_numeric($_GET['id']) && ($_GET['tab'] == 'grupos'):
							 $r->_busca('GRU_id', $_GET['id']);
							 $cliente = $r->_getReg();
							 break;		  
					}
					?>
                    <form id="cadastro" class="formPessoa grid6" method="post" action="?cat=cadastros&pg=produtos&add=true&tab=grupos">
                        <div class="widget">
                            <div class="whead"><h6>Cadastro - Grupo de Produtos</h6><div class="clear"></div></div>
                                <?=$mensagem;?>
                                <?=(is_numeric($_GET['id']))?'<input type="hidden" name="GRU_id" value="'.(int)$_GET['id'].'"/>':'';?>
                                <!--DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                                 <div  class="formRow">
                                        <div id="razao-social" class="grid3"><label>Nome:<span class="req">*</span></label></div>
                                        <div class="grid9"><input type="text" name="GRU_nome" value="<?=$cliente['GRU_nome']?>"  class="validate[required] grid4" /></div><div class="clear"></div>
                                </div>
                                
                                 <div  class="formRow">
                                        <div id="cpf-cnpj" class="grid3"><label>Descricao:<span class="req">*</span></label></div>
                                        <div class="grid9"><input type="text" name="GRU_descricao" value="<?=$cliente['GRU_descricao']?>"  class="validate[required] grid4" /></div><div class="clear"></div>
                                </div>
                                
                                <div class="formRow">
                                     <div class="clear"></div>
                                     <div class="divider"><span></span></div>
                                    
                                    <div class="floatR">
                                        <input type="submit" name="grupos"  value="Submit" class="buttonM grid6 bGreen formSubmit">
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
                              $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['GRU_id'].'" />';
                              $colum[$i]['Nome'] = $reg[$i]['GRU_nome'];
                              $colum[$i]['Descricao'] = $reg[$i]['GRU_descricao'];
                              if($edit = true){
                                  $colum[$i]['Editar ou Excluir'] = '
                                        <ul class="btn-group toolbar">
                                            <li><a href="?cat=cadastros&pg=produtos&tab=grupos&id='.$reg[$i]['GRU_id'].'&tab=grupos" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
                                            <li><a href="?cat=cadastros&pg=produtos&tab=grupos&remove=true&id='.$reg[$i]['GRU_id'].'&tab=grupos" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
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
                                  <div class="widget grid6 check">
                                    <div class="whead"> 
                                      <span class="titleIcon">
                                      <input type="checkbox" id="titleCheck" name="titleCheck" />
                                      </span>
                                      <h6>Lista de Grupos de Produtos</h6>
                                      <div class="clear"></div>
                                    </div>
                                    <div class="dyn"> 
                                        <a class="tOptions" title="Options">
                                            <img src="images/icons/options.png" alt="" />
                                        </a>
                                        <form id="remover"  method="post" action="?cat=cadastros&pg=produtos&tab=grupos&remove=true&tab=grupos">
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
                    
