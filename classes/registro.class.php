<?

/* CLASSE DE MANIPULAÇÃO DE REGISTRO NA TABELA */
# $user = new Registro("funcionarios");
//
// SELECTS
// 
# print_r($user->_select());                        tudo
# print_r($user->_select($id));                     busca por numero de id
# print_r($user->_select(0,5));                     tudo com limite desejado
# print_r($user->_select("login","jonatas"));       busca nome do campo=>valor
# echo $user->_getErro();                              exibe possiveis erros

/*
 * autor  Jonatas Miler
 * versao 1.0
 */

class Registro {

    //nome da tabela
    public $tabela = '';
    // $registro =  array campo=>valor
    protected $registro = array('');
    // erros recebidos, use _getErro();
    protected $erro = '';
    // array com os verdadeiros nomes da tabela para verificação
    private $nomesReais = array();
    private $con;
    private $host = "localhost";
    private $db = "ratos";
    private $dbUser = "root";
    private $dbPass = "";
    public $cliente;

    // constroi conexao 
    public function __construct($tabela, $campos = false) {
        if ($tabela) {

            $this->con = mysqli_connect($this->host, $this->dbUser, $this->dbPass, $this->db);
                       
            // carrega o nome da tabela
            $this->tabela = $tabela;
            // carrega os verdadeiros campos da tabela para comparação
            $this->_loadCampos();
            //se estiver setado a variavel $campos e for array
            // automaticamente inicia a gravação de um novo registro
            if (is_array($campos)) {
                $this->_load($campos);
                return $this->_grava();
            }
        }
    }

    /* --------------------SELECTS-------------------- */

    public function _select() {
        // pega os argumentos passados para este metodo
        $args = func_get_args();
        $this->tabela;
        $select = "SELECT * FROM " . $this->tabela;

        // verifica as alternativas de select
        switch (isset($args)) {
            // se não hover argumentos seleciona tudo
            case func_num_args() == 0:
                $retorno = $select;
                break;

            // se houver apenas um argumento e for string: seleciona pelas opcoes passada
            case func_num_args() == 1 && is_string($args[0]) && strlen($args[0]) > 2 :
                $retorno = $select . " " . $args[0];
                break;
            // se houver apenas um argumento e for numerico: seleciona pela id
            case func_num_args() == 1 && is_numeric($args[0]) :
                $retorno = $select . " WHERE " . $this->_addPrefixo('id') . " = " . (int) $args[0];
                break;

            // se houver 2 argumentos e ambos forem numericos
            case func_num_args() == 2 && is_numeric($args[0]) && is_numeric($args[1]) :
                // seleciona tudo com limite argumento1,argumento2
                $retorno = $select . " LIMIT " . $args[0] . "," . $args[1];
                break;

            // se houver o campo1, for string e estiver setado o segundo campo
            case func_num_args() > 1 && is_string($args[0]) && isset($args[1]):
                // seleciona tudo da tabela com nomeDoCampo=>Valor
                // se houver um terceiro considera-se um adicional como ex: ORDER BY... ou LIMIT...
                if (isset($args[2])) {
                    $adicional = $args[2];
                } else {
                    $adicional = '';
                }

                $retorno = $select . " WHERE " . $args[0] . " = '" . $args[1] . "' " . $adicional;
                break;
        }
        // executa a query e retorna o registro
        $this->registro = $this->_query($retorno);
        return $this->registro;
    }

    /* ------------------------VALORES------------------------ */

