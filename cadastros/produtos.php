<script>
$(document).ready(function() {
	
	//===== Tabs =====//
		$("ul.tabs li").removeClass("activeTab"); //Remove any "active" class
		$li = $(".<?=$_GET['tab']?>");
		$li.addClass("activeTab"); //Add "active" class to selected tab
		$li.parent().parent().find(".tab_content").hide(); //Hide all tab content
		activeTab = $li.find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).show(); //Fade in the active content
})
</script>
<link href="css/styles.css" rel="stylesheet" type="text/css" />
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Fornecedores</span>
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
                <li><a href="?pg=home">Painel de Controle</a></li>
                <li><a href="?cat=cadastros&pg=produtos">Produtos</a>
                </li>
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
                        <li><a href="?cat=cadastros&pg=produtos&add=true" title=""><span class="icos-add"></span>Novo</a></li>
                        <li><a href="?cat=cadastros&pg=produtos&list=true" title=""><span class="icos-archive"></span>Lista</a></li>
                    </ul>
                </li>
            </ul>
             <div class="clear"></div>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
        <div class="fluid">
        <!--Abas de cadastros-->
        <div class="widget grid12">       
            <ul class="tabs">
                <li class="grupos"><a href="#grupos">Grupos</a></li>
                <li class="tratamentos"><a href="#tratamentos">Tratamentos</a></li>
                <li class="servicos"><a href="#servicos" class="activeTab">Serviços</a></li>
                <li class="pragas_alvo"><a href="#pragas_alvo" class="activeTab">Pragas Alvo</a></li>
                <li class="produtos"><a href="#produtos">Produtos</a></li>
            </ul>
            
            <div class="tab_container">
                <div id="grupos" class="tab_content">
                    <? include 'grupos.php'; ?>             
                </div>
                <div id="tratamentos" class="tab_content">
                     <? include 'tratamentos.php'; ?>             
                </div>
                <div id="pragas_alvo" class="tab_content">
                   <? include 'pragas.php'; ?>                     
                </div>
                <div id="servicos" class="tab_content">
                   <? include 'servicos.php'; ?>                     
                </div>
                <div id="produtos" class="tab_content">
                   <? include 'produto.php'; ?>
                </div>
            </div>	
            <div class="clear"></div>		 
        </div>
       
        
        </div>  
    </div>
     	<script language="javascript">
		
			$(document).ready(function(){
				
				// validação do formulário
				jQuery("#cadastro").validationEngine('attach',{
					onAjaxFormComplete: function(status, form, json, options){
						if (status === true) {
							form.submit();
						}else{
							return false
						}
					}
				});
				
			});
			$(window).load(function(){
				var campos = <?=$campos?>;
				preencer(campos);
			})
			
			
			function preencer(json){
				for(var key in json){
					$("[name="+key+"]").val(json[key]);
				}
			}


		</script>

    