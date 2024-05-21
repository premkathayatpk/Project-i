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
            <form action="index.php" method="GET">
                <input class="search_input" type="text" name="search" placeholder="Search">
            </form>
        </div>

        <div class="action_bar">
            <a class="action_container" href="login.php">
                <span class="action_name">Login</span>
            </a>
            <a onclick="loginmessage()" class="cart_btn"> <i class="fa-solid fa-cart-arrow-down"></i></a>
            <a onclick="loginmessage()" class="Wish_btn"><i class="fa-solid fa-heart"></i></a>
        </div>
    </header>

    <!-- Navbar section -->
    <div class="nav">
        <nav class="nav_bar">
            <a href="index.php">Home</a>
            <a href="home/men.php">Men</a>
            <a href="home/women.php">Women</a>
            <a href="home/kids.php">Kids</a>
            <a href="home/contactus.php">Feedback</a>
        </nav>
        <div class="menu_icon">
            <i class="fa-solid fa-bars"></i>
        </div>
    </div>

    <!-- Hero section -->
    <div class="hero">
        <img src="images/banner1.jpg" alt="Image">
    </div>
    <div class="container">
        <section class="products">
            <h1 class="heading">Featured Products</h1>
            <div class="box-container">
                <?php
                include 'config.php';
                
                // Check if search term is set
                $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

                // Modify the query to include search term
                $sql = "SELECT * FROM product";
                if ($search) {
                    $sql .= " WHERE name LIKE '%$search%' OR brand LIKE '%$search%' OR category LIKE '%$search%' OR size LIKE '$search' OR price LIKE '$search' ";
                }

                $select_products = mysqli_query($conn, $sql);
                if (mysqli_num_rows($select_products) > 0) {
                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                ?>
                        <form action="" method="post">
                            <div class="box">
                                <img src="<?php echo "Admin/uploaded_img/" . $fetch_product['image']; ?>" alt="">
                                <h3>
                                    <div class='name'><?php echo $fetch_product['name']; ?></div>
                                </h3>
                                
                                <div class="brand"> Brand: <?php echo $fetch_product['brand']; ?></div>
                                <div class="size">Size: <?php echo $fetch_product['size']; ?></div>
                                <div class="price">Rs. <?php echo $fetch_product['price']; ?>/-</div>

                                <input type="hidden" name="product_brand" value="<?php echo $fetch_product['brand']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
                                <input type="hidden" name="product_size" value="<?php echo $fetch_product['size']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <button type="submit" class="btn" onclick="loginmessage()" name="add_to_cart">Add to Cart</button>
                                <button type="submit" class="btn" onclick="loginmessage()" name="add_to_wishlist">Add to Wishlist</button>
                            </div>
                        </form>
                <?php
                    }
                } else {
                    echo "<p>No products found</p>";
                }
                ?>
            </div>
        </section>
    </div>
    <?php include 'footer.php'; ?>

    <script src="js/index.js"></script>
    <script>
        function loginmessage() {
            alert("Login First");
        }
    </script>
</body>
</html>
