<?php


include 'header.php';
// include 'config.php';

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
    $u_id=$u_id;

    // Using prepared statements to prevent SQL injection
    $select_cart = $conn->prepare("SELECT * FROM cart WHERE name = ? and u_id=?");
    $select_cart->bind_param("si", $product_name,$u_id);
    $select_cart->execute();
    $result = $select_cart->get_result();
    
    if ($result->num_rows > 0) {
        $message[] = 'Product already added to cart.';
    } else {
        $insert_product = $conn->prepare("INSERT INTO cart(brand, name, category, size, price, image, quantity,u_id) VALUES(?, ?, ?, ?, ?, ?, ?,?)");
        $insert_product->bind_param("ssssssii", $product_brand, $product_name, $product_category, $product_size, $product_price, $product_image, $product_quantity,$u_id);
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
    $u_id=$u_id;
    
    // Using prepared statements to prevent SQL injection
    $select_wishlist = $conn->prepare("SELECT * FROM wishlist WHERE name = ? and u_id=?");
    $select_wishlist->bind_param("si", $product_name,$u_id);
    $select_wishlist->execute();
    $result = $select_wishlist->get_result();
    
    if ($result->num_rows > 0) {
        $message[] = 'Product already added to wishlist.';
    } else {
        $insert_product = $conn->prepare("INSERT INTO wishlist(brand, name, category, size, price, image, quantity,u_id) VALUES(?, ?, ?, ?, ?, ?, ?,?)");
        $insert_product->bind_param("ssssssii", $product_brand, $product_name, $product_category, $product_size, $product_price, $product_image, $product_quantity,$u_id);
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

<div class="hero">
    <img src="images/banner1.jpg" alt="Image">
</div>

<?php
// Display messages
if (!empty($message)) {
    foreach ($message as $msg) {
        echo '<div class="message"><span>' . $msg . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i></div>';
    }
}
?>

<div class="container">
    <section class="products">
        <h1 class="heading">Featured Products</h1>
        <div class="box-container">
            <?php
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
                            <button type="submit" class="btn" name="add_to_cart">Add to Cart</button>
                            <button type="submit" class="btn" name="add_to_wishlist">Add to Wishlist</button>
                        </div>
                    </form>
            <?php
                }
            } else {
                echo '<p>No products found</p>';
            }
            ?>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
