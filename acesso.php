<?

session_name("usuario");
session_start();
define('DS', DIRECTORY_SEPARATOR);
Error_reporting (0);
/* CONGIF  */

// caminho absoluto, raiz do sistema
$config = array(
    'RAIZ' => realpath(dirname(__FILE__)) . '/', // deve terminar com '/' (barra)
    'ERRO', //para iniciar a SESSION ERRO
    'URL' => 'http://localhost/sistemas/ratos/'
);

foreach ($config as $key => $val) {
    $_SESSION[$key] = $val;
}

// classe auto inclue o arquivo da classe chamada, sem ter que escrever os includes
class ClassAutoloader {

    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
    }

    private function loader($className) {
        $GLOBALS['FN_eventos'] = 'Carregado a classe ' . $className . ' via ' . __METHOD__ . "()\n";
        $class = $_SESSION['RAIZ'] . 'classes/' . strtolower($className) . '.class.php';
        if (file_exists($class)) {
            include $class;
        } else {
            $_SESSION['ERRO'] .= 'classe ' . $className . ' NÃO pode ser carregada via ' . __METHOD__ . "()\n";
        }
    }

}

// INICIA CARREGADOR AUTOMÁTICO DE CLASSES
new ClassAutoloader;

/* ----------------CONFIG USUARIO------------------ */

// CARREGA OBJ USUARIO
$user = new usuario;

// INICIA O CONFIG DO USUARIO BASICO
$nomeUser = $user->_get('FUN_nome');
$emailUser = $user->_get('FUN_email');
$imagemUser = $user->_getImagem();
/* ------------------------------------------------ */

$faceConfig = array(
    'appId' => '125524540913473', // krav-maga
    'secret' => 'ad5456e983032eac2a84215e384aecdf',
    'status' => true, // check login status.
    'cookie' => true, // enable cookies to allow the server to access the session.
    'oauth' => true, // enable OAuth 2.0.
    'xfbml' => true, // parse XFBML.
    'fileUpload' => true
);

// App Office Web
$_SESSION['facebook'] = new Facebook($faceConfig);
$_SESSION['facebook']->setFileUploadSupport(true);
$_SESSION['facebookScope'] = array(
    'scope' => 'publish_stream,status_update,create_event,rsvp_event,email,user_about_me,user_birthday,user_education_history,user_likes,user_location,user_events,user_photos,user_videos,friends_events,publish_actions,user_actions:scribd-com'
);

// VERIFICA LOGIN
if (!isset($_SESSION['User'])) {
    if (!empty($_COOKIE['TOKEN'])) {
        if (is_array($user->_selectUser('FUN_token', $_COOKIE['TOKEN']))) {

            // INICIA O CONFIG DO USUARIO BASICO
            $_SESSION['User'] = array(
                'id' => $user->_get('FUN_id'),
                'nome' => $user->_get('FUN_nome'),
                'email' => $user->_get('FUN_email'),
                'facebook' => $user->_get('FUN_facebook'),
                'token' => $user->_get('FUN_token'),
                'TTT' => 0, //tentativas de acesso. "variavel desativado"
                'H' => date("d/m/Y  H:i:s")
            );

            $nomeUser = $user->_get('FUN_nome');
            $emailUser = $user->_get('FUN_email');
            $imagemUser = $user->_getImagem();
        }//endIf
    } else {
        Principal::Redir("login.php");
        exit();
    }
}

if ((empty($_SESSION['User'])) || ($_SESSION['User']['TTT'] > 2)) {
    Principal::Redir("login.php");
    exit;
} else {

    if (is_array($user->_selectUser('FUN_id', $_SESSION['User']['id']))) {

        //$_SESSION['facebook']->setAccessToken($_SESSION['User']['token']);
        // See if there is a user from a cookie
        //$userFace = $_SESSION['facebook']->getUser();
//        if ($userFace && ($_SESSION['User']['token'] != $user->_get('FUN_token'))) {
//            try {
//                // Prossiga sabendo que você tem um usuário logado que está autenticado.
//                $user_profile = $_SESSION['facebook']->api('/me');
//                if ($user_profile > 0) {
//                    $_SESSION['User']['facebook'] = $user_profile['id'];
//                    $user->_setFacebookId($user_profile['id']);
//                    $user->_setToken($_SESSION['User']['token']);
//                    $user->_grava();
//
//                    $nomeUser = $user->_get('FUN_nome');
//                    $emailUser = $user->_get('FUN_email');
//                    $imagemUser = $user->_getImagem();
//                }
//            } catch (FacebookApiException $e) {
//                $_SESSION['ERROS'] .= $e->getMessage();
//                $user = null;
//            }
//        } else {
//            // INICIA O CONFIG DO USUARIO BASICO
//            $nomeUser = $user->_get('FUN_nome');
//            $emailUser = $user->_get('FUN_email');
//            $imagemUser = $user->_getImagem();
//        }

        $dataSalva = $_SESSION['User']['H'];
        $agora = date("d/m/Y  H:i:s");
        $tempo_transcorrido = (strtotime($agora) - strtotime($dataSalva));

        //comparamos o tempo transcorrido 
        if ($tempo_transcorrido >= 15000) {
            //se passaram 10 minutos ou mais 
            session_destroy(); // destruo a sessão 
            Principal::Alert('Sua Sessão Expirou. Por Favor Refaça o Login');
            Principal::Redir('login.php');
            //envio ao usuário à página de autenticação 
            //senão, atualizo a data da sessão 
        } else {
            $_SESSION['H'] = $agora;
        }
    } else {
        unset($_SESSION['User']);
        Principal::Redir();
    }
}


