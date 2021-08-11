<div class="widget grid6">
    <div class="whead">
        <h6>Classificação dos Ambientes</h6>
        <div class="clear"></div>
     </div>
    <!--DADOS DO ORÇAMENTO!-->
    <div  class="formRow">
        <div class="grid12 ambientes">
            <div class="grid9 searchDrop">
                <span class="note"><b>Serviços</b></span>
                 <select  name="orcamento[vistoria][SER_id]" data-placeholder="Escolha um Serviço" 
                  class="servico grid12 validate[required]" tabindex="2">
                       <option value=""></option> 
                       <?
                        $SER = new Registro('servicos');
                        $select_ser = $SER->_select();
                         if(is_array($select_ser)){
                            foreach($select_ser as $servico){
                              if($vistoria['SER_id'] == $servico['SER_id']){
                                $select = 'selected="selected"';
                              }else{
                                $select = "";
                              }
                              echo '<option valor="'.$servico['SER_valor'].'" value="'.$servico['SER_id'].'" '.$select.'>'.$servico['SER_nome'].' - '.$servico["SER_descricao"].'</option> ';
                            }
                        }
                      ?>
                </select>
             </div>
             <div class="grid3 searchDrop">
<!--                <span class="note"><b><b>Tipo</b></b></span>
                <select name="orcamento[vistoria][VIS_tipo]" data-placeholder="Escolha um Tipo" 
                  class="select validate[required]" tabindex="2">
                   <option value=""></option> 
                   <option value="PRINCIPAL">PRINCIPAL</option> 
                </select>-->
            </div>
        </div>
        <div class="clear"></div>
    </div>

    <div  class="formRow">
        <div class="grid12 ">
            <div class="grid9 searchDrop">
                <span class="note"><b>Consultor 1</b></span>
                 <select name="orcamento[vistoria][VIS_consultor1_id]" data-placeholder="Escolha um Consultor" 
                  class="select grid12 validate[required]" tabindex="2">
                       <option value=""></option> 
                       <?
                        $SER = new Registro('funcionarios');
                        $select_FUN = $SER->_select('FUN_cargo',0);
                         if(is_array($select_FUN)){
                            foreach($select_FUN as $funcionarios){
                              if($vistoria['VIS_consultor1_id'] == $funcionarios['FUN_id']){
                                $select = 'selected="selected"';
                              }else{
                                $select = "";
                              }
                              echo '<option value="'.$funcionarios['FUN_id'].'" '.$select.'>'.$funcionarios['FUN_nome'].'</option> ';
                            }
                        }
                      ?>
                </select>
             </div>
             <!-- <div class="grid3 searchDrop">
             	<span class="note"><b>% Comissão 1</b></span>
                <input type="text" name="orcamento[vistoria][VIS_consultor1_comissao]"  value="<?=$edit['vistoria']['VIS_consultor1_comissao'];?>" class="validNum" />
            </div> -->
        </div>
        <div class="clear"></div>
    </div>


    <div  class="formRow">
        <div class="grid12 ">
            <div class="grid9 searchDrop">
                <span class="note"><b>Consultor 2</b></span>
                 <select name="orcamento[vistoria][VIS_consultor2_id]" data-placeholder="Escolha um Consultor" 
                  class="select grid12 validate[required]" tabindex="2">
                       <option value=""></option> 
                       <?
                        $SER = new Registro('funcionarios');
                        $select_FUN = $SER->_select('FUN_cargo',0);
                         if(is_array($select_FUN)){
                            foreach($select_FUN as $funcionarios){
                              if($vistoria['VIS_consultor2_id'] == $funcionarios['FUN_id']){
                                $select = 'selected="selected"';
                              }else{
                                $select = "";
                              }
                              echo '<option value="'.$funcionarios['FUN_id'].'" '.$select.'>'.$funcionarios['FUN_nome'].'</option> ';
                            }
                        }
                      ?>
                </select>
             </div>
             
            <!--  <div class="grid3 searchDrop">
                <span class="note"><b>% Comissão 2</b></span>
                <input type="text" class="alidate[required] validNum" name="orcamento[vistoria][VIS_consultor2_comissao]"  value="<?=$vistoria['VIS_consultor2_comissao'];?>" />
            </div> -->
        </div>
        <div class="clear"></div>
    </div>
    
    <div  class="formRow">
        <div class="grid12 ">
            <div class="grid9 searchDrop">
                <span class="note"><b>Gestor</b></span>
                 <select name="orcamento[vistoria][VIS_gestor_id]" data-placeholder="Escolha um Consultor" 
                  class="select grid12 validate[required]" tabindex="2">
                       <option value=""></option> 
                       <?
                        $SER = new Registro('funcionarios');
                        $select_FUN = $SER->_select('FUN_cargo',1);
                         if(is_array($select_FUN)){
                            foreach($select_FUN as $funcionarios){
                              if($vistoria['VIS_gestor_id'] == $funcionarios['FUN_id']){
                                $select = 'selected="selected"';
                              }else{
                                $select = "";
                              }
                              echo '<option value="'.$funcionarios['FUN_id'].'" '.$select.'>'.$funcionarios['FUN_nome'].'</option> ';
                            }
                        }
                      ?>
                </select>
             </div>
             <!-- <div class="grid3 searchDrop">
             	<span class="note"><b>% Comissão 1</b></span>
                <input type="text" name="orcamento[vistoria][VIS_consultor1_comissao]"  value="<?=$edit['vistoria']['VIS_consultor1_comissao'];?>" class="validNum" />
            </div> -->
        </div>
        <div class="clear"></div>
    </div>

    
    <!-- Cálculo de preço !-->
     <div  class="formRow">

        <div id="" class="grid6">
                <div class="grid12"><b>Terreno</b></div>
                <div class="grid12">
                <div class="grid6">
                    <span class="note"><b>Área</b></span>
                    <input  type="text" name="orcamento[vistoria][VIS_terreno_area]"  value="<?=$vistoria['VIS_terreno_area'];?>" class="validate[required] validNum"  />
                </div>
                <div class="grid6">
                    <span class="note"><b>Perímetro</b></span>
                    <input type="text" name="orcamento[vistoria][VIS_terreno_perimetro]"  value="<?=$vistoria['VIS_terreno_perimetro'];?>" class="validate[required] validNum" />
                </div>
            </div>
        </div>

        <div id="" class="grid6">
                <div class="grid12"><b>Área construida</b></div>
                <div class="grid12">
                <div class="grid6">
                    <span class="note"><b>Área</b></span>
                    <input type="text" name="orcamento[vistoria][VIS_construcao_area]"  value="<?=$vistoria['VIS_construcao_area'];?>" class="validate[required] validNum"  />
                </div>
                <div class="grid6">
                    <span class="note"><b>Perímetro</b></span>
                    <input  type="text" name="orcamento[vistoria][VIS_construcao_perimetro]"  value="<?=$vistoria['VIS_construcao_perimetro'];?>" class="validate[required] validNum"  />
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div> 
    <!-- FIM Cálculo de preço !--> 

