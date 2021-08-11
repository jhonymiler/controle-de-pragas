<?
/*
for($i=0;  $i<50; $i++){
	$html[$i]  = '<li>Item '.$i.'</li>';
}

$pg = new Paginacao;
$pg->Limit = 7;
$pg->num_pg = (int)$_GET[num];
$pg->html = $html;
$pg->paginar();

echo $pg->nav;

*/


class Paginacao{
	public  $Total   			= 50; // Total de arrays da variavel $this->html
	public  $Limit   			= 10; // Limite de registros por pagina
	public  $num_pg  			= ''; // Numero da pagina, padrão 1
	public  $html    			= array(); // $this->html[x] = '<li>....</li>';
	public  $inicio  			= 0;
	public  $ate     			= ''; 
	public  $num_links  		= 7; 
	public  $paginas 			= ''; // numero de paginas geradas
	public  $do_link		 	= ''; // parametro inicial do FOR dos links
	public  $ate_link	 		= ''; // parametro final do FOR dos links
	public  $nav	 			= ''; // html gerado para navegação
	public  $style	 			= 'padrao'; // estilo css contido no arquivo style.css
	public  $get	 			= 'num'; // nome do get
	public  $getHtml			= '';
	
	
	// carrega e verifica os valores das propriedades
	private function carregarDados(){
		if (!is_numeric($this->num_pg) or empty($this->num_pg)){
			$this->num_pg = 1;
		}
		if(!is_numeric($this->Limit)){
			echo 'Determine o limete por pagina com a variavel $var->Limit';
		}
		else
		{
			// ex: num_pg = 2 + Limit = 10 ==> inicio = 20 , começa a paginação do item 20
			$this->inicio = (($this->num_pg -1) * $this->Limit); 
			
			// e vai até: Limit = 10 + inicio = 20 ==> 30, ou seja vai do item 20 até o item 30
			$this->ate = $this->inicio + $this->Limit; 
			// $this->html deve ser um array
			if(is_array($this->html)){
				//Conta o quantidade de arrays (registros)
				$this->Total = count($this->html);
				//caucula o total de paginas
				$this->paginas = ceil($this->Total/$this->Limit);
			}
			else{ echo 'Os itens devem estar dentro de um array;'; }
		}
	}
	
	
	function paginar(){
		$this->carregarDados();
		for($i = $this->inicio; $i < $this->ate; $i++){
			$this->getHtml .=  $this->html[$i];
		}
	  	if($this->paginas>1)
		{
			if(count($_GET)>0){
				$p = 0;
				$string[$p]= '?';
				foreach($_GET as $key=>$val){
					if($key != $this->get){
						$string[$p]= $key.'='.$val;
						$p++;
					}
				}
				$get_string = implode('&',$string);
			}
			else { $get_string = '?'; }
			
			$url = $_SERVER['PHP_SELF'].$get_string.$this->get.'=';
			$this->nav .= "<ul id='pages' class='".$this->style."'>";
			
			if ($this->num_pg>1)
			{
				$this->nav .= "<li id='prev'><a href='".$url. ($this->num_pg-1) ."' > << Anterior</a></li> ";
			}
			
			// se numero de paginas geradas for maior ou igual ao numero de links... diminui o numero de links
			if($this->num_links >= $this->paginas){$this->num_links = $this->paginas-1;}
			// Calcula o inicio e fim do ciclo dos links
			$this->do_link = $this->num_pg - floor($this->num_links/2);
			$this->ate_link = $this->num_pg + floor($this->num_links/2);
			
			/* Define manualmente o inicio e fim do ciclo se
			   estivermos nas primeiras ou ultimas paginas */
			
			if ($this->do_link < 1) {
					$this->do_link = 1;
					$this->ate_link = $this->num_links;
			} else if ($this->ate_link > $this->paginas) {
					$this->do_link = $this->paginas - $this->num_links;
					$this->ate_link = $this->paginas;
			} else {
					/* Incrementa 1 valor ao inicio do ciclo se o numero de links
					   for par, caso contrario iremos ter um link a mais */
			
					if (!($this->num_links%2)) {
							$this->ate_link++;
					}
			}
			// Calcula se o numero de paginas for maior que o numero limite de link
			// Mostra o link da primeira pagina
			if ($this->num_pg > $this->num_links+2)
			{
				$this->nav .= "<li><a href='".$url."'>1...</a></li> ";
			}
			
			// Faz o looping dos links sempre mantendo apenas um bloco de links
			// seguindo aquantidade limite de botões do link $this->num_links;
			for ($cont = $this->do_link; $cont <= $this->ate_link; $cont++)
			{
				if ($cont==$this->num_pg)
				{
					$this->nav .= "<li><a  class='active' href='".$url. $cont ."' >".$cont." </a></li> ";
				}
				else
				{ 
				
					$this->nav .= "<li><a href='".$url. $cont ."'> $cont</a></li> ";
				}
			}
			// Calcula se o numero de paginas for maior que o limite de links
			// Mostra o link da última pagina
			if ($this->ate_link+2 < $this->paginas)
			{
				$this->nav .= "<li><a href='".$url. ($this->paginas) ."'>...".$this->paginas."</a></li> ";
			}
			
			if ($this->num_pg<$this->paginas)
			{
				$this->nav .= "<li id='next'><a href='".$url. ($this->num_pg+1) ."'> Pr&oacute;ximo >></a></li><br style='clear:both;'> ";
			}
			$this->nav .= "</ul>";
		}
	}
	
}
