
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Battery Calculator</title>
</head>
<body>
    <h2>Battery Calculator</h2>

    <form method="POST">
        <input type="number" name="distance" placeholder="Mission Distance">
        <br><br>
        <input type="number" name="consumption" placeholder="Energy Consumption">
        <br><br>
        <input type="number" name="capacity" placeholder="Battery Capacity">
        <br><br>
        <input type="submit">
    </form>

<?php
if(isset($_POST["distance"]))
{
    $distance = (int)$_POST["distance"];
    $consumption = (int)$_POST["consumption"];
    $capacity = (int)$_POST["capacity"];

    if($capacity > 0)
    {
        $total = $distance * $consumption;
        $battery = ceil($total / $capacity);
        $unused = ($battery * $capacity) - $total;
        $percentage = ($unused / ($battery * $capacity)) * 100;

        echo "Total Energy: $total<br>";
        echo "Battery Modules: $battery<br>";
        echo "Unused Energy: $unused<br>";

        if($percentage <= 10)
            echo "Efficient";
        elseif($percentage <= 25)
            echo "Acceptable";
        else
            echo "Wasteful";
    }
    else
        echo "Invalid Capacity";
}
?>
</body>
</html>
