<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ppi
 *
 * @author Jonatas
 */
class ppi {
    public $baixa = array(
        'Não monitorado',
        'Monitorado',
        'Acesso Impedido',
        'Implantado'
    );
    public $placa = array(
        'intacto',
        'Danificado',
        'Extraviado',
        
    );
    public $porta_placa = array(
        'Intacta',
        'Comsumida',
        'Danificada',
        'Extraviada'
    );
    
    private $db; // tabela do banco de dados
    private $os; // tabela do banco de dados
    
   public function __construct() {
       $this->db = new Registro('ppi');
       $this->os = new Registro('ordem_servico');
   }
   
   public function get(){
       $args = func_get_args();
       return call_user_func_array(array($this->db, '_select'), $args);
   }
   
   public function listaTodos(){
       $os = $this->os->_select('ORD_id',$_GET['ord_id']);
       $pontos = json_decode($os[0]['ORD_pontos']);
       return $pontos;
   }
   
   public function exibeTabela(){
       $registros = $this->listaTodos();
      
       if(count($registros) > 0){
            $i = 0;
            $colum = array();
            foreach($registros as $item){
               if($item->tipo_dispositivo == 'ppi'){  
                $baixa = $this->db->_query('SELECT * FROM ppi WHERE PON_id = "'.$item->id.'" and ORD_id="'.$_GET['ord_id'].'" ORDER BY PPI_id DESC');
                $baixa = $baixa[0];
                
                 $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$item->id.'" />';
                $colum[$i]['Nº'] =  $item->num;
                $colum[$i]['Local'] =  $item->local;
                $colum[$i]['Status'] = ( $item->status == 1)?'Ativo':'Inativo';
                $colum[$i]['Dispositivo'] = $item->dispositivo;

                $colum[$i]['Dispositivo'] = $this->baixa[ $baixa['PPI_dispositivo'] ];
                $colum[$i]['Porta Placa'] = $this->porta_placa[ $baixa['PPI_porta_placa'] ];
                $colum[$i]['Substituido'] =  ($baixa['PPI_porta_placa_substituido'] == 0)?'':'Sim';
                $colum[$i]['Placa'] = $this->placa[ $baixa['PPI_placa'] ];
                $colum[$i]['Substituida'] =  ($baixa['PPI_placa_substituida'] == 0)?'':'Sim';
                $colum[$i]['Opções'] = '
                    <ul class="btn-group toolbar">
                        <li>
                            <a href="?cat=os&pg=monitoramento&tipoPonto=ppi&ord_id='.$_GET['ord_id'].'&pon_id='.$item->id.'" class="tablectrl_small bDefault">
                                    <span class="iconb" data-icon="&#xe1db;"></span>
                            </a>
                        </li>
                        <li>
                            <a href="?cat=os&pg=monitoramento&tipoPonto=ppi&ord_id='.$_GET['ord_id'].'&remove='.$item->id.'" class="tablectrl_small bDefault">
                                    <span class="iconb" data-icon="&#xe136;"></span>
                            </a>
                        </li>
                    </ul> 
                ';
                $i++;
               }
            }
            
            if(count($colum) > 0){
                ob_start();
                $tab = new tabela($colum);
                $tab->addAttr();
                if(is_object($tab)){
                        $tab->show();
                 }
                 $html = ob_get_contents();
                 ob_clean();
            }
         
       }

         return $html;
   }
   
   public function gravar($dados){
       $this->db->_load($dados);
       $id = $this->db->_grava();
       return is_numeric($id)?$id:false;
   }
   
   public function atualiza($dados){
       $this->db->_load($dados);
       $id = $this->db->_atualiza();
       return is_numeric($id)?$id:false;
   }
   
   
   public function excluir($id){
       if(is_array($id)) $id =  implode(',',$id);
       return $this->db->_query('DELETE FROM ppi WHERE PPI_id IN ('.$id.')');
   }
    
}

$ppi = new ppi;

/**
 * EXCLUI VÁRIOS REGISTROS
 */
if(isset($_GET['remove'])) if($ppi->excluir($_GET['remove'])) $msg = getMsg('Excluido com sucesso!','sucesso');

if(count($_POST['checkRow']) > 0){
    if($ppi->excluir($_POST['checkRow'])) $msg = getMsg('Excluido com sucesso!','sucesso');
}else{
    
    if(isset($_POST['PPI_id'])){
        
        $_POST['PPI_data_implantacao'] = date('Y-m-d');
        if(!empty($_GET['pon_id']) && !empty($_POST['PPI_id'])){
            $_POST['PON_id'] = $_GET['pon_id'];
            if($ppi->atualiza($_POST)){
                $msg = getMsg('Atualizado com sucesso!','sucesso');
            }else{
                $msg = getMsg('Não foi possível atualizar os dados!','erro');
            }
        }else{
            if($ppi->gravar($_POST)){
                $msg = getMsg('Gravado com sucesso!','sucesso');
            }else{
                $msg = getMsg('Não foi possível gravar os dados!','erro');
            }
        }
    }
}

if(isset($_GET['pon_id'])){
    $dados = $ppi->get('WHERE PON_id="'.$_GET['pon_id'].'" and ORD_id="'.$_GET['ord_id'].'"');
    echo "<script>
              $(document).ready(function($){ 
                dados = JSON.parse('". json_encode($dados) ."');
                dados[0]['ORD_id'] = ".$_GET['ord_id'].";
                preencer(dados[0]); 
              });
          </script>";
}

