<?php
include 'header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    // Update the order status
    $update_sql = "UPDATE `order` SET `action` = '$status' WHERE `id` = $order_id";
    if ($conn->query($update_sql) === TRUE) {
        // echo "Order status updated successfully.";
    } else {
        // echo "Error updating order status: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <style>
        table {
            margin-top: 20px;
            margin-left: 250px;
            width: 80%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 8px 12px 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: green;    
            color: #fff;   
            font-size:20px; 
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .action-buttons select {
            width: 100%;
            padding: 5px;
        }
select{
    padding:5px;
    font-size:15px;
    color:#fff;
}
   
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select[name="status"]').forEach(function(select) {
                applyOptionStyles(select);
                select.addEventListener('change', function() {
                    applyOptionStyles(this);
                });
            });
        });

        function applyOptionStyles(select) {
            select.style.backgroundColor = '';
            if (select.value === 'Pending') {
                select.style.backgroundColor = 'orange';
                
            } else if (select.value === 'Delivered') {
                select.style.backgroundColor = 'green';
            } else if (select.value === 'Canceled') {
                select.style.backgroundColor = 'red';
            }
        }
    </script>
</head>

<body>
    <center>
        <h2>Order List</h2>
    </center>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>City</th>
                <th>Payment Method</th>
                <th>Mobile Number</th>
                <th>Total Products</th>
                <th>Total Price</th>
                <th>Order Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Select data from the order table
            $sql = "SELECT * FROM `order`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    $status_class = strtolower($row["action"]);
                    echo "<tr>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["city"] . "</td>";
                    echo "<td>" . $row["method"] . "</td>";
                    echo "<td>" . $row["number"] . "</td>";
                    echo "<td>" . $row["total_products"] . "</td>";
                    echo "<td>" . $row["total_price"] . "</td>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "<td class='$status_class'>";
                    echo "<form method='POST' action=''>";
                    echo "<input type='hidden' name='order_id' value='" . $row["id"] . "'>";
                    echo "<select name='status' onchange='this.form.submit()'>";
                    echo "<option class='pending' value='Pending'" . ($row["action"] == "Pending" ? " selected" : "") . ">Pending</option>";
                    echo "<option class='delivered' value='Delivered'" . ($row["action"] == "Delivered" ? " selected" : "") . ">Delivered</option>";
                    echo "<option class='canceled' value='Canceled'" . ($row["action"] == "Canceled" ? " selected" : "") . ">Canceled</option>";
                    echo "</select>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No orders found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>

