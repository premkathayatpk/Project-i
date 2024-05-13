<?php
include 'header.php';
include '../config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order List</title>
    <style>
        table {
            margin-left: 250px;
            width: 80%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-buttons select {
            width: 100%;
            padding: 5px;
        }

        /* Pending */
        .pending {
            background-color: yellow;
        }

        /* Delivered */
        .delivered {
            background-color: green;
            color: white;
        }

        /* Canceled */
        .canceled {
            background-color: red;
            color: white;
        }
    </style>
</head>

<body>
    <h2>Order List</h2>
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
            $sql = "SELECT email, city, method, number, total_products, total_price, order_date FROM `order`";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["city"] . "</td>";
                    echo "<td>" . $row["method"] . "</td>";
                    echo "<td>" . $row["number"] . "</td>";
                    echo "<td>" . $row["total_products"] . "</td>";
                    echo "<td>" . $row["total_price"] . "</td>";
                    echo "<td>" . $row["order_date"] . "</td>";
                    echo "<td class='action-buttons'>";
                    echo "<select class='pending' onchange='changeColor(this)'>";
                    echo "<option value='pending'>Pending</option>";
                    echo "<option value='delivered' class='delivered'>Delivered</option>";
                    echo "<option value='canceled' class='canceled'>Canceled</option>";
                    echo "</select>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No orders found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function changeColor(select) {
            var option = select.options[select.selectedIndex];
            select.className = option.className;
        }
    </script>
</body>

</html>
