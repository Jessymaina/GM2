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
        <h2>create account</h2>
        <form action="register.php" method="post">
            <div class="form-group">
                <label for="name">NAME:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">EMAIL:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="phonenumber">PHONE NUMBER:</label>
                <input type="number" id="phonenumber" name="phonenumber" required>
            </div>
            <div class="form-group">
                <label for="idnumber">ID NUMBER:</label>
                <input type="number" id="idnumber" name="idnumber" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password1" name="password1" required>
            </div>
            <div class="form-group">
                <label for="password">Confirm Password:</label>
                <input type="password" id="password2" name="password2" required>
            </div>

            <button type="submit" name="register" class="login-button">register</button>
        </form>
        <a href="index.php">back to log in</a>
    <a href="home.php">back home</a>
    </div>

</body>
</html>