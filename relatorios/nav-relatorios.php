   
    
    <!-- Secondary nav -->
    <div class="secNav">
        <div class="secWrapper">
            <div class="secTop">
                <div class="balance">
                <div class="balInfo">Ordem de Serviço:</div>
                </div>
            </div>
            
            <!-- Tabs container -->
            <div id="tab-container" class="tab-container">                
                <div id="general">
                    <ul class="subNav">
                        <li><a href="?cat=relatorios&pg=tecnico" class="<?=($_GET['pg'] == 'tecnico')?'this':'';?>" title=""><span class="icos-flag2"></span>Técnico</a></li>
                        <li><a href="?cat=relatorios&pg=lista" class="<?=($_GET['pg'] == 'lista')?'this':'';?>" title=""><span class="icos-list"></span>Lista</a></li>
                        <li><a href="?cat=relatorios&pg=baixa" class="<?=($_GET['pg'] == 'baixa')?'this':'';?>" title=""><span class="icos-download"></span>Baixar OS</a></li>
                        <li><a href="?cat=relatorios&pg=monitoramento" class="<?=($_GET['pg'] == 'monitoramento')?'this':'';?>" title=""><span class="icos-marker"></span>Monitoramento</a></li>
                        <li><a href="?cat=relatorios&pg=ocorrencia_pragas" class="<?=($_GET['pg'] == 'ocorrencia_pragas')?'this':'';?>" title=""><span class="icos-cat"></span>Ocorrência de Pragas</a></li>
                        
                    </ul>
                </div>
            </div>
            <div class="divider"><span></span></div>
       </div> 
       <div class="clear"></div>
   </div>