    // seta valores somente no primeiro registro do array _set('email','email@email.com');
    // ou _set( array('nome'=>'jose','email','email@email.com') );
    // ou também pode setar valores em registro especifico do array ex:
    // _set('email','email@email.com',$i = 5); ou apenas _set('email','email@email.com'); 
    public function _set() {
        $args = func_get_args();
        //print_r($args)."\n";
        if (func_num_args() > 0) {
            $i = 0;
            switch ($args) {
                case func_num_args() == 2 :
                    $campos = $this->_set($args[0], $args[1], $i);
                    break;

                case func_num_args() == 1 && is_array($args[0]):
                    foreach ($args[0] as $campo => $valor) {
                        $campos = $this->_set($campo, $valor, $i);
                    }
                    break;

                case func_num_args() == 3:
                    $i = ($args[2]) ? $args[2] : 0;
                    $campo = $args[0];
                    $valor = $args[1];
                    if ($this->_isValid($campo)) {
                        $this->registro[$i][$campo] = $valor;
                    }
                    break;
            }

            $i++;
        }
    }

    /* ---------------------BUSCAS--------------------- */

//  $user = new Registro("funcionarios");
//  print_r($user->_busca("login", 's'));

    public function _busca($campo, $valor) {
        $this->registro = $this->_query("SELECT * FROM " . $this->tabela . " WHERE " . $campo . " REGEXP '" . $valor . "'");
        return $this->registro;
    }

    /* ---------------------EDIÇÃO--------------------- */

    public function _atualiza() {
        //print_r($this->registro);
        for ($i = 0; $i < count($this->registro); $i++) {
            foreach ($this->registro[$i] as $campo => $valor) {
                if ($campo == $this->_addPrefixo('id')) {
                    $id = $valor;
                } else {
                    $string[$i][] = $campo . "='" . $valor . "'\n";
                }
            }
            //echo " UPDATE ".$this->tabela." SET ".implode(',', $string[$i])." WHERE ".$this->_addPrefixo('id')." = '".$id."'<br><br><br><br><br><br><br>";
            mysqli_query($this->con," UPDATE " . $this->tabela . " SET " . implode(',', $string[$i]) . " WHERE " . $this->_addPrefixo('id') . " = '" . $id . "'") or die(mysqli_error());
            $linhas += mysqli_affected_rows();
            $i++;
        }
        return $linhas;
    }

    public function _grava() {
        $i = 0;
        if (is_array($this->registro)) {

            $arr = is_array($this->registro[0]) ? $this->registro[0] : $this->registro;
            // se existir um registro com essa id, nega a gravação
            if (is_array($this->_select($this->_addPrefixo('id'), $arr['id']))) {
                $data = date('d-m-Y H:m:s');
                $msg = "Este registro: '" . $arr['id'] . "' já existe.";
                $this->_setErro($data, $msg);
            } else {

                foreach ($arr as $campo => $valor) {
                    if ($campo != $this->_addPrefixo('id')) {
                        $campos[$i][] = $campo;
                        $valores[$i][] = "'" . $valor . "'";
                    }
                }

                //echo "INSERT INTO ".$this->tabela." (".implode(',', $campos[$i]).") VALUES (".implode(',', $valores[$i]).")<br>";
                $grava = mysqli_query($this->con,"INSERT INTO " . $this->tabela . " (" . implode(',', $campos[$i]) . ") VALUES (" . implode(',', $valores[$i]) . ")") or $this->_setErro(mysqli_errno(), mysqli_error());
                if ($grava) {
                    return mysqli_insert_id();
                } else {
                    return false;
                }
                $i++;
            }
        }
    }

    public function _delete($campo, $valor) {
        if (is_array($valor)) {
            $ids = implode(',', $valor);
        } else {
            $ids = $valor;
        }
        $delete = mysqli_query($this->con,'DELETE FROM ' . $this->tabela . ' WHERE ' . $campo . ' IN (' . $ids . ')') or $this->_setErro(mysqli_errno(), mysqli_error());
        return mysqli_affected_rows();
    }

    /* ------------------------FERRAMENTAS----------------------- */

