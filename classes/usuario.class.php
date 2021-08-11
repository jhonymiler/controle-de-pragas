<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of usuario
 *
 * @author Jonatas
 */

class usuario{
    //put your code here
    public $erro;

    private $reg;// objeto Registro com todas as funções
    private $tabela = 'funcionarios';
    private $usuario;

    public function __construct($usuario = array()) {
        
        //constroi o objeto registro
        if(!class_exists("Registro")){
            require_once 'registro.class.php'; 
        }
        $this->reg = new Registro($this->tabela);
       
        /*----------------CONFIG USUARIO------------------*/
        // INICIA A CONFIGURAÇÃO BADICA
        $info = array(
            'FUN_nome'  => 'Seu Nome',
            'FUN_email' => 'exemplo@email.com'
        );
        $this->reg->_load($info);

        /*------------------------------------------------*/
        
        // se for array contiver mais registros do que 0
        if(is_array($usuario) && count($usuario) > 0){
            //carrega os dados no objeto registro
            $this->reg->_load($usuario);
            //grava na tabela
            $this->reg->_grava();
            
        }else{
            // se não, pega os argumentos passados pela função
            $args = func_get_args();
            if(count($args)>0){
                // se maior que zero carrega a função select do objeto Registro e 
                call_user_func_array(array($this->reg,'_select'), func_get_args());
            }
            $this->erro .= $this->reg->_getErro();
        }
    }
    
    public function _selectUser() {
        $args = func_get_args();
        //print_r($args);
        $this->usuario = $this->_getFuncRegistro('_select',  $args);
        return $this->usuario;
    }
    
    public function _set() {
        $args = func_get_args();
        $this->_getFuncRegistro('_set',  $args);
        $this->usuario = $this->reg->_getReg();
    }
    
    public function _get() {
        $args = func_get_args();
        $reg = $this->reg->_getReg();
        if(count($args) == 1){
           $reg =  $reg[ $args[0] ];
        }
        return  $reg;
    }
    
    
    // Determina o id do Facebook
    public function _setFacebookId($idFacebook){
        $this->reg->_set('FUN_facebook',$idFacebook);
    }
    
    //pega a imagem do usuário
    public function _getImagem(){
        $reg = $this->reg->_getReg();
        if(is_array($reg)){
            $faceIdUser= '';
            if($faceIdUser == ''){
                $imagemUser = 'images/userLogin2.png';
            }else{
                $imagemUser = 'https://graph.facebook.com/'.$this->_get('FUN_facebook').'/picture';
            }
        }else{
            $imagemUser = 'images/userLogin2.png';
        }
        return $imagemUser;
    }
    
    

    public function _grava(){
        $idAtual = $this->_get('FUN_id');
        if($this->_userExiste($idAtual)){
            return  $this->reg->_atualiza();
        }else{
            return  $this->reg->_grava();
        }
    }
    
    
    private function _userExiste($id){
        $usuarioExiste = new registro($this->tabela);
        $user = $usuarioExiste->_select($id);
        if(is_array($user) && count($user) > 0){
            return true;
        }else{
            return false;
        }
    }
    
    
   private function _getFuncRegistro() {
        $args = func_get_args();        
        $func = $args[0];
        unset($args[0]);
        $argumentos = $args[1];
       // print_r($func);
        return  call_user_func_array(array($this->reg,$func), $argumentos);
    }
 
    
    // pega os erros do mysql;
    public function _getErro() {
        return $this->erro .= $this->reg->_getErro();
    }
    
    public function _validToken($token) {
        if(md5( $this->_get('FUN_email') ) == $token){
            return true;
        }  else {
            return false;
        }
    }
    
    // gera um token
    public function _setToken($TOKEN) {        
        $this->_set('FUN_token',$TOKEN);
    }
    
    // deleta o token
    public function _delToken(){
        $this->_set('FUN_token',md5('falso'));
    }
}
//$array = array(
//    "nome"=>"Rafel",
//    "email"=>"jonatas@officeweb.com.br",
//    "facebook"=>"jonatas.m.o"
//);
//$user = new usuario(10);
//print_r($user);
//$user->_selectUser('login','asdf');
//
//$user->_set("nome","amborsio");
//print_r($user->_get('nome'));

//print_r($user);



