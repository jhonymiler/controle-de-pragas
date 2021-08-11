<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of request
 *
 * @author Jonatas
 */

class request {
  private $params = Array();
  private $tipo = '';

  public function __construct() {
    $this->_parseParams();
  }

  /**
    * @param string $name Nome do argumento para visualização
    * @param mixed $default Retorna vazio se não existir a requisição pedida
    * @returns Retorna todos os valores GET/POST/PUT/DELETE , ou Deflt como vazio
    */
  public function get($name = null) {
    if (isset($this->params[$name])) {
      $this->params[$name] = scape($this->params[$name]);
      return $this->params;
    }
  }
  
  /*
   * Escapa as entradas
   */
  private function scape($param) {
      foreach($param as $key=>$val){
            if(is_array($param[$key])){
                foreach($param[$key] as $key2=>$val2){
                    $param[$key][$key2]=addslashes($val2);
                }
            }else{
                $param[$key]=addslashes($val);
            }
	}
        return  $param;
  }


  /**
   * Pega o tipo da requisição para análise posterior
   */
  public function getType() {
      return $this->tipo;
  }

  private function _parseParams() {
    $method = $_SERVER['REQUEST_METHOD'];
    switch($_SERVER['REQUEST_METHOD']){
            case 'GET': 
                $this->params = $_GET;
                $this->tipo = 'GET';
                    break; 
            case 'POST': 
                $this->params = $_POST;;
                $this->tipo = 'POST'; 
                    break;
            case 'PUT':	
                parse_str(file_get_contents('php://input'), $this->params);;
                $this->tipo = 'PUT'; 
                    break; 
            case 'DELETE': 
                parse_str(file_get_contents('php://input'), $this->params);;
                $this->tipo = 'DELETE'; 
                    break; 
    }
  }
}



