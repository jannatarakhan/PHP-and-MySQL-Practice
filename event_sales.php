<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <h2>Item Calculator</h2>
    <form method="POST">
        <input type="number" name="items" placeholder="Items Per Day">
        <br><br>
        <input type="number" name="days" placeholder="Days">
        <br><br>
        <input type="number" name="target" placeholder="Target">
        <br><br>
        <input type="submit">
    </form>
</body>
</html>

<?php
if(isset($_POST["items"]))
{
    $items=(int)$_POST["items"];
    $days=(int)$_POST["days"];
    $target=(int)$_POST["target"];

    $total = $items * $days;

    echo "Total Items: $total<br>";

    if($total >= 500)
        echo "Excellent<br>";
    elseif($total>=300 && $total<500)
        echo "Good<br>";
    elseif($total>=150 && $total<300)
        echo "Average<br>";
    else
        echo "Poor<br>";

    echo "Target: $target<br>";

    if($total == $target)
        echo "Target met exactly (0 difference)";
    elseif($total > $target)
        echo "Above target by " . ($total - $target);
    else
        echo "Below target by " . ($target - $total);
}
?>



