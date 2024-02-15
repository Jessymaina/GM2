<?php
require_once('connection.php');
?>

<?php

if(isset($_POST['addproduct'])) {
    // Retrieve form data
    $productcode = $_POST['productcode'];
    $productname = $_POST['productname'];
    $productprice = $_POST['productprice'];
    $productqty = $_POST['productqty'];
    $productdescription = $_POST['productdescription'];
    $productstatus = isset($_POST['productstatus']) ? $_POST['productstatus'] : 0; // Default status to 0 if not provided

    // File upload handling
    $file = $_FILES['productimage'];
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileError = $file['error'];

    // Destination folder
    $destinationFolder = 'assets/';

    // Check if file uploaded successfully
    if ($fileError === 0) {
        // Check if the file is already in the assets folder
        if (strpos($fileTmpName, $destinationFolder) === false) {
            // Move the uploaded file to the assets folder
            $fileDestination = $destinationFolder . $fileName;
            move_uploaded_file($fileTmpName, $fileDestination);
        } else {
            $fileDestination = $fileTmpName;
        }

        // Insert data into the database
        $sql = "INSERT INTO product (productcode, productname, productquantity, productdescription, productstatus, productprice, file)
                VALUES ('$productcode', '$productname', '$productqty', '$productdescription', '$productstatus', '$productprice', '$fileDestination')";
        
        if(mysqli_query($con, $sql)) {
            echo "Product added successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($con);
        }
    } else {
        echo "There was an error uploading your file.";
    }
}

if(isset($_POST['removeproduct'])) {
    // Retrieve product code to remove
    $productCodeToRemove = $_POST['productcode'];
    
    // Remove product from the database
    $sql = "DELETE FROM product WHERE productcode='$productCodeToRemove'";
    
    if(mysqli_query($con, $sql)) {
        echo "Product removed successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<header class="header">
    <div class="">
        <nav class="">
            <a href="dashboard.php">Dashboard</a>
            <a href="admin.php">Add Products</a>
            <a href="products.php">View Products</a>
            <a href="user.php">System Users</a>
            <a href="customer.php">Customer Feedback</a>
        </nav>
    </div>
</header>

<div class="container">
    <form action="" method="post" class="addproduct" enctype="multipart/form-data">
        <h3>Add a New Product</h3>
        <input type="number" name="productcode" placeholder="Enter Product Code" class="box" required>
        <input type="text" name="productname" placeholder="Enter Product Name" class="box" >
        <input type="number" name="productprice" placeholder="Enter Product Price" class="box" >
        <input type="number" name="productqty" placeholder="Enter Product Quantity" class="box" >
        <input type="text" name="productdescription" placeholder="Enter Product Description" class="box" >
        <input type="file" name="productimage" accept="image/jpg,image/png,image/jpeg" class="box" >
        <input type="submit" value="Add the Product" name="addproduct" class="btn">
        <input type="submit" value="Remove Product" name="removeproduct" class="btn">
    </form>
</div>

</body>
</html>
