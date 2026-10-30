
<?php
$conn = mysqli_connect("localhost", "root", "", "uiu_bookshop");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Task 1: Programming Books</h2>

<?php
$sql1 = "SELECT *
         FROM book_info
         WHERE Category = 'Programming'
         ORDER BY Price DESC";

$result1 = mysqli_query($conn, $sql1);

if ($result1) {
    echo "<table border='1'>";
    echo "<tr><th>Book Title</th><th>Author</th>
          <th>Category</th><th>Price</th><th>Stock</th></tr>";

    while ($row = mysqli_fetch_assoc($result1)) {
        echo "<tr>";
        echo "<td>" . $row['BookTitle'] . "</td>";
        echo "<td>" . $row['Author'] . "</td>";
        echo "<td>" . $row['Category'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "<td>" . $row['Stock'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 2: Programming Books Above 400</h2>

<?php
$sql2 = "SELECT BookTitle, Author, Price
         FROM book_info
         WHERE Price > 400
         AND Category = 'Programming'";

$result2 = mysqli_query($conn, $sql2);

if ($result2) {
    echo "<table border='1'>";
    echo "<tr><th>Book Title</th><th>Author</th><th>Price</th></tr>";

    while ($row = mysqli_fetch_assoc($result2)) {
        echo "<tr>";
        echo "<td>" . $row['BookTitle'] . "</td>";
        echo "<td>" . $row['Author'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 3: Category Wise Book Count</h2>

<?php
$sql3 = "SELECT Category, COUNT(*) AS TotalBooks
         FROM book_info
         GROUP BY Category";

$result3 = mysqli_query($conn, $sql3);

if ($result3) {
    echo "<table border='1'>";
    echo "<tr><th>Category</th><th>Total Books</th></tr>";

    while ($row = mysqli_fetch_assoc($result3)) {
        echo "<tr>";
        echo "<td>" . $row['Category'] . "</td>";
        echo "<td>" . $row['TotalBooks'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 4: Total Net Worth</h2>

<?php
$sql4 = "SELECT SUM(Price * Stock) AS TotalWorth
         FROM book_info";

$result4 = mysqli_query($conn, $sql4);

if ($result4) {
    $row = mysqli_fetch_assoc($result4);
    echo "Total Net Worth: " . $row['TotalWorth'];
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 5: Reduce Language Book Price</h2>

<?php
$sql5 = "UPDATE book_info
         SET Price = Price * 0.90
         WHERE Category = 'Language'";

if (mysqli_query($conn, $sql5)) {
    echo "Price updated successfully.<br>";
} else {
    echo mysqli_error($conn);
}

$sql6 = "SELECT BookTitle, Price
         FROM book_info
         WHERE Category = 'Language'";

$result6 = mysqli_query($conn, $sql6);

if ($result6) {
    echo "<table border='1'>";
    echo "<tr><th>Book Title</th><th>Updated Price</th></tr>";

    while ($row = mysqli_fetch_assoc($result6)) {
        echo "<tr>";
        echo "<td>" . $row['BookTitle'] . "</td>";
        echo "<td>" . $row['Price'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo mysqli_error($conn);
}

mysqli_close($conn);
?>

</body>
</html>
