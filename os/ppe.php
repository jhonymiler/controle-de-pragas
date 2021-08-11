<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ppe
 *
 * @author Jonatas
 */
class ppe {
    public $baixa = array(
        'Não monitorado',
        'Monitorado',
        'Acesso Impedido',
        'Implantado'
    );
    public $isca = array(        
        'Intacto',
        'Comsumido',
        'Danificado',
        'Extraviado'

    );
    public $porta_isca = array(
        'intacta',
        'Danificada',
        'Extraviada',
        
    );
    
    private $db; // tabela do banco de dados
    private $os; // tabela do banco de dados
    
    
   public function __construct() {
       $this->db = new Registro('ppe');
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
              if($item->tipo_dispositivo == 'ppe'){  
                $baixa = $this->db->_query('SELECT * FROM ppe WHERE PON_id = "'.$item->id.'" and ORD_id="'.$_GET['ord_id'].'" ORDER BY PPE_id DESC');
                $baixa = $baixa[0];

                $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$item->id.'" />';
                $colum[$i]['Nº'] =  $item->num;
                $colum[$i]['Local'] =  $item->local;
                $colum[$i]['Status'] = ( $item->status == 1)?'Ativo':'Inativo';
                $colum[$i]['Dispositivo'] = $item->dispositivo;
                
                $colum[$i]['Baixa'] = $this->baixa[ $baixa['PPE_baixa'] ];
                $colum[$i]['Porta Isca'] = $this->porta_isca[ $baixa['PPE_porta_isca'] ];
                $colum[$i]['Substituido'] =  ($baixa['PPE_porta_isca_substituido'] == 0)?'':'Sim';
                $colum[$i]['Isca'] = $this->isca[ $baixa['PPE_isca'] ];
                $colum[$i]['Substituida'] =  ($baixa['PPE_isca_substituida'] == 0)?'':'Sim';
                $colum[$i]['Opções'] = '
                    <ul class="btn-group toolbar">
                        <li>
                                <a href="?cat=os&pg=monitoramento&tipoPonto=ppe&ord_id='.$_GET['ord_id'].'&pon_id='.$item->id.'" class="tablectrl_small bDefault">
                                        <span class="iconb" data-icon="&#xe1db;"></span>
                                </a>
                        </li>
                        <li>
                                <a href="?cat=os&pg=monitoramento&tipoPonto=ppe&ord_id='.$_GET['ord_id'].'&remove='.$item->id.'" class="tablectrl_small bDefault">
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
       return $this->db->_query('DELETE FROM ppe WHERE PPE_id IN ('.$id.')');
   }
}

//exibe($_POST);

$ppe = new ppe;
/**
 * EXCLUI VÁRIOS REGISTROS
 */
if(isset($_GET['remove'])) if($ppe->excluir($_GET['remove'])) $msg = getMsg('Excluido com sucesso!','sucesso');

if(count($_POST['checkRow']) > 0){
    if($ppe->excluir($_POST['checkRow'])) $msg = getMsg('Excluido com sucesso!','sucesso');
}else{
    if(isset($_POST['PON_id'])){
        
        $_POST['PPE_data_implantacao'] = date('Y-m-d');
        if(!empty($_GET['pon_id']) && !empty($_POST['PPE_id'])){
            $_POST['PON_id'] = $_GET['pon_id'];
            if($ppe->atualiza($_POST)){
                $msg = getMsg('Atualizado com sucesso!','sucesso');
            }else{
                $msg = getMsg('Não foi possível atualizar os dados!','erro');
            }
        }else{
            if($ppe->gravar($_POST)){
                $msg = getMsg('Gravado com sucesso!','sucesso');
            }else{
                $msg = getMsg('Não foi possível gravar os dados!','erro');
            }
        }
    }
}

if(isset($_GET['pon_id'])){
    $dados = $ppe->get('WHERE PON_id="'.$_GET['pon_id'].'" and ORD_id="'.$_GET['ord_id'].'"');
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
      <h6>Lista de PPE's</h6>
      <div class="clear"></div>
    </div>
    <div  class="dyn hiddenpars"> 
            <a class="tOptions" title="Options">
                    <img src="images/icons/options.png" alt="" />
            </a>
            <form id="remover"  method="post" action="index.php?cat=os&pg=monitoramento&tipoPonto=ppe&ord_id=<?=$_GET['ord_id']?>">
             <?= $ppe->exibeTabela();?>
             <input type="submit" name="remover"  value="Remover Selecionados" class="buttonM  bRed floatR">
      </form>


    </div>
</div>
<div class="divider"><span></span></div>



<?
    if(!empty($_GET['pon_id'])){
?>
<form class=" grid12" method="post">
    <div class="fluid">
        <!--Abas de cadastros-->
        <div class="widget grid12">
            <div class="whead">
                <h6>Dados do Ponto</h6>
                <div class="clear"></div>
            </div>
            <div class="fluid">
                
                    <input type="hidden"  name="PPE_id" value="<?=$dados['PPE_id']?>" />
                    <input type="hidden"  name="PON_id" value="<?=$_GET['pon_id']?>" />
                    <input type="hidden"  name="ORD_id" value="<?=$_GET['ord_id']?>" />

                    <div class="formRow">
                        <div class="grid3"><label>Baixa :</label></div>
                        <div class="grid9 on_off">
                            <div class="floatL mr10"><input type="radio" id="radio10"  name="PPE_baixa" value="1" /><lavel for="radio10">Monitorado</lavel> </div>
                            <div class="floatL mr10"><input type="radio" id="radio11"  name="PPE_baixa" value="2"/><lavel for="radio11"> Acesso Impedido</lavel></div>
                            <div class="floatL mr10"><input type="radio" id="radio13"  name="PPE_baixa" value="3"/><lavel for="radio13">Implantado</lavel></div>
                            <div class="floatL mr10"><input type="radio" id="radio14"  name="PPE_baixa" value="0"/><lavel for="radio14">Não Monitorado</lavel></div>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="formRow">
                        <div class="grid3"><label>Porta Isca :</label></div>
                        <div class="grid9 on_off">
                            <div class="floatL mr10"><input type="radio" id="radio15"  name="PPE_porta_isca" value="0" /><lavel for="radio15">Intacto</lavel> </div>
                            <div class="floatL mr10"><input type="radio" id="radio16"  name="PPE_porta_isca" value="1"/><lavel for="radio16"> Danificado</lavel></div>
                            <div class="floatL mr10"><input type="radio" id="radio17"  name="PPE_porta_isca" value="2"/><lavel for="radio17">Extraviado</lavel></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="formRow">
                        <div class="grid3"><label>Substituido :</label></div>
                        <div class="grid9 on_off">
                            <div class="floatL mr10"><input type="radio" id="PPE_porta_isca_substituido_sim"  name="PPE_porta_isca_substituido" value="1" /><lavel for="PPE_porta_isca_substituido_sim">Sim</lavel> </div>
                            <div class="floatL mr10"><input type="radio" id="PPE_porta_isca_substituido_nao"  name="PPE_porta_isca_substituido" value="0"/><lavel for="PPE_porta_isca_substituido_nao"> Não</lavel></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="formRow">
                        <div class="grid3"><label>Isca :</label></div>
                        <div class="grid9 on_off">
                            <div class="floatL mr10"><input type="radio" id="radio21"  name="PPE_isca" value="0" /><lavel for="radio21">Intacto</lavel> </div>
                            <div class="floatL mr10"><input type="radio" id="radio19"  name="PPE_isca" value="1"/><lavel for="radio19"> Consumida</lavel></div>
                            <div class="floatL mr10"><input type="radio" id="radio20"  name="PPE_isca" value="2"/><lavel for="radio20">Danificada</lavel></div>
                            <div class="floatL mr10"><input type="radio" id="radio22"  name="PPE_isca" value="3"/><lavel for="radio22">Extraviada</lavel></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div> 
                      <div class="formRow">
                        <div class="grid3"><label>Substituida :</label></div>
                        <div class="grid9 on_off">
                            <div class="floatL mr10"><input type="radio" id="PPE_isca_substituida_sim"  name="PPE_isca_substituida" value="1" /><lavel for="PPE_isca_substituida_sim">Sim</lavel> </div>
                            <div class="floatL mr10"><input type="radio" id="PPE_isca_substituida_nao"  name="PPE_isca_substituida" value="0"/><lavel for="PPE_isca_substituida_nao"> Não</lavel></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <!-- FIM Atividades complementáres !--> 
                <div class="formRow">
                    <div class="grid12" align="right">
                        <input type="submit"  value="Salvar" class="buttonM  bGreen floatR">
                    </div>

                    <div class="clear"></div>
                </div> 
            </div>
        </div>
    </div>
</form>
    <? }?>