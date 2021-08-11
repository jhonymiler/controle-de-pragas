<?
	session_name("usuario");
	session_start();
	// classe auto inclue o arquivo da classe chamada, sem ter que escrever os includes
	Error_reporting (0);
	/*--------------CARREGA TODAS AS CLASSES----------------*/
	class ClassAutoloader {
		public function __construct() {
			spl_autoload_register(array($this, 'loader'));
		}
		private function loader($className) {
			$GLOBALS['FN_eventos'] = 'Carregado a classe '. $className. ' via '. __METHOD__. "()\n";
			require_once ('classes/'. strtolower($className) . '.class.php');
		}
	}
	// INICIA CARREGADOR AUTOMÁTICO DE CLASSES
	new ClassAutoloader;
	
	/*----------------CONFIG USUARIO------------------*/
	
	// CARREGA OBJ USUARIO
	$usuario = new usuario;
	/*----------------ESQUECE USUARIO----------------*/
//	if(isset($_REQUEST['esquecer'])){
//		if(is_array($usuario->_selectUser('FUN_token',$_COOKIE['TOKEN']))){
//			$usuario->_delToken();
//			$usuario->_grava();
//		}
//	}

/*-------------LOGIN------------*/
	if(isset($_REQUEST['login']))
	{
		if(!empty($_REQUEST['login'])&&!empty($_REQUEST['senha'])){
				// cria o objetos  logar
				$log = new Login;
				$log->logar($_REQUEST['login'], $_REQUEST['senha'],true);
				
				if(is_array($log->usuario)){
					$_SESSION['User'] = $log->usuario;
					if($_SESSION['User']['token'] == ''){
						//Principal::Redir("login.php?facebook=getAcess");
                                                Principal::Redir("index.php");
					}else{
						Principal::Redir("index.php");
					}
					
				}
				
		}else{
				Principal::Alert('Preencha corretamente os campos de login e senha!');
		}
	}
	
	
	if(isset($_GET['token']))
	{
		
		$_SESSION['User']['token'] = $_GET['token'];
		
		//Principal::Redir("classes/cookie/geratoken.php");
		Principal::Redir("index.php");
		// cria o objetos  logar
	}
	
	/*----------------CONFIG USUARIO------------------*/
	
	// CARREGA OBJ USUARIO
	$usuario = new usuario;
	
	// INICIA O CONFIG DO USUARIO BASICO
	$nomeUser  = $usuario->_get('FUN_nome');
	$emailUser = $usuario->_get('FUN_email');
	$imagemUser = $usuario->_getImagem();
	if(isset($_SESSION['User']['id'])){
                $usuario->_selectUser('FUN_id',$_SESSION['User']['id']);
		// CARREGA AS INFOS DO USUÁRIO EXISTENTE
		$nomeUser  = $usuario->_get('FUN_nome');
		$emailUser = $usuario->_get('FUN_email');
		//$imagemUser = $usuario->_getImagem();
	}
	
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<title>Painel de controle - Login</title>

