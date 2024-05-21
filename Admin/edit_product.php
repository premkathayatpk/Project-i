<?php
require('header.php');

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
        // echo "<script>alert('Update success');</script>";
        header("Location: product.php");
    } else {
        echo "<scrip>alert('Failed to update product');</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <style>
        h1{
            text-align: center;
            margin: 20px;

        }
        .s-btn{
           border:none;
           border-radius:5px;
           padding:10px;
           background:#4CAF50;
           color:#ffff;
           font-size:20px;
           font-weight: 800;        }
    </style>
</head>
<body>
    <center>
        
    <h1>Edit Product</h1>
    <form action="" method="post">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="<?php echo $product['name']; ?>">
<br>
<br>
        <label for="price">Price</label>
        <input type="number" id="price" name="price" min="0" value="<?php echo $product['price']; ?>">
        <br>
<br>
        <label for="size">Size</label>
        <input type="text" id="size" name="size" value="<?php echo $product['size']; ?>">
        <br>
<br>
        <label for="brand">Brand</label>
        <input type="text" id="brand" name="brand" value="<?php echo $product['brand']; ?>">
        <br>
<br>
        <label for="category">Category</label>
        <select name="category" id="category">
            <option value="Men" <?php if($product['category'] == 'Men') echo 'selected'; ?>>Men</option>
            <option value="Women" <?php if($product['category'] == 'Women') echo 'selected'; ?>>Women</option>
            <option value="Kids" <?php if($product['category'] == 'Kids') echo 'selected'; ?>>Kids</option>
        </select>
        <br>
<br>
        <button type="submit"  onclick="alert('Update success');" class="s-btn" name="submit">Update</button>
    </form>
    </center>
</body>
</html>
