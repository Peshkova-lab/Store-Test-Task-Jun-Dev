<?php

include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/type.php';

// create instances of database classes and objects
$database = new Database();
$db = $database->getConnection();

$type = new Type($db);

// request for products
$stmt = Product::readAll($db);
$num = $stmt->rowCount();

// set page title
$page_title = "Products";

//header 
require_once "layout_header.php";
?>

<div class='right-button-margin'>
    
    <button id = "delete-product-btn" class='btn btn-default pull-right cyber'>MASS DELETE</button>

    <a href='add_product.php' class='btn btn-default pull-right cyber'>ADD</a>

</div>


<?php
// display products, if any
if ($num > 0) {

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        
            extract($row);
        
            echo "<div class='card cyber'>";
            echo "<input type='checkbox' class='delete-checkbox' id='{$id}' value='{$name}'>";
            echo "<p class='sku'>{$sku}</p>";
            echo "<p class='name'>{$name}</p>";
            echo "<p class='price'>{$price} &#36;</p>";
            $type->setId($typeId);
            $type->readSpecAttr();
            echo "<p class='specAttr'>{$type->getSpecAttr()}: {$specAttr}</p>";
            echo "</input></div>";
        }
    }
// inform the user that there are no products
else {
    echo "<div class='alert alert-info'>Products not found.</div>";
}
?>

<script src = "libs/js/jquery-3.6.0.min.js"></script>
<script src = "libs/js/main.js"></script>

<?php 
require_once "layout_footer.php";
?>