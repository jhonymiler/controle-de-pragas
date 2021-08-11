<?
require_once 'acesso.php';
header ('Content-type: text/html; charset=utf8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title><?=$nomeUser?> - Controle de pragas</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/ui.spinner.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.mousewheel.js"></script>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>

<script type="text/javascript" src="js/plugins/charts/excanvas.min.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.orderBars.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/plugins/charts/jquery.sparkline.min.js"></script>

<script type="text/javascript" src="js/plugins/tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.sortable.js"></script>
<script type="text/javascript" src="js/plugins/tables/jquery.resizable.js"></script>

<script type="text/javascript" src="js/plugins/forms/autogrowtextarea.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.uniform.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.inputlimiter.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.tagsinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.maskedinput.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.autotab.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.chosen.min.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.dualListBox.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.cleditor.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.ibutton.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine-en.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.validationEngine.js"></script>

<script type="text/javascript" src="js/plugins/uploader/plupload.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html4.js"></script>
<script type="text/javascript" src="js/plugins/uploader/plupload.html5.js"></script>
<script type="text/javascript" src="js/plugins/uploader/jquery.plupload.queue.js"></script>

<script type="text/javascript" src="js/plugins/wizards/jquery.form.wizard.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.validate.js"></script>
<script type="text/javascript" src="js/plugins/wizards/jquery.form.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.collapsible.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.breadcrumbs.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.tipsy.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.progress.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.timeentry.min.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.colorpicker.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.jgrowl.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fancybox.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.fileTree.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>

<script type="text/javascript" src="js/plugins/others/jquery.fullcalendar.js"></script>
<script type="text/javascript" src="js/plugins/others/jquery.elfinder.js"></script>

<script type="text/javascript" src="js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="js/files/bootstrap.js"></script>
<script type="text/javascript" src="js/files/functions.js"></script>
<script type="text/javascript" src="js/plugins/facebook.js"></script>
<script type="text/javascript">
$(function(){
	
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/pt_BR/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));

      // Init the SDK upon load
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?=$faceConfig['appId'];?>',// App ID
          channelUrl : '//connect.facebook.net/pt_BR/all.js', // Path to your Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });

        // listen for and handle auth.statusChange events
        FB.Event.subscribe('auth.statusChange', function(response) {
          if (response.authResponse) {
			FB.getAuthResponse()['accessToken']			  
            // user has auth'd your app and is logged into Facebook
			FB.api('/me', function(me){
              if (me.name) {
				  //sendRequestToRecipients(me.id);
                //document.getElementById('auth-displayname').innerHTML = me.name;
				//for (var i in me){
					//alert('Campo \''+i+'\': ' + me[i])
					//navego pelas chaves do array como um for
					//document.getElementById('tudo').innerHTML = 'Campo \''+i+'\': ' + me[i] + '<br>';
					//$("#tudo").append( i + ' : ' + me[i] +'<br>')
				//}
				/*$(".img-face").attr('src','https://graph.facebook.com/'+me.id+'/picture')
				$("#face-info span b").html('Ol&aacute; '+me.name)
				// pagina de contato
				$("#nome").val(me.name)
				$("#email").val(me.email)
				$("#url-face").val('https://facebook.com/'+me.id)*/
              }
            })
          }
        });
				
      } 
	  
	
//	$(".nav li a").click(function(){
//		id = $(this).attr('id');
//		$(".nav>li>a").removeClass('active');
//		$(this).addClass('active');
//		$.get(id+"/options.php",function(retorno){
//			$('#content').append(retorno)
//			$('#sidebar').addClass('with');
//			$('#sidebar').removeClass('without');
//			$('#content').css('margin-left','327px');//.addClass('withoutSide');
//			$('#footer > .wrapper').remmoveClass('fullOne');
//	   });		
//		/*if ($('div').hasClass('secNav')){
//			
//			$(".secNav").remove();
//			$('#sidebar').addClass('without');
//			$('#content').css('margin-left','100px');//.addClass('withoutSide');
//			$('#footer > .wrapper').addClass('fullOne');
//		}else{
//			$.get("template/secNav.php",function(retorno){
//				$('#sidebar').append(retorno)
//				$('#sidebar').addClass('with');
//				$('#sidebar').removeClass('without');
//				$('#content').css('margin-left','327px');//.addClass('withoutSide');
//				$('#footer > .wrapper').remmoveClass('fullOne');
//			});
//		}*/
//		
//		return false;
//	})
	if ($('div').hasClass('secNav')) {
			$('#sidebar').addClass('with');
			//$('#content').addClass('withSide');
		}
		else {
			$('#sidebar').addClass('without');
			$('#content').css('margin-left','100px');//.addClass('withoutSide');
			$('#footer > .wrapper').addClass('fullOne');
	};
})
</script>
<!--<script type="text/javascript" src="js/charts/chart.js"></script>
<script type="text/javascript" src="js/charts/hBar_side.js"></script>-->

