<?
	$orc = new orcamento;
	if(isset($_GET['remove'])){
		if(is_array($_POST['checkRow'])){
            $id = $_POST['checkRow'];
		}elseif(is_numeric($_GET['remove'])){
			$id = $_GET['remove'];
		}
		$orc->delete($id);
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
                <li><a href="index.php">Painel de Controle</a></li>
                <li><a href="?cat=orcamentos&pg=orcamentos&tab=relatorio-vistoria">Orçamentos</a></li>
                <li><a href="index.php?cat=orcamentos&pg=lista">Lista</a></li>
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
			$orc->getListaOrcamentos();
		?>
       </div>
    </div>
	

    