<?
                
    $r = new Registro('produtos');
    switch($_GET){

            // ADICIONA UM REGISTRO
            case $_GET['add'] == true && $_POST['produtos'] && empty($_POST['PRO_id']) :
                    $_POST['PRA_id'] = json_encode($_POST['PRA_id']);
                    $_POST['TRA_id'] = json_encode($_POST['TRA_id']);
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
            case $_GET['add'] == true  && $_POST['produtos'] && is_numeric($_POST['PRO_id']) :
                    $_POST['PRA_id'] = json_encode($_POST['PRA_id']);
                    $_POST['TRA_id'] = json_encode($_POST['TRA_id']);
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
                              $linhas_afetadas = $r->_delete('PRO_id', $_GET['id']);

                      // se hover um post remover, remove varios registros que foram selecionados na lista
                      }else if(!isset($_GET['id']) && isset($_POST['remover'])){
                            foreach($_POST['checkRow'] as $valor){
                                    $linhas_afetadas += $r->_delete('PRO_id',$valor);
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
            case is_numeric($_GET['id']) && ($_GET['tab'] == 'produtos'):
                     $r->_busca('PRO_id', $_GET['id']);
                     $cliente = $r->_getReg();
                     $cliente['PRO_unid_estoque_chzn'] = $cliente['PRO_unid_estoque'];
                     $cliente['PRO_unid_cliente_chzn'] = $cliente['PRO_unid_cliente'];
                     $campos = json_encode($cliente);
                     break;		  
    }
    
            $unidades = array(
                'GOTAS'=>'Gotas',
                'GR'=>'Gr',
                'KG'=>'Kg',
                'LT'=>'Lt',
                'ML'=>'Ml',
                'UN'=>'Un',
            );
            $PRO_unid_estoque = '';
            $PRO_unid_cliente = '';
            foreach ($unidades as $key => $value) {
                $select_estoque = ($key == $cliente['PRO_unid_estoque'])?'selected="selected"':'';
                $select_cliente = ($key == $cliente['PRO_unid_cliente'] )?'selected="selected"':'';
                
                $PRO_unid_estoque .= '<option value="'.$key.'" '.$select_estoque.'>'.$value.'</option>';
                $PRO_unid_cliente .= '<option value="'.$key.'" '.$select_cliente.'>'.$value.'</option>';
            }
    ?>
                    
                    <script>
                            $(window).load(function(){
                                var campos = <?=$campos?>;

                                 preencer(campos)
                                 $("#valorPrecoFinal").html( 'R$ <b>'+campos.PRO_preco_final+'</b>');
                                 PRO_conver_estoque = $("#PRO_conver_estoque").val()
                                 $("#valorEstoque").html(campos.PRO_conver_estoque+' '+campos.PRO_unid_estoque_chzn)
                                 $("#valorCliente").html(campos.PRO_conver_cliente*campos.PRO_conver_estoque+' '+campos.PRO_unid_cliente_chzn)
                            })
                    </script>

                    <form id="cadastro" class="formPessoa grid12" style="margin-left:0px;" method="post"  action="?cat=cadastros&pg=produtos&add=true&tab=produtos">
                           <div class="widget grid6">
                            <div class="whead"><h6>Informações do Produtos</h6><div class="clear"></div>
                                <?=$mensagem;?>
                            </div>    
                                <!--DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                                 <div  class="formRow">
                                       <?=(is_numeric($_GET['id']))?'<input type="hidden" name="PRO_id" value="'.$_GET['id'].'"/>':'';?>
                                        <div id="razao-social" class="grid3"><label>Nome:<span class="req">*</span></label></div>
                                        <div class="grid9"><input type="text" name="PRO_nome"  class="validate[required] grid4" /></div>
                                        <div class="clear"></div>
                                </div>
                                
                                 <div  class="formRow">
                                        <div id="cpf-cnpj" class="grid3"><label>Fabricante:<span class="req">*</span></label></div>
                                        <div class="grid9"><input type="text" name="PRO_fabricante"  class="validate[required] grid4" /></div><div class="clear"></div>
                                </div>
                                
                                 <div  class="formRow">
                                        <div id="cpf-cnpj" class="grid3"><label>Modelo:<span class="req">*</span></label></div>
                                        <div class="grid9"><input type="text" name="PRO_modelo"  class="validate[required] grid4" /></div><div class="clear"></div>
                                </div>
                                <div class="formRow">
                                    <div class="grid3"><label>Grupo:</label></div>
                                    <div class="grid9 searchDrop">
                                        <select data-placeholder="Escolha um Grupo..." name="GRU_id" class="select validate[required]"  style="width:350px;" tabindex="2">
                                            <option value=""></option> 
                                            <?
                                                $g = new Registro('grupo');
                                                $grupos = $g->_select();
                                                if(is_array($grupos)){
                                                    foreach($grupos as $grupo){
														if($cliente['GRU_id'] == $grupo['GRU_id']){
															$select = 'selected="selected"';
														}else{
															$select = "";
														}
                                                        echo '<option value="'.$grupo['GRU_id'].'" '.$select.'>'.$grupo['GRU_nome'].'</option> ';
                                                    }
                                                }
                                           ?>
                                        </select>
                                        
                                    </div>             
                                    <div class="clear"></div>
                                </div>
                                
                                <div class="formRow">
                                    <div class="grid3"><label>Descricao:<span class="req">*</span></label></div>
                                    <div class="grid9"><input type="text" class="validate[required]" name="PRO_descricao" id="descricao" /></div><div class="clear"></div>
                                </div>
                                
                                <div class="formRow">
                                    <div class="grid3"><label>Estoque Mínimo:<span class="req">*</span></label></div>
                                    <div class="grid9"><input type="text" name="PRO_estoqueminimo"  class="validate[required] grid4" /></div><div class="clear"></div>
                                </div>
                           </div>
                           <div class="widget grid6">
                              <div class="whead"><h6>Informações do Química</h6><div class="clear"></div></div>
                                <div class="formRow">
                                    <div class="grid3"><label>Parecer técnico:<span class="req">*</span></label></div>
                                    <div class="grid9"><textarea class="validate[required]" name="PRO_parecer_tecnico" id="PRO_parecer_tecnico"></textarea></div><div class="clear"></div>
                                </div>
                                
                                <div class="formRow">
                                    <div class="grid3"><label>Grupo químico:</label></div>
                                    <div class="grid9"><input type="text" class="validate[required]" name="PRO_grupo_quimico" id="PRO_grupo_quimico" /></div><div class="clear"></div>
                                </div>
                                <div class="formRow">
                                    <div class="grid3"><label>Princípio ativo:</label></div>
                                    <div class="grid9"><input type="text" class="validate[required]" name="PRO_princ_ativo" id="PRO_princ_ativo" /></div><div class="clear"></div>
                                </div>
                                <div class="formRow">
                                    <div class="grid3"><label>% Concentração:</label></div>
                                    <div class="grid9"><input type="text" class="validate[required] validNum" name="PRO_concentracao" id="PRO_concentracao" /></div><div class="clear"></div>
                                </div>
                                <div class="formRow">
                                    <div class="grid3"><label>Nº Registro:</label></div>
                                    <div class="grid9"><input type="text" class="validate[required]" name="PRO_num_registro" id="PRO_num_registro" /></div><div class="clear"></div>
                                </div>
                                <div class="formRow">
                                    <div class="grid3"><label>Antidoto:</label></div>
                                    <div class="grid9"><input type="text" class="validate[required]" name="PRO_antidoto" id="PRO_antidoto" /></div><div class="clear"></div>
                                </div>
                           </div>
                           <br class="clear">
                           <div class="divider"><span></span></div>
                           <div class="widget grid6" style="margin-left:0px;">
                              <div class="whead"><h6>Cálculos e medidas</h6><div class="clear"></div></div>
                                <!--Unidade de medidas -->
                                <div  class="formRow">
                                    <div class="grid12"><b>Unidade de medida</b></div>
                                    <div class="grid12">
                                        <div class="grid6 searchDrop">
                                            <span class="note">Estoque</span>
                                            <select name="PRO_unid_estoque" class="grid8 select validate[required]" id="PRO_unid_estoque">
                                                <?=$PRO_unid_estoque?>
                                            </select>
                                        </div>
                                        <div class="grid6 searchDrop">
                                            <span class="note">Cliente</span>
                                            <select name="PRO_unid_cliente"  class="grid8 select validate[required]" id="PRO_unid_cliente">
                                                <?=$PRO_unid_cliente?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                
                                <div class="formRow">
                                    <!-- Transformação de medida !-->
                                    <div class="grid12"><b>Controle de Estoque</b></div>
                                    <div class="grid12">
                                        <div class="grid6">
                                            <span class="note">Medida por Produto em   (<b id="medida_produto" style="font-weight:bold;font-size:16px;"><?=$cliente['PRO_unid_estoque'];?></b>)</span>
                                            <input id="PRO_medida_produto" type="text" name="PRO_medida_produto" class="validate[required] validNum" value="0" />
                                        </div>
                                        <div class="grid6">
                                            <span class="note">Minimo no Estoque</span>
                                            <input id="PRO_qtd_estoque" type="text" name="PRO_qtd_estoque" class="validate[required] validNum" value="0"/>
                                        </div>
                                        
                                     </div>
                                     <div class="clear"></div>
                                 </div>
                                
                                <div class="formRow">
                                    <!-- Transformação de medida !-->
                                    <div class="grid12"><b>Conversor de unidade de medida</b></div>
                                    <div class="grid12">
                                        <div class="grid2">
                                            <span class="note">Baixa</span>
                                            <input id="PRO_baixa" type="text" name="PRO_baixa" class="validate[required]" value="0" onkeyup="converteUnidadesProduto(this)" />
                                        </div>
                                         <span class="req" style="float:left;">x</span>
                                        <div class="grid2">
                                            <span class="note">Conv</span>
                                            <input id="PRO_conver_estoque" type="text" name="PRO_conver_estoque" class="validate[required]" onkeyup="converteUnidadesProduto(this)" value="0" />
                                        </div>
                                         <span class="req" style="float:left;">=</span>
                                        <div class="grid2">
                                            <span class="note">Estoque</span>
                                            <div id="valorEstoque">2,5 Kg</div>
                                        </div>
                                         <span class="req" style="float:left;">x</span>
                                        <div class="grid2">
                                            <span class="note">Conv</span>
                                            <input id="PRO_conver_cliente" type="text" name="PRO_conver_cliente" class="validate[required]" onkeyup="converteUnidadesProduto(this)" value="0" />
                                        </div>
                                         <span class="req" style="float:left;">=</span>
                                        <div class="grid2">
                                             <span class="note">Cliente</span>
                                             <div id="valorCliente">2,5 Kg</div>
                                        </div>
                                     </div>
                                     <div class="clear"></div>
                                 </div>
                                 <!-- Cálculo de preço !-->
                                 <div  class="formRow">
                                    <div class="grid4"><b>Cálculo de preço</b></div>
                                    <div id="" class="grid8">
                                        <div class="grid4">
                                            <span class="note">Custo</span>
                                            <input id="PRO_preco_custo" type="text" name="PRO_preco_custo" class="validate[required] preco validNum" value="0" />
                                        </div>
                                        <div class="grid4">
                                            <span class="note">% Lucro</span>
                                            <input id="PRO_porcent_lucro" type="text" name="PRO_porcent_lucro" class="validate[required] preco validNum"  value="0" />
                                        </div>
                                        <div class="grid4">
                                            <span class="note">Final</span>
                                            <input id="PRO_preco_final" type="hidden" name="PRO_preco_final" class="validate[required] validNum precoFinal"  value="0" />
                                            <div id="valorPrecoFinal">R$ 0,00</div>
                                        </div>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                           </div>
                           
                           <div class="widget grid6">
                              <div class="whead"><h6>Diluição Química</h6><div class="clear"></div></div>
                                 <!-- Cálculo de preço !-->
                                 <div  class="formRow">
                                    <div class="grid4"><b>Diluição Fispq</b></div>
                                    <div id="Endereco" class="grid8">
                                        <input id="PRO_diluicao_fispq" type="text" name="PRO_diluicao_fispq" class="validate[required]" value="" />
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                 <!-- Cálculo de preço !-->
                                 <div  class="formRow">
                                    <div class="grid4"><b>Qtd / Área</b></div>
                                    <div id="Endereco" class="grid8">
                                        <input id="PRO_qtd_area" type="text" name="PRO_qtd_area" class="validate[required]" value=""  />
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                 <div class="formRow">
                                    <div class="grid4"><label>Praga alvo :</label></div>
                                    <div class="grid8">
                                        <select name="PRA_id[]" multiple="multiple" class="multiple" title="Selecione multiplos serviços">
                                                <?
                                                    $s = new Registro('pragas');
                                                    $preagas = $s->_select();
                                                    if(is_array($preagas)){
                                                        foreach($preagas as $prag){
                                                            if(isset($cliente['PRO_id'])){	
                                                                    $pra_ids = json_decode($cliente['PRA_id']);
                                                                    $pra_select = in_array($prag['PRA_id'],$pra_ids)?'selected="selected"':'';
                                                            }else{$pra_select ='';}
                                                            echo '<option value="'.$prag['PRA_id'].'" '.$pra_select.'>'.$prag['PRA_sigla'].' - '.$prag['PRA_nome'].'</option> ';
                                                        }
                                                    }
                                               ?>
                                        </select>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                                 <div class="formRow">
                                    <div class="grid4"><label>Tratamentos :</label></div>
                                    <div class="grid8">
                                        <select name="TRA_id[]" multiple="multiple" class="multiple" title="Selecione multiplos serviços">
                                                <?
                                                    $s = new Registro('tratamentos');
                                                    $servicos = $s->_select();
                                                    if(is_array($servicos)){
                                                        foreach($servicos as $serv){
															if(isset($cliente['PRO_id'])){	
																$serv_ids = json_decode($cliente['TRA_id']);
																$ser_select = (in_array($serv['TRA_id'],$serv_ids))?'selected="selected"':'';
															}else{$ser_select ='';}
                                                            echo '<option value="'.$serv['TRA_id'].'" '.$ser_select.'>'.$serv['TRA_sigla'].' - '.$serv['TRA_nome'].'</option> ';
                                                        }
                                                    }
                                               ?>
                                        </select>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                           </div>
                           
                           <div class="widget grid12" style="margin-left:0px;">
                                <div class="formRow">
                                    <div class="clear"></div>
                                    <div class="divider"><span></span></div>
                                    <div class="floatR">
                                        <input type="submit" name="produtos"  value="Submit" class="buttonM grid6 bGreen formSubmit">
                                        <input type="button" class="buttonM grid6 bRed" value="Cancel">
                                        <div class="clear"></div>
                                    </div>
                                    <div class="clear"></div>
                            	</div>
                            	<div class="clear"></div>
                           </div>
                    </form>
				 <? 
				 
                        $prod = $r->_select();
					    $g = new Registro('grupo');
					    $grupos = $g->_select();
					   
                        for ($i = 0;$i < count($prod);$i++) {
                              $coluna_produtos[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$prod[$i]['PRO_id'].'" />';
                              $coluna_produtos[$i]['Nome'] = $prod[$i]['PRO_nome'];
							  
							  if(is_array($grupos)){  
								foreach($grupos as $grupo){
									if($prod[$i]['GRU_id'] == $grupo['GRU_id']){
										$GRU_nome = $grupo['GRU_nome'];
									}
								}
							  }                              
							  
							  $coluna_produtos[$i]['Grupo'] = $GRU_nome;
                              $coluna_produtos[$i]['Diluição Fispq'] = $prod[$i]['PRO_diluicao_fispq'];
                              $coluna_produtos[$i]['Qtd / Área'] = $prod[$i]['PRO_qtd_area'];
                              $coluna_produtos[$i]['Preço'] = $prod[$i]['PRO_preco_final'];
                              if($edit = true){
                                  $coluna_produtos[$i]['Editar ou Excluir'] = '
                                        <ul class="btn-group toolbar">
                                            <li><a href="?cat=cadastros&pg=produtos&tab=produtos&id='.$prod[$i]['PRO_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
                                            <li><a href="?cat=cadastros&pg=produtos&tab=produtos&remove=true&id='.$prod[$i]['PRO_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
                                        </ul> 
                                  ';
                                       
                              }
                        }
                        if(count($prod)>0){
                            // constroi a tabela
                            $tabProd = new tabela($coluna_produtos);
							// adiciona atributos
							$tabProd->addAttr();
                              echo '
                                  <div class="widget grid12 check" style="margin-left:0px;">
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
                                        <form id="remover"  method="post" action="?cat=cadastros&pg=produtos&remove=true">
                              ';
                             if(is_object($tabProd)){
                                 $tabProd->show();
                              }
                            echo '
                                            <input type="submit" name="remover"  value="Remover Selecionados" class="buttonM grid6 bRed formSubmit">
                                      </form>
                                    </div>
                                </div>
                            ';
            
                        }
                 ?>
                    
