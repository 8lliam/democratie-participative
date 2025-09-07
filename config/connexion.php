
<?php
class Connexion {
    // Les attributs static caractéristiques de la connexion
    static private $hostname = 'localhost';
    static private $database = 'saes3-wsimion';
    static private $login = 'saes3-wsimion';
    static private $password ='iwwwHI2TAjw9lt62';// votre mdp

    static private $tabUTF8 = array (PDO:: MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8");
    // L'attribut static qui matérialisera la connexion
    static private $pdo;

    // Le getter public de cet attribut
    static public function pdo() {return self::$pdo;}
    
    // La fonction static de connexion qui initialise $pdo et Lance la tentative de connexion 
    static public function connect() {
        $h = self::$hostname; 
        $d = self::$database; 
        $l = self::$login;
        $p= self::$password; 
        $t = self::$tabUTF8;
        try {
        self::$pdo = new PDO ("mysql:host=$h; dbname=$d", $l, $p, $t);
        self::$pdo->setAttribute (PDO::ATTR_ERRMODE, PDO:: ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            $retour["success"] = false;
            $retour["message"] = "Connexion à la base de donnée impossible";
            echo json_encode($retour);
            exit();
        }
    }
}
?>
