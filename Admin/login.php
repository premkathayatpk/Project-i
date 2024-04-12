<?php
require 'header.php'
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container login">
        <div class="box form-box">
            <header>Login</header>
            <div class="wrapper">
                <form action="" onsubmit="return invalid()" method="post">
                    <div class="field  input">
                        <label for="uname">Username</label>
                        <input type="text" name="uname" id="uname" placeholder="Username" required>
                    </div>

                    <div class="field  input">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="field ">
                        <input type="submit" class="btn" name="submit" value="Login" required>
                    </div>

                    
                </form>
            </div>
        </div>
    </div>
</body>



</html>


<?php 
require ("../config.php");

if(isset($_POST['submit'])){
$username =$_POST['uname'];
$password=$_POST['password'];

    
$query = "select *from admin where username = '$username' and password='$password' ";

$result = $conn->query($query);

if($result -> num_rows == 1){
    //login success
    header("Location: index.php");
    exit();


