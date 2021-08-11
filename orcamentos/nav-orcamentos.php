   
    
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
                        <li><a href="?cat=orcamentos&pg=orcamentos&tab=relatorio-vistoria" class="<?=($_GET['pg'] == 'orcamentos')?'this':'';?>" title=""><span class="icos-flag2"></span>Novo</a></li>
                        <li><a href="?cat=orcamentos&pg=lista" class="<?=($_GET['pg'] == 'lista')?'this':'';?>" title=""><span class="icos-list"></span>Lista</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="divider"><span></span></div>
       </div> 
       <div class="clear"></div>
   </div>