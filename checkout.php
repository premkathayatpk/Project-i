<?php
include 'header.php';

if (isset($_POST['order_btn'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $house_no = $_POST['house_no'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $state = $_POST['state'];
    $u_id = $u_id;
    // Retrieve products from the cart for the current user
    $cart_query = $conn->prepare("SELECT * FROM cart WHERE u_id = ?");
    $cart_query->bind_param("i", $u_id);
    $cart_query->execute();
    $cart_result = $cart_query->get_result();

    $total_price = 0;
    $product_name = [];

    if ($cart_result->num_rows > 0) {
        while ($product_item = $cart_result->fetch_assoc()) {
            $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
            $product_price = $product_item['price'] * $product_item['quantity'];
            $total_price += $product_price;
        }
        $total_products = implode(', ', $product_name);

        // Insert order details into the database
        $detail_query = $conn->prepare("INSERT INTO `order` (name, number, email, method, house_no, street, city, state, total_products, total_price) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $detail_query->bind_param("ssssissssd", $name, $number, $email, $method, $house_no, $street, $city, $state, $total_products, $total_price);
        $detail_query->execute();

        if ($detail_query) {
            echo "
           
            <div class='order-message-container'>
                <div class='message-container'>
                    <h3>Thank you for shopping!</h3>
                    <div class='order-detail'>
                        <span>$total_products</span>
                        <span class='total'>Total: $$total_price/-</span>
                    </div>
                    <div class='customer-details'>
                        <p>Your name: <span>$name</span></p>
                        <p>Your number: <span>$number</span></p>
                        <p>Your email: <span>$email</span></p>
                        <p>Your address: <span>$house_no, $city</span></p>
                        <p>Your payment mode: <span>$method</span></p>
                    </div>
                     <a href='index1.php' class='btn'>OK</a>
                    <a href='checkout.php' class='btn'>Continue shopping</a>
                </div>
            </div>";
            echo "<script>alert('Thank you for shopping! Your order has been successfully placed.');</script>";

        } else {
            echo "Error inserting order details: " . $conn->error;
        }
    } else {
        echo "<div class='order-message-container'><div class='message-container'><h3>No items found in your cart!</h3></div></div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .conformbtn button {
            margin-top: 20px;
            background-color: blue;
            width: 100%;
            font-size: 20px;
            color: white;
            font-weight: 700;
            padding: 5px;
            border: none;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <section class="checkout-form">
            <h1 class="heading">Complete Your Order</h1>
            <form action="" method="post">
                <div class="display-order">
                    <?php
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` where u_id=$u_id");
                   
                    $total = 0;
                    $grand_total = 0;
                    if (mysqli_num_rows($select_cart) > 0) {
                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                            $total_price = ($fetch_cart['price'] * $fetch_cart['quantity']);
                            $grand_total = $total += $total_price;
                            echo "<span>{$fetch_cart['name']} ({$fetch_cart['quantity']})</span>";
                        }
                        echo "<span class='grand-total'>Grand Total: $$grand_total/-</span>";
                    }
                     else {
                        echo "<div class='display-order'><span>Your cart is empty!</span></div>";
                    }
                    ?>
                </div>
                <div class="flex">
                    <div class="inputBox">
                        <span>Your Name</span>
                        <input type="text" placeholder="Name" name="name" required>
                    </div>
                    <div class="inputBox">
                        <span>Your Number</span>
                        <input type="number" placeholder="Phone Number" name="number" required>
                    </div>
                    <div class="inputBox">
                        <span>Your Email</span>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="inputBox">
                        <span>Payment Method</span>
                        <select name="method">
                            <option value="cash on delivery" selected>Cash on Delivery</option>
                            <option value="credit card">Credit Card</option>
                            <option value="esewa">Esewa</option>
                        </select>
                    </div>
                    <div class="inputBox">
                        <span>House Number</span>
                        <input type="text" placeholder="House Number" name="house_no" required>
                    </div>
                    <div class="inputBox">
                        <span>City</span>
                        <input type="text" placeholder="City" name="city" required>
                    </div>
                    <div class="inputBox">
                        <span>Street</span>
                        <input type="text" placeholder="Street" name="street" required>
                    </div>
                    <div class="inputBox">
                        <span>State</span>
                        <input type="text" placeholder="State" name="state" required>
                    </div>
                    
                    
                    </div>
                    <div class="conformbtn">
                        <button type="submit" name="order_btn">Confirm</button>
                </div>
            </form>
        </section>
    </div>
</body>

</html>
<?php include 'footer.php'; ?>
