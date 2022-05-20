<?php
class Type {

    private $conn;
    private $table_name = "types";

    public $id;
    public $type;
    private $specAttr;

    function setId($id) {
        $this->id = $id;
    }

    function getSpecAttr() {
        return $this->specAttr;
    }

    public function __construct($db) {
        $this->conn = $db;
    }

    function read() {

        $query = "SELECT
                    id, type, specAttr
                FROM
                    " . $this->table_name . "
                ORDER BY
                    type";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function readType() {

    $query = "SELECT type FROM " . $this->table_name . " WHERE id = ? limit 0,1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->type = $row['type'];

    }

    function readSpecAttr() {

    $query = "SELECT specAttr FROM " . $this->table_name . " WHERE id = ? limit 0,1";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $this->id);
    $stmt->execute();

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $this->specAttr = $row['specAttr'];

    }
}
?>