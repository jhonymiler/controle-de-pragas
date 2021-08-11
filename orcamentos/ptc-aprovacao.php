<div class="widget grid8">
    <div class="whead">
        <h6>PTC - e Aprovação</h6>
        <div class="clear"></div>
    </div>
    <!-- Formação de Preço !-->
    <div  class="formRow">
        <div class="grid12 ">
                <div class="grid6 searchDrop">
                    <span class="note"><b>Nº Dias de Validade</b></span>
                     <input type="text" name="orcamento[ORC_dias_validade]" id="dias" class="validNum" value="<?=$orcamento['ORC_dias_validade']?>" />
                     <span class="note"><b>Data: </b></span>
                     <input type="text" name="orcamento[ORC_data_criacao]" id="Data" value="<?=($orcamento['ORC_data_criacao'])?$orcamento['ORC_data_criacao']:date('d/m/Y')?>" />
                     <span class="note"><b>Dificuldade de Fechamento:</b></span>
                     <select id="dificuldade_fechamento" class="select grid12 validate[required]" name="orcamento[ORC_dificuldade_fechamento]" tabindex="2">
                        <?
							$dif = 0;
							while($dif < 5){
								if($dif == $orcamento['ORC_dificuldade_fechamento']){ $select = 'selected="selected"';}else{$select = '';}
								echo '<option value="'.$dif.'" '.$select.'>'.$dif.'</option> ';
								$dif++;
							}
						?>
                     </select>
              </div> 
                 
                 <div class="grid6 searchDrop">
                    <span class="note"><b>Status:</b></span>
                    <select id="Status" name="orcamento[ORC_status]" class="select grid12 validate[required]" tabindex="2" />
                    	<?
							$status = array(0=>'Aguardando',1=>'Orçamento',2=>'Aprovado',3=>'Reprovado');
							foreach($status as $k=>$v){
								if($k == $orcamento['ORC_status']){ $select = 'selected="selected"';}else{$select = '';}
								echo '<option value="'.$k.'" '.$select.'>'.$v.'</option> ';
							}
						?>
                   </select>
                    <span class="note"><b>Motivo:</b></span>
                    <select id="motivo" name="orcamento[ORC_motivo]" class="select grid12 validate[required]" tabindex="2">
                    	<?
							$motivo = array(
							"Agregado", 
							"ALTERAÇÃO CONTRATUAL", 
							"Apresentação", 
							"APROVOU OUTRO SERVIÇO", 
							"ATENDIMENTO", 
							"AUTO - APLICAÇÃO", 
							"Capacitação", 
							"CLIENTE", 
							"COBERTURA", 
							"CONCORRENTE", 
							"CONDIÇÃO ESPECIAL", 
							"CORTESIA", 
							"COTAÇÃO", 
							"DEMORA DO ORÇAMENTO",
							"DOCUMENTAÇÃO",
							"ENCERROU ATIVIDADES",
							"FALÊNCIA",
							"GARANTIA",
							"INADIMPLÊNCIA",
							"LICITAÇÃO",
							"MANTEVE EMPRESA",
							"MÉTODO",
							"MUDANÇA DE ENDEREÇO",
							"Preço",
							"PREGÃO",
							"PROMOÇÃO",
							"PROSPECÇÃO",
							"REFORMA",
							"RENOVAÇÃO",
							"SEM INTERESSE",
							"SEM PREVISÃO",
							"VERBA",
							"VISTORIA INADEQUADA");
							foreach($motivo as $k=>$v){
								if($k == $orcamento['ORC_motivo']){ $select = 'selected="selected"';}else{$select = '';}
								echo '<option value="'.$k.'" '.$select.'>'.$v.'</option> ';
							}
						?>
                   
                   </select>
                     
                     
    
                 </div>
                
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
    </div>
</div>
<!-- segunda parte !-->