<?
class tabela{
// cria tag tabela
    private $tabela;
    private $tbody;
    private $thead;
	private $attr = array(
		'cellpadding' => 0,
		'cellspacing' => 0,
		'width'       => "100%",
		'class'       => "tDefault checkAll tMedia dTable"
	);
   
    
    public function __construct($array,$pref_idLinha = 'linha'){
		
        // cria o html da tabela 
        $this->tabela = new html('table');
		
        // cria o html cabeçalho e corpo
        $this->thead = new html('thead');
        $this->tbody = new html('tbody');
        
        // gera head
        $colunas = array_keys($array[0]);
        $this->thead->add($this->geraThead($colunas));
        
        // gera body
        $this->geraTbody($array,$pref_idLinha);
        
    }
	
	// Adicionar atributos a tabela
	public function addAttr(){
		// pega os argumentos passados para este metodo
        $args = func_get_args();
		
		 switch (isset($args)) {
            // se não hover argumentos adiciona os atributos pré-definidos
            case func_num_args() == 2:
                $attr = array($args[0],$args[1]); // array de atributos padrão
                break;
            case (func_num_args() == 1) && is_array($args[0]):
                $attr = $args[0]; // array de atributos padrão
                break;
			default:
                $attr = $this->attr; // array de atributos padrão
                break;
				
		}
		foreach($attr as $at => $val){
			$this->tabela->$at = $val;
		}
	}
	
    // mostra todos os htmls gerado
    public function show(){
        $this->tabela->add($this->thead);
        $this->tabela->add($this->tbody);
		
        return $this->tabela->show();
    }
	
	// gera a linha do cabeçalho e o cabeçalho propriamente dito
    private function geraThead($campos){
        $tr = new html('tr');
        foreach ($campos as $valor) {
           $td = new html('td');
           $td->add($valor);
           $td->class = 'sortCol';
           $tr->add($td);
        }
        return $tr;
    }
	// gera a linha do corpo da tabela e o corpo propriamente dito
    private function geraTbody($campos,$linha){
       
       for($i = 0; $i< count($campos); $i++){
           $tr = new html('tr');
		   $tr->id = $linha.'_'.$i;
		   $tr->class = $linha;
            foreach ($campos[$i] as $campo=>$valor) {
                $td = new html('td');
                $td->add($valor);
                $tr->add($td);
            }
           $this->tbody->add($tr);
       }
    }
}		