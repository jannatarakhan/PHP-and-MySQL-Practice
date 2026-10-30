
<?php
$conn = mysqli_connect("localhost", "root", "", "campus_library");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Task 1: Status Wise Book Count</h2>
<?php
$sql1 = "SELECT Status, COUNT(*) AS TotalBooks
         FROM book_loans
         GROUP BY Status
         HAVING COUNT(*) > 1";

$result1 = mysqli_query($conn, $sql1);

if ($result1) {
    echo "<table border='1'>";
    echo "<tr><th>Status</th><th>Total Books</th></tr>";

    while ($row = mysqli_fetch_assoc($result1)) {
        echo "<tr>";
        echo "<td>" . $row['Status'] . "</td>";
        echo "<td>" . $row['TotalBooks'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 2: Update Grace Period</h2>

<?php
$sql2 = "UPDATE book_loans
         SET Status = 'Grace Period',
             PenaltyFee = 0
         WHERE Status = 'Overdue'
         AND DaysOverdue < 7";

if (mysqli_query($conn, $sql2)) {
    echo "Task 2 completed successfully.";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 3: Increase Penalty Fee</h2>

<?php
$sql3 = "UPDATE book_loans
         SET PenaltyFee = PenaltyFee * 1.10
         WHERE PenaltyFee > 20
         AND PenaltyFee * 1.10 <= 50";

if (mysqli_query($conn, $sql3)) {
    echo "Task 3 completed successfully.";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 4: Book Wise Total Penalty</h2>

<?php
$sql4 = "SELECT BookTitle,
                SUM(PenaltyFee) AS TotalPenalty
         FROM book_loans
         GROUP BY BookTitle
         ORDER BY TotalPenalty DESC";

$result4 = mysqli_query($conn, $sql4);

if ($result4) {
    echo "<table border='1'>";
    echo "<tr><th>Book Title</th><th>Total Penalty</th></tr>";

    while ($row = mysqli_fetch_assoc($result4)) {
        echo "<tr>";
        echo "<td>" . $row['BookTitle'] . "</td>";
        echo "<td>" . $row['TotalPenalty'] . "</td>";
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
