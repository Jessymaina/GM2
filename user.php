<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('connection.php');

// Check if form is submitted to update user details
if (isset($_POST['save'])) {
    // Loop through the submitted data to update user details
    foreach ($_POST['fullname'] as $key => $fullname) {
        
        // Check if the other arrays are set as well
        if (isset($_POST['email'][$key], $_POST['phonenumber'][$key], $_POST['idnumber'][$key])) {
            $email = $_POST['email'][$key];
            $phonenumber = $_POST['phonenumber'][$key];
            $idnumber = $_POST['idnumber'][$key];

            // Update user details in the register table using the ID number as the identifier
            $sqlUpdateRegister = "UPDATE register SET fullname='$fullname', email='$email', phonenumber='$phonenumber' WHERE idnumber='$idnumber'";
            if ($con->query($sqlUpdateRegister) !== true) {
                echo "Error updating user: " . mysqli_error($con);
            }

            // Update user details in the user table using the email as the identifier
            $sqlUpdateUser = "UPDATE user SET username='$email' WHERE username='$email'";
            if ($con->query($sqlUpdateUser) !== true) {
                echo "Error updating user: " . mysqli_error($con);
            }
        }
    }
    // Reload the page after updating
    echo "<script>window.location.href = window.location.href;</script>";
}

// Check if add user button is clicked
if (isset($_POST['addUser'])) {
    // Add a new row for a new user
    echo "<script>addUserRow();</script>";
}

// Check if delete user button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the delete button is clicked
    if (isset($_POST['delete'])) {
        // Check if any user is selected for deletion
        if (isset($_POST['selectedUsers'])) {
            // Loop through each selected user and delete them
            foreach ($_POST['selectedUsers'] as $userId) {
                $sqlDeleteUser = "DELETE FROM register WHERE idnumber='$userId'";
                mysqli_query($con, $sqlDeleteUser);
            }
            // Redirect to the same page after deletion
            header("Location: ".$_SERVER['PHP_SELF']);
            exit;
        } else {
            echo "Please select at least one user to delete.";
        }
    }
}

// Fetch user records from the database
$sqlSelectUsers = "SELECT * FROM register";
$result = mysqli_query($con, $sqlSelectUsers);

if (isset($_POST['xxx'])) {
    // Check if users are selected for deletion
    if (isset($_POST['selectedUsers'])) {
        $selectedUsers = $_POST['selectedUsers'];
        // Loop through selected users and delete them from both tables
        foreach ($selectedUsers as $userId) {
            $sqlDeleteRegister = "DELETE FROM register WHERE idnumber='$userId'";
            if ($con->query($sqlDeleteRegister) !== true) {
                echo "Error deleting user: " . mysqli_error($con);
            }

            $sqlDelete = "DELETE register, user FROM register INNER JOIN user ON register.email = user.username WHERE register.email='$email'";
            if ($con->query($sqlDeleteUser) !== true) {
                echo "Error deleting user: " . mysqli_error($con);
            }
        }
        // Reload the page after deleting users
        echo "<script>window.location.href = window.location.href;</script>";
    } else {
        // If no users are selected, show an alert
        echo "<script>alert('Please select at least one user to delete.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    
    <style>
         table {
        width: 100%;
        border-collapse: collapse;
    }
    
    th, td {
        
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
        
    }
    
    th {
        background-color: #f2f2f2;
        background:orange;
    }
    
    tr:hover {
        background-color: #f2f2f2;
    }
    
    input[type="text"],
    input[type="email"] {
        width: 100%;
        padding: 5px;
        box-sizing: border-box;
    }
    
    button {
        background-color: #4CAF50;
        color: white;
        padding: 8px 20px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
    }
    
    button:hover {
        background-color: #45a049;
    }
    </style>
      
      <link rel="stylesheet" href="css/general.css">
   
    <script>
        function addUserRow() {
            // Create a new row for adding a user
            var table = document.querySelector('table');
            var newRow = table.insertRow(table.rows.length - 1);
            newRow.innerHTML = "<td><input type='checkbox' name='selectedUsers[]'></td>" +
                "<td><input type='text' name='fullname[]'></td>" +
                "<td><input type='email' name='email[]'></td>" +
                "<td><input type='text' name='phonenumber[]'></td>" +
                "<td><input type='text' name='idnumber[]'></td>";
        }

        function confirmDeleteUser() {
            // JavaScript confirmation for deleting a user
            var confirmation = confirm("Are you sure you want to delete selected user(s)?");
            if (confirmation) {
                // Proceed with form submission if user confirms
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</head>
<body>
<header class="">
    <div class="usernav">
        <nav class="">
            <a href="dashboard.php">Dashboard</a>
            <a href="admin.php">Add Products</a>
            <a href="products.php">View Products</a>
            <a href="user.php">System Users</a>
            <a href="customer.php">Customer Feedback</a>
        </nav>
    </div>
</header>

<h2>User Management</h2>

<form method="POST">
    <table>
        <tr>
            <th>Select</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>ID Number</th>
        </tr>
        <?php
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td><input type='checkbox' name='selectedUsers[]' value='{$row['idnumber']}'></td>";
            echo "<td><input type='text' name='fullname[]' value='{$row['fullname']}'></td>";
            echo "<td><input type='email' name='email[]' value='{$row['email']}'></td>";
            echo "<td><input type='text' name='phonenumber[]' value='{$row['phonenumber']}'></td>";
            echo "<td><input type='text' name='idnumber[]' value='{$row['idnumber']}'></td>";
            echo "</tr>";
        }
        ?>
        <tr id="newRow" style="display: none;">
            <td><input type='checkbox' name='selectedUsers[]'></td>
            <td><input type='text' name='fullname[]'></td>
            <td><input type='email' name='email[]'></td>
            <td><input type='text' name='phonenumber[]'></td>
            <td><input type='text' name='idnumber[]'></td>
        </tr>
        <tr>
            <td colspan="5">
                <button type="button" onclick="addUserRow()">Add User</button>
                <button type="submit" name="delete">Delete User</button>
                <button type="submit" name="save">Save Changes</button>
            </td>
        </tr>
    </table>
</form>

<form id="deleteForm" method="POST" style="display: none;">
    <input type="hidden" name="deleteUser">
</form>

</body>
</html>

<?php
mysqli_close($con);
?>