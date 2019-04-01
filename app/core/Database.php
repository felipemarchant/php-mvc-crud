<?php 

class Database {

    private $pdo;
    private $stmt;

    public function __construct() {

        $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME;
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );

        try {
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        }catch(PDOException $e) {
            die($e->getMessage());
        }
    }

    public function query($sql) {
        $this->stmt = $this->pdo->prepare($sql);
        return $this;
    }

    public function bind($param, $value, $type = null) {
        if(is_null($type)){
            switch(true){
                case is_int($value):
                    $type = PDO::PARAM_INT;
                break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->stmt->bindValue($param, $value, $type);
        return $this;
    }

    public function execute() {
        $this->stmt->execute();
        return $this;
    }

    public function all() {
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function one() {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function count() {
        return $this->stmt->rowCount();
    }


}