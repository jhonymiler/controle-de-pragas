
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
            <form class=" grid4" style="margin-left:0px;" method="get" action="index.php">
                <div  class="formRow fluid">
                    <div class="grid9">
                        <div class=" searchDrop">
                            <span class="note">Cliente</span>
                            <input type="hidden"  name='cat' value="<?=$_GET['cat']?>">
                            <input type="hidden"  name='pg'  value="<?=$_GET['pg']?>">
                             <select name="cli_id" data-placeholder="Escolha um Cliente" class="select validate[required]"  tabindex="2">
                                 <option value=""></option> 
                                <?
                                $CLI = new Registro('clientes');
                                    $select_func = $CLI->_select();
                                     if(is_array($select_func)){
                                        foreach($select_func as $clientes){
                                          if($_GET['cli_id'] == $clientes['CLI_id']){
                                            $select = 'selected="selected"';
                                          }else{
                                            $select = "";
                                          }
                                          echo '<option value="'.$clientes['CLI_id'].'" '.$select.'>'.$clientes['CLI_nome'].'</option> ';
                                        }
                                    }
                                   ?>
                            </select>
                        </div>
                    </div>
                     <div class="grid3">
                        <input id='buscarOS' type="submit" value="Buscar" class="buttonM bGreen " style="margin-top: 23px;">
                     </div>
                    <div class="clear"></div>
                </div>
              
          </form>
         </div>
          
          
         <? 
            if(isset($_GET['tipoPonto']) && isset($_GET['ord_id'])){
                if(file_exists($config['RAIZ'].DS.'os'.DS.getPagina($_GET['tipoPonto']).'.php')){
                     include  $config['RAIZ'].DS.'os'.DS.getPagina($_GET['tipoPonto']).'.php';
                }
            }
        ?> 
          
      </div>
    </div>