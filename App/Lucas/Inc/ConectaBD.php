<?php
/**
 * Description of ConectaBD
 * @author Osvaldo
 */
namespace App\Lucas\Inc;

define('HOST', 'localhost');
define('USERNAME', 'root');
define('PASSWORD', '');
define('DBNAME', 'shop');
define('DSN', 'mysql:host=' . HOST . ';dbname=' . DBNAME . '');

class ConectaBD {
    
    private $Dsn;
    private $User;
    private $Password;
    private static $Conn;
    
    public function __construct() {
        $this->Dsn = DSN;
        $this->User = USERNAME;
        $this->Password = PASSWORD;
    }
    
    public static function Conn() {
        // Se o a instancia nao existe eu crio uma:
        if (is_null(self::$Conn)) {
            try {
                // self::$conn = new PDO('mysql:host=localhost;dbname=video_aula;','root','senha');
                self::$Conn = new PDO(DSN, USERNAME, PASSWORD);
                self::$Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // echo 'Erro na tentativa de conectar ao sistema, informe o problema COD:0x0FE12';
                // exit();
                echo $e->GetMessage();
                exit("Erro ao conectar!");
            }
        }// Verifica se ja esta conectado, Se ja existe instancia na memoria eu a retorno.
        return self::$Conn;
    }// function $Conn
// class ConectaBD
}
