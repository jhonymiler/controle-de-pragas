<?
class Login {
    
    public $usuario;
    
    protected $user = false;
    private $erros = array();


    public function __construct() {
        $this->user = new usuario;
    }


    function logar($login,$pass,$permanecer = false){
       

        if($this->user->_selectUser("FUN_email",$login)){
//            echo "<pre>";
//            print_r($this->user);
//            echo "</pre>";
            if($this->user->_get('FUN_senha') == md5($pass)){
                // se a senha for verdadeira
                $this->usuario = array(
                    'id'         => $this->user->_get('FUN_id'),
                    'nome'       => $this->user->_get('FUN_nome'),
                    'email'      => $this->user->_get('FUN_email'),
                    'facebook'   => $this->user->_get('FUN_facebook'),
                    'TTT'        => 0, //tentativas de acesso. "variavel desativado"
                    'H'          => date("d/m/Y  H:i:s")
                );
//                // gera o token para o everCookie
//                if($permanecer == true){
//                    $token = md5($this->usuario['FUN_email']);
//                    $this->user->_setToken($token);
//                    $this->user->_grava();
//                    $this->usuario['token'] = $this->user->_get('FUN_token');
//                }

            }
            else
            {
                $this->setErro($i++, "Senha Incorreta.", '');
				Principal::Alert('Senha Incorreta.');
				Principal::Voltar();
				
                exit();
            }

        }
        else
        {
            $this->setErro($i++, "Usuário não exite!", '');
			Principal::Alert('Usu&aacute;rio n&atilde;o exite!');
			Principal::Voltar();
            exit();
        }

    }
    
    
    // passa os erros para a variavel $this->erro
    private function setErro($no,$msg,$realErro) {
        return $this->erros = array('num'=>$no, 'msg'=>$msg, 'realErro'=>$realErro);
    }

    public function erros(){
        print_r($this->erros);
    }

        public function sair() {
        // desfaz a sessão e o token
        unset($_SESSION['User']);
        session_destroy();
        //REDIRECIONAMOS PARA PÁGINA DE LOGIN
        if(!isset($_SESSION['User'])){
            header("location:login.php?esquecer=true");
            exit;
        }

    }
	
}
