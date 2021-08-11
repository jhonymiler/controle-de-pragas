<?
    require_once $_SESSION['RAIZ'].'acesso.php';
    $ord = new ordemServico;
    $orc = new orcamento;
   
    if(empty($_GET['ord_id'])){
        $mensagem = getMsg('Informe o número da OS','alerta');
    }else{    
        
       $os = $ord->getOs($_GET['ord_id']);
       //exibe($os);
       if(is_array($os)){
           $orcamento = $orc->getOrcamento($os['ORC_id']);
           $cliente = $orc->getCliente($orcamento['CLI_id']);
           
           $primeiraOs = ($os['id_pai'] == 0)?$os['ORD_id']:$os['id_pai'];
       }
       if(!is_array($os)){
           $mensagem = getMsg('O número da OS é inválido!','erro');
           $id = '';
       }else{
           $id = "&ord_id=".$_GET['ord_id'];
       }
    }
?>

  <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .linha:hover{
            background-color:#f2f2f2;
        }
    </style>
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Técnico</span>
        
        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="?cat=os&pg=lista">Ordens de Serviço</a></li>
                <li><a href="?cat=os&pg=monitoramento&ord_id=<?=$_GET['ord_id']?>">Monitoramento</a></li>
            </ul>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper"> 
       <?=$mensagem;?>
      <div class="fluid">
         <div class="widget grid12"> 
            <form class=" grid3" style="margin-left:0px;" method="get" action="index.php">
              <div  class="formRow fluid">
                <div class="grid9">
                    <input type="hidden"  name='cat' value="<?=$_GET['cat']?>">
                    <input type="hidden"  name='pg'  value="<?=$_GET['pg']?>">
                    <input type="text"    name='ord_id'  placeholder='Nº OS'  value="<?=$_GET['ord_id']?>" >
                </div>
                 <div class="grid3">
                     <input id='buscarOS' type="submit" value="Buscar" class="buttonM bGreen " >
                </div> 

              </div>
          </form>
         <? if(is_array($cliente)){ ?>
            <div class="grid9">
                 <h5><?=$cliente['CLI_nome'];?></h5>
                 <span class="myRole">Visita: <?=$os['ORD_data_visita']?> - <?=$os['ORD_hora_visita'];?></span>
                 <span class="followers">Primeira OS deste cronograma: <?=$primeiraOs;?></span>
             </div>
         <? } ?>
        </div>
        <? if(is_array($cliente)){ ?> 
            <div class="widget grid12" style="margin-left:0px;"> 
                <div  class="formRow grid3">
                   <a href="?cat=os&pg=monitoramento&tipoPonto=ponto<?=$id?>" class="buttonL bDefault mb10 mt5">Add Pontos</a>
                </div>
                <div  class="formRow grid9" align="right">
                   <a href="?cat=os&pg=monitoramento&tipoPonto=ppe<?=$id?>" class="buttonL bDefault mb10 mt5">PPE</a>
                   <a href="?cat=os&pg=monitoramento&tipoPonto=ppi<?=$id?>" class="buttonL bDefault mb10 mt5">PPI</a>
                   <a href="?cat=os&pg=monitoramento&tipoPonto=biologica<?=$id?>" class="buttonL bDefault mb10 mt5">BIOLÓGICA</a>
                   <a href="?cat=os&pg=monitoramento&tipoPonto=luminosa<?=$id?>" class="buttonL bDefault mb10 mt5">LUMINOSA</a>
                   <a href="?cat=os&pg=monitoramento&tipoPonto=outros<?=$id?>" class="buttonL bDefault mb10 mt5">OUTRAS</a>
                   <a href="?cat=os&pg=monitoramento&tipoPonto=prp<?=$id?>" class="buttonL bDefault mb10 mt5">PRP</a>
                </div>
            </div>  
        <? }?>
      </div>
         <? 
            if(isset($_GET['tipoPonto']) && isset($_GET['ord_id'])){
                if(file_exists($config['RAIZ'].DS.'os'.DS.getPagina($_GET['tipoPonto']).'.php')){
                     include  $config['RAIZ'].DS.'os'.DS.getPagina($_GET['tipoPonto']).'.php';
                }
            }
        ?>
    </div>
	