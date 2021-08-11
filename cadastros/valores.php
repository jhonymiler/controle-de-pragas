<?
	$r = new Registro('valores');
	$_POST['VAL_id'] = 8;
	if($_GET['add'] == true && isset($_POST['valores']) && is_numeric($_POST['VAL_id'])){
		$r->_load($_POST);
		if($r->_atualiza()>0){
			$note['tipo'] = 'nSuccess';
			$note['msg'] = 'Atualizado com sucesso!';
		}else{
			$note['tipo'] = 'nFailure';
			$note['msg'] = $r->_getErro();
		}
		$mensagem = '
				<div class="nNote '.$note['tipo'].'">
					<p>'.$note['msg'].'</p>
				</div>                    
		';
	}

	 $r->_busca('VAL_id', $_POST['VAL_id']);
	 $cliente = $r->_getReg();
	 $campos = json_encode($cliente);
?>
<script>
    $(window).load(function(){
        var campos = <?=$campos?>;
        preencer(campos);
	})
</script>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
    <div class="contentTop">
        <span class="pageTitle"><span class="fs1 iconb" data-icon=""></span> Valores</span>
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
                <li><a href="#">Cadastros</a>
                <li><a href="?cat=cadastros&pg=valores">Valores</a>
                </li>
            </ul>
        </div>
    </div>
    
    <!-- Main content -->
    <div class="wrapper">
    <div class="fluid">
        <form id="cadastro" class="formPessoa grid12" method="post" action="?cat=cadastros&pg=valores&add=true">
            <div class="widget">
                <div class="whead"><h6>Cadastro - Valores diversos</h6><div class="clear"></div></div>
                    <?=$mensagem;?>
                    <!--DADOS DA PESSOA JURIDICA OU JURIDICA!-->
                     <div  class="formRow">
                          
                            <div class="grid3"><label>Refeição:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_refeicao" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                        
                      <div  class="formRow">
                            <div class="grid3"><label>Hora/Operador: <span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_dia_operador" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                      <div  class="formRow">
                            <div class="grid3"><label>Hora/Gestor: <span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_dia_gestor" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                        
                      <div  class="formRow">
                            <div class="grid3"><label>Dia/Hotel: <span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_hotel" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                        
                      <div  class="formRow">
                            <div class="grid3"><label>Preço/Km: <span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_km" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                        
                      <div  class="formRow">
                            <div class="grid3"><label>Material de Escritório:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_material_escritorio" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                        
                      <div  class="formRow">
                            <div class="grid3"><label>Lucro:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_lucro" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                        
                      <div  class="formRow">
                            <div class="grid3"><label>Imposto:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_imposto" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                        
                      <div  class="formRow">
                            <div class="grid3"><label>Comissão:<span class="req">*</span></label></div>
                            <div class="grid9"><input type="text" name="VAL_comissao" value=""  class="validate[required] validNum" /></div>
                            <div class="clear"></div>
                      </div>
                        
                   </div> 
                    <div class="formRow">
                         <div class="clear"></div>
                         <div class="divider"><span></span></div>
                        
                        <div class="floatR">
                            <input type="submit" name="valores"  value="Submit" class="buttonM grid6 bGreen formSubmit">
                            <input type="button" class="buttonM grid6 bRed" value="Cancel">
                            <div class="clear"></div>
                        </div>
                        <div class="clear"></div>
              </div>
                    <div class="clear"></div>
            </div>
        </form>
    </div>

    