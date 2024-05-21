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
            <h1 class="head">Login</h1>
            <div class="wrapper">
                <form action="" method="post">
                    <div class="field  input">
                        <label for="uname">Email/Username</label>
                        <input type="email" name="uname" id="uname" placeholder="Email/Username" required>
                    </div>

                    <div class="field  input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>

                    <div class="field ">
                        <input type="submit" class="btn" name="submit" value="Login">
                    </div>
                    <div class="admin ">
                        <a href="admin/login.php">Login as Admin</a>
                    </div> 
                    <div class="links">
                        Don't have account? <a href="register.php">Sign Up Now</a>
                    </div>

                    <div class="goback ">
                        <a href="index.php">Go Back to Website</a> 
                    </div>    
                   
                </form>
            </div>
        </div>
    </div>
</body>

</html>

<?php 
session_start(); // Starting the session

include 'config.php';

if(isset($_POST['submit'])){
    $uname = $_POST['uname'];
    $password = $_POST['password'];


    // Using prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM customer WHERE email = ? AND password = ?");
    $stmt->bind_param("ss", $uname, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        // Login successful, fetch user ID and set session variables
        $user = $result->fetch_assoc();
        $_SESSION['uname'] = $user['email'];
        $_SESSION['u_id'] = $user['u_id']; // Assuming u_id is the column name for user ID
        $_SESSION['loggedin'] = true;

        header("Location: index1.php");
        exit();
    } else {
        // Login failed, display an error message
        echo "<script>alert('Invalid Username/Password');</script>";
        exit();
    }
}
?>
