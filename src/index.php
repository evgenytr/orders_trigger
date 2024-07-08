<?php
error_reporting( E_ALL );
ini_set( "display_errors", 1 );

echo '<html>
    <body>';

require_once ('storage.php');

$storage = new Storage();

$storage->connect();

$stats = $storage->getStats();
$products = $storage->getProducts();

$storage->disconnect();

echo '<h2>Order statistics</h2>';
echo '<table>';
echo '<tr><th>Category</th><th>Total products</th><th>Date</th></tr>';

foreach ($stats as $row){
    $curr_date = date("d/m/y",strtotime($row[2]));
    echo "<tr><td>$row[0]</td><td>$row[1]</td><td>$curr_date</td></tr>";
};

echo '</table>';

$product_options = [];
$curr_category_name = "";

foreach ($products as $row) {
    if($row[2]!=$curr_category_name) {
        $curr_category_name = $row[2];
        $product_options[]='<optgroup label="'.$curr_category_name.'"></optgroup>';
    }
    $product_options[] = '<option value="'.$row[0].'">'.$row[1].'</option>';
};

echo '<h2>Add new order</h2>';
echo '<form action="place_order.php" method="post">
<label for="product">Product:</label>
<select name="product">';
echo implode("\n",$product_options);
echo '</select>
<label for="quantity">Quantity:</label>
<input name="quantity" id="quantity" type="number" value="1"/>
<button type="submit">Place order</button>
</form>
</body></html>';
?>