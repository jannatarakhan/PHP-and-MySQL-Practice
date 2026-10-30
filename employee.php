
<?php
$conn = mysqli_connect("localhost", "root", "", "uiutech_final");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html>
<body>

<h2>Task 1: Performance Rating Count</h2>

<?php
$sql1 = "SELECT PerformanceRating, COUNT(*) AS TotalEmployees
         FROM employee_final
         GROUP BY PerformanceRating";

$result1 = mysqli_query($conn, $sql1);

if ($result1) {
    echo "<table border='1'>";
    echo "<tr><th>Rating</th><th>Total Employees</th></tr>";

    while ($row = mysqli_fetch_assoc($result1)) {
        echo "<tr>";
        echo "<td>" . $row['PerformanceRating'] . "</td>";
        echo "<td>" . $row['TotalEmployees'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 2: Update Performance Rating</h2>

<?php
$sql2 = "UPDATE employee_final
         SET PerformanceRating = 'C'
         WHERE Salary < 40000
         AND PerformanceRating != 'D'";

if (mysqli_query($conn, $sql2)) {
    echo "Task 2 completed successfully.";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 3: Add Salary Bonus</h2>

<?php
$sql3 = "UPDATE employee_final
         SET Salary = Salary + 5000
         WHERE Salary > 50000
         AND Salary + 5000 <= 60000";

if (mysqli_query($conn, $sql3)) {
    echo "Task 3 completed successfully.";
} else {
    echo mysqli_error($conn);
}
?>

<h2>Task 4: Department Wise Employee Count</h2>

<?php
$sql4 = "SELECT DepartmentName,
                COUNT(*) AS TotalEmployees
         FROM employee_final
         GROUP BY DepartmentID, DepartmentName
         ORDER BY TotalEmployees DESC";

$result4 = mysqli_query($conn, $sql4);

if ($result4) {
    echo "<table border='1'>";
    echo "<tr><th>Department</th><th>Total Employees</th></tr>";

    while ($row = mysqli_fetch_assoc($result4)) {
        echo "<tr>";
        echo "<td>" . $row['DepartmentName'] . "</td>";
        echo "<td>" . $row['TotalEmployees'] . "</td>";
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
