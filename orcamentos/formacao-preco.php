<script type="text/javascript" src="./orcamentos/js/formacao-preco.js"></script>
<div class="widget grid8">
    <div class="whead">
        <h6>Formação de Preço</h6>
        <div class="clear"></div>
     </div>
    <!-- Formação de Preço !-->
    <div  class="formRow">
        <div class="grid12 ">
            <div class="grid6 searchDrop">
                <span class="note"><b>Nº Operadores</b></span>
                 <input type="text" name="orcamento[formacao_preco][FOR_num_operadores]" id="FOR_num_operadores" value="<?=$preco['FOR_num_operadores'];?>" />
                 <?
				 	if($preco['FOR_cobrar_hotel'] == 1){
						$hotelSelect ='checked="checked"';
					}
				 	if($preco['FOR_cobrar_hotel_num_dias'] == 1){
						$cobrarDiasSelect ='checked="checked"';
					}
				 ?>
                 <span class="note"><input type="checkbox" <?=$hotelSelect?> value="1" name="orcamento[formacao_preco][FOR_cobrar_hotel]" id="hotel" />&nbsp;<b>Cobrar Hotel</b></span>
                 <div id="cobra_hotel">
                        <b>Todas as visitas</b>
                        <input type="checkbox"  <?=$cobrarDiasSelect?> name="orcamento[formacao_preco][FOR_cobrar_hotel_num_dias]" id="todos_dias" />
                        <div class="clear"></div>
                     <span class="qtd_dias_hotel">
                        <b>Quantidade de dias</b>
                        <input type="text" value="<?=$preco['FOR_qtd_dias_hotel'];?>" name="orcamento[formacao_preco][FOR_qtd_dias_hotel]" id="qtd_dias_hotel"/>
                     </span>
                    
                 </div>
                 
                 <span class="note"><b>Distância</b></span>
                 <input type="text" name="orcamento[formacao_preco][FOR_distancia]" id="FOR_distancia" value="<?=$preco['FOR_distancia'];?>"  />
                 
                 <span class="note"><b>Visitas totais</b></span>
                 <input type="text" name="orcamento[formacao_preco][FOR_total_visitas]" id="FOR_total_visitas" value="<?=$preco['FOR_total_visitas'];?>"  />
                 
                 <span class="note"><b>Duração total em horas</b></span>
                 <input type="text" name="orcamento[formacao_preco][FOR_total_duracao]" id="FOR_total_duracao" value="<?=$preco['FOR_total_duracao'];?>"  />
                
             </div>
            <div class="grid6 searchDrop">
                
                 <span class="note"><b>Total Sugerido </b></span>
                 <input type="text" name="orcamento[formacao_preco][FOR_total_sugerido]" id="FOR_total_sugerido"  value="<?=$preco['FOR_total_sugerido'];?>"/>
                 
                 <div id="controle_desconto">
                     <div class="grid6">
                        <span class="note"><b>Desconto</b></span>
                        <input type="text" name="orcamento[formacao_preco][FOR_desconto]" id="FOR_desconto"  value="<?=$preco['FOR_desconto'];?>"/>
                        <div class="clear"></div>
                    </div>
                    <div class="grid6">
                        <span class="note"><b>R$ / % </b></span>
                      <select id="FOR_tipo_desconto" name="orcamento[formacao_preco][FOR_tipo_desconto]" class="select grid12 validate[required]" tabindex="2">
                             <option value="dinheiro" <?=($preco['FOR_tipo_desconto'] == "dinheiro")?"selected='selected'":"";?>>R$</option> 
                             <option value="porcentagem" <?=($preco['FOR_tipo_desconto'] == "porcentagem")?"selected='selected'":"";?>>%</option> 
                      </select>
                        <div class="clear"></div>
                    </div>
                     <div class="clear"></div>
                 </div>
                <div class="clear"></div>
                <span class="note"><b>Total Negociado </b></span>
                 <input type="text" name="orcamento[formacao_preco][FOR_total_negociado]" id="FOR_total_negociado"  value="<?=$preco['FOR_total_negociado'];?>"/>

           
                
                 <span class="note"><b>Tipo Pgto</b></span>
                 <select id="FOR_tipo_pgto" name="orcamento[formacao_preco][FOR_tipo_pgto]" data-placeholder="Escolha um Pgto" 
                  class="select grid12 validate[required]" tabindex="2">
                       <option value=""></option> 
                       <option value="À VISTA" <?=($preco['FOR_tipo_pgto'] == "À VISTA")?"selected='selected'":"";?>>À VISTA</option> 
                       <option value="FATURADO" <?=($preco['FOR_tipo_pgto'] == "FATURADO")?"selected='selected'":"";?>>FATURADO</option> 
                       <option value="PARCELADO" <?=($preco['FOR_tipo_pgto'] == "PARCELADO")?"selected='selected'":"";?>>PARCELADO</option> 
                       <option value="A COMBINAR" <?=($preco['FOR_tipo_pgto'] == "A COMBINAR")?"selected='selected'":"";?>>A COMBINAR</option> 
                       <option value="C APRESENTAÇÃO" <?=($preco['FOR_tipo_pgto'] == "C APRESENTAÇÃO")?"selected='selected'":"";?>>C APRESENTAÇÃO</option> 
                       
                </select>
                 <div id="pagamento" style="display:<?=($preco['FOR_tipo_pgto'] == "PARCELADO")?"block":"none"?>;">
                    <span class="note"><b>Nº Parcelas</b></span>
                    <input type="text" name="orcamento[formacao_preco][FOR_num_parcelas]" id="FOR_num_parcelas"  value="<?=$preco['FOR_num_parcelas'];?>"/>
                    <span class="note"><b>Valor da Parcela</b></span>
                    <input type="text" name="orcamento[formacao_preco][FOR_valor_parcela]" id="FOR_valor_parcela"  value="<?=$preco['FOR_valor_parcela'];?>"/>
                 </div>
                <!--     <span class="note"><b>Base p/ Comissão</b></span>
                 <input type="text" name="orcamento[formacao_preco][FOR_base_comeissao]" id="FOR_base_comeissao"  value="<?=$preco['FOR_base_comeissao'];?>"/>
                 <div id="comissao_parcela">
                     <span class="note"><b>Comissão por parcela</b></span>
                     <input type="text" name="orcamento[formacao_preco][FOR_comissao_parcela]" id="FOR_comissao_parcela"  value="<?=$preco['FOR_comissao_parcela'];?>"/>
                 </div>-->
                
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <!-- Cálculo de preço !-->
    <!-- Descrição dos ambientes internos !-->
     <div  class="formRow">
        <div id="" class="grid12">
            <div class="grid6">
                <div class="note" style="margin-bottom:5px;">
                    <b>Valor</b>
                     <div class="clear"></div>
                </div>
                <input type="text"  id="FOR_valor_adicional" class="validNum" />
            </div>
            <div class="grid6">
                <span class="note"><b>Descricao</b></span>
                <textarea  id="FOR_valor_adicional_descricao"></textarea>
            </div>
            <div class="clear"></div>
            <a href="#" class="tablectrl_large bGreen floatR addRecurso_tab2">
               <span class="iconb" data-icon="&#xe078;"> Add Valor</span>
            </a>
            <div class="">
              <?
                $reg = json_decode($preco['FOR_valores_adicionais']);
				if(!is_array($reg)){
					$reg[0] = new stdClass();
					$reg[0]->id = '';
					$reg[0]->descricao = '';
					$reg[0]->valor = 0;
				}
				for ($i = 0;$i < count($reg);$i++) {
								
							  $FOR_valores_adicionais += $reg[$i]->valor;
					
							  $colum[$i]['']= $reg[$i]->id;
							  $colum[$i]['Valor'] = $reg[$i]->valor;
							  $colum[$i]['Descrricao'] = $reg[$i]->descricao;
		
							  if($edit = true){
									$colum[$i]['Op'] = '
									  <textarea name="orcamento[formacao_preco][FOR_valores_adicionais][]"  style="display:none;">' . json_encode($reg[$i]) . '</textarea>
									  <ul class="btn-group toolbar">
										  <li><a href="#" onclick="return removeLinha(\'linha2_'.$i.'\')" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
									  </ul> 
									';
							  }
				}
				if(count($reg)>0){
					// constroi a tabela
					$tab = new tabela($colum,"linha2");
					$attr = array(
						'cellpadding' => 0,
						'cellspacing' => 0,
						'width'       => "100%",
						'class'       => "tDefault"
						);
					$tab->addAttr($attr);
					  echo '
									<div class="widget">
										<div class="whead"> 
										  <h6>Lista de valores adicionais</h6>
										  <div class="clear"></div>
										</div>
										<div  class="recursos_tab2"> 
					  ';
					 if(is_object($tab)){
						 $tab->show();
					  }
					echo '
										 </div>
									</div>
					';
				}
		
    
              ?>
               <div>
        	<span style="float:right;font-size:16px !important;" id="total_extras" class="green">Total <b><?=($FOR_valores_adicionais > 0)?$FOR_valores_adicionais:"0.00";?></b>
                    
                </span>
        	<div class="clear"></div> 
        </div>
        <div class="clear"></div> 
            </div>
        </div>
        <div class="clear"></div>
    </div> 