</head>

<body>

<!-- Top line begins -->
<div id="top">
    <div class="wrapper">
        <a href="index.php" title="" class="logo"><img src="images/logo.png" alt="" /></a>
        
        <!-- Right top nav -->
        <div class="topNav">
            <ul class="userNav">
                <li><a title="Início" class="home" href="index.php"></a></li>
                <li><a href="?sair=true" title="" class="logout"></a></li>
                <li class="showTabletP"><a href="#" title="" class="sidebar"></a></li>
            </ul>
        </div>
        
        <!-- Responsive nav -->
        <ul class="altMenu">
            
            <li><a href="?cat=cadastros" title="" class="exp">Cadastros</a>
                <ul>
                
                    <li><a href="?cat=funcionarios">Funcionários</a></li>
                    <li><a href="?cat=clientes">Fornecedores</a></li>
                    <li><a href="?cat=produto">Produtos</a></li>
                    <li><a href="?cat=vendedores">Vendedores</a></li>
                </ul>
            </li>
            <li><a href="index.php" title="">Dashboard</a></li>
            <li><a href="forms.html" title="" class="exp">Forms stuff</a>
                <ul>
                    <li><a href="forms.html">Inputs &amp; elements</a></li>
                    <li><a href="form_validation.html">Validation</a></li>
                    <li><a href="form_editor.html">File uploads &amp; editor</a></li>
                    <li><a href="form_wizards.html">Form wizards</a></li>
                </ul>
            </li>
            <li><a href="messages.html" title="">Messages</a></li>
            <li><a href="statistics.html" title="">Statistics</a></li>
            <li><a href="tables.html" title="" class="exp">Tables</a>
                <ul>
                    <li><a href="tables.html">Standard tables</a></li>
                    <li><a href="tables_dynamic.html">Dynamic tables</a></li>
                    <li><a href="tables_control.html">Tables with control</a></li>
                    <li><a href="tables_sortable.html">Sortable &amp; resizable</a></li>
                </ul>
            </li>
            <li><a href="other_calendar.html" title="" class="exp">Other pages</a>
                <ul>
                    <li><a href="other_calendar.html">Calendar</a></li>
                    <li><a href="other_gallery.html">Images gallery</a></li>
                    <li><a href="other_file_manager.html">File manager</a></li>
                    <li><a href="other_404.html">Sample error page</a></li>
                    <li><a href="other_typography.html">Typography</a></li>
                </ul>
            </li>
        </ul>
        <div class="clear"></div>
    </div>
    
</div>
<!-- Top line ends -->


