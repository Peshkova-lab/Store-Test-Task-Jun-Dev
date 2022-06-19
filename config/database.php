<?php
class Database {

    // укажите свои собственные учетные данные для базы данных 
    //private $host = "localhost";
   // private $db_name = "id18963566_productsdb";
    //private $username = "id18963566_jun_dev_test_task";
    //private $password = "xt#i<ULe^?qq+^8@";
    
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