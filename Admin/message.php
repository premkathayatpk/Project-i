<?php
    include 'header.php';
    ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback List</title>
    <style>
    
    </style>
    
    <link rel='stylesheet' href='css/message.css'>

</head>

<body>
    <center>
        <h1>Feedback</h1>
   <?php


    // Function to delete a message
    function deleteMessage($conn, $id)
    {
        $sql = "DELETE FROM message WHERE mid=$id";
        if ($conn->query($sql) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
    }

    // Check if delete request is sent
    if (isset($_GET['delete_id'])) {
        deleteMessage($conn, $_GET['delete_id']);
    }

    // SQL query to select email and message from the message table
    $sql = "SELECT mid, email, message FROM message";

    // Execute the query
    $result = $conn->query($sql);

    // Check if there are any rows in the result
    if ($result->num_rows > 0) {
        // Output data of each row
        echo "<table>";
        echo "<tr><th>Email</th><th>Feedback</th><th>Action</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["email"] . "</td><td>" . $row["message"] . "</td>";
            echo "<td><form method='get'><input type='hidden' name='delete_id' value='" . $row["mid"] . "'><button type='submit' class='delete-btn'>Delete</button></form></td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results"; // If no rows are returned
    }

    // Close the database connection
    $conn->close();

    ?>
    </center>
</body>

</html>
