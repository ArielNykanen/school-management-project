<?php

final class DataAccessLayer 
{
	private $host = '127.0.0.1';
	private $db   = 'theschool';
	private $user = 'root';
	private $pass = '1212';
	private $charset = 'utf8';
    private $dsn;
    private $opt = [
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
		PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    private static $Instance;

    private function __construct() 
    {
        $this->dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
    }
   
    public static function Instance() 
    {
        if (DataAccessLayer::$Instance === null) {
            DataAccessLayer::$Instance = new DataAccessLayer();
        }
        return DataAccessLayer::$Instance;
    }

    public function select($query, $params = null) 
    {
        $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        $statement = $pdo->prepare($query);

        if (!empty($params)) 
        {
            $statement->execute($params);
        } 
        else 
        {
            $statement->execute();
        }
        return $statement;
    }
    public function insert($query, $params) {
        $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        $statement = $pdo->prepare($query);
        
        $statement->execute($params);
    }

    public function update($query, $params) {
        $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        $statement = $pdo->prepare($query);

        $statement->execute($params);
    }

    public function delete($query, $params) {
        $pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
        $statement = $pdo->prepare($query);

        $statement->execute($params);
    }
}
?>