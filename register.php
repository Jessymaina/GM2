 <?php
require_once('connection.php');
?>
<!-- code to insert to insert new user details to database and to create account -->
<?php
if (isset ($_POST['register'])){
   $privilege = "user";
   $datecreated = date("Y-m-d H:i:s");
   $password1 = md5($_POST['password1']);//security.
   $password2 = md5($_POST['password2']);
if($password1==$password2){
  $name =$_POST['name'];
  $email =$_POST['email'];
  $phonenumber =$_POST['phonenumber'];
  $idnumber =$_POST['idnumber'];
  $sqlcreateuser = "INSERT INTO register (fullname,email,phonenumber,datecreated,idnumber) VALUES ('{$name}','{$email}','{$phonenumber}','{$datecreated}','{$idnumber}')";
if ($con->query($sqlcreateuser) === true ){
  
    $sqlcreateaccount = "INSERT INTO user (username,userpassword,priviledge) VALUES ('{$email}','{$password2}','{$privilege}')"; 
    if ($con->query($sqlcreateaccount) === true ){
        echo "<script>alert('account successful');</script>";
    }
    else{
        echo "<script>alert('account created contact admin for log in credentials');</script>";
    }

}
else{
    echo "<script>alert('failed');</script>";
}
}
else{
    echo "<script>alert('password do not match');</script>";
 
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOG IN</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<div class="login-form">
    <h2>Create Account</h2>
    <form action="register.php" method="post">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required oninput="checkEmailValidity(this)">
            <small id="email-error-msg" style="color: red;"></small>
        </div>
        <div class="form-group">
            <label for="phonenumber">Phone Number:</label>
            <input type="tel" id="phonenumber" name="phonenumber" pattern="[0-9]{10}" required>
            <small>Format: 10 digits</small>
        </div>
        <div class="form-group">
            <label for="idnumber">ID Number:</label>
            <input type="text" id="idnumber" name="idnumber" pattern="[0-9]{8}" required>
            <small>Format: 8 digits</small>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password1" name="password1" minlength="6" required>
            <small>Minimum length: 6 characters</small>
        </div>
        <div class="form-group">
            <label for="password">Confirm Password:</label>
            <input type="password" id="password2" name="password2" minlength="6" required>
            <small>Minimum length: 6 characters</small>
        </div>
        <button type="submit" name="register" class="login-button">Register</button>
    </form>
        <a href="index.php">back to log in</a>
    <a href="home.php">back home</a>
    </div>
    <script>
    function checkEmailValidity(input) {
        let email = input.value;
        let errorMessage = "";
        let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!emailRegex.test(email)) {
            errorMessage = "Please enter a valid email address.";
        }

        document.getElementById("email-error-msg").textContent = errorMessage;
        input.setCustomValidity(errorMessage);
    }
</script>
</body>
</html>