<?php
include 'header.php';
// @include 'config.php';

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
    $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE name = ? and u_id=?");
    $select_cart->bind_param("si", $product_name,$u_id);
    $select_cart->execute();
    $result = $select_cart->get_result();
    if ($result->num_rows > 0) {
        $message[] = 'Product already added to cart';
    } else {
        $insert_product = $conn->prepare("INSERT INTO cart(brand, name, category, size, price, image, quantity,u_id) VALUES(?, ?, ?, ?, ?, ?, ?,?)");
        $insert_product->bind_param("ssssssii", $product_brand, $product_name, $product_category, $product_size, $product_price, $product_image, $product_quantity,$u_id);
        $insert_product->execute();
        $message[] = 'Product added to cart successfully.';
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $delete_wishlist_item = $conn->prepare("DELETE FROM wishlist WHERE id = ?");
    $delete_wishlist_item->bind_param("i", $remove_id);
    $delete_wishlist_item->execute();
    header('location:wishlist.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
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
            <h1 class="heading">Wishlist</h1>
            <div class="box-container">
                <?php
                 $u_id = $_SESSION['u_id'];
                $select_products = mysqli_query($conn, "SELECT * FROM wishlist WHERE u_id = '$u_id'");
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
                                <a href="wishlist.php?remove=<?php echo $fetch_product['id']; ?>" onclick="return confirm('Remove item from cart?')" class="delete-btn"><i class="fas fa-trash"></i> Remove</a>
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
</body>

</html>
