<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link src="images/logo.png">

  <title>Shoes Store</title>

  <!-- Google Fonts Link For Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/index.css">
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
      <a href="cart.php" class="btn"> <i class="fa-solid fa-cart-arrow-down"></i></a>
      <a href="wishlist.php" class="btn">Wishlist</a>
    </div>
  </header>