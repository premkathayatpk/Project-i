<?php
require 'header.php';
?>

<center>
<?php


function deleteCustomer($conn, $id)
{
    // First, delete associated rows from the cart table
    $sql_delete_cart = "DELETE FROM cart WHERE u_id=$id";
    $conn->query($sql_delete_cart);

    // Then, delete the customer from the customer table
    $sql_delete_customer = "DELETE FROM customer WHERE u_id=$id";
    if ($conn->query($sql_delete_customer) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}


// Check if delete request is sent
if (isset($_GET['delete_id'])) {
    deleteCustomer($conn, $_GET['delete_id']);
}

?>
</center>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/customer.css">

</head>

<body>


    <div class="customer">
        <center>
            <h1>Customers</h1>
        </center>

        <div class="customer-table">
            <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Action</th> <!-- Action column added -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = mysqli_query($conn, "SELECT * FROM `customer`") or die(mysqli_error($conn));
                    while ($fetch = mysqli_fetch_array($query)) {
                    ?>
                        <tr>
                            <td><?php echo $fetch['firstname']; ?></td>
                            <td><?php echo $fetch['lastname']; ?></td>
                            <td><?php echo $fetch['address']; ?></td>
                            <td><?php echo $fetch['mobile']; ?></td>
                            <td><?php echo $fetch['email']; ?></td>
                            <!-- Action column with delete button -->
                            <td>
                                <form method="get">
                                    <input type="hidden" name="delete_id" value="<?php echo $fetch['u_id']; ?>">
                                    <button type="submit" class="delete-btn">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
