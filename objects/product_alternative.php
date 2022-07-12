<?php
/*
class Product {

    private $conn;
    private $table_name = "products";

    protected $id;
    protected $name;
    protected $price;
    protected $sku;
    protected $typeId;
    protected $specAttribute;


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
        $this->specAttribute = $specAttr;   
      }


    public function __construct($db) {
        $this->conn = $db;
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
        $stmt->bindParam(":specAttr", $this->specAttribute);
        $stmt->bindParam(":typeId", $this->typeId);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

    }

    function readAll($type = 0) {

        if ($type == 0) {

                $query = "SELECT
                    id, sku, name, price,  typeId, specAttr
                FROM
                    " . $this->table_name . "
                ORDER BY
                    sku ASC";
        } 
        else {
                $query = "SELECT
                    id, sku, name, price,  typeId, specAttr
                FROM
                    " . $this->table_name . "
                WHERE = " . $type . "
                ORDER BY
                    sku ASC";
        }

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
    
        return $stmt;
    }


    function delete() {

    $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);

    if ($result = $stmt->execute()) {
        return true;
    } else {
        return false;
    }
}
}*/
?>