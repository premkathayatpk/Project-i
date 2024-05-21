<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Kids Products</title>
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   
   <link rel="stylesheet" href="../css/style.css">
</head>

<body>
   <div class="container">
      <section class="products">
         <h1 class="heading">Kids Products</h1>
               <div class="box-container">
                  <?php
                  $select_products = mysqli_query($conn, "SELECT * FROM product");
                 
                  if (mysqli_num_rows($select_products) > 0) {
                     while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                        $product_category= $fetch_product['category'];
                        if ($product_category == 'Kids') {
                        ?>
                        <form action="" method="post">
                            <div class="box">
                                <img src="<?php echo "../Admin/uploaded_img/" . $fetch_product['image']; ?>" alt="">
                                <h3>
                                <div class='name'><?php echo $fetch_product['name']; ?></div>
                                </h3>
                                
                                <div class="brand"> Brand: <?php echo $fetch_product['brand']; ?></div>
                                <!-- <div class="category"><?php echo $fetch_product['category']; ?></div> -->
                                <div class="size">Size: <?php echo $fetch_product['size']; ?></div>
                                <div class="price">Rs. <?php echo $fetch_product['price']; ?>/-</div>

                                <input type="hidden" name="product_brand" value="<?php echo $fetch_product['brand']; ?>">
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                <input type="hidden" name="product_category" value="<?php echo $fetch_product['category']; ?>">
                                <input type="hidden" name="product_size" value="<?php echo $fetch_product['size']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <button type="submit" onclick="loginmessage()" class="btn" name="add_to_cart">Add to Cart</button>
                                <button type="submit" onclick="loginmessage()" class="btn" name="add_to_wishlist">Add to Wishlist</button>
                            </div>
                        </form>
                        <?php
                     }
                  }}
                  ?>
               </div>
          
            </section>
   </div>

   <script>
        function loginmessage(){
            alert ("Login First");
        }

</script>

   <?php include 'footer.php';?>
</body>
</html>
