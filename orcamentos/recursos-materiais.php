<?
  $r = new Registro('recursos_materiais');
  //$ultimo_id = $r->_select('WHERE REC_id ORDER BY DESC LIMIT 0,1');
?>
<div class="fluid">
	<div class="grid8">
        <div class="widget">
            <div class="whead">
                <h6>Recursos Materiais</h6>
                <div class="clear"></div>
             </div>
            <!-- Recursos Materiais !-->
            <div  class="formRow">
                <div class="grid3">
                   <span class="note"><b><b>Nº Aplicações</b></b></span>
                   <?=isset($recursos['REC_id']) ? '<input type="hidden" name="orcamento[recursos_materiais][REC_id]" value="'.$recursos['REC_id'].'" />' : $ultimo_id;?>
                   <input type="text" id="nAplic" class="validNum" value="0" />
               </div><div class="grid9">
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
                     $rec = new recursos_materiais;
                     $rec->_gera_Tabela_Recursos($recursos['REC_dados_recursos']);
                    ?>
                    <div class="clear"></div> 
                
            </div> 
            <!-- FIM Cálculo de preço !--> 
        
        </div>
        <div class="widget">
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
                                 if(strtoupper(substr($recursos['PRO_nome'], 0, 3)) == strtoupper(substr($produtos['PRO_nome'], 0, 3))){
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
                 $rec = new recursos_materiais;
                 $rec->_gera_Tabela_Recursos_produtos($recursos['REC_dados_recursos_produtos']);
               ?>
                
                <div class="clear"></div> 
            </div> 
            <!-- FIM Atividades complementáres !--> 
        </div>
    </div>
    <div class="grid4">
        <div class="widget">
         <div  class="formRow">
            <div id="" class="grid12">
                <div class="grid12">
                    <span class="note"><b>Descrição dos ambientes internos</b></span>
                    <textarea rows="5"  name="orcamento[recursos_materiais][REC_ambientes_internos]" id="REC_ambientes_internos"><?=($recursos['REC_ambientes_internos'])?></textarea>
                </div>
            </div>
            <div class="clear"></div>
        </div> 
        <!-- FIM Descrição dos ambientes internos !-->
        
        <!-- Condições específicas de edificação !-->
         <div  class="formRow">
            <div id="" class="grid12">
                <div class="grid12">
                    <span class="note"><b>Condições específicas de edificação</b></span>
                    <textarea rows="5" name="orcamento[recursos_materiais][REC_condicoes_especificas]" id="REC_condicoes_especificas"><?=$recursos['REC_condicoes_especificas']?></textarea>
                </div>
            </div>
            <div class="clear"></div>
        </div> 
        <!-- FIM Condições específicas de edificação !-->
        
        <!-- Descrição dos ambientes externos !-->
         <div  class="formRow">
            <div id="" class="grid12">
                <div class="grid12">
                    <span class="note"><b>Descrição dos ambientes externos</b></span>
                    <textarea rows="5"  name="orcamento[recursos_materiais][REC_ambientes_externos]" id="REC_ambientes_externos"><?=$recursos['REC_ambientes_externos']?></textarea>
                </div>
            </div>
            <div class="clear"></div>
        </div> 
        <!-- FIM Descrição dos ambientes externos !-->
        
        <!-- Descrição do meio urbano próximo!-->
         <div  class="formRow">
            <div id="" class="grid12">
                <div class="grid12">
                    <span class="note"><b>Descrição do meio urbano próximo</b></span>
                    <textarea  rows="5" name="orcamento[recursos_materiais][REC_descr_urbano]" id="PRO_parecer_tecnico"><?=$recursos['REC_descr_urbano']?></textarea>
                </div>
            </div>
            <div class="clear"></div>
        </div> 
        <!-- FIM Descrição do meio urbano próximo !-->
        </div>
	</div>


</div>