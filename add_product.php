<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/type.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

$type = new Type($db);

// set page title
$page_title = "New Product";

require_once "layout_header.php";
?>

<div class='right-button-margin'>
    <a href='index.php' class='btn btn-default pull-right cyber'>Cancel</a>
</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  
    <table class='table table-hover table-responsive table-bordered'>
       
        <tr>
            <td>SKU</td>
            <td><input type="text" id='sku' placeholder="SKU" title="Please, provide sku" name='sku' class='form-control' required /></td>
        </tr>

        <tr>
            <td>Name</td>
            <td><input type='text' id='name' placeholder="Name" title="Please, provide name" name='name' class='form-control' required /></td>
        </tr>
  
        <tr>
            <td>Price</td>
            <td><input type="number" step="0.01" id='price' placeholder="Price" title="Please, provide price" name='price' class='form-control' required /></td>
        </tr>
  
        <tr>
            <td>Type</td>
            <td>
                <?php
            // read product categories from the database
            $stmt = $type->read();
  
            // put them in the dropdown list
            echo "<select class='form-control' id='typeId' name='typeId' required >";
           // echo "<option>Choose type...</option>";
  
            while ($row_type = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row_type);
            echo "<option value='{$type}'>{$type}</option>";
            }
  
            echo "</select>";
            ?>  
            </td>
        </tr>

        <tr id="Book" class="specAttr">
            <td> Weight (KG): </td>
            <td>
                <input id="weight" placeholder="Weight" title="Please, provide weight" name="weight" class='form-control' type="number" step="0.01" />
            </td>
        </tr>

        <tr id="DVD" class="specAttr" hidden>
            <td>Size (MB):</td>
            <td>
                <input id="size" placeholder="Size" title="Please, provide size" name="size" class='form-control' type="number" oninvalid="this.setCustomValidity('Please enter this field')" />
            </td>
        </tr>

        <tr id="Furniture" class="specAttr" hidden>
            <td> Height x Width x Lenght (CM): </td>
            <td>
                <input id="height" placeholder="Height"  title="Please, provide height" name="height" class='form-control' type="number" step="0.05" />
                <input id="width" placeholder="Width" title="Please, provide width" name="width"  class='form-control' type="number" step="0.05" />
                <input id="lenght" placeholder="Lenght" title="Please, provide lenght" name="lenght" class='form-control' type="number" step="0.05" />
            </td>
        </tr>

        <tr>
            <td></td>
            <td><button type="submit" class="btn btn-primary cyber">Save</button></td>
        </tr>
        
  
    </table>
</form>

<?php
// if the form has been submitted
if ($_POST) {

    $product = new $_POST['typeId']($db);

    // set values ​​for product properties
    $product->setSpecAttr($_POST['size'] . "." . $_POST['weight'] . "." . $_POST['height'] . "." . $_POST['width'] . "." . $_POST['lenght']);
    $product->setSKU($_POST['sku']);
    $product->setName($_POST['name']);
    $product->setPrice($_POST['price']);
    $product->setTypeId($_POST['typeId']);

    echo "('" . $product->getSKU() . "', '" . $product->getName() . "', '" . $product->getPrice() . "', " . $product->getTypeId() . ", '" . $product->getSpecAttr() . "')"; 
    
    $query = "INSERT INTO products
    SET
    sku=:sku, name=:name, price=:price,  typeId=:typeId, specAttr=:specAttr";

$stmt = $db->prepare($query);

$stmt->bindParam(":sku", $product->getSKU());
$stmt->bindParam(":name", $product->getName());
$stmt->bindParam(":price", $product->getPrice());
$stmt->bindParam(":specAttr", $product->getSpecAttr());
$stmt->bindParam(":typeId", $product->getTypeId());

if ($stmt->execute()) {
    ?>
    <script type="text/javascript">
        setTimeout('location.replace("/index.php")', 500);
    </script>
    <?php echo "<div class='alert alert-success'>Product create success!</div>";
} else {
    echo "<div class='alert alert-danger'>Product create failed.</div>";
}

}
?>



<script src = "libs/js/jquery-3.6.0.min.js"></script>
<script src = "libs/js/main.js"></script>

<?php // footer
require_once "layout_footer.php";
?>

