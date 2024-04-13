<?php
require ('header.php');
include '../config.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes" />
    <meta charset="UTF-8" />
    <!-- The above 3 meta tags must come first in the head -->

    <title>Save product details</title>

    <script src="https://code.jquery.com/jquery-3.2.1.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="product.css">
       
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php
    if (isset($message)) {
        foreach ($message as $message) {
            echo '<div class="message"><span>' . $message . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
        }
        ;
    }
    ;
    ?>
    <div class="form-container">
        <h2>Add a product</h2>

        <div class="messages">

        </div>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo isset($product_Name) ? $product_Name : ''; ?>">

            <label for="price">Price</label>
            <input type="number" id="price" name="price" min="0"
                value="<?php echo isset($product_Price) ? $product_Price : ''; ?>">
            <label for="file">Size</label>
                    <input type="text" name="size" placeholder="Size" required>
                    
                    <label for="file">Brand</label>
                    <input type="text" name="brand" placeholder="Brand Name	" required>

                   
                    <label for="file">Stock</label>
                    <input type="number" name="qty" placeholder="No. of Stock" required>
                   

                    <label for="file"> Category</label>

                    <select name="category">
                        <option value='men'>Men</option>
                        <option value='women'>Women</option>
                        <option value='kids'>Kids</option>

                    </select>
                    <br>
                    <br>
                    <label for="file">Image</label>
            <input type="file" id="file" name="file">

            <button type="submit" id="submit" name="submit" class="button">
                Submit
            </button>
        </form>