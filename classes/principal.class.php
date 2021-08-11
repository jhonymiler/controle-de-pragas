<?	
class Principal extends Conexao
{
	public $Raiz = '';
	public $TIPO = array( '', 
						  'artigos'=>"Artigos", 
						  'noticias'=>"Galeria de Imagens", 
						  'notas'=>"Notas", 
						  'texto-longo'=>"Somente Texto",
						  'noticias'=>"Not&iacute;cais", 
						  'parceiros'=>"Parceiros", 
						  'videos'=>"V&iacute;deos",
						  'galerias'=>"Galeria de Imagem",
						  'agenda'=>"Agenda",
						  'vitrine'=>"Vitrine",
						  'galeria-background'=>"Imagens/Backgrounds"
						  
	);
	public $MODO = array('',"&Uacute;nico", "Multiplos" );
							
	public $Pagina = array("index","configuracoes","users","conteudo","forms","agenda","eventos",
	"audio","dowloads","equipe","menus","secoes","subsecoes","conteudo","fixar","depoimentos","acesso", "galerias", "banco_imgs", "banco_imgs_cadastrar", "banco_imgs_excluir", "bkp", "check", "class", "configuracao", "configuracoes", "conteudo", "galeria", "conteudo_excluir_arquivo", "conteudo_excluir_arquivo2", "conteudo_excluir_arquivo3", "perfil", "noticias", "links", "notas", "parceiros", "css", "depoimentos", "fixar", "agenda", "artigos", "audio", "audio_simples", "downloads", "equipe", "galerias", "galeria_imagem", "links", "noticias", "quem-somos", "vitrine", "perfil", "produtos", "publicidade", "videos", "funcao_backup", "funcao_zip", "galeria", "icones", "icones_permissao", "icones_pleno", "noticias", "index", "login", "menus", "galeiras", "minha_conta", "pedidos", "pedidos_excluir", "pedidos_operacoes", "pedidos_visualizar", "permissao", "programacao", "programacao_excluir", "contato", "recados_excluir", "recados_noticias", "relatorio", "sair", "secoes", "artigo", "noticias", "subsecoes", "subsecoes_excluir", "subsecoes_lista","texto-longo","blog","conteudo", "contato", "usuario", "usuario_acesso","portfolio", "usuario_administrar", "usuario_administrar1", "usuario_excluir", "usuario_inserir", "usuario_logar", "usuario_status", "visitas","galeria-background"
,'home');

	public $config = array();
	
	public function getConfig(){
		$config = GerConteudo::Sel(' configuracoes',false,false);
		return $config[0];
	}
	
	static function getData(){
		$meses = array (
						1 => "Janeiro", 
						2 => "Fevereiro", 
						3 => "Março", 
						4 => "Abril", 
						5 => "Maio", 
						6 => "Junho", 
						7 => "Julho", 
						8 => "Agosto", 
						9 => "Setembro", 
						10 => "Outubro", 
						11 => "Novembro", 
						12 => "Dezembro"
		);
		$diasdasemana = array (
						1 => "Segunda-Feira",
						2 => "Terça-Feira",
						3 => "Quarta-Feira",
						4 => "Quinta-Feira",
						5 => "Sexta-Feira",
						6 => "Sábado",
						0 => "Domingo"
		);
		 $hoje = getdate();
		 $dia = $hoje["mday"];
		 $mes = $hoje["mon"];
		 $nomemes = $meses[$mes];
		 $ano = $hoje["year"];
		 $diadasemana = $hoje["wday"];
		 $nomediadasemana = $diasdasemana[$diadasemana];
		 echo "$nomediadasemana, $dia de $nomemes de $ano";						
	}
	function GravaConfig($camposevalores){
		$gravar = new GerConteudo;
		$grava = $gravar->Atualiza('configuracoes',$camposevalores,array('CONF_id'=>1),false);
		return $grava; // true ou false
	}

	function getUrl() {
	  $current_url = $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
	  return $current_url;
	}	

	function GeraMenu($menu){
		if(count($menu)>0){
			
			echo "<script>Arredonda();</script>";
			
			foreach($menu as $pagina => $texto){
				echo "<li onclick=Pagina('".$pagina."')>".$texto."</li>";
			}
			
		}
	}
							
	public static function Alert($texto){
		echo "<script>alert('".$texto."');</script>";		
	}
	public static function Redir($caminho){
		echo "<script>window.location = '".$caminho."';</script>";
	}
	public static function Voltar(){
		echo "<script>javascript:history.back(1)</script>";
	}
        public static function Abrir($caminho){
		echo "<script>window.open('".$caminho."');</script>";
	}
	public static function  TRATAR($texto)// Metodo Tratar Texto
	{
		$srting = addslashes($texto);
		return $srting;
	}
	
	//Tratar ids numéricas
	public static function TRATAR_ID($texto)
	{
		$texto_certo = 	addslashes($texto);// retira as possiveis aspas
		if(is_numeric($texto_certo))// verifica se realmente é um número
		{
			return $texto_certo;// retonra a variavel tratada
		}
		else
		{
			echo $this->Redir("index.php");
			exit();
	
		}
	}
	
	function URL($texto)//Metodo Tratar URL 
	{
		return $texto_certo = addslashes($texto);// retira as possiveis aspas
	}
	
