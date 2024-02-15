<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Display</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<link rel="stylesheet" href="css/admin.css">
    <style>
        /* Your CSS styles here */
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product {
            border: 1px solid #ccc;
            padding: 20px;
            width: 300px;
        }

        .product img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
        }

        .button-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .product button {
            background-color: #4CAF50;
            border: none;
            color: yellow;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            transition-duration: 0.4s;
        }

        .product button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<header class="header">
        <div class="flex">
            <nav class="navbar"></nav>
            <a href="dashboard.php">Dashboard</a>
                <a href="admin.php">add products</a>
                <a href="products.php">view products</a>
                <a href="user.php">system users</a>
                <a href="customer.php">Customer feedback</a>
                </nav>
              
        </div>
    </header>
    <div class="product-container">
        <?php
        require_once('connection.php');

        $sql = "SELECT * FROM product";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<h3>" . $row["productname"] . "</h3>";
                echo "<p>Price: $" . $row["productprice"] . "</p>";
                echo "<p>Quantity: <span id='quantity-" . $row["productcode"] . "'>" . $row["productquantity"] . "</span></p>";
                echo "<p>Description: " . $row["productdescription"] . "</p>";
                echo "<img src='" . $row["file"] . "' alt='" . $row["productname"] . "'>";
                echo "<div class='button-container'>";
                echo "<button onclick='changeQuantity(" . $row["productcode"] . ", 1)'>+</button>";
                echo "<button onclick='changeQuantity(" . $row["productcode"] . ", -1)'>-</button>";
                echo "</div>"; // Close button container
                echo "</div>"; // Close product container
            }
        } else {
            echo "No products available";
        }

        mysqli_close($con);
        ?>
    </div>

    <script>
        function changeQuantity(productCode, change) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "updatequantity.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var quantitySpan = document.getElementById("quantity-" + productCode);
                    var newQuantity = parseInt(xhr.responseText);
                    if (!isNaN(newQuantity)) {
                        quantitySpan.innerText = newQuantity;
                    }
                }
            };
            xhr.send("productCode=" + productCode + "&change=" + change);
        }
    </script>
</body>
</html>
