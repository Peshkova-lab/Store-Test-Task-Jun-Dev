<?php
    include_once 'config/database.php';
    include_once 'objects/product.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    $arr = $_POST['products'];

    foreach ($arr as $a) {
        if (Product::delete($db, $a)) {
            echo "Delete success!";
        }
        else {
            echo "Delete failed!";
        }
    }
    
?>