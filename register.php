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
                <form action="" method="post">
                    <div class="field  input">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
                    </div>

                    <div class="field  input">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                    </div>

                    <div class="field  input">
                        <label for="address">Address</label>
                        <input type="text" name="address" id="address" placeholder="Address " required>
                    </div>

                    <div class="field  input">
                        <label for="country">Country</label>
                        <input type="text" name="country" id="country" placeholder="Your Country" required>
                    </div>

                    
                    <div class="field  input">
                        <label for="zipcode">Zipcode</label>
                        <input type="text" name="zipcode" id="zipcode" placeholder="Zipcode" required>
                    </div>

                    <div class="field  input ">
                        <label for="gender">Gender</label>
                        <div class="gender">
                            <label for="male" class="radio-inline">
                                <input type="radio" name="gender" id="male" value="m" required>
                                Male
                            </label>
                            <label for="female" class="radio-inline">
                                <input type="radio" name="gender" id="female" value="f" required>
                                Female</label>
                            <label for="other" class="radio-inline">
                                <input type="radio" name="gender" id="other" value="o" required>
                                Others</label>

                        </div>
                    </div>