</div>

<!-- segunda parte !--> 
 <div class="widget grid4 demostrativo">
 	<div class="whead">
        <h6>Demonstrativo</h6>
        <div class="clear"></div>
     </div>
    <!-- Atividades complementáres !-->
     <div  class="formRow">
         <div class="grid6">
             <span><b>Material Direto</b></span>
         </div>
         <div class="grid6">
            <input type="text" class="total-form-preco" name="orcamento[formacao_preco][FOR_material_direto]" id="FOR_material_direto"  value="<?=isset($preco['FOR_material_direto'])?$preco['FOR_material_direto']:0?>" />
         </div>

        <div class="clear"></div>
    </div> 
    <div  class="formRow">
         <div class="grid6">
             <span><b>Mão de Obra</b></span>
         </div>
         <div class="grid6">
            <input type="text" class="total-form-preco" name="orcamento[formacao_preco][FOR_mao_obra]" id="FOR_mao_obra"  value="<?=isset($preco['FOR_mao_obra'])?$preco['FOR_mao_obra']:0?>" />
         </div>

        <div class="clear"></div>
    </div> 
    <div  class="formRow">
         <div class="grid6">
             <span><b>Deslocamento</b></span>
         </div>
         <div class="grid6">
            <input type="text" class="total-form-preco" name="orcamento[formacao_preco][FOR_deslocalmento]" id="FOR_deslocalmento"  value="<?=isset($preco['FOR_deslocalmento'])?$preco['FOR_deslocalmento']:0?>" />
         </div>

        <div class="clear"></div>
    </div> 
    <div  class="formRow">
         <div class="grid6">
             <span><b>Outras Despesas</b></span>
         </div>
         <div class="grid6">
            <input type="text" class="total-form-preco" name="orcamento[formacao_preco][FOR_outras_despesas]" id="FOR_outras_despesas" value="<?=isset($preco['FOR_outras_despesas'])?$preco['FOR_outras_despesas']:0?>" />
         </div>

        <div class="clear"></div>
    </div> 
    <div  class="formRow">
         <div class="grid6">
             <span><b>Administração</b></span>
         </div>
         <div class="grid6">
            <input type="text" class="total-form-preco" name="orcamento[formacao_preco][FOR_administracao_valor]" id="FOR_administracao_valor"  value="<?=isset($preco['FOR_administracao_valor'])?$preco['FOR_administracao_valor']:0?>" />
         </div>

        <div class="clear"></div>
    </div> 
    
    <div  class="formRow">
         <div class="grid6">
             <span><b>Total das Despesas</b></span>
         </div>
         <div class="grid6">
            <input type="text" name="orcamento[formacao_preco][FOR_total_despesas]" id="FOR_total_despesas"  value="<?=isset($preco['FOR_total_despesas'])?$preco['FOR_total_despesas']:0?>" />
         </div>

        <div class="clear"></div>
    </div> 
    <div  class="formRow">
         <div class="grid6">
             <span><b>Comissão</b></span>
         </div>
         <div class="grid6">
            <input type="text" name="orcamento[formacao_preco][FOR_comissao_valor]" id="FOR_comissao_valor"  value="<?=isset($preco['FOR_comissao_valor'])?$preco['FOR_comissao_valor']:0?>" />
         </div>

        <div class="clear"></div>
    </div> 
    <div  class="formRow">
         <div class="grid6">
             <span><b>Lucro</b></span>
         </div>
         <div class="grid6">
            <input type="text" name="orcamento[formacao_preco][FOR_lucro]" id="FOR_lucro" value="<?=isset($preco['FOR_lucro'])?$preco['FOR_lucro']:0?>" />
         </div>

        <div class="clear"></div>
    </div> 
   <!-- 
   <div  class="formRow">
         <div class="grid6">
             <span><b>Precentual de Lucro</b></span>
         </div>
         <div class="grid6">
            <input type="text" class="total-form-preco" name="orcamento[formacao_preco][FOR_lucro_percent]" id="FOR_lucro_percent" value="0" />
         </div>

        <div class="clear"></div>
    </div> 
    FIM Atividades complementáres !--> 

    
    <!-- FIM Descrição do meio urbano próximo !-->
</div>

<!-- segunda parte !--> 
<div class="widget grid4">
    <div class="total"  style="font-size: 300% !important;">
        <span style="margin-bottom: 10px;">Total</span>
        <span id="total" class="green">R$ <b><?=isset($preco['FOR_total'])? number_format($preco['FOR_total'],2,',',' '):'0,00'?></b>
        
        </span>
        <input type="hidden" name="orcamento[formacao_preco][FOR_total]" id="FOR_total"  value="<?=isset($preco['FOR_total'])?$preco['FOR_total']:0?>" />
    </div>
   <!-- Atividades complementáres !-->
    
</div>

