<?php
require_once('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>
<header class="header">
    <div class="flex">
        <nav class="navbar"></nav>
        <a href="dashboard.php">Dashboard</a>
        <a href="admin.php">Add Products</a>
        <a href="products.php">View Products</a>
        <a href="user.php">System Users</a>
        <a href="customer.php">Customer Feedback</a>
    </div>
</header>

<?php
    // Display all data from the enquiries table
    $sqlSelectEnquiries = "SELECT NAME, EMAIL, MESSAGE, DATECREATED, STATUS FROM enquiries";
    $result = mysqli_query($con, $sqlSelectEnquiries);

    $count = 1; // Initialize count variable

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Enquiries</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Count</th><th>Name</th><th>Email</th><th>Message</th><th>Date Created</th><th>Status</th><th>Action</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $count . "</td>"; // Display count
            echo "<td>" . $row['NAME'] . "</td>";
            echo "<td>" . $row['EMAIL'] . "</td>";
            echo "<td>" . $row['MESSAGE'] . "</td>";
            echo "<td>" . $row['DATECREATED'] . "</td>";
            echo "<td>" . $row['STATUS'] . "</td>";
            echo "<td><a href='respond.php?count=" . $count . "&email=" . $row['EMAIL'] . "'>Respond</a></td>"; // Pass count and email as parameters
            echo "</tr>";
            $count++; // Increment count for next iteration
        }
        echo "</table>";
    } else {
        echo "No enquiries found.";
    }
?>

</body>
</html>
