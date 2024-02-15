<?php
require_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve product code and change in quantity from the AJAX request
    $productCode = $_POST['productCode'];
    $change = $_POST['change'];

    // Query to update product quantity in the database
    $sql = "UPDATE product SET productquantity = productquantity + $change WHERE productcode = $productCode";

    if (mysqli_query($con, $sql)) {
        // Retrieve and return the updated quantity
        $updatedQuantitySql = "SELECT productquantity FROM product WHERE productcode = $productCode";
        $result = mysqli_query($con, $updatedQuantitySql);
        $row = mysqli_fetch_assoc($result);
        echo $row['productquantity'];
    } else {
        echo "Error updating quantity: " . mysqli_error($con);
    }
}

mysqli_close($con);
?>
