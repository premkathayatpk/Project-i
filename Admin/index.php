<?php require 'header.php'; 
?>
<html>

<head>
    <style>
        h1{
            margin-top:30px;
            text-align:center;
        }
.das-container{
    margin:20px;
    padding-top:20px;
    display:flex;
    justify-content:space-evenly ;
    text-align:center;
    background-color:green;
    color:white;
    height: 200px;
}    </style>
    <link rel='stylesheet' href='css/message.css'>
    <link rel='stylesheet' href='css/customer.css'>
</head>

<body>
<h1>Welcome, to Admin </h1>
    <div class="das-container">
        <div class="total_user">
            <?php
            // Count the number of customers
            $sql = "SELECT COUNT(*) FROM customer";
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Fetch the result and display it
                $row = mysqli_fetch_row($result);
                echo "<h1> " . $row[0] . "</h1>";
            } else {
                // Handle error if query fails
                echo "<h1>Error fetching data</h1>";
            }
            ?>
           <h2>Total Customer</h2>
        </div>
        
        <div class="total_order">
            <?php
            // Count the number of orders
            $sql = "SELECT COUNT(*) FROM `order`"; 
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Fetch the result and display it
                $row = mysqli_fetch_row($result);
                echo "<h1>" . $row[0] . "</h1>";
            } else {
                // Handle error if query fails
                echo "<h1>Error fetching data</h1>";
            }
            ?>
           <h2>Total order</h2> 
        </div>
        
        <div class="total_admin">
        <?php
            // Count the number of orders
            $sql = "SELECT COUNT(*) FROM `product`"; // Use backticks around `order`
            $result = mysqli_query($conn, $sql);

            if ($result) {
                // Fetch the result and display it
                $row = mysqli_fetch_row($result);
                echo "<h1>" . $row[0] . "</h1>";
            } else {
                // Handle error if query fails
                echo "<h1>Error fetching data</h1>";
            }
            ?>
          <h2>Total Product</h2>  
        </div>
    </div>

</body>
</html>