    // Query do Mysql
    public function _query($param) {
        $query = mysqli_query($this->con,$param);
        if (!$query) {
            $this->_setErro(mysqli_errno(), mysqli_error());
            return $this->_getErro();
        } elseif ($query && $this->procpalavras($param, array('delete', 'updade', 'DELETE', 'UPDATE')) != 1) {
            while ($campos = mysqli_fetch_assoc($query)) {
                $retorno[] = $campos;
            }
            return $retorno;
        }
    }

    // função boa pra procurar palavra
    public function procpalavras($frase, $palavras, $resultado = 0) {
        foreach ($palavras as $key => $value) {
            $pos = strpos($frase, $value);
            if ($pos !== false) {
                $resultado = 1;
                break;
            }
        }
        return $resultado;
    }

    public static function filtroData($data) {
        if (strpos($data, '-')) {
            return implode('/', array_reverse(explode('-', $data)));
        }
        if (strpos($data, '/')) {
            return implode('-', array_reverse(explode('/', $data)));
        }
    }

    // percorre o array dentro de uma função desejada
    public function _load($Arr) {
        $this->registro = array();
        foreach ($Arr as $key => $value) {
            if ($this->_isValid($key)) {
                $reg[$key] = "$value";
            }
        }


        $this->registro = array($reg);
        return $this->registro;
    }

    // carrega os verdadeiros campos da tabela para comparação
    private function _loadCampos() {
        // seleciona os verdadeiros nomes das colunas
        if (preg_match('/^[a-z_]+$/', $this->tabela)) {
            $this->nomesReais = array();
            $query = mysqli_query($this->con,"SELECT * FROM " . $this->tabela);
            $num_fields = mysqli_num_fields($query);
            for ($i = 0; $i < $num_fields; $i++) {
                $fields = mysqli_fetch_field($query);
                array_push($this->nomesReais, $fields->name);
            }
        }
    }

    public function _get($campo) {
        return $this->registro[0][$campo];
    }

    public function _getReg($param = "array") {

        switch ($param) {
            case "json":
                return str_replace('\/', '/', json_encode($this->registro[0]));
                break;

            case "xml":
                if (class_exists('Xml')) {
                    $xml = new Xml($this->tabela);
                } else {
                    require_once 'xml.class.php';
                    $xml = new Xml($this->tabela);
                }
                $xml->fromArray($this->registro[0]);

                return $xml->getDocument();
                break;

            default:
                return $this->registro[0];
                break;
        }
    }

    // adiciona o prefixo no nome dos campos para gravação ou seleção
    public function _addPrefixo($param) {
        return strtoupper(substr($this->tabela, 0, 3)) . "_" . $param;
    }

    private function _isValid($campo) {

        if (in_array($campo, $this->nomesReais)) {
            return true;
        } else {
            return false;
        }
    }

    // passa os erros para a variavel $this->erro
    private function _setErro($no, $msg) {
        return $this->erro .= "[" . $no . "] = " . $msg . "\n";
    }

    // pega os erros ocorridos
    public function _getErro() {
        $msg = "Erros ocorridos\n";
        return $msg . $this->erro . "\n";
    }

}

//$array = array(
//    "nome"=>"Rafel",
//    "email"=>"jonatas@officeweb.com.br",
//    "facebook"=>"jonatas.m.o"
//);
//echo '<pre>';
//$reg = new Registro("funcionarios");
//$registros = $reg->_select(10);
//$reg->_set("nome","Milton")."\n";
//$reg->_set($array);
//print_r($reg->_getReg());
////print_r($registros);
////unset($registros[0]['id']);
//print_r($registros);
//foreach ($registros[0] as $value) {
    //print_r($reg->_prepara($registros[0]));
//}

//$registros[0]['token'] = '';
//print_r($reg->_load($registros));
//print_r($reg->_getReg());
////print_r($reg->_grava());
////echo $reg->_getErro();
////echo $reg->_getReg()."\n";
//echo $reg->_atualiza()."\n";
//////$reg->_delete('id', '5');
//echo $reg->_getErro();
//echo '</pre>';

