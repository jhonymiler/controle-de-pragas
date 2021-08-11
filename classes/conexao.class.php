<?

class Conexao {

    private $host = "localhost";
    private $db = "ratos";
    private $dbUser = "root";
    private $dbPass = "";
    public $cliente;

    function __construct() {

        $dbLink = mysqli_connect($this->host, $this->dbUser, $this->dbPass, $this->db);
        if ($dbLink) {
            return $dbLink;
        } else {
            die("Erro ao acessar banco de dados");
        }
    }

}
