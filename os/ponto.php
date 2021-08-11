<?
if(count($_POST['ORD_pontos']) > 0){
    $pontos['ORD_id'] = $_GET['ord_id'];
    $pontos['ORD_pontos'] = '['.implode(',',$_POST['ORD_pontos']).']';
    
    $ord = new ordemServico;
    if($ord->grava($pontos)){
        if($_POST['subistitui'] == 1){
            $ord->db->_query(" UPDATE ordem_servico SET ORD_pontos='".$pontos['ORD_pontos']."' WHERE (ORD_id ='".$primeiraOs."' or id_pai='".$primeiraOs."') and ORD_data_visita >= '".$ord->db->filtroData($os['ORD_data_visita'])."'");
        }

        $mensagem = getMsg('Adicionado com Sucesso','sucesso');
    }
    $ord->listar();
    $os = $ord->getOs($_GET['ord_id']);
}

class ponto{
    public $id                  = '';
    public $num                 = '';
    public $local               = '';
    public $dispositivo         = '';
    public $tipo_dispositivo    = '';
    public $status = 0;
    
    
    public function get($campo){
        return $this->$campo;
    }
    
    public function set($campo,$valor){
        return $this->$campo = $valor;
    }

}

function gera_tabela_pontos($reg = false) {
    
        if($reg == false){
            $r = false;
            $reg = array(new ponto());
        }else{
            $r = true;
            $reg = json_decode($reg);
        }
    
        for ($i = 0; $i < count($reg); $i++) {

            $recursos = ($reg[$i]);

            $colum[$i]['Nº'] = $recursos->num;
            $colum[$i]['Local'] = $recursos->local;
            $colum[$i]['Dispositivo'] = $recursos->dispositivo;
            $colum[$i]['Tipo Dispositivo'] = $recursos->tipo_dispositivo;
            $colum[$i]['Status'] = ($recursos->status == 0)?'Inativo':'Ativo';
            
            $colum[$i]['Op'] = '';
            $colum[$i]['Op'] .= ($r == false)?'':'<textarea name="ORD_pontos[]" style="display:none;">' . json_encode($recursos) . '</textarea>';
            $colum[$i]['Op'] .= '
                <ul class="btn-group toolbar">
                        <li><a href="#" onclick="return excluirLinha(\'linha5_' . $i . '\')" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
                        <li>
                            <a href="#" title="Editar" onclick="return editarLinha(\'linha5_' . $i . '\')" class="tablectrl_small bDefault">
                                <span class="iconb" data-icon=""></span>
                            </a>
                        </li>
                </ul>
          ';

        }

        
        if (count($colum) > 0) {
            // constroi a tabela
            $tab = new tabela($colum,'linha5');
            $attr = array(
                'cellpadding' => 0,
                'cellspacing' => 0,
                'width'       => "100%",
                'class'       => "tDefault",
            );
            $tab->addAttr($attr);
            echo '
                <div class="widget">
                  <div class="whead">
                    <h6>Lista</h6>
                    <div class="clear"></div>
                  </div>
                  <div  class="recursos_tab5">
                ';
                    if (is_object($tab)) {
                        $tab->show();
                    }
            echo '
                        </div>
                </div>
                <div>
                    <div class="clear"></div> 
                </div>
              ';
        }
        
    }

