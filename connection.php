<?php
$servername = "localhost";
$database = "grocery";
$password = "";
$username = "root";

/*connection to database */
$con = new mysqli($servername,$username,$password,$database);
/*if($con->connect_error){
    echo "connection failed";
}
else{
    echo "connection successsfull";
}*/
?>