</div>

<!-- segunda parte !--> 
 <div class="widget grid6">
    <!-- Atividades complementáres !-->
     <div  class="formRow">
        <div id="" class="grid12">
            <div class="grid12">
                <span class="note"><b>Atividades complementares</b></span>
                <textarea name="orcamento[vistoria][VIS_atividades_complementares]" id=""><?=$vistoria['VIS_atividades_complementares'];?></textarea>
            </div>
        </div>
        <div class="clear"></div>
    </div> 
    <!-- FIM Atividades complementáres !--> 

    <!-- Descrição dos ambientes internos !-->
     <div  class="formRow">
        <div id="" class="grid12">
            <div class="grid12">
                <span class="note"><b>Descrição dos ambientes internos</b></span>
                <textarea name="orcamento[vistoria][VIS_ambientes_internos]" id=""><?=$vistoria['VIS_ambientes_internos'];?></textarea>
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
                <textarea name="orcamento[vistoria][VIS_edificacoes]" id=""><?=$vistoria['VIS_edificacoes'];?></textarea>
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
                <textarea name="orcamento[vistoria][VIS_ambientes_externos]" id=""><?=$vistoria['VIS_ambientes_externos'];?></textarea>
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
                <textarea name="orcamento[vistoria][VIS_meio_urbano]" id=""><?=$vistoria['VIS_meio_urbano'];?></textarea>
            </div>
        </div>
        <div class="clear"></div>
    </div> 
    <!-- FIM Descrição do meio urbano próximo !-->
</div>