echo $msg;
?>
<div class="widget check">
    <div class="whead"> 
      <span class="titleIcon">
      <input type="checkbox" id="titleCheck" name="titleCheck" />
      </span>
      <h6>Lista de PPI's</h6>
      <div class="clear"></div>
    </div>
    <div  class="dyn hiddenpars"> 
            <a class="tOptions" title="Options">
                    <img src="images/icons/options.png" alt="" />
            </a>
            <form id="remover"  method="post" action="index.php?cat=os&pg=monitoramentos&tipoPonto=ppi&ord_id=<?=$_GET['ord_id']?>">
             <?= $ppi->exibeTabela();?>
               
                    <input type="submit" name="remover"  value="Remover Selecionados" class="buttonM  bRed floatR">
      </form>


    </div>
</div>
<div class="divider"><span></span></div>



<?
    if(!empty($_GET['pon_id'])){
?>
<form id="orcamento" class=" grid12 orcamento" style="margin-left:0px;" method="post" >
    <div class="fluid">
        <!--Abas de cadastros-->
        <div class="widget grid12">
            <div class="whead">
                <h6>Dados do Ponto</h6>
                <div class="clear"></div>
            </div>
            
            <input type="hidden"  name="PPI_id" value="<?=$dados['PPI_id']?>" />
            <input type="hidden"  name="PON_id" value="<?=$_GET['pon_id']?>" />
            <input type="hidden"  name="ORD_id" value="<?=$_GET['ord_id']?>" />

            <div class="fluid">
              
                <div class="formRow">
                    <div class="grid3"><label>Baixa :</label></div>
                    <div class="grid9 on_off">
                        <div class="floatL mr10"><input type="radio" id="radio10"  name="PPI_dispositivo" value="1" /><lavel for="radio10">Monitorado</lavel> </div>
                        <div class="floatL mr10"><input type="radio" id="radio11"  name="PPI_dispositivo" value="2"/><lavel for="radio11"> Acesso Impedido</lavel></div>
                        <div class="floatL mr10"><input type="radio" id="radio13"  name="PPI_dispositivo" value="3"/><lavel for="radio13">Implantado</lavel></div>
                        <div class="floatL mr10"><input type="radio" id="radio14"  name="PPI_dispositivo" value="0"/><lavel for="radio14">Não Monitorado</lavel></div>
                    </div>
                    <div class="clear"></div>
                </div> 
                <div class="formRow">
                    <div class="grid3"><label>Porta Placa :</label></div>
                    <div class="grid9 on_off">
                        <div class="floatL mr10"><input type="radio" id="radio15"  name="PPI_porta_placa" value="0" /><lavel for="radio15">Intacto</lavel> </div>
                        <div class="floatL mr10"><input type="radio" id="radio16"  name="PPI_porta_placa" value="1"/><lavel for="radio16"> Danificado</lavel></div>
                        <div class="floatL mr10"><input type="radio" id="radio17"  name="PPI_porta_placa" value="2"/><lavel for="radio17">Extraviado</lavel></div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div> 
                 <div class="formRow">
                    <div class="grid3"><label>Substituido :</label></div>
                    <div class="grid9 on_off">
                        <div class="floatL mr10"><input type="radio" id="PPI_porta_placa_substituido_sim"  name="PPI_porta_placa_substituido" value="1" /><lavel for="PPI_porta_placa_substituido_sim">Sim</lavel> </div>
                        <div class="floatL mr10"><input type="radio" id="PPI_porta_placa_substituido_nao"  name="PPI_porta_placa_substituido" value="0"/><lavel for="PPI_porta_placa_substituido_nao"> Não</lavel></div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div> 
                <div class="formRow">
                    <div class="grid3"><label>Placa :</label></div>
                    <div class="grid9 on_off">
                        <div class="floatL mr10"><input type="radio" id="radio21"  name="PPI_placa" value="0" /><lavel for="radio21">Intacta</lavel> </div>
                        <div class="floatL mr10"><input type="radio" id="radio19"  name="PPI_placa" value="1"/><lavel for="radio19"> Consumida</lavel></div>
                        <div class="floatL mr10"><input type="radio" id="radio20"  name="PPI_placa" value="2"/><lavel for="radio20">Danificada</lavel></div>
                        <div class="floatL mr10"><input type="radio" id="radio22"  name="PPI_placa" value="3"/><lavel for="radio22">Extraviada</lavel></div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div> 
                 <div class="formRow">
                    <div class="grid3"><label>Substituida :</label></div>
                    <div class="grid9 on_off">
                        <div class="floatL mr10"><input type="radio" id="PPI_placa_substituida_sim"  name="PPI_placa_substituida" value="1" /><lavel for="PPI_placa_substituida_sim">Sim</lavel> </div>
                        <div class="floatL mr10"><input type="radio" id="PPI_placa_substituida_nao"  name="PPI_placa_substituida" value="0"/><lavel for="PPI_placa_substituida_nao"> Não</lavel></div>
                        <div class="clear"></div>
                    </div>
                    <div class="clear"></div>
                </div> 
                 <div class="formRow">
                    <div class="grid12" align="right">
                        <input type="submit"  value="Salvar" class="buttonM  bGreen floatR">
                    </div>

                    <div class="clear"></div>
                </div> 
                <div class="clear"></div> 

            </div>
        </div>
    </div>
</form>
    <? }?>