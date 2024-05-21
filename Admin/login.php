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
            <header>Admin Login</header>
            <div class="wrapper">
                <form action="" method="post">
                    <div class="field  input">
                        <label for="uname">Username</label>
                        <input type="text" name="uname" id="uname" placeholder="Username" required>
                    </div>



                    <div class="field  input">
                        <label for="password">Password</label>
                        <input type="password" name="password" placeholder="Password" required>
                    </div>

                    <div class="field ">
                        <input type="submit" class="btn" name="submit" value="Login">
                    </div>

                    <div class="goback ">
                        <a href="../index.php">Go Back to Website</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>



</html>


<?php  
session_start(); // Starting the session

include '../config.php';

if(isset($_POST['submit'])){
    $uname= $_POST['uname'];
    $password = $_POST['password'];

    $sql= "SELECT * FROM admin WHERE username='$uname' AND password ='$password'";
    
    $result = $conn->query($sql);

    if($result->num_rows > 0){
        // Login successful, set session variables
        $_SESSION['uname'] = $uname;
        $_SESSION['loggedin'] = true;

        header("Location: index.php");
        exit();
    } else {
        // Login failed
        echo "<script>alert('Invalid Username/Password');</script>";

        exit();
    }
}

?>

