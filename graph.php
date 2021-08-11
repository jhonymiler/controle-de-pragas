<?
class ClassAutoloader {
	public function __construct() {
		spl_autoload_register(array($this, 'loader'));
	}
	private function loader($className) {
		$GLOBALS['FN_eventos'] = 'Carregado a classe '. $className. ' via '. __METHOD__. "()\n";
		include 'classes/'. strtolower($className) . '.class.php';
	}
}

// INICIA CARREGADOR AUTOMÁTICO DE CLASSES
new ClassAutoloader;

$pessoa = new cliente;
print_r($pessoa->_geraTabela());