<?
    require_once $_SESSION['RAIZ'].'acesso.php';
    $ord = new ordemServico;
    
       
    if(isset($_POST['ORD_id'])){
        if($ord->baixar($_POST)){
            $mensagem = getMsg('Gravado com sucesso!','sucesso');
        }else{
            $mensagem = getMsg('Houve um erro, a baixa não pode ser gravada corretamente!','erro');
        }
    }

    if(empty($_GET['id'])){
        $mensagem = getMsg('Informe o número da OS','alerta');
    }else{
        $os = '';
        
       $os = $ord->getOs($_GET['id']);
       if(!is_array($os)){
           $mensagem = getMsg('O número da OS é inválido!','erro');
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
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Baixas de OS's</span>
        <ul class="quickStats">
            <li>
                <a href="" class="blueImg"><img src="images/icons/quickstats/plus.png" alt="" /></a>
                <div class="floatR"><strong class="blue">5489</strong><span>Visitas realizadas</span></div>
            </li>
            <li>
                <a href="" class="redImg"><img src="images/icons/quickstats/user.png" alt="" /></a>
                <div class="floatR"><strong class="blue">4658</strong><span>Clientes</span></div>
            </li>
            <li>
                <a href="" class="greenImg"><img src="images/icons/quickstats/money.png" alt="" /></a>
                <div class="floatR"><strong class="blue">1289</strong><span>Produtos</span></div>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    
    <!-- Breadcrumbs line -->
    <div class="breadLine">
        <div class="bc">
            <ul id="breadcrumbs" class="breadcrumbs">
                <li><a href="?cat=os&pg=lista">Ordens de Serviço</a></li>
                <li><a href="?cat=os&pg=baixa&id=<?=$_GET['id']?>">Baixas de OS's</a></li>
            </ul>
        </div>
        
       
    </div>
    
    <!-- Main content -->
    <div class="wrapper"> 
        <?
           // EXIBE O CÓDIGO DO POST PARA DEBUG
           //echo wgCode($_SESSION['POST']);
        ?> 
         <?=$mensagem;?>
        <div class="fluid">
              <!--Abas de cadastros-->
              <div class="widget grid12"> 
              <form class=" grid12" style="margin-left:0px;" method="get" action="index.php">
                  <div  class="formRow fluid">
                    <div class="grid1">
                        <input type="hidden"  name='cat' value="<?=$_GET['cat']?>">
                        <input type="hidden"  name='pg'  value="<?=$_GET['pg']?>">
                        <input type="text"    name='id'  placeholder='Nº OS'  value="<?=$_GET['id']?>" >
                    </div>
                     <div class="grid1">
                         <input id='buscarOS' type="submit" value="Buscar" class="buttonM bGreen " >
                    </div> 
                      
                  </div>
              </form>
              </div>
        </div>
        
        
       
        <form id="orcamento" class=" grid12 orcamento" style="margin-left:0px;" method="post" action="">
            <div class="fluid">
                <!--Abas de cadastros-->
                <div class="widget grid12"> 

                  <div  class="formRow fluid">

                      <div class="grid2">
                          <span class="note">Hora da Partida</span>
                          <input type="text" name="ORD_partida"  value="<?=$os['ORD_partida']?>" class="horaMeia" >
                          <input type="hidden" name="ORD_id"  value="<?=$os['ORD_id']?>"  >
                      </div>
                      <div class="grid2">
                          <span class="note">Data da Chegada</span>
                          <input type="text" name="ORD_chegada"  value="<?=$ord->filtroData($os['ORD_chegada'])?>" class="datepicker" >
                      </div>
                      <div class="grid2">
                          <span class="note">Hora da Chegada</span>
                          <input type="text" name="ORD_chegada_hora"  value="<?=$os['ORD_chegada_hora']?>" class="horaMeia" >
                      </div>
                      <div class="grid2">
                          <span class="note">Hora Início do Serviço</span>
                          <input type="text" name="ORD_inicio_servico"  value="<?=$os['ORD_inicio_servico']?>"  class="horaMeia" >
                      </div>
                  </div>
              </div>  
         </div>
         <div class="fluid">
            <div class="widget grid12"> 
                
            	<div  class="formRow fluid">
                    
                    <div class="grid2">
                    	<span class="note">KM da Partida</span>
                        <input type="text" name="ORD_km_partida"  value="<?=$os['ORD_km_partida']?>" >
                    </div>
                    <div class="grid2">
                    	<span class="note">KM da Chegada</span>
                        <input type="text" name="ORD_km_chegada"  value="<?=$os['ORD_km_chegada']?>" >
                    </div>
                    <div class="grid2">
                    	<span class="note">Data do termino</span>
                        <input type="text" name="ORD_termino"  value="<?=$ord->filtroData($os['ORD_termino'])?>" class="datepicker" >
                    </div>
                    <div class="grid2">
                    	<span class="note">Hora termino do Serviço</span>
                        <input type="text" name="ORD_termino_hora"  value="<?=$os['ORD_termino_hora']?>"  class="horaMeia" >
                    </div>
                </div>
            </div>  
         </div>
            
        <div class="fluid">
            <div class="widget grid12"> 
                
            	<div  class="formRow fluid">
                    
                    <div class="grid4">
                    	<span class="note">Acompanhado por:</span>
                        <input type="text" name="ORD_acompanhado_por"  value="<?=$os['ORD_acompanhado_por']?>" >
                    </div>
                    <div class="grid8">
                    	<span class="note">Observações</span>
                        <textarea name="ORD_obs"> <?=$os['ORD_obs']?></textarea>
                    </div>
                   
                </div>
            </div>  
         </div>
        <div class="fluid">
             <div class="widget grid12"> 
            	<div class="formRow">
                    <div class="grid2"><label>Status :</label> </div>
                    <div class="grid10">
                        
                        <div class="radio" id="uniform-radio1">
                            <span <?=($os['ORD_status'] == 1)?'class="checked"':''?>>
                                <input type="radio" id="radio1" name="ORD_status" <?=($os['ORD_status'] == 1)?'checked="checked"':''?> style="opacity: 0;" value='1'>
                            </span>
                        </div>
                        <label for="radio1" class="mr20">Executado</label>
                        
                        
                        <div class="radio" id="uniform-radio2">
                            <span <?=($os['ORD_status'] == 2)?'class="checked"':''?>>
                                <input type="radio" id="radio2" name="ORD_status" <?=($os['ORD_status'] == 2)?'checked="checked"':''?> style="opacity: 0;" value='2'>
                            </span>
                        </div>
                        <label for="radio2" class="mr20">Não Executado</label>
                        
                        <div class="radio" id="uniform-radio3">
                            <span <?=($os['ORD_status'] == 3)?'class="checked"':''?>>
                                <input type="radio" id="radio3" name="ORD_status" <?=($os['ORD_status'] == 3)?'checked="checked"':''?> style="opacity: 0;" value='3'>
                            </span>
                        </div>
                        <label for="radio3" class="mr20">Imcompleto</label>
                        
                        <div class="radio" id="uniform-radio4">
                            <span <?=($os['ORD_status'] == 4)?'class="checked"':''?>>
                                <input type="radio" id="radio4" name="ORD_status" <?=($os['ORD_status'] == 4)?'checked="checked"':''?> style="opacity: 0;" value='4'>
                            </span>
                        </div>
                        <label for="radio4" class="mr20">Cancelado</label>
                        
                        <div class="radio" id="uniform-radio5">
                            <span  <?=($os['ORD_status'] == 5)?'class="checked"':''?>>
                                <input type="radio" id="radio5" name="ORD_status" <?=($os['ORD_status'] == 5)?'checked="checked"':''?> style="opacity: 0;" value='0'>
                            </span>
                        </div>
                        <label for="radio5" class="mr20">Em Aberto</label>
                       
                    </div>
                    <div class="clear"></div>
                </div>
            </div>  
        </div>   
        <?
          $r = new Registro('recursos_materiais');
          //$ultimo_id = $r->_select('WHERE REC_id ORDER BY DESC LIMIT 0,1');
        ?>
        <div class="fluid">
            <div class="floatR" style="margin-right:15px;">
                <input type="submit" name="controle-orcamento"  value="Salvar" class="buttonM bGreen " >
                <div class="clear"></div>
            </div>
            <div class="clear"></div> 
            <br />

        </div>
                       
        </form> 

    </div>
	