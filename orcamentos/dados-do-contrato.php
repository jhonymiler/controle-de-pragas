
<script>
    $(function(){
        $("#termino").blur(function(){
            inicio = $("#inicio").val();
            i = inicio.split('/');
            //new Date(year, month, day, hours, minutes, seconds, milliseconds)
            ini = new Date(i[2], i[1], i[0]);
            // termino
            termino = $("#termino").val();
            t = termino.split('/');
            //new Date(year, month, day, hours, minutes, seconds, milliseconds)
            ter = new Date(t[2], t[1], t[0]);
            // retorna a diferença entre as datas de inicio e termino
            var diferenca = (ter.getFullYear()*12 + ter.getMonth()) - (ini.getFullYear()*12 + ini.getMonth());
            $("#duracao").val(diferenca);
        })
    })
</script>
<div class="widget grid12">
    <div class="whead">
        <h6>Dados do contrato</h6>
        <div class="clear"></div>
     </div>

    
    <!-- Datas e Duração !-->
     <div  class="formRow">
        <div id="" class="grid6">
                <div class="grid6">
                <div class="grid4">
                    <span class="note"><b>Nºcontrato</b></span>
                    23423523
                </div>
                <div class="grid4">
                    <span class="note"><b>Início</b></span>
                    <input  type="text" id="inicio" name="orcamento[contrato][CON_inicio]" class="validate[required] maskDate"  value="<?=isset($contrato['CON_inicio']) ? $contrato['CON_inicio'] : date('d/m/Y');?>" />
                </div>
                <div class="grid4">
                    <span class="note"><b>Término</b></span>
                    <input  type="text" id="termino" name="orcamento[contrato][CON_termino]" class="validate[required] maskDate" value="<?=$contrato['CON_termino']?>" />
                </div>
            </div>
                <div class="grid6">
                <div class="grid4">&nbsp;</div>
                <div class="grid4">
                    <span class="note"><b>Duração</b></span>
                    <input  type="text" id="duracao" name="orcamento[contrato][CON_duracao]" class="validate[required] validNum"  value="<?=$contrato['CON_duracao']?>" />
                </div>
                <div class="grid4">
                    <span class="note"><b>Prorrogação</b></span>
                    <input  type="text" name="orcamento[contrato][CON_prorrogacao]" class="validate[required] maskDate"  value="<?=$contrato['CON_prorrogacao']?>" />
                </div>
            </div>
        </div>
        
    <!-- FIM Datas e Duração !--> 

    <!-- Dados do monitoramento !-->
        <div class="grid3">
            <div class="searchDrop">
                <span class="note"><b>monitoramento</b></span>
                 <select id="CON_monitoramento" name="orcamento[contrato][CON_monitoramento]" data-placeholder="Frequência" 
                  class="select grid12 validate[required] frequencia" tabindex="2">
                     <option value=""></option> 
                        <option value="7" <?=($contrato['CON_monitoramento'] == 7) ? 'selected="selected"':'' ;?>>Semanal</option> 
                       <option value="15" <?=($contrato['CON_monitoramento'] == 15) ? 'selected="selected"':'' ;?>>Quinzenal</option> 
                       <option value="30" <?=($contrato['CON_monitoramento'] == 30) ? 'selected="selected"':'' ;?>>Mensal</option> 
                       <option value="90" <?=($contrato['CON_monitoramento'] == 90) ? 'selected="selected"':'' ;?>>Trimestral</option> 
                       <option value="180" <?=($contrato['CON_monitoramento'] == 180) ? 'selected="selected"':'' ;?>>Semestral</option> 
                       <option value="365" <?=($contrato['CON_monitoramento'] == 365) ? 'selected="selected"':'' ;?>>Anual</option> 
                </select>
             </div>
             <div>
                <span class="note"><b>Duração da visita</b></span>
                <input id="CON_duracao_visita" type="text" style="width:80%" class="validate[required] hora duracao_visita" name="orcamento[contrato][CON_duracao_visita]" value="<?=$contrato['CON_duracao_visita']?>" />
             </div>                                     
         </div>
        <div class="grid3">
            <div class="grid12 searchDrop">
                <span class="note"><b>Descrição</b></span>
                 <textarea class="validate[required]" name="orcamento[contrato][CON_duracao_visita_obs]" rows="5"><?=$contrato['CON_duracao_visita_obs']?></textarea>
             </div>
         </div>
         <div class="clear"></div>
    </div>
    <!-- FIM Dados do monitoramento  !-->

    <!-- Tratamento Químico !-->
    <div  class="formRow">
        <div class="grid3">
            <div class="searchDrop">
                <span class="note"><b>Tratamento Químico</b></span>
                
                 <select id="CON_tratamento_quimico" name="orcamento[contrato][CON_tratamento_quimico]" data-placeholder="Frequência" 
                  class="select grid12 validate[required] frequencia" tabindex="2">
                       <option value=""></option> 
                       <option value="7" <?=($contrato['CON_tratamento_quimico'] == 7) ? 'selected="selected"':'' ;?>>Semanal</option> 
                       <option value="15" <?=($contrato['CON_tratamento_quimico'] == 15) ? 'selected="selected"':'' ;?>>Quinzenal</option> 
                       <option value="30" <?=($contrato['CON_tratamento_quimico'] == 30) ? 'selected="selected"':'' ;?>>Mensal</option> 
                       <option value="90" <?=($contrato['CON_tratamento_quimico'] == 90) ? 'selected="selected"':'' ;?>>Trimestral</option> 
                       <option value="180" <?=($contrato['CON_tratamento_quimico'] == 180) ? 'selected="selected"':'' ;?>>Semestral</option> 
                       <option value="365" <?=($contrato['CON_tratamento_quimico'] == 365) ? 'selected="selected"':'' ;?>>Anual</option> 
                </select>
             </div>
             <div>
                <span class="note"><b>Duração da visita</b></span>
                <input id="CON_tratamento_quimico_duracao" type="text" style="width:80%" placeholder="00:00" class="validate[required] hora duracao_visita" name="orcamento[contrato][CON_tratamento_quimico_duracao]" value="<?=$contrato['CON_tratamento_quimico_duracao']?>" />
             </div>                                     
             <div class="clear"></div>
         </div>
        <div class="grid3">
            <div class="grid12 searchDrop">
                <span class="note"><b>Descrição</b></span>
                 <textarea class="validate[required]" name="orcamento[contrato][CON_tratamento_quimico_obs]" rows="5"><?=$contrato['CON_tratamento_quimico_obs']?></textarea>
             </div>
         </div>
         
    <!-- FIM Tratamento Químico !-->
    
    <!-- Visita do Gestor !-->
        <div class="grid3">
            <div class="searchDrop">
                <span class="note"><b>Visita do Gestor</b></span>
                 <select id="CON_visita_gestor" name="orcamento[contrato][CON_visita_gestor]" data-placeholder="Frequência" 
                  class="select grid12 validate[required] frequencia" tabindex="2">
                       <option value=""></option> 
                       <option value="7" <?=($contrato['CON_visita_gestor'] == 7) ? 'selected="selected"':'' ;?>>Semanal</option> 
                       <option value="15" <?=($contrato['CON_visita_gestor'] == 15) ? 'selected="selected"':'' ;?>>Quinzenal</option> 
                       <option value="30" <?=($contrato['CON_visita_gestor'] == 30) ? 'selected="selected"':'' ;?>>Mensal</option> 
                       <option value="90" <?=($contrato['CON_visita_gestor'] == 90) ? 'selected="selected"':'' ;?>>Trimestral</option> 
                       <option value="180" <?=($contrato['CON_visita_gestor'] == 180) ? 'selected="selected"':'' ;?>>Semestral</option> 
                       <option value="365" <?=($contrato['CON_visita_gestor'] == 365) ? 'selected="selected"':'' ;?>>Anual</option>  
                </select>
             </div>
             <div>
                <span class="note"><b>Duração da visita</b></span>
                <input id="CON_visita_gestor_duracao" type="text" style="width:80%" placeholder="00:00" name="orcamento[contrato][CON_visita_gestor_duracao]" class="validate[required] hora duracao_visita" value="<?=$contrato['CON_visita_gestor_duracao']?>" />
             </div>                                     
             <div class="clear"></div>
         </div>
        <div class="grid3">
            <div class="grid12 searchDrop">
                <span class="note"><b>Descrição</b></span>
                 <textarea class="validate[required]" name="orcamento[contrato][CON_visita_gestor_obs]" rows="5"><?=$contrato['CON_visita_gestor_obs']?></textarea>
             </div>
         </div>
         <div class="clear"></div>
    </div>
    <!-- FIM Visita do Gestor !-->

    <!-- Visitas Extras !-->
     <div  class="formRow">

        <div id="" class="grid6">
                <div class="grid12"><b>Visitas Extras</b></div>
                <div class="grid12">
                <div class="grid6">
                    <span class="note"><b>Qtd</b></span>
                    <input id="CON_visitas_extras_qtd" type="text" name="orcamento[contrato][CON_visitas_extras_qtd]" class="validate[required] validNum duracao_visita" value="<?=$contrato['CON_visitas_extras_qtd']?>"  />
                </div>
                <div class="grid6">
                    <span class="note"><b>Horas</b></span>
                    <input id="CON_visitas_extras_horas"  type="text" name="orcamento[contrato][CON_visitas_extras_horas]" class="validate[required] hora duracao_visita" value="<?=$contrato['CON_visitas_extras_horas']?>" placeholder="00:00" />
                </div>
            </div>
        </div>

        <div id="" class="grid6">
                <div class="grid12"><b>Observações</b></div>
                <div class="grid12">

                <div class="grid12 searchDrop">
                <span class="note"><b>Descrição</b></span>
                 <textarea class="validate[required]" name="orcamento[contrato][CON_visitas_extras_obs]" rows="5"><?=$contrato['CON_visitas_extras_obs']?></textarea>
             </div>
            </div>
        </div>
        <div class="clear"></div>
    </div> 
    <!-- FIM Visitas Extras !-->

</div>
