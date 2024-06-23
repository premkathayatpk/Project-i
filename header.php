<?php
// Start the session if it hasn't been started already
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit();
}

// Include your database connection file
include 'config.php';

// Retrieve the first name from the database based on the username
$username = $_SESSION['uname'];
$u_id = $_SESSION['u_id'];

$stmt = $conn->prepare("SELECT firstname FROM customer WHERE email = ?");
$stmt->bind_param("s", $username);
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css/header.css">
</head>
<body>
  <!-- Header section -->
  <header>
    <div class="logo_container">
      <a href="index1.php"><img class="shoe_logo" src="images/logo.png" alt="Logo"></a>
    </div>

    <div class="search_bar">
            <i class="fa-solid fa-magnifying-glass search_icon"></i>
            <form action="index1.php" method="GET">
                <input class="search_input" type="text" name="search" placeholder="Search">
            </form>
        </div>

    <div class="action_bar">
      Welcome, <?php echo htmlspecialchars($firstname); ?>!
      <a class="action_container" href="logout.php">
        <span class="action_name">Logout</span>
      </a>
      <a href="cart.php" class="cart_btn"> <i class="fa-solid fa-cart-arrow-down"></i></a>
      <a href="wishlist.php" class="Wish_btn"><i class="fa-solid fa-heart" alter="W"></i></a>
    </div>
  </header>

  <!-- Navbar section -->
  <div class="nav">
    <nav class="nav_bar">
      <a href="index1.php">Home</a>
      <a href="men.php">Men</a>
      <a href="women.php">Women</a>
      <a href="kids.php">Kids</a>
      <a href="contactus.php">Feedback</a>
    </nav>
    <div class="menu_icon">
      <i class="fa-solid fa-bars" alter="Menue"></i>
    </div>
  </div>

  <script src="js/index.js"></script>
</body>
</html>
