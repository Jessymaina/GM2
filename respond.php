<?php
require_once('connection.php');
if(isset($_POST['submitresponse'])) {
    // Retrieve form data
    $customerEmail = $_POST['EMAIL'];
    $responseMessage = $_POST['MESSAGE'];

    // Update database with response message
   $sqlUpdate = "UPDATE enquiries SET Action = '$responseMessage' WHERE EMAIL = '$customerEmail'";
    if (mysqli_query($con, $sqlUpdate)) {
        // Send response to customer email
       // $to = $customerEmail;
       // $subject = "Response to your enquiry";
       // $message = $responseMessage;
       // $headers = "From: codjecinta@gmail.com"; // Your email address
       // mail($to, $subject, $message, $headers);
        
       echo "Response sent successfully and action field updated.";
    } else {
       echo "Error updating database: " . mysqli_error($con);
    }
}
?> 




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respond</title>
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
            <a href="respond.php">Customer Responses</a>
        </nav>
    </div>
</header>

<h2>Respond to Customer</h2>

<?php
if(isset($_GET['email'])) {
    $customerEmail = $_GET['email'];
    echo "<p>Responding to: $customerEmail</p>";
?>
  
<?php
} else {
    echo "No customer email provided";
}
?>
  <form action="respond.php" method="post">
        <input type="hidden" name="customer_email" value="<?php echo $customerEmail; ?>">
        <textarea name="response_message" rows="4" cols="50" placeholder="Enter your response here"></textarea><br>
        <input type="submit" name="submitresponse" value="Send Response">
    </form>

</body>
</html>
