<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of outros
 *
 * @author Jonatas
 */
class outros {
    public $baixa = array(
        'Implantado',
        'Monitorado',
        'Acesso Impedido'
    );
    public $placa_adesiva = array(
        'Capturados',
        'Danificada',
        'Extraviada'
    );
    public $lampada = array(
        'Conforme',
        'Não Conforme',
        'Não Avaliada'
    );
    
    private $db; // tabela do banco de dados
    private $os; // tabela do banco de dados
    
   public function __construct() {
       $this->db = new Registro('outros');
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
      
       if(count($registros)){
            $i = 0;
            $colum = array();
            foreach($registros as $item){
                if($item->tipo_dispositivo == 'outros'){  
                    $baixa = $this->db->_query('SELECT * FROM outros WHERE PON_id = "'.$item->id.'" and ORD_id="'.$_GET['ord_id'].'" ORDER BY OUT_id DESC');
                    $baixa = $baixa[0];
                    $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$item->id.'" />';
                    $colum[$i]['Nº'] =  $item->num;
                    $colum[$i]['Local'] =  $item->local;
                    $colum[$i]['Status'] = ( $item->status == 1)?'Ativo':'Inativo';
                    $colum[$i]['Dispositivo'] = $item->dispositivo;

                    $colum[$i]['Baixa'] = $this->baixa[ $baixa['OUT_baixa'] ];
                    $colum[$i]['Mon. Dispositivo'] = $this->placa_adesiva[ $baixa['OUT_dispositivo_captura'] ];
                    $colum[$i]['% Captura'] = $baixa['OUT_capturados'];
                    $colum[$i]['Substituido'] =  ($baixa['OUT_substituido'] == 0)?'':'Sim';
                    $colum[$i]['Opções'] = '
                        <ul class="btn-group toolbar">
                            <li>
                                    <a href="?cat=os&pg=monitoramento&tipoPonto=outros&ord_id='.$_GET['ord_id'].'&pon_id='.$item->id.'" class="tablectrl_small bDefault">
                                            <span class="iconb" data-icon="&#xe1db;"></span>
                                    </a>
                            </li>
                            <li>
                                    <a href="?cat=os&pg=monitoramento&tipoPonto=outros&ord_id='.$_GET['ord_id'].'&remove='.$item->id.'" class="tablectrl_small bDefault">
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
       return $this->db->_query('DELETE FROM outros WHERE OUT_id IN ('.$id.')');
   }
}

//exibe($_POST);

$outros = new outros;
/**
 * EXCLUI VÁRIOS REGISTROS
 */
if(isset($_GET['remove'])) if($outros->excluir($_GET['remove'])) $msg = getMsg('Excluido com sucesso!','sucesso');

if(count($_POST['checkRow']) > 0){
    if($outros->excluir($_POST['checkRow'])) $msg = getMsg('Excluido com sucesso!','sucesso');
}else{
    
    if(isset($_POST['PON_id'])){
        
        $_POST['OUT_data_implantacao'] = date('Y-m-d');
        if(!empty($_GET['pon_id']) && !empty($_POST['OUT_id'])){
            $_POST['PON_id'] = $_GET['pon_id'];
            if($outros->atualiza($_POST)){
                $msg = getMsg('Atualizado com sucesso!','sucesso');
            }else{
                $msg = getMsg('Não foi possível atualizar os dados!','erro');
            }
        }else{
            if($outros->gravar($_POST)){
                $msg = getMsg('Gravado com sucesso!','sucesso');
            }else{
                $msg = getMsg('Não foi possível gravar os dados!','erro');
            }
        }
    }
}

if(isset($_GET['pon_id'])){
    $dados = $outros->get('WHERE PON_id="'.$_GET['pon_id'].'" and ORD_id="'.$_GET['ord_id'].'"');
    if(count($dados)){
        echo "<script>
                  $(document).ready(function($){ 
                    dados = JSON.parse('". json_encode($dados) ."');
                    dados[0]['ORD_id'] = ".$_GET['ord_id'].";
                    preencer(dados[0]); 
                  });
              </script>";
    }
}

echo $msg;

?>

<script>
    $(document).ready(function(){
        $("#OUT_captura").<?=($dados[0]['OUT_dispositivo_captura'] == 0 || $dados[0]['OUT_dispositivo_captura'] == '')?'hide()':'show()';?>;
        $('[name=OUT_dispositivo_captura]').click(function(){
            if(this.checked && this.value == 0){
                $("#OUT_captura").show();
            }else{
                $("#OUT_captura").hide().val("0");
            }
        })
    })
    
</script>
<div class="widget check">
    <div class="whead"> 
      <span class="titleIcon">
      <input type="checkbox" id="titleCheck" name="titleCheck" />
      </span>
      <h6>Lista de Aramdilhas Luminosa</h6>
      <div class="clear"></div>
    </div>
    <div  class="dyn hiddenpars"> 
            <a class="tOptions" title="Options">
                    <img src="images/icons/options.png" alt="" />
            </a>
            <form id="remover"  method="post" action="index.php?cat=os&pg=monitoramento&tipoPonto=outros&ord_id=<?=$_GET['ord_id']?>">
             <?= $outros->exibeTabela();?>
            <input type="submit" name="remover"  value="Remover Selecionados" class="buttonM  bRed floatR">
      </form>


    </div>
</div>
<div class="divider"><span></span></div>


<?
    if(!empty($_GET['pon_id'])){
?>

<form  method="post" >
    <div class="fluid">
        <!--Abas de cadastros-->
        <div class="widget grid12">
            <div class="whead">
                <h6>Dados do Ponto</h6>
                <div class="clear"></div>
            </div>
            <div class="fluid">
                                
                    <input type="hidden"  name="OUT_id" value="<?=$dados['OUT_id']?>" />
                    <input type="hidden"  name="PON_id" value="<?=$_GET['pon_id']?>" />
                    <input type="hidden"  name="ORD_id" value="<?=$_GET['ord_id']?>" />
                     
                    <div class="formRow">
                        <div class="grid3"><label>Baixa :</label></div>
                        <div class="grid9 on_off">
                            <div class="floatL mr10"><input type="radio" id="radio10"  name="OUT_baixa" value="0" checked="checked" /><lavel for="radio10">Implantado</lavel> </div>
                            <div class="floatL mr10"><input type="radio" id="radio13"  name="OUT_baixa" value="1"/><lavel for="radio13">Monitorado</lavel></div>
                            <div class="floatL mr10"><input type="radio" id="radio11"  name="OUT_baixa" value="2"/><lavel for="radio11"> Acesso Impedido</lavel></div>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="formRow">
                        <div class="grid3"><label>Dispositivo :</label></div>
                        <div class="grid9 on_off">
                            <div class="floatL mr10"><input type="radio" id="radio21"  name="OUT_dispositivo_captura" value="0" /><lavel for="radio21">Capturados</lavel> 
                                <input id="OUT_captura" style="width:50px;" type="text" name="OUT_capturados" placeholder="%" />
                            </div>
                            <div class="floatL mr10"><input type="radio" id="radio19"  name="OUT_dispositivo_captura" value="1" checked="checked"/><lavel for="radio19">Sem Captura</lavel></div>
                            <div class="floatL mr10"><input type="radio" id="radio20"  name="OUT_dispositivo_captura" value="2"/><lavel for="radio20">Extraviada</lavel></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="formRow">
                        <div class="grid3"><label>Substituido :</label></div>
                        <div class="grid9 on_off">
                            <div class="floatL mr10"><input type="radio" id="OUT_substituida_sim"  name="OUT_substituido" value="1" /><lavel for="OUT_substituida_sim">Sim</lavel> </div>
                            <div class="floatL mr10"><input type="radio" id="OUT_substituida_nao"  name="OUT_substituido" value="0" checked="checked"/><lavel for="OUT_substituida_nao"> Não</lavel></div>
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
                    </div> 
                    <div class="formRow">
                        <div class="grid12" align="right">
                            <input type="submit" name="remover"  value="Salvar" class="buttonM  bGreen floatR">
                        </div>
                        
                        <div class="clear"></div>
                    </div> 
            </div>
        </div>
    </div>
</form>
<? }?>