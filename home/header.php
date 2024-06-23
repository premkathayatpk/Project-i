<?php include '../config.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/header.css">


</head>

<body>
  <!-- Header section -->
  <header>
    <div class="logo_container">
      <a href="../index.php"><img class="shoe_logo" src="../images/logo.png" alt="Logo"></a>
    </div>

    <div class="search_bar">
            <i class="fa-solid fa-magnifying-glass search_icon"></i>
            <form action="../index.php" method="GET">
                <input class="search_input" type="text" name="search" placeholder="Search">
            </form>
        </div>

    <?php    $search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

// Modify the query to include search term
$sql = "SELECT * FROM product";
if ($search) {
  $sql .= " WHERE name LIKE '%$search%' OR brand LIKE '%$search%' OR category LIKE '%$search%' OR size LIKE '$search' OR price LIKE '$search' ";}
?>


    <div class="action_bar">
      <a class="action_container" href="../login.php">
        <span class="action_name">Login</span>
      </a>
      <a onclick="loginmessage()" class="cart_btn"><i class="fa-solid fa-cart-arrow-down"></i></a>
      <a  onclick="loginmessage()" class="Wish_btn"><i class="fa-solid fa-heart"></i></a>
    </div>
  </header>

  <!-- Navbar section -->
  <div class="nav">
    <nav class="nav_bar">
      <a href="../index.php">Home</a>
      <a href="men.php">Men</a>
      <a href="women.php">Women</a>
      <a href="kids.php">Kids</a>
      <a href="contactus.php">Feedback</a>
    </nav>
    <div class="menu_icon">
      <i class="fa-solid fa-bars" alter="Menue"></i>
    </div>
  </div>

  <script src="../js/index.js"></script>

  <script>
        function loginmessage(){
            alert ("Login First");
        }

</script>

</body>

</html>