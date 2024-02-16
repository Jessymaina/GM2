<?php
require_once('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = $_POST['feedbackId'];
    $action = $_POST['response'];
    $dateReplied = date("Y-m-d H:i:s"); // Get current date and time
    $status = 0;

    // Update database with the provided data
    $sqlUpdate = "UPDATE enquiries SET ACTION = '$action', DATEREPLIED = '$dateReplied', STATUS = '$status' WHERE COUNT = $id";

    if (mysqli_query($con, $sqlUpdate)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Feedback</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/adminreply.css">
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
    $sqlSelectEnquiries = "SELECT NAME, EMAIL, MESSAGE, DATECREATED, STATUS, COUNT FROM enquiries";
    $result = mysqli_query($con, $sqlSelectEnquiries);

    $count = 1; // Initialize count variable

    if (mysqli_num_rows($result) > 0) {
        echo "<h2>Enquiries</h2>";
        echo "<table border='1'>";
        echo "<tr><th>Count</th><th>ID</th><th>Name</th><th>Email</th><th>Message</th><th>Date Created</th><th>Status</th><th>Action</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $count . "</td>"; // Display count
            echo "<td>" . $row['COUNT'] . "</td>";
            echo "<td>" . $row['NAME'] . "</td>";
            echo "<td>" . $row['EMAIL'] . "</td>";
            echo "<td>" . $row['MESSAGE'] . "</td>";
            echo "<td>" . $row['DATECREATED'] . "</td>";
            echo "<td>" . $row['STATUS'] . "</td>";
            echo "<td><a href='#' class='respond-link' onclick=\"openForm('{$row['EMAIL']}')\">Respond</a></td>"; // Pass count and email as parameters
            echo "</tr>";
            $count++; // Increment count for next iteration
        }
        echo "</table>";
    } else {
        echo "No enquiries found.";
    }
?>


<!-- Added this div for the pop-up form to reply-->
<div id="respondForm" class="popup-form">
    <form id="responseForm" class="popup-content" method="post" action="customer.php">
        <span class="close" onclick="closeForm()">&times;</span>
        <h2>Respond to Feedback</h2>
        <input type="hidden" id="feedbackId" name="feedbackId">
        <input type="text" id="feedbackName" name="feedbackName" readonly>
        <input type="email" id="feedbackEmail" name="feedbackEmail" readonly>
        <textarea id="feedbackMessage" name="feedbackMessage" readonly></textarea>
        <textarea id="responseMessage" placeholder="Your response..." name="response" required></textarea>
        <button type="submit">Send</button>
    </form>
</div>

<script>
    // Added this JavaScript for showing and hiding the pop-up form
function openForm() {
    document.getElementById("respondForm").style.display = "block";
}

function closeForm() {
    document.getElementById("respondForm").style.display = "none";
}

// Add an event listener to handle opening the form when "Respond" link is clicked
document.querySelectorAll('.respond-link').forEach(item => {
    item.addEventListener('click', event => {
        var row = event.target.closest('tr');
        var id = row.cells[1].innerText;
        var name = row.cells[2].innerText;
        var email = row.cells[3].innerText;
        var message = row.cells[4].innerText;
        var dateCreated = row.cells[5].innerText;

        document.getElementById('feedbackId').value = id;
        document.getElementById('feedbackName').value = name;
        document.getElementById('feedbackEmail').value = email;
        document.getElementById('feedbackMessage').value = message;
        document.getElementById('responseSubject').value = ''; // Clear the subject field
        document.getElementById('responseMessage').value = ''; // Clear the response field

        openForm();
    });
});

</script>
</body>
</html>