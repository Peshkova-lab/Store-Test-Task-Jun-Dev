<?php
abstract class Product {

    static private $conn;
    static private $table_name = "products";

    protected $id;
    protected $name;
    protected $price;
    protected $sku;
    protected $typeId;
    protected $specAttr;

    function setId($id) {
        $this->id = $id;
    }

    function setName($name) {
      $this->name = $name;   
    }

    function setSKU($sku) {
        $this->sku = $sku;   
    }

    function setPrice($price) {
        $this->price = $price;   
    }
    
    function getSKU() {
        return $this->sku;
    }

    function getName() {
        return $this->name;
    }
    
    function getPrice() {
        return $this->price;
    }

    function getTypeId() {
        return $this->typeId;
    }

    function getSpecAttr() {
        return $this->specAttr;
    
    }

    abstract function setSpecAttr($specAttr);
    abstract function create();

    static function readAll($db) {
        self::$conn = $db;
        $query = "SELECT
                    id, sku, name, price,  typeId, specAttr
                FROM
                    " . self::$table_name . "
                ORDER BY
                    sku ASC";
    
        $stmt = self::$conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }

    // deleting a product
    static function delete($db, $id) {
        self::$conn = $db;

    $query = "DELETE FROM " . self::$table_name . " WHERE id = ?";

    $stmt = self::$conn->prepare($query);
    $stmt->bindParam(1, $id);

    if ($result = $stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
}

class Book extends Product {

    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function setTypeId() {
        $this->typeId = 2;   
    }

    function setSpecAttr($specAttr) {
        $attrs = explode(".", $specAttr);

        $this->specAttr = $attrs[1] . " KG";
    }

    function create() {

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sku=:sku, name=:name, price=:price,  typeId=:typeId, specAttr=:specAttr";

        $stmt = $this->conn->prepare($query);

        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->specAttr=htmlspecialchars(strip_tags($this->specAttr));
        $this->typeId=htmlspecialchars(strip_tags($this->typeId));


        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":specAttr", $this->specAttr);
        $stmt->bindParam(":typeId", $this->typeId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }
}

class DVD extends Product {
    
    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function setTypeId() {
        $this->typeId = 1;   
    }

    function setSpecAttr($specAttr) {

        $attrs = explode(".", $specAttr);

        $this->specAttr = $attrs[0] . " MB";
    }

    function create() {

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sku=:sku, name=:name, price=:price,  typeId=:typeId, specAttr=:specAttr";

        $stmt = $this->conn->prepare($query);

        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->specAttr=htmlspecialchars(strip_tags($this->specAttr));
        $this->typeId=htmlspecialchars(strip_tags($this->typeId));
        
        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":specAttr", $this->specAttr);
        $stmt->bindParam(":typeId", $this->typeId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }
}

class Furniture extends Product {

    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function setTypeId() {
        $this->typeId = 3;   
    }
    
    function setSpecAttr($specAttr) {
        
        $attrs = explode(".", $specAttr);

        $this->specAttr = $attrs[2] . "x" . $attrs[3] . "x" . $attrs[4] . " CM";
    }

    function create() {
        
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sku=:sku, name=:name, price=:price,  typeId=:typeId, specAttr=:specAttr";

        $stmt = $this->conn->prepare($query);

        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->specAttr=htmlspecialchars(strip_tags($this->specAttr));
        $this->typeId=htmlspecialchars(strip_tags($this->typeId));

        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":specAttr", $this->specAttr);
        $stmt->bindParam(":typeId", $this->typeId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>