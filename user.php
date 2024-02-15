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

            // Update user details in the database using the ID number as the identifier
            $sqlUpdateUser = "UPDATE register SET fullname='$fullname', email='$email', phonenumber='$phonenumber' WHERE idnumber='$idnumber'";
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
if (isset($_POST['deleteUser'])) {
    // Check if users are selected for deletion
    if (isset($_POST['selectedUsers'])) {
        $selectedUsers = $_POST['selectedUsers'];
        // Loop through selected users and delete them from the database
        foreach ($selectedUsers as $userId) {
            $sqlDeleteUser = "DELETE FROM register WHERE idnumber='$userId'";
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

// Fetch user records from the database
$sqlSelectUsers = "SELECT * FROM register";
$result = mysqli_query($con, $sqlSelectUsers);
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
    </style>
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
                <button type="button" onclick="confirmDeleteUser()">Delete User</button>
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
