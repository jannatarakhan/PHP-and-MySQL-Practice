<?php

// Database Connection
$conn = mysqli_connect("localhost", "root", "", "tourism");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tourism Management System</title>
</head>
<body>

<h1>Tourism Management System</h1>


<!-- TASK 1 -->
<h2>Task 1: Display Tourist Spots</h2>

<?php

$sql1 = "SELECT SpotName, Region, Rating
         FROM tourist_spot
         WHERE Rating > 4.5
            OR SpotName LIKE '%Beach%'
         ORDER BY Rating DESC";

$result1 = mysqli_query($conn, $sql1);

if ($result1) {

    echo "<table border='1'>";

    echo "<tr>
            <th>Spot Name</th>
            <th>Region</th>
            <th>Rating</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result1)) {

        echo "<tr>";
        echo "<td>" . $row['SpotName'] . "</td>";
        echo "<td>" . $row['Region'] . "</td>";
        echo "<td>" . $row['Rating'] . "</td>";
        echo "</tr>";

    }

    echo "</table>";

} else {
    echo mysqli_error($conn);
}

?>


<!-- TASK 2 -->
<h2>Task 2: Update Rating and Entry Fee</h2>
<?php
$sql2 = "UPDATE tourist_spot
         SET Rating = Rating + 0.2,
             EntryFee = EntryFee * 1.10
         WHERE Rating BETWEEN 4.0 AND 4.5
           AND EntryFee > 0";

if (mysqli_query($conn, $sql2)) {
    echo "Task 2 completed successfully.";
} else {
    echo mysqli_error($conn);
}
?>

<!-- TASK 3 -->
<h2>Task 3: Category Wise Report</h2>
<?php
$sql3 = "SELECT Category,
                COUNT(*) AS TotalSpots,
                AVG(Rating) AS AverageRating,
                SUM(VisitorsPerYear) AS TotalVisitors
         FROM tourist_spot
         GROUP BY Category
         HAVING AVG(Rating) > 4.4
         ORDER BY AverageRating DESC";

$result3 = mysqli_query($conn, $sql3);

if ($result3) {

    echo "<table border='1'>";

    echo "<tr>
            <th>Category</th>
            <th>Total Spots</th>
            <th>Average Rating</th>
            <th>Total Visitors Per Year</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result3)) {

        echo "<tr>";
        echo "<td>" . $row['Category'] . "</td>";
        echo "<td>" . $row['TotalSpots'] . "</td>";
        echo "<td>" . number_format($row['AverageRating'], 2) . "</td>";
        echo "<td>" . $row['TotalVisitors'] . "</td>";
        echo "</tr>";

    }
    echo "</table>";
} else {
    echo mysqli_error($conn);
}
?>

<!-- TASK 4 -->
<h2>Task 4: Region Wise Estimated Yearly Revenue</h2>
<?php
$sql4 = "SELECT Region,
                SUM(EntryFee * VisitorsPerYear) AS TotalRevenue
         FROM tourist_spot
         GROUP BY Region
         HAVING SUM(EntryFee * VisitorsPerYear) > 1000000
         ORDER BY TotalRevenue DESC";

$result4 = mysqli_query($conn, $sql4);

if ($result4) {

    echo "<table border='1'>";

    echo "<tr>
            <th>Region</th>
            <th>Total Estimated Yearly Revenue</th>
          </tr>";

    while ($row = mysqli_fetch_assoc($result4)) {

        echo "<tr>";
        echo "<td>" . $row['Region'] . "</td>";
        echo "<td>" . $row['TotalRevenue'] . "</td>";
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