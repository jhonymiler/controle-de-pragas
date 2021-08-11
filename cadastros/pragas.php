                <?
					$r = new Registro('pragas');
					switch($_GET){
						
						// ADICIONA UM REGISTRO
						case $_GET['add'] == true && $_POST['pragas'] && empty($_POST['PRA_id']) :
							$_POST['SER_id'] = json_encode($_POST['SER_id']);
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
						case $_GET['add'] == true  && $_POST['pragas'] && is_numeric($_POST['PRA_id']) :
							$_POST['SER_id'] = json_encode($_POST['SER_id']);
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
								  $linhas_afetadas = $r->_delete('PRA_id', $_GET['id']);
								  
							  // se hover um post remover, remove varios registros que foram selecionados na lista
							  }else if(!isset($_GET['id']) && isset($_POST['remover'])){
								foreach($_POST['checkRow'] as $valor){
									$linhas_afetadas += $r->_delete('PRA_id',$valor);
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
						case is_numeric($_GET['id']) && ($_GET['tab'] == 'pragas_alvo'):
							 $r->_busca('PRA_id', $_GET['id']);
							 $cliente = $r->_getReg();
							 break;		  
					}
					?>
                    <form id="cadastro" class="formPessoa grid6" method="post" action="?cat=cadastros&pg=produtos&add=true&tab=pragas_alvo">
                        <div class="widget">
                            <div class="whead"><h6>Cadastro - Pragas Alvos</h6><div class="clear"></div></div>
                                <?=$mensagem;?>
                                <?=(is_numeric($_GET['id']))?'<input type="hidden" name="PRA_id" value="'.(int)$_GET['id'].'"/>':'';?>
                                <!--DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                                 <div  class="formRow">
                                        <div id="sigla" class="grid3"><label>Sigla:<span class="req">*</span></label></div>
                                        <div class="grid2"><input type="text" name="PRA_sigla" value="<?=$cliente['PRA_sigla']?>"  class="validate[required]" /></div><div class="clear"></div>
                                </div>
                                 <div  class="formRow">
                                        <div id="razao-social" class="grid3"><label>Nome:<span class="req">*</span></label></div>
                                        <div class="grid9"><input type="text" name="PRA_nome" value="<?=$cliente['PRA_nome']?>"  class="validate[required] grid4" /></div><div class="clear"></div>
                                </div>
                                <div class="formRow">
                                    <div class="grid3"><label>Serviços :</label></div>
                                    <div class="grid9">
                                        <select name="SER_id[]" multiple="multiple" class="multiple" title="Selecione multiplos serviços">
                                                <?
                                                    $s = new Registro('servicos');
                                                    $servicos = $s->_select();
                                                    if(is_array($servicos)){
                                                        foreach($servicos as $serv){
															if(isset($cliente['SER_id'])){	
																$serv_ids = json_decode($cliente['SER_id']);
																$ser_select = (in_array($serv['SER_id'],$serv_ids))?'selected="selected"':'';
															}else{$ser_select ='';}
                                                            echo '<option value="'.$serv['SER_id'].'" '.$ser_select.'>'.$serv['SER_nome'].'</option> ';
                                                        }
                                                    }
                                               ?>
                                        </select>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                        
                                <div class="formRow">
                                     <div class="clear"></div>
                                     <div class="divider"><span></span></div>
                                    
                                    <div class="floatR">
                                        <input type="submit" name="pragas" value="Submit" class="buttonM grid6 bGreen formSubmit">
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
						$s = new Registro('servicos');

                        for ($i = 0;$i < count($reg);$i++) {
                              $columPRA[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['PRA_id'].'" />';
                              $columPRA[$i]['Nome'] = $reg[$i]['PRA_nome'];
							  $SER_id_array = json_decode($reg[$i]['SER_id']);
							  
							  foreach($SER_id_array as $SER_id){
								 $SER_reg = $s->_select($SER_id);
								 $SER_nome[] = $SER_reg[$i]['SER_nome'];
							  }
                              $columPRA[$i]['Serviços'] = implode(', ',$SER_nome);
                              if($edit = true){
                                  $columPRA[$i]['Editar ou Excluir'] = '
                                        <ul class="btn-group toolbar">
                                            <li><a href="?cat=cadastros&pg=produtos&tab=pragas&id='.$reg[$i]['PRA_id'].'&tab=pragas_alvo" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
                                            <li><a href="?cat=cadastros&pg=produtos&tab=pragas&remove=true&id='.$reg[$i]['PRA_id'].'&tab=pragas_alvo" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
                                        </ul> 
                                  ';
                                       
                              }
                        }
                        if(count($reg)>0){
                            // constroi a tabela
                            $tab = new tabela($columPRA);
							// adiciona atributos
							$tab->addAttr();
                              echo '
                                  <div class="widget grid6 check">
                                    <div class="whead"> 
                                      <span class="titleIcon">
                                      <input type="checkbox" id="titleCheck" name="titleCheck" />
                                      </span>
                                      <h6>Lista de Pragas</h6>
                                      <div class="clear"></div>
                                    </div>
                                    <div class="dyn"> 
                                        <a class="tOptions" title="Options">
                                            <img src="images/icons/options.png" alt="" />
                                        </a>
                                        <form id="remover"  method="post" action="?cat=cadastros&pg=produtos&tab=pragas&remove=true&tab=pragas_alvo">
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
                    
