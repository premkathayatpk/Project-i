<?php
include 'config.php';

// Initialize message array
$message = [];

if (isset($_POST['add_to_cart'])) {
    $product_brand = $_POST['product_brand'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_size = $_POST['product_size'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    
    // Using prepared statements to prevent SQL injection
    $select_cart = $conn->prepare("SELECT * FROM cart WHERE name = ?");
    $select_cart->bind_param("s", $product_name);
    $select_cart->execute();
    $result = $select_cart->get_result();
    
    if ($result->num_rows > 0) {
        $message[] = 'Product already added to cart.';
    } else {
        $insert_product = $conn->prepare("INSERT INTO cart(brand, name, category, size, price, image, quantity) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $insert_product->bind_param("ssssssi", $product_brand, $product_name, $product_category, $product_size, $product_price, $product_image, $product_quantity);
        $insert_product->execute();
        $message[] = 'Product added to cart successfully.';
    }
}

if (isset($_POST['add_to_wishlist'])) {
    $product_brand = $_POST['product_brand'];
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_size = $_POST['product_size'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    
    // Using prepared statements to prevent SQL injection
    $select_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE name = ?");
    $select_wishlist->bind_param("s", $product_name);
    $select_wishlist->execute();
    $result = $select_wishlist->get_result();
    
    if ($result->num_rows > 0) {
        $message[] = 'Product already added to wishlist.';
    } else {
        $insert_product = $conn->prepare("INSERT INTO wishlist(brand, name, category, size, price, image, quantity) VALUES(?, ?, ?, ?, ?, ?, ?)");
        $insert_product->bind_param("ssssssi", $product_brand, $product_name, $product_category, $product_size, $product_price, $product_image, $product_quantity);
        $insert_product->execute();
        $message[] = 'Product added to wishlist successfully.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
 
</head>
<body>
    <!-- Header section -->
  <header>
    <div class="logo_container">
      <a href="index.php"><img class="shoe_logo" src="images/logo.png" alt="Logo"></a>
    </div>

    <div class="search_bar">
      <i class="fa-solid fa-magnifying-glass search_icon"></i>
      <input class="search_input" placeholder="Search">
    </div>



    <div class="action_bar">
      <a class="action_container" href="login.php">
        <span class="action_name">Login</span>
      </a>
      <a href="cart.php" class="cart_btn"> <i class="fa-solid fa-cart-arrow-down"></i></a>
      <a href="wishlist.php" class="Wish_btn">Wishlist</a>
    </div>
  </header>

  <!-- Navbar section -->
  <div class="nav">
    <nav class="nav_bar">
      <a href="index.php">Home</a>
      <a href="men.php">Men</a>
      <a href="women.php">Women</a>
      <a href="kids.php">Kids</a>
      <a href="contactus.php">Contact Us</a>
    </nav>
    <div class="menu_icon">
      <i class="fa-solid fa-bars"></i>
    </div>
  </div>

<!-- Hero section -->
    <div class="hero">
        <img src="images/banner1.jpg" alt="Image">
    </div>
    <?php
    // Display messages
    if (!empty($message)) {
        foreach ($message as $msg) {
            echo '<div class="message"><span>' . $msg . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        }
    }
    ?>
    <div class="container">
        <section class="products">
            <h1 class="heading">Featured Products</h1>
            <div class="box-container">
                <?php
                $select_products = mysqli_query($conn, "SELECT * FROM product");
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <form action="" method="post">
                            <div class="box">
                                <img src="<?php echo "Admin/uploaded_img/" . $fetch_product['image']; ?>" alt="">
                                <h3>Brand: <?php echo $fetch_product['brand']; ?></h3>
                                <div class='name'><?php echo $fetch_product['name']; ?></div>
                                <div class="category"><?php echo $fetch_product['category']; ?></div>
                                <div class="size">Size: <?php echo $fetch_product['size']; ?></div>
                                <div class="price">Rs. <?php echo $fetch_product['price']; ?>/-</div>

                                <input type="hidden" name="product_brand" value="<?php echo $fetch_product['brand']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
                                <input type="hidden" name="product_size" value="<?php echo $fetch_product['size']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <button type="submit" class="btn" name="add_to_cart">Add to Cart</button>
                                <button type="submit" class="btn" name="add_to_wishlist">Add to Wishlist</button>
                            </div>
                        </form>
                <?php
                    }
                }
                ?>
            </div>
        </section>
    </div>
    <?php include 'footer.php'; ?>

    <script src="js/index.js"></script>

</body>
</html>
