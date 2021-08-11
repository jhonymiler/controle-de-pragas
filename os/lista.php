<?
	$ord = new ordemServico;
		
	if(is_numeric($_GET['remove'])){
		if($ord->excluir($_GET['remove'])){
			$note['tipo'] = 'nSuccess';
			$note['msg']  = 'Excluído com sucesso!';
	   }else{
		   $note['tipo'] = 'nFailure';
		   $note['msg'] = 'Erro: Não foi possível excluir.';
	   }
	}elseif(isset($_POST) && isset($_GET['remove'])){
		$ord->excluir($_POST['checkRow']);
		$note['tipo'] = 'nSuccess';
		$note['msg']  = 'Excluído com sucesso!';
	}
	

?>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .linha:hover{
            background-color:#f2f2f2;
        }
    </style>
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Orçamentos</span>
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
                <li><a href="?cat=os&pg=novo">Nova</a></li>
            </ul>
        </div>
        
        <div class="breadLinks">
            <ul>
                <!--<li><a href="#" title=""><i class="icos-list"></i><span>Lista clientes</span> <strong>(+58)</strong></a></li>-->
                <li class="has">
                    <a title="">
                        <i class="icos-cog4"></i>
                        <span>Opções</span>
                        <span><img src="images/elements/control/hasddArrow.png" alt="" /></span>
                    </a>
                    <ul>
                        <li><a href="" title=""><span class="icos-add"></span>Novo</a></li>
                        <li><a href="" title=""><span class="icos-archive"></span>Lista</a></li>
                    </ul>
                </li>
            </ul>
             <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper"> 
        <?
           // EXIBE O CÓDIGO DO POST PARA DEBUG
           //echo wgCode($_SESSION['POST']);
        ?>      
       <div class="fluid">
	<? 
          
            //$dados = $ord->listar($_GET['filhos']);
            if(is_numeric($_GET['filhos'])){
                $dados = $ord->db->_select('WHERE id_pai = "'.$_GET['filhos'].'" or ORD_id="'.$_GET['filhos'].'" ORDER BY ORD_data_visita ASC');
            }else{
                $dados = $ord->db->_select('WHERE id_pai = "0" ORDER BY ORD_data_visita ASC');
            }
            if(is_array($dados)){
                foreach($dados as $ordens){
                    $ordens['ORD_data_visita'] = $ord->db->filtroData($ordens['ORD_data_visita']);
                    $d[ $ordens['ORD_id'] ] = $ordens;
                }
            }else{

                $d  = false;
            }
            $ord->gerarTabela($d);	
        
        ?>
       </div>
    </div>
	

    