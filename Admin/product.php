<?php
require('header.php');

$message = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $product_Name = isset($_POST["name"]) ? mysqli_real_escape_string($conn, $_POST['name']) : '';
    $product_Price = isset($_POST["price"]) ? $_POST['price'] : '';
    $product_size = isset($_POST["size"]) ? $_POST['size'] : '';
    $product_brand = isset($_POST["brand"]) ? $_POST['brand'] : '';
    $product_category = isset($_POST["category"]) ? $_POST['category'] : '';

    if (empty($product_Name)) {
        $errors[] = 'Please provide a product name';
    }

    if ($product_Price <= 0) {
        $errors[] = 'Please provide a valid product price';
    }

    if (empty($product_size)) {
        $errors[] = 'Please provide product size';
    }

    if (empty($product_brand)) {
        $errors[] = 'Please provide product brand';
    }

    if (empty($errors)) {
        // Check if product with the same name exists
        $check_product_query = "SELECT * FROM product WHERE name='$product_Name'";
        $check_product_result = mysqli_query($conn, $check_product_query);
        
        if (mysqli_num_rows($check_product_result) > 0) {
            $message[] = 'Product with the same name already exists.';
        } else {
            if (!empty($_FILES['file']['name'])) {
                $file_name = $_FILES['file']['name'];
                $file_tmp = $_FILES['file']['tmp_name'];
                $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                $upload_dir = 'uploaded_img/';
                $target_file = $upload_dir . basename($file_name);

                $extensions = array("jpeg", "jpg", "png");

                if (in_array($file_ext, $extensions)) {
                    if (move_uploaded_file($file_tmp, $target_file)) {
                        $insert_product = mysqli_query($conn, "INSERT INTO product(name, price, image, size, brand, category) VALUES('$product_Name', '$product_Price', '$file_name', '$product_size', '$product_brand', '$product_category')");
                        if ($insert_product) {
                            $message[] = 'Product added successfully.';
                            $product_Name = '';
                            $product_Price = '';
                        } else {
                            $message[] = 'Error adding product to database';
                        }
                    } else {
                        $message[] = 'Failed to upload file';
                    }
                } else {
                    $message[] = "Extension not allowed, please select JPEG or PNG file";
                }
            } else {
                $message[] = 'Please upload an image';
            }
        }
    } else {
        foreach ($errors as $error) {
            $message[] = $error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <meta charset="UTF-8" />
    <title>Product Management</title>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="css/product.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hidden {
            display: none;
        }
        .visible {
            display: block;
        }
        #toggleButton {
            cursor: pointer;
            padding: 8px;
            border: none;
            border-radius: 5px;
            background-color: green;
            color: white;
            font-size: 20px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <center>
        <button id="toggleButton">Add Product</button>
        <div id="toggleDiv" class="hidden">
            <div class="form-container">
                <h2>Add a Product</h2>
                <?php if (!empty($message)) : ?>
                    <?php foreach ($message as $msg) : ?>
                        <div class="message">
                            <span><?php echo $msg; ?></span>
                            <i class="fas fa-times" onclick="this.parentElement.style.display = 'none';"></i>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <form action="" method="post" enctype="multipart/form-data">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Name" value="<?php echo isset($product_Name) ? $product_Name : ''; ?>">
                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" placeholder="Price" min="0" value="<?php echo isset($product_Price) ? $product_Price : ''; ?>">
                    <label for="size">Size</label>
                    <input type="text" id="size" name="size" placeholder="Size" value="<?php echo isset($product_size) ? $product_size : ''; ?>" required>
                    <label for="brand">Brand</label>
                    <input type="text" id="brand" name="brand" placeholder="Brand Name" value="<?php echo isset($product_brand) ? $product_brand : ''; ?>" required>
                    <label for="category">Category</label>
                    <select name="category">
                        <option value='Men' <?php echo (isset($product_category) && $product_category == 'Men') ? 'selected' : ''; ?>>Men</option>
                        <option value='Women' <?php echo (isset($product_category) && $product_category == 'Women') ? 'selected' : ''; ?>>Women</option>
                        <option value='Kids' <?php echo (isset($product_category) && $product_category == 'Kids') ? 'selected' : ''; ?>>Kids</option>
                    </select>
                    <br>
                    <label for="file">Image</label>
                    <input type="file" id="file" name="file">
                    <button type="submit" id="submit" name="submit" class="button">Submit</button>
                </form>
            </div>
        </div>
        <script>
            document.getElementById('toggleButton').addEventListener('click', function () {
                var div = document.getElementById('toggleDiv');
                if (div.classList.contains('hidden')) {
                    div.classList.remove('hidden');
                    div.classList.add('visible');
                } else {
                    div.classList.remove('visible');
                    div.classList.add('hidden');
                }
            });
        </script>
        <div class="product-list">
            <h2>Product List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Brand</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch all products from the database
                    $result = mysqli_query($conn, "SELECT * FROM product");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td><img src='uploaded_img/{$row['image']}' alt='{$row['name']}' width='100'></td>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['price']}</td>";
                        echo "<td>{$row['size']}</td>";
                        echo "<td>{$row['brand']}</td>";
                        echo "<td>{$row['category']}</td>";
                        echo "<td>
                                <a href='edit_product.php?id={$row['id']}'><i class='fas fa-edit'></i></a>
                                <a href='delete_product.php?id={$row['id']}' onclick='return confirm(`Are you sure you want to delete this product?`);'><i class='fas fa-trash-alt'></i></a>
                            </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </center>
</body>
</html>
