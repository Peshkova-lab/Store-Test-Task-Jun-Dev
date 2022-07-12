<?php
class Database {

    // укажите свои собственные учетные данные для базы данных 
    //private $host = "localhost";
   // private $db_name = "id19255532_productsdb";
    //private $username = "id19255532_peshkova_jun_dev_test_task";
    //private $password = "ajQ({%y(s2LRY7NY";
    
    private $host = "storeWork";
    private $db_name = "productsdb";
    private $username = "root";
    private $password = "root";

    public $conn;

    private $table_name = "products";

    // получение соединения с базой данных 
    public function getConnection() {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        } catch(PDOException $exception) {
            echo "Ошибка соединения: " . $exception->getMessage();
        }

        return $this->conn;
    }

    function readAll() {

        // запрос MySQL 
        $query = "SELECT
                    id, sku, name, price,  typeId, specAttr
                FROM
                    " . $this->table_name . "
                ORDER BY
                    sku ASC";
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }
}
?>