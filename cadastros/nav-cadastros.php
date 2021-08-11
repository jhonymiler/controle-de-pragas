   
    
    <!-- Secondary nav -->
    <div class="secNav">
        <div class="secWrapper">
            <div class="secTop">
                <div class="balance">
                <div class="balInfo">Cadastros:</div>
                </div>
            </div>
            
            <!-- Tabs container -->
            <div id="tab-container" class="tab-container">                
                <div id="general">
                    <ul class="subNav">
                        <li><a href="?cat=cadastros&pg=funcionarios" class="<?=($_GET['pg'] == 'funcionarios')?'this':'';?>" title=""><span class="icos-admin"></span>Funcionários</a></li>
                        <li><a href="?cat=cadastros&pg=equipes" class="<?=($_GET['pg'] == 'equipes')?'this':'';?>" title=""><span class="icos-view"></span>Equipes de técnicos</a></li>
                        <li><a href="?cat=cadastros&pg=veiculos" class="<?=($_GET['pg'] == 'veiculos')?'this':'';?>" title=""><span class="icos-car"></span>Veículos</a></li>
                        <li><a href="?cat=cadastros&pg=clientes" class="<?=($_GET['pg'] == 'clientes')?'this':'';?>" title=""><span class="icos-admin2"></span>Clientes</a></li>
                        <li><a href="?cat=cadastros&pg=fornecedor" class="<?=($_GET['pg'] == 'fornecedor')?'this':'';?>" title=""><span class="icos-users"></span>Fornecedores</a></li>
                        <li><a href="?cat=cadastros&pg=produtos" class="<?=($_GET['pg'] == 'produtos')?'this':'';?>" title=""><span class="icos-cart3"></span>Produtos</a></li>
                        <li><a href="?cat=cadastros&pg=valores" title=""><span class="icos-pricetag"></span>Valores</a></li>
                    </ul>
                </div>
            </div>
            <div class="divider"><span></span></div>
       </div> 
       <div class="clear"></div>
   </div>