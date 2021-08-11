<?
session_name("usuario");
session_start();
clearstatcache(); 


// classe auto inclue o arquivo da classe chamada, sem ter que escrever os includes
class ClassAutoloader {
	public function __construct() {
		spl_autoload_register(array($this, 'loader'));
	}
	private function loader($className) {
		$GLOBALS['FN_eventos'] = 'Carregado a classe '. $className. ' via '. __METHOD__. "()\n";
		include 'classes/'. strtolower($className) . '.class.php';
	}
}

if($_POST){
	foreach($_POST as $key=>$val){
		if(is_array($_POST[$key])){
			$i=0;
			foreach($_POST[$key] as $val2){
				$_POST[$key][$i]=addslashes($val2);
				$i++;
			}
		}
		else
		{
			$_POST[$key]=addslashes($val);
		}

	}
	
	
}
$autoloader = new ClassAutoloader();
if(isset($_REQUEST[fieldId])){

	$r = new Registro($_REQUEST[nomeTabela]);
	$CampoEmail = $r->_addPrefixo($_REQUEST[fieldId]);
	$email = $r->_select($CampoEmail, $_REQUEST[fieldValue]);
	if(is_array($email)){
		echo '["'.$_REQUEST[fieldId].'",false,"existeEmail"]';
	}else{
		echo '["'.$_REQUEST[fieldId].'",true]';
	}
}




