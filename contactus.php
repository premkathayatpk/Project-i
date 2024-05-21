<?php 
include 'header.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/index.css">
</head>

<body>
<center>
    <form method="post" action="">
      <div class="contact-email">
        Email:<br>
        <input type="email" name="email" placeholder="Email" required>
      </div>

      <div class="contact-message">
        Message:
        <br>
        <textarea name="message" id="message" placeholder="Type your Message." cols="30" rows="10"></textarea>
      </div>
      <div class="contact-button">
        <button type="submit" name="btn-submit" class="btn btn-submit">Submit</button>
        <button type="reset" class="btn btn-cancel">Cancel</button>
      </div>
    </form>
  </div>
</body>
</center>
</html>

<?php 
if (isset($_POST['btn-submit'])){
  // Include your database connection file
  // include 'connection.php';

  // Prepare and bind parameters
  $stmt = $conn->prepare("INSERT INTO message (email, message) VALUES (?, ?)");
  $stmt->bind_param("ss", $email, $message);

  // Set parameters
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Execute statement
  if ($stmt->execute() === TRUE) {
      echo "Message inserted successfully";
  } else {
      echo "Error: " . $conn->error;
  }

  // Close statement
  $stmt->close();

  // Close connection
  $conn->close();
}

include 'footer.php';
?>
