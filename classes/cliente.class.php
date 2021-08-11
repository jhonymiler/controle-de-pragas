<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 CREATE TABLE `cliente` (
    `PES_id` INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `PES_nome` VARCHAR( 200 ) NOT NULL ,
    `PES_rasao_social` VARCHAR( 200 ) NOT NULL ,
    `PES_cpf_cnpj` VARCHAR( 50 ) NOT NULL ,
    `PES_rg_ie` VARCHAR( 50 ) NOT NULL ,
    `PES_cep` VARCHAR( 200 ) NOT NULL ,
    `PES_rua` VARCHAR( 200 ) NOT NULL ,
    `PES_num` VARCHAR( 200 ) NOT NULL ,
    `PES_complemento` VARCHAR( 200 ) NOT NULL ,
    `PES_bairro` VARCHAR( 200 ) NOT NULL ,
    `PES_cidade` VARCHAR( 200 ) NOT NULL ,
    `PES_uf` VARCHAR( 2 ) NOT NULL ,
    `PES_tel1` VARCHAR( 200 ) NOT NULL ,
    `PES_tel2` VARCHAR( 200 ) NOT NULL ,
    `PES_fax` VARCHAR( 200 ) NOT NULL ,
    `PES_cel` VARCHAR( 200 ) NOT NULL ,
    `PES_email` VARCHAR( 200 ) NOT NULL ,
    `PES_classificacao` VARCHAR( 200 ) NOT NULL
    `PES_tipo` VARCHAR( 200 ) NOT NULL
) ENGINE = MYISAM ;
 * 
 * Instancia:
    $jonatas = new cliente;
    $jonatas->cliente->_busca('nome','jonatas');
    print_r($jonatas->cliente->_getReg('json'));

 */
/**
 * Description of cliente
 *
 * @author Jonatas
 */

class cliente{
    //put your code here
    public $erro;
    public $clientes;

    private $reg;// objeto Registro com todas as funções
    private $tabela = 'clientes';
    private $cliente;
    

    public function __construct($cliente = array()) {
        
        //constroi o objeto registro
        if(!class_exists("Registro")){
            require_once 'registro.class.php'; 
        }
        $this->reg = new Registro($this->tabela);
       
        /*----------------CONFIG USUARIO------------------*/
        // INICIA A CONFIGURAÇÃO BADICA
        $info = array(0=>array(
            'CLI_nome'  => 'Seu Nome',
            'CLI_email' => 'exemplo@email.com'
        ));
        $this->reg->_load($info);
        /*------------------------------------------------*/
        
        // se for array contiver mais registros do que 0
        if(is_array($cliente) && count($cliente) > 0){
            //carrega os dados no objeto registro
            $this->reg->_load($cliente);
            //grava na tabela
            $this->reg->_grava();
            
        }else{
            // se não, pega os argumentos passados pela função
            $args = func_get_args();
            if(func_num_args($args) > 0){
                // se maior que zero carrega a função select do objeto Registro e 
                call_user_func_array(array($this->reg,'_select'), func_get_args());
            }
            $this->erro .= $this->reg->_getErro();
            $this->reg->_getReg();
        }
    }
    
    public function _geraTabela($edit = true) {
        $reg = $this->reg->_select();
		for ($i = 0;$i < count($reg);$i++) {
			  $colum[$i][' '] = '<input type="checkbox" name="checkRow[]" value="'.$reg[$i]['CLI_id'].'" />';
			  $colum[$i]['Nome'] = $reg[$i]['CLI_nome'];
			  $colum[$i]['CPF:'] = $reg[$i]['CLI_cpf'];
			  $colum[$i]['Endereço'] = $reg[$i]['CLI_rua'].", ".$reg[$i]['CLI_num'].".<br> ".$reg[$i]['CLI_bairro']." ".$reg[$i]['CLI_cidade']."/".$reg[$i]['CLI_uf']."<br> CEP: ".$reg[$i]['CLI_cep'].
			  $colum[$i]['Fone'] = $reg[$i]['CLI_tel1'];
			  $colum[$i]['Cel.'] = $reg[$i]['CLI_cel'];
			  $colum[$i]['E-mail'] = $reg[$i]['CLI_email'];
			  if($edit = true){
				  $colum[$i]['Opções'] = '
						<ul class="btn-group toolbar">
							<li><a href="?cat=cadastros&pg=clientes&id='.$reg[$i]['CLI_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe1db;"></span></a></li>
							<li><a href="?cat=cadastros&pg=clientes&remove=true&id='.$reg[$i]['CLI_id'].'" class="tablectrl_small bDefault"><span class="iconb" data-icon="&#xe136;"></span></a></li>
						</ul> 
				  ';
					   
			  }
		}
		if(count($reg)>0){
			// constroi a tabela
			$tab = new tabela($colum);
			$tab->addAttr();
			  echo '
				  <div class="widget check">
					<div class="whead"> 
					  <span class="titleIcon">
					  <input type="checkbox" id="titleCheck" name="titleCheck" />
					  </span>
					  <h6>Lista de Clientes</h6>
					  <div class="clear"></div>
					</div>
					<div  class="dyn hiddenpars"> 
						<a class="tOptions" title="Options">
							<img src="images/icons/options.png" alt="" />
						</a>
						<form id="remover"  method="post" action="?cat=cadastros&pg=funcionarios&remove=true">
			  ';
			 if(is_object($tab)){
				 $tab->show();
			  }
			echo '
							<input type="submit" name="remover"  value="Remover Selecionados" class="buttonM grid6 bRed formSubmit">
					  </form>
					</div>
				</div>
			';
		}
		if(count($reg)>0){
			// constroi a tabela
			$tab = new tabela($colum);
	
			return $tab;
		}else{
			return false;
		}
    }


    public function _select() {
        $args = func_get_args();
        //print_r($args);
        $this->cliente = $this->_getFuncRegistro('_select',  $args);
        return $this->cliente;
    }
    
    public function _set() {
        $args = func_get_args();
        $this->_getFuncRegistro('_set',  $args);
        $this->cliente = $this->reg->_getReg();
    }
    
    public function _get() {
        $args = func_get_args();
        $reg = $this->reg->_getReg();
        if(func_num_args($args) == 1){
           $reg =  $reg[ $args[0] ];
        }
        return  $reg;
    }
    

    public function _grava(){
        $idAtual = $this->_get('CLI_id');
        if($this->_userExiste($idAtual)){
            return  $this->reg->_atualiza();
        }else{
            return  $this->reg->_grava();
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
    
    public function _listFisica() {
        
        return $this->cliente = $this->reg->_select('CLI_tipo','fisica');
    }
    
    public function _listJuridica() {
        
        return $this->cliente = $this->reg->_select('CLI_tipo','juridica');
    }

}