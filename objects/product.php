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

    function setTypeId($typeId) {
        $this->typeId = $typeId;   
    }

    function setSpecAttr($specAttr) {
        $this->specAttr = $specAttr;
    }

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

    protected $weight;
    
    function setWeight($weight) {
        $this->weight = $weight;
    }

    function getWeight() {
        return $this->weight;
    }

    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {

        $this->setWeight($this->specAttr);

        
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sku=:sku, name=:name, price=:price,  typeId=:typeId, specAttr=:specAttribute";

        $stmt = $this->conn->prepare($query);

       
        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->specAttr=htmlspecialchars(strip_tags($this->specAttr));
        $this->typeId=htmlspecialchars(strip_tags($this->typeId));


        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":specAttribute", $this->weight);
        $stmt->bindParam(":typeId", $this->typeId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }
}

class Disc extends Product {

    protected $size;
    
    function setSize($size) {
        $this->size = $size;
    }

    function getSize() {
        return $this->size;
    }

    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {

        $this->setSize($this->specAttr);

        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sku=:sku, name=:name, price=:price,  typeId=:typeId, specAttr=:specAttribute";

        $stmt = $this->conn->prepare($query);

        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->specAttr=htmlspecialchars(strip_tags($this->specAttr));
        $this->size = htmlspecialchars(strip_tags($this->size));
        $this->typeId=htmlspecialchars(strip_tags($this->typeId));
        
        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":specAttribute", $this->size);
        $stmt->bindParam(":typeId", $this->typeId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }
}

class Furniture extends Product {

    protected $height;
    protected $width;
    protected $lenght;

    protected $dimensions;
    
    function setHeight($height) {
        $this->height = $height;
    }

    function setWidth($width) {
        $this->width = $width;
    }

    function setLenght($lenght) {
        $this->lenght = $lenght;
    }

    private $conn;
    private $table_name = "products";

    public function __construct($db) {
        $this->conn = $db;
    }

    function create() {
        
        $query = "INSERT INTO
                    " . $this->table_name . "
                SET
                    sku=:sku, name=:name, price=:price,  typeId=:typeId, specAttr=:specAttribute";

        $stmt = $this->conn->prepare($query);

        $this->sku=htmlspecialchars(strip_tags($this->sku));
        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->specAttr=htmlspecialchars(strip_tags($this->specAttr));
        $this->typeId=htmlspecialchars(strip_tags($this->typeId));

        $stmt->bindParam(":sku", $this->sku);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":specAttribute", $this->specAttr);
        $stmt->bindParam(":typeId", $this->typeId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
?>