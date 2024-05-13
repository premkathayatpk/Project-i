<?php
require('header.php');
include '../config.php';

if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch product details from database
    $query = "SELECT * FROM product WHERE id=$id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
}

if(isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];

    // Update product details in the database
    $query = "UPDATE product SET name='$name', price='$price', size='$size', brand='$brand', category='$category' WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if($result) {
        echo "<script>alert('Update success');</script>";
        header("Location: product.php");
    } else {
        echo "<script>alert('Failed to update product');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
</head>
<body>
    <h2>Edit Product</h2>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>">

        <label for="price">Price</label>
        <input type="number" id="price" name="price" min="0" value="<?php echo $product['price']; ?>">

        <label for="size">Size</label>
        <input type="text" id="size" name="size" value="<?php echo $product['size']; ?>">

        <label for="brand">Brand</label>
        <input type="text" id="brand" name="brand" value="<?php echo $product['brand']; ?>">

        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="Men" <?php if($product['category'] == 'Men') echo 'selected'; ?>>Men</option>
            <option value="Women" <?php if($product['category'] == 'Women') echo 'selected'; ?>>Women</option>
            <option value="Kids" <?php if($product['category'] == 'Kids') echo 'selected'; ?>>Kids</option>
        </select>

        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