<!-- Sidebar begins -->
<div id="sidebar">
    <div class="mainNav">
        <div class="user">
            <a title="<?=$nomeUser?>" class="leftUserDrop"><img src="<?=$imagemUser?>" width="72" height="70" alt="" /><span><strong>3</strong></span></a><span><?=$user->_get('nome')?></span>
            <ul class="leftUser">
                <li><a href="#" title="" class="sProfile">Minha conta</a></li>
                <li><a href="#" title="" class="sMessages">Mensagens</a></li>
                <li><a href="#" title="" class="sSettings">Configurações</a></li>
                <li><a href="#" title="" class="sLogout">Sair</a></li>
            </ul>
        </div>
        
        <!-- Responsive nav -->
      <div class="altNav">
            <!-- User nav -->
            <ul class="userNav">
                <li><a href="#" title="" class="profile"></a></li>
                <li><a href="#" title="" class="messages"></a></li>
                <li><a href="#" title="" class="settings"></a></li>
                <li><a href="?sair=true" title="" class="logout"></a></li>
            </ul>
        </div>
        
        <!-- Main nav -->
        <ul class="nav">
            <li><a href="?cat=cadastros" id="cadastros" title="Cadastros"><img src="images/icons/mainnav/ui.png" alt="" /><span>Cadastros</span></a>
                <ul>
                    <li><a href="?cat=cadastros&pg=clientes" title="" class="this"><span class="icos-admin"></span>Clientes</a></li>
                    <li><a href="?cat=cadastros&pg=fornecedor" title=""><span class="icos-users"></span>Fornecedores</a></li>
                    <li><a href="?cat=cadastros&pg=index.php" title=""><span class="icos-cart3"></span>Produtos</a></li>
                    <li><a href="?cat=cadastros&pg=vendedores" title=""><span class="icos-users2"></span>Vendedores</a></li>
                    <li><a href="?cat=cadastros&pg=usuarios" title=""><span class="icos-admin2"></span>Usuários</a></li>
                  <span id="sprytextarea1">
                    <textarea name="textarea1" id="textarea1" cols="45" rows="5"></textarea>
                    <span class="textareaRequiredMsg">Um valor é necessário.</span></span>
                </ul>
            </li>
            <li><a href="?cat=orcamentos&pg=orcamentos" title="Orçamentos"><img src="images/icons/mainnav/orcamento.png" alt="Orçamentos" /><span>Orçamento</span></a></li>
            <li><a href="?cat=os&pg=registro" title="Ordens de Serviços"><img src="images/icons/mainnav/dashboard.png" alt="Ordens de Serviços" /><span>OS's</span></a></li>
            <li><a href="?cat=relatorios&pg=home" title=""><img src="images/icons/mainnav/statistics.png" alt=""><span>Relatórios</span></a></li>
            <!--<li><a href="forms.html" title=""><img src="images/icons/mainnav/forms.png" alt="" /><span>Relatórios</span></a>
                <ul>
                    <li><a href="forms.html" title=""><span class="icol-list"></span>Inputs &amp; elements</a></li>
                    <li><a href="form_validation.html" title=""><span class="icol-alert"></span>Validation</a></li>
                    <li><a href="form_editor.html" title=""><span class="icol-pencil"></span>File uploader &amp; WYSIWYG</a></li>
                    <li><a href="form_wizards.html" title=""><span class="icol-signpost"></span>Form wizards</a></li>
                </ul>
            </li>
            <li><a href="messages.html" title=""><img src="images/icons/mainnav/messages.png" alt="" /><span>Messages</span></a></li>
            <li><a href="statistics.html" title=""><img src="images/icons/mainnav/statistics.png" alt="" /><span>Statistics</span></a></li>
            <li><a href="tables.html" title=""><img src="images/icons/mainnav/tables.png" alt="" /><span>Tables</span></a>
                <ul>
                    <li><a href="tables.html" title=""><span class="icol-frames"></span>Standard tables</a></li>
                    <li><a href="tables_dynamic.html" title=""><span class="icol-refresh"></span>Dynamic table</a></li>
                    <li><a href="tables_control.html" title=""><span class="icol-bullseye"></span>Tables with control</a></li>
                    <li><a href="tables_sortable.html" title=""><span class="icol-transfer"></span>Sortable and resizable</a></li>
                </ul>
            </li>
            <li><a href="other_calendar.html" title=""><img src="images/icons/mainnav/other.png" alt="" /><span>Other pages</span></a>
                <ul>
                    <li><a href="other_calendar.html" title=""><span class="icol-dcalendar"></span>Calendar</a></li>
                    <li><a href="other_gallery.html" title=""><span class="icol-images2"></span>Images gallery</a></li>
                    <li><a href="other_file_manager.html" title=""><span class="icol-files"></span>File manager</a></li>
                    <li><a href="#" title="" class="exp"><span class="icol-alert"></span>Error pages <span class="dataNumRed">6</span></a>
                        <ul>
                            <li><a href="other_403.html" title="">403 error</a></li>
                            <li><a href="other_404.html" title="">404 error</a></li>
                            <li><a href="other_405.html" title="">405 error</a></li>
                            <li><a href="other_500.html" title="">500 error</a></li>
                            <li><a href="other_503.html" title="">503 error</a></li>
                            <li><a href="other_offline.html" title="">Website is offline error</a></li>
                        </ul>
                    </li>
                    <li><a href="other_typography.html" title=""><span class="icol-create"></span>Typography</a></li>
                    <li><a href="other_invoice.html" title=""><span class="icol-money2"></span>Invoice template</a></li>-->
                </ul>
            </li>
        </ul>
    </div>
 <?
 	if(file_exists(getcwd().'/'.getPagina($_GET['cat']).'/nav-'.getPagina($_GET['cat']).'.php')){
		include getcwd().'/'.getPagina($_GET['cat']).'/nav-'.getPagina($_GET['cat']).'.php';
	}
 ?>
</div>
<!-- Sidebar ends -->
    
    
<!-- Content begins -->
<div id="content">
<? 
    if(isset($_GET['pg'])){
            if(file_exists(getcwd().'/'.getPagina($_GET['cat']).'/'.getPagina($_GET['pg']).'.php')){
                 include  getcwd().'/'.getPagina($_GET['cat']).'/'.getPagina($_GET['pg']).'.php';
            }else{
                include "home.php";
            }
    }else{ include "home.php"; }
?>
</div>
<!-- Content ends -->
</body>
</html>
