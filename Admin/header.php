<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/admin.css">
</head>
<body>

  <!-- navbar -->

  <div class="navbar">
    <div class="nav-logo">
      <a href="index.php">
        <span class="icon">
          <img src="image/logo.png" alt="icone">
        </span>
        <br>
        <span class="logo-title"> Shoe Store</span>
      </a>
    </div>

    <div class="nav-items">
      <a href="index.php">
        <span class="icon">
          <i class="fa-solid fa-house"></i> </span>
        Dashboard
      </a>
      <a href="product.php">
        <span class=" icon">
          <i class="fa-solid fa-layer-group"></i> </span>
        Product
      </a>

      <a href="order.php">
        <span class="icon">
          <i class="fa-solid fa-cart-shopping"></i> </span>
        Order
      </a>


      <a href="customer.php">
        <span class="icon">
          <i class="fa-solid fa-users"></i>
        </span>
        Customer
      </a>
      <a href="report.php">
        <span class="icon">
          <i class="fa-solid fa-book"></i> </span>
        Report
      </a>

      <a href="login.php">
        <i class="fa-solid fa-right-from-bracket"></i>
        Logout
      </a>
    </div>
  </div>

  <!-- Header section -->
  <header class="header">
    <div class="menu-icon">
      <i class="fa-solid fa-bars"></i>
    </div>