<link href="css/styles.css" rel="stylesheet" type="text/css" />
<!--[if IE]> <link href="css/ie.css" rel="stylesheet" type="text/css"> <![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<script type="text/javascript" src="js/plugins/forms/ui.spinner.js"></script>
<script type="text/javascript" src="js/plugins/forms/jquery.mousewheel.js"></script>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>


<script type="text/javascript" src="js/plugins/ui/jquery.sourcerer.js"></script>
<script type="text/javascript" src="js/plugins/ui/jquery.easytabs.min.js"></script>
<script type="text/javascript" src="js/files/bootstrap.js"></script>
<script type="text/javascript" src="js/files/login.js"></script>
<script type="text/javascript" src="js/files/functions.js"></script>

</script>

</head>

<body>

<!-- Top line begins -->
<div id="top">
	<div class="wrapper">
    	<a href="#" title="" class="logo"><img src="images/logo.png"  alt="" /></a>
        
        <!-- Right top nav -->
        <div class="clear"></div>
    </div>
</div>
<!-- Top line ends -->


<!-- Login wrapper begins -->
<div class="loginWrapper">

	<!-- Current user form -->
    <?
	if($_GET['facebook'] == 'getAcess'){
//
//	$faceConfig = array(
//		  'appId'  => '125524540913473', // officeweb
//		  'secret' => 'ad5456e983032eac2a84215e384aecdf',
//		  'status'	=> true, // check login status.
//		  'cookie' 	=> true, // enable cookies to allow the server to access the session.
//		  'oauth' 	=> true, // enable OAuth 2.0.
//		  'xfbml' 	=> true, // parse XFBML.
//		  'fileUpload' => true
//	);
	?>
        <div id="fb-root"></div>
        <script type="text/javascript">
            var button;
            var userInfo;
 
            window.fbAsyncInit = function() {
                FB.init({ appId: '<?=$faceConfig['appId'];?>',
                    status: true,
                    cookie: true,
                    xfbml: true,
                    oauth: true,
					fileUpload : true
				});
 
 
               function updateButton(response) {
                    button       =   document.getElementById('fb-auth');
 
                    if (response.authResponse) {
                        //user is already logged in and connected
                        FB.api('/me', function(info) {
                            login(response, info);
                        });
 
                        button.onclick = function() {
                            FB.logout(function(response) {
                                logout(response);
                            });
                        };
                    } else {
                        //user is not connected to your app or logged out
                        button.innerHTML = '<span class="icon-facebook"></span><span>Conectar ao facebook</span>';
                        button.onclick = function() {
                            FB.login(function(response) {
                                if (response.authResponse) {
                                    FB.api('/me', function(info) {
                                        login(response, info);
                                    });
                                } else {
                                    //user cancelled login or did not grant authorization
                                }
                            }, {scope:'publish_stream,status_update,create_event,rsvp_event,email,user_about_me,user_birthday,user_education_history,user_likes,user_location,user_events,user_photos,user_videos,friends_events,publish_actions,user_actions:scribd-com'});
                        }
                    }
                }
 
                // run once with current status and whenever the status changes
                FB.getLoginStatus(updateButton);
                FB.Event.subscribe('auth.statusChange', updateButton);
            };
            (function() {
                var e = document.createElement('script'); e.async = true;
                e.src = document.location.protocol
                    + '//connect.facebook.net/pt_BR/all.js';
                document.getElementById('fb-root').appendChild(e);
            }());
 
            function login(response, info){
                if (response.authResponse) {
                    var accessToken                                 =   response.authResponse.accessToken;
					<?=(!isset($_GET['token']))?'window.location =\'login.php?token=\'+accessToken;':'alert("Entrando")';?>
// 
//                    userInfo.innerHTML                             = '<img src="https://graph.facebook.com/' + info.id + '/picture">' + info.name
//                                                                     + "<br /> Your Access Token: " + accessToken;
//                    button.innerHTML                               = 'Logout';
//                    showLoader(false);
//                    document.getElementById('other').style.display = "block";
                }
            }
 
            function logout(response){
				alert('Saindo');
                //userInfo.innerHTML                             =   "";
//                document.getElementById('debug').innerHTML     =   "";
//                document.getElementById('other').style.display =   "none";
//                showLoader(false);
            }
    </script>
    <form action="" method="post" id="login" class="login">
        <div class="loginPic">
            <a href="#" title="<?=$nomeUser;?>"><img src="<?=$imagemUser?>" width="105" heigth="106" alt="" /></a>
            <span><?=$nomeUser;?></span>
            <div class="loginActions">
               <div><a href="#" title="Trocar usuário" class="logleft flip"></a></div>
               <div><a href="?esquecer&time=<?=time()?>" title="Esquecer-me?" class="logright esquecerMe"></a></div>
            </div>
        </div>
        <div class="logControl">
            <a href="#" id="fb-auth" class="buttonM bBlue" ></a><br><br>
            <a href="index.php" class="buttonM bRed"><span class="icon-home"></span><span>Agora não</span></a>
            <div class="clear"></div>
        </div>
    </form>
    
    <? }else{?>
    <form action="" method="post" id="login" class="login">
        <div class="loginPic">
            <a href="#" title="<?=$nomeUser;?>"><img src="<?=$imagemUser?>" width="105" heigth="106" alt="" /></a>
            <span><?=$nomeUser;?></span>
            <div class="loginActions">
               <div><a href="#" title="Trocar usuário" class="logleft flip"></a></div>
               <div><a href="?esquecer&time=<?=time()?>" title="Esquecer-me?" class="logright esquecerMe"></a></div>
            </div>
        </div>
        <input type="text" name="login" placeholder="Seu e-email" class="loginEmail" value="<?=$emailUser;?>" />
        <input type="password" name="senha" placeholder="Senha" class="loginPassword" />
        <div class="logControl">
            <input type="submit" name="submit" value="Login" style="margin-right:20px;" class="buttonM bGreen" />
            <?=$face_link_login;?>             
            <div class="clear"></div>
        </div>
        <?=$faceButton;?>
    </form>
    <? }?>
    <!-- New user form -->
    <form action="" method="post" id="recover" class="login">
        <div class="loginPic">
            <a href="#" title=""><img src="images/userLogin2.png" alt="" /></a>
            <div class="loginActions">
                <div><a href="#" title="" class="logback flip"></a></div>
                <div><a href="#" title="Esqueceu a senha?" class="logright esqueceuSenha"></a></div>
            </div>
        </div>
        <input type="text" name="login" placeholder="Seu email" class="loginUsername" />
        <input type="password" name="senha" placeholder="Senha" class="loginPassword" />
        
        <div class="logControl">
            <input type="submit" name="submit" value="Login" style="margin:0 20px 0 15px;" class="buttonM bGreen" />
            <div class="clear"></div>
        </div>
    </form>

</div>
<!-- FACEBOOK JAVASCRIPT -->

</body>
</html>