if (!empty($_GET['sair'])) {
    $login = new Login;
    $login->sair();
}


/* ----------------------------TOOLS----------------------------- */

function dataFiltro($data) {//$data = yyyy-mm-dd
    if (strpos($data, '-')) {
        return implode('/', array_reverse(explode('-', $data)));
    }
    if (strpos($data, '/')) {
        return implode('-', array_reverse(explode('/', $data)));
    }
}

function autoSelect($array) {

    if (!is_array($array)) {
        return false;
    }
    $associative = count(array_diff(array_keys($array), array_keys(array_keys($array))));
    if ($associative) {
        $construct = array();
        foreach ($array as $key => $value) {
            // Primeiro Copiamos cada par chave/valor em uma matriz de estacionamento
            // formatando cada chave e valor adequadamente
            // Formatando a chave
            if (is_numeric($key)) {
                $key = "key_$key";
            }

            $key = "\"" . addslashes($key) . "\"";

            // Formatando o valor
            if (is_array($value)) {
                $value = autoSelect($value);
            } else if (!is_numeric($value) || is_string($value)) {
                $value = "\"" . addslashes($value) . "\"";
            }

            // Add para o array estacionário:
            $construct[] = "$key: $value";
        }


        // Então convertemos o array estácinário no formato JSON
        $result = json_encode($construct);
    } else { // Se o array for um vetor (não associativo):
        $construct = array();
        foreach ($array as $value) {

            // Formata Valor:
            if (is_array($value)) {
                $value = autoSelect($value);
            } else if (!is_numeric($value) || is_string($value)) {
                $value = "'" . addslashes($value) . "'";
            }

            // Add para o array estacionário:
            $construct[] = $value;
        }

        // Então convertemos o array estácinário no formato JSON
        $result = json_encode($construct);
    }

    return $result;
}

function getPagina($pagina) {
    //Verifica se há algum dessas estenções ou comandos no get, se houver redireciona para a pagina principal
    if (!preg_match("/(http|www|ftp|.dat|.txt|wget|.exe|.php|.asp|.aspx|.html|select|update|delete|drop|truncate|order)/", strtolower(addslashes($pagina))) == true) {
        return ($pagina);
    }
    return false;
}

// adiciona widget para visualização de codigo. ex: print_r($_POST)
function wgCode($code, $titulo = '') {

    //pega print
    ob_start();
    print_r($code);
    $code = ob_get_contents();
    ob_get_clean();
    $titulo = empty($titulo) ? "Visualização de código" : $titulo;
    $codigo = '
        <!-- Syntax highlighter widget -->
	<div class="widget">
            <div class="whead hand closed normal">
                <h6>' . $titulo . '</h6>
                <a href="#" class="buttonH bBlue" title="">botao</a>
                <div class="clear"></div>
            </div>
            <pre class="code">' . $code . '</pre>
	</div>';

    return $codigo;
}

function exibe($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function utf8_encode_deep(&$input) {
    if (is_string($input)) {
        $input = utf8_encode($input);
    } else if (is_array($input)) {
        foreach ($input as &$value) {
            utf8_encode_deep($value);
        }

        unset($value);
    } else if (is_object($input)) {
        $vars = array_keys(get_object_vars($input));

        foreach ($vars as $var) {
            utf8_encode_deep($input->$var);
        }
    }
}

function utf8_decode_deep(&$input) {
    if (is_string($input)) {
        $input = utf8_decode($input);
    } else if (is_array($input)) {
        foreach ($input as &$value) {
            utf8_decode_deep($value);
        }

        unset($value);
    } else if (is_object($input)) {
        $vars = array_keys(get_object_vars($input));

        foreach ($vars as $var) {
            utf8_decode_deep($input->$var);
        }
    }
}

function getMsg($msg, $tipo = 'sucesso') {
    switch ($tipo) {
        case 'sucesso':
            $tipo = 'nSuccess';
            break;
        case 'erro':
            $tipo = 'nFailure';
            break;

        case 'info':
            $tipo = 'nInformation';
            break;

        case 'alerta':
            $tipo = 'nWarning';
            break;

        default:
            break;
    }
    $mensagem = '
        <div class="nNote ' . $tipo . '">
                <p>' . $msg . '</p>
        </div>                    
    ';

    return $mensagem;
}