?>
<script>
	
	$(document).ready(function() {
            if($("#linha5_0 td textarea").length == 0){
                $("#linha5_0").remove();
            }
            $("#pontos").submit(function(){
                r = confirm("Deseja que as proximas visitas sejam redefinidas com as listas de DETALHES DO TRATAMENTO, DEFENSIVOS E ACESSÓRIOS desta OS? !");
                if (r == true){
                  $("#subistitui").val('1')
                }
            });
            var i_list = $('.linha').length;
            $(".addRecurso_tab5").click(function(){
                
                if($("#PON_id").val() == ''){
                    time = new Date();
                    id =  "<?=$_GET['ord_id']?>-"+time.getTime();
                }else{
                    id =  $("#PON_id").val();
                }
                rec = {
                    id: id,
                    tipo_dispositivo: $("#PON_tipo_dispositivo").val(),
                    num : $("#PON_num").val(),
                    descricao : $("#PON_descricao").val(),
                    local : $("#PON_local").val(),
                    dispositivo : $("#PON_dispositivo").val(),
                    status : $('[name="PON_status"]').val()
                };

                if($('#PON_status_inativo').is(":checked")){
                    rec.status = $('#PON_status_inativo').val()
                    status = 'Inativo';
                }

                 if($('#PON_status_ativo').is(":checked")){
                    rec.status = $('#PON_status_ativo').val()
                    status = 'Ativo';
                }
                json = JSON.stringify(rec);
                
                linha = '<tr id="linha5_'+i_list+'" class="linha odd">'+
                        '<td class="sorting_1 noBorderB">'+rec.num+'</td>'+
                        '<td class="noBorderB">'+rec.local+'</td>'+
                        '<td class="noBorderB">'+rec.dispositivo+'</td>'+
                        '<td class="noBorderB">'+rec.tipo_dispositivo+'</td>'+
                        '<td class="noBorderB">'+status+'</td>'+
                        '<td class="noBorderB">'+
                            '<textarea name="ORD_pontos[]" style="display:none;">'+json+'</textarea>'+
                            '<ul class="btn-group toolbar">'+
                                '<li><a href="#"  onclick="return excluirLinha(\'linha5_'+i_list+'\')" class="tablectrl_small bDefault"><span class="iconb" data-icon=""></span></a></li>'+
                                '<li>'+
                                    '<a href="#" title="Editar" onclick="return editarLinha(\'linha5_'+i_list+'\')" class="tablectrl_small bDefault">'+
                                        '<span class="iconb" data-icon=""></span>'+
                                    '</a>'+
                                '</li>'+
                            '</ul>'+ 
                        '</td>'+
                '</tr>';

                $(".recursos_tab5 tbody").append(linha);
                $('#PON_id,#PON_num,#PON_local,#PON_descricao,#PON_dispositivo').val("");
                i_list++;
                return false
            })
           
	})
        
        function excluirLinha(linha){
            $("#"+linha).remove();
            return false;
        }
        
        function editarLinha(linha){
            
            jsonString = $("#"+linha).find('td textarea').val()
            json = JSON.parse(jsonString);
            excluirLinha(linha);
            $("#PON_id").val(json.id)
            
            $("#PON_tipo_dispositivo").find('option').each(function(e){
                if($(this).val() == json.tipo_dispositivo){
                    $(this).attr('selected',true);
                }
            })
            $("#PON_tipo_dispositivo").chosen().trigger("liszt:updated");
            $("#PON_num").val(json.num)
            $("#PON_descricao").val(json.descricao)
            $("#PON_local").val(json.local)
            $("#PON_dispositivo").val(json.dispositivo)
            
            $('[name="PON_status"]').each(function(e){
                if($(this).val() == json.status){
                    $(this).attr("checked",true).parent('span').addClass('checked');
                }else{
                    $(this).attr("checked",false).parent('span').removeClass('checked');
                }
            })
            
            return false
        }
        
  
</script>
<?=$mensagem;?>
<form id="pontos" class=" grid12" method="post">
    <div class="fluid">
        <!--Abas de cadastros-->
        <div class="widget ">
            <div class="whead">
                <h6>Controle de Pontos de Monitoramento</h6>
                <div class="clear"></div>
            </div>
             <div class="formRow">
                <div class="grid3"><label>Tipo do Dispositivo :</label></div>
                <div class="grid9 noSearch">
                <select id="PON_tipo_dispositivo" class="select" placeholder='Selecione um tipo'>
                    <option value="ppe">PPE</option>
                    <option value="ppi">PPI</option>
                    <option value="luminosa">LUMINOSA</option>
                    <option value="biologica">BIOLÓGICA</option>
                    <option value="outros">OUTROS</option>
                </select>
                </div>
                <div class="clear"></div>
                <input type="hidden" id="subistitui" name="subistitui" value="0"/>
            </div>
            <div class="formRow">
                <div class="grid3"><label>Ordem num.:</label></div>
                <div class="grid4"><input type="text" id="PON_num" /><input type="hidden" id="PON_id" value=""/></div>
                <div class="grid3">
                    <div class="floatL mr10"><input type="radio" id="PON_status_inativo"  name="PON_status" value="0" /><lavel for="PON_status_sim">Inativo</lavel> </div>
                    <div class="floatL mr10"><input type="radio" id="PON_status_ativo"  name="PON_status" checked="checked" value="1"/><lavel for="PON_status_nao"> Ativo</lavel></div>
                    <div class="clear"></div>
                </div>
                <div class="clear"></div>
            </div> 
            <div class="formRow">
                <div class="grid3"><label>Local:</label></div>
                <div class="grid9"><input type="text" id="PON_local" /></div>
                <div class="clear"></div>
            </div> 
            <div class="formRow">
                <div class="grid3"><label>Descrição:</label></div>
                <div class="grid9"><textarea rows="8" cols="" id="PON_descricao"></textarea></div>
                <div class="clear"></div>
            </div> 
            <div class="formRow">
                <div class="grid3"><label>Dispositivo:</label></div>
                <div class="grid9"><input id="PON_dispositivo" type="text" value=""></div>
                <div class="clear"></div>
                <div class="clear"></div>    
            </div> 
            <div class="formRow">
                <div class="grid12">
                    <a href="#" class="tablectrl_large bGreen floatR addRecurso_tab5"><span class="iconb" data-icon="&#xe078;"></span></a>
                </div>
                <?
                  echo   gera_tabela_pontos($os['ORD_pontos']);
                ?>
            </div>       
            <div class="formRow">
                <div class="grid12" align="right">
                    <input type="submit"  value="Salvar" class="buttonM  bGreen floatR">
                </div>

                <div class="clear"></div>
            </div> 
        </div>
        
      
    </div>
</form>