	function AbrirPagina($pagina,$tipo = 'site'){// função que trata o get antes de abrir a pagina
	  $config = self::getConfig();
	  $raiz = $config['CONF_raiz'];
	  define('RAIZ', getcwd()); // pega caminho da pasta onde a função AbrirPagina
	  define('NEGADO',"<script>alert('Acesso Negado'); window.location='index.php';</script>");
		
	  if($pagina)// Se a variavel pagina estiver setada...
	  {
	  	$pagina = $this->TRATAR($pagina);// Trata a variavel com addslashes
	  	$arquivos = $this->Pagina;
		  
		if(preg_match("/(http|www|ftp|.dat|.txt|wget|.exe|.php|.asp|.aspx|.html|select|update|delete|drop|truncate|order)/", strtolower($pagina)) == true)
		{   //Verifica se há algum dessas estenções ou comandos no get, se houver redireciona para a pagina principal

			echo NEGADO;
			exit();
		}
		else
		{	// Se não... Verifica se o get, existe na relação de arquivos	
		
			if(array_search($pagina, $arquivos))
			{
				//echo (RAIZ.'admin/forms/'.$pagina.".php");
				if($tipo == 'site' && file_exists( RAIZ.'/'.$pagina.".php")){
					//Verifica se é um arquivo realmente, se não... vai para o index	
					return  RAIZ.'/'.$pagina.".php";
				}
				elseif($tipo == 'admin' && file_exists( RAIZ.'/forms/'.$pagina.".php")){
					return RAIZ.'/forms/'.$pagina.".php";
				}
				else
				{
					echo RAIZ.'/forms/'.$pagina.".php";
					//echo NEGADO;
					exit();
				}
			
			} else 
			{
				//echo NEGADO;
				exit();
			
			}
		}
	  }
	  
	  // se tudo der certo retorna o get
	}// Fim AbrirPagina
	
	
//		function Log($tabela = Null,$ultID,$acao){
//			// Grava os dados e a ação do aministrador
//			 $gravação = $this->Gravar("log",array($_SESSION[AdminID],date("Y-m-d H:i:s"),addslashes($acao)));
//			 $ultimoID = mysql_insert_id();
//
//			 
//			 if($tabela != Null){
//				 $prefixo = strtoupper(substr($tabela,0,3))."_id";
//				 //$this->Alert($ultimoID);
//				 $GravaTabela = $this->Atualiza($tabela,array("LOG_id" => $ultimoID),array($prefixo => $ultID),"");
//			}
//			 
//		 }
		static function getIp()
		{
			if (!empty($_SERVER['HTTP_CLIENT_IP']))
			{
				$ip = $_SERVER['HTTP_CLIENT_IP'];
			}
			elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
			{
				$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
			else{
				$ip = $_SERVER['REMOTE_ADDR'];
			}
		 
			return $ip;
		 
		}
		function disparar($para,$nome,$remetente,$assunto,$mensagem){		  
			   $Mensagem = ($mensagem);
			   $headers="From:  <naoresponda@grupocrx.com.br>\n";
			   $headers.="X-Sender:<$para>\n";
			   $headers.="X-mailer: PHP\n";
			   $headers.="Return-Path: <naoresponda@grupocrx.com.br>\n";
			   $headers.="Reply-To: ".$remetente."\n";
			   $headers.="Content-Type: text/html; charset=iso-8859-1\n";
			   $Assunto=utf8_decode($assunto);
			   $to = "$nome <$para>";
			   $enviar=mail($to, $Assunto, $Mensagem, $headers);
			   if($enviar>0)
			   {
					return true;
			   }
			   else
			   {
					return false;   
			   }
		}
		function dataFiltro($data){//$data = yyyy-mm-dd
			if(strpos($data,'-')){
				return implode('/',array_reverse(explode('-',$data)));
			}
			if(strpos($data,'/')){
				return implode('-',array_reverse(explode('/',$data)));
			}
		}

		function Slug($str)
		{
			$str = strtolower($str);
			//Cria um array com os acentos e o caracter a substituir
			$a = array(
			'/[ÂÀÁÄÃ]/'=>'A',
			'/[âãàáä]/'=>'a',
			'/[ÊÈÉË]/'=>'E',
			'/[êèéë]/'=>'e',
			'/[ÎÍÌÏ]/'=>'I',
			'/[îíìï]/'=>'i',
			'/[ÔÕÒÓÖ]/'=>'O',
			'/[ôõòóö]/'=>'o',
			'/[ÛÙÚÜ]/'=>'U',
			'/[ûúùü]/'=>'u',
			'/[çÇ+]/'=> 'c',
			'/[\%\&\!\?\(\)#@:\.ºª, ]+/'=>'-',
			'/-+/'=>'-'
			);
			// Tira o acento pela chave do array e retorna o texto
			//Principal::Alert(preg_replace(array_keys($a), array_values($a), $str));
			return  preg_replace(array_keys($a),array_values($a), $str);			
			
		}
		static function Saudacao(){
			$timestamp = mktime(date("H")-3, date("i"), date("s"));
			$data = gmdate("H:i:s", $timestamp);
			if($data < 5)
			{
			   echo "Navegando de madrugada?";
			}
			else
			if($data < 8)
			{
			   echo "Acordou cedo!";
			}
			else
			if($data < 12)
			{
			   echo "Tenha um bom dia";
			}
			else
			if($data < 18)
			{
			   echo "Boa tarde";
			}
			else
			{
			   echo "Boa noite";
			}
		}
		
		// lista todos os arquivos e pasta de uma determinada pasta
		// e jutna em uma matrix
		function getFiles($pasta){
			define('DS', '/');
			$diretorio = dir($pasta);
			while($item = $diretorio -> read()){
				if ($item!="." && $item!=".."){ 
					// checa se o tipo de arquivo encontrado é uma pasta
					if (is_dir($pasta.$item)) { 
						// caso VERDADEIRO adiciona o item à variável de pastas
						$lista['pastas'][] = $pasta.DS.$item; 
					} else{ 
						// caso FALSO adiciona o item à variável de arquivos
						$lista['files'][] = $item;
					}
				}
		   }
		   $diretorio -> close();
			return $lista;
		}
}
