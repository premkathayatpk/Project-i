<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}

// Include your database connection file
include 'config.php';

// Retrieve the first name from the database based on the username
$username = $_SESSION['uname'];
$u_id = $_SESSION['u_id'];

$stmt = $conn->prepare("SELECT firstname FROM customer WHERE email = ?");
$stmt1 = $conn->prepare("SELECT u_id FROM customer WHERE email = ?");
$stmt->bind_param("s", $username);
$stmt1->bind_param("i", $u_id);

$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($firstname);
    $stmt->fetch();
} else {
    // Handle the case where the username is not found in the database
    $firstname = "Unknown";
}

$stmt->close();
?>

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
      <a href="index1.php"><img class="shoe_logo" src="images/logo.png" alt="Logo"></a>
    </div>

    <div class="search_bar">
      <i class="fa-solid fa-magnifying-glass search_icon"></i>
      <input class="search_input" placeholder="Search">
    </div>

    <div class="action_bar">
      Welcome, <?php echo $firstname; ?>!

      <a class="action_container" href="logout.php">
        <span class="action_name">Logout</span>
      </a>
      <a href="cart.php" class="cart_btn"> <i class="fa-solid fa-cart-arrow-down"></i></a>
      <a href="wishlist.php" class="Wish_btn">Wishlist</a>
    </div>
  </header>

  <!-- Navbar section -->
  <div class="nav">
    <nav class="nav_bar">
      <a href="index1.php">Home</a>
      <a href="men.php">Men</a>
      <a href="women.php">Women</a>
      <a href="kids.php">Kids</a>
      <a href="contactus.php">Contact Us</a>
    </nav>
    <div class="menu_icon">
      <i class="fa-solid fa-bars"></i>
    </div>
  </div>

  <script src="js/index.js"></script>
</body>

</html>
