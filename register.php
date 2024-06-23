<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="container register">
        <div class="box form-box">
            <header>Sign Up</header>
            <div class="wrapper">
                <form action="" method="post" id="signupForm">
                    <div class="field input">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
                    </div>

                    <div class="field input">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                    </div>

                    <div class="field input">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" placeholder="Address" required>
                    </div>

                    <div class="field input">
                        <label for="email">Email/Username</label>
                        <input type="email" name="email" id="email" placeholder="Email/Username" required>
                    </div>

                    <div class="field input">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password" required>
                    </div>

                    <div class="field input">
                        <label for="mobile">Phone Number</label>
                        <input type="number" name="mobile" id="mobile" placeholder="Phone Number" required>
                    </div>

                    <div class="field">
                        <input type="submit" class="btn" name="submit" value="Sign Up">
                    </div>

                    <div class="links">
                        Already a member? <a href="login.php">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('signupForm').addEventListener('submit', function (e) {
            let phone = document.getElementById('mobile').value;
            let password = document.getElementById('password').value;

            if (!validatePhone(phone)) {
                alert('Invalid phone number. It must be exactly 10 digits and start with 98.');
                e.preventDefault();
            } else if (!validatePassword(password)) {
                alert('Weak password, please enter a stronger password');
                e.preventDefault(); 
            }
        });

        function validatePassword(password) {
            return password.length > 7;
        }

        function validatePhone(phone) {
            const phoneRegex = /^98\d{8}$/;
            return phoneRegex.test(phone);
        }
    </script>
</body>

</html>


<?php
include 'config.php';
// include 'header.php';

if (isset($_POST['submit'])) {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $address = $_POST['address'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    // Prepare and bind SQL statement
    $sql = "INSERT INTO customer (firstname, lastname, address, mobile, email, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $fname, $lname, $address, $mobile, $email, $password);

    if ($stmt->execute()) {
        // Account creation successful
        echo '<script>alert("Account created successfully."); window.location.href = "login.php";</script>';
        exit;
    } else {
        // Error handling
        echo '<script>alert("Error: ' . $stmt->error . '");</script>';
    }

    $stmt->close();
}

$conn->close();
?>

