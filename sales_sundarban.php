<?php

// Database Connection
$conn = mysqli_connect("localhost", "root", "", "sundarbon");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sundarban Sales Operations</title>
</head>
<body>

<h1>Sundarban Sales Operations</h1>

<!-- TASK 1 -->
<h2>Task 1: Total Revenue per Category</h2>
<?php
$sql1 = "SELECT CategoryName, SUM(Revenue) AS total_rev
         FROM sales_data
         GROUP BY CategoryName";

$result1 = mysqli_query($conn, $sql1);

if ($result1) {

    echo "<table border='1'>";
    echo "<tr>
            <th>Category Name</th>
            <th>Total Revenue</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result1)) {

        echo "<tr>";
        echo "<td>" . $row['CategoryName'] . "</td>";
        echo "<td>" . $row['total_rev'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";

} else {
    echo mysqli_error($conn);
}
?>

<!-- TASK 2 -->
<h2>Task 2: Update Low Performing Products</h2>
<?php
$sql2 = "UPDATE sales_data
         SET CategoryName = 'Low Performing'
         WHERE Revenue < 40000";

if (mysqli_query($conn, $sql2)) {
    echo "Task 2 completed successfully.";
} else {
    echo mysqli_error($conn);
}
?>
<!-- TASK 3 -->
<h2>Task 3: Increase Revenue by 10%</h2>
<?php
$sql3 = "UPDATE sales_data
         SET Revenue = Revenue * 1.10
         WHERE Revenue > 70000";

if (mysqli_query($conn, $sql3)) {
    echo "Task 3 completed successfully.";
} else {
    echo mysqli_error($conn);
}
?>
<!-- TASK 4 -->
<h2>Task 4: Product Seller Status</h2>
<?php
$sql4 = "SELECT ProductName, CategoryName, Revenue,
                CASE
                    WHEN Revenue > (
                        SELECT AVG(Revenue)
                        FROM sales_data
                        WHERE CategoryName = s.CategoryName
                    )
                    THEN 'Top Seller'
                    ELSE 'Regular Seller'
                END AS Status
         FROM sales_data s
         ORDER BY CategoryName, Revenue DESC";

$result4 = mysqli_query($conn, $sql4);
if ($result4) {

    echo "<table border='1'>";

    echo "<tr>
            <th>Product Name</th>
            <th>Category Name</th>
            <th>Revenue</th>
            <th>Status</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result4)) {
        echo "<tr>";
        echo "<td>" . $row['ProductName'] . "</td>";
        echo "<td>" . $row['CategoryName'] . "</td>";
        echo "<td>" . $row['Revenue'] . "</td>";
        echo "<td>" . $row['Status'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo mysqli_error($conn);
}
// Close Connection
mysqli_close($conn);
?>
</body>
</html>