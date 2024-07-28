<?php include_once '../../math.php'; ?>
<?php session_start(); ?>
<?php
$res = 0;
if (isset($_POST['calculate'])) {
    $firstNumber = $_POST['first_number'];
    $secondNumber = $_POST['second_number'];
    $operator = $_POST['operator'];

    $mathObj = new Math($firstNumber, $secondNumber);

    $res = $mathObj->calculate($operator);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div style="width: 50%;margin-left:auto;margin-right:auto;">
        <h2>Calculator</h2>

        <h2 style="background-color: darkblue; color: #fff; box-shadow: 0 0 0 10px rgba(0,0,0,0.1);"><?= 'The total result is = ' . $res ?></h2>

        <form action="" method="post">
            <input type="text" name="first_number" placeholder="Enter first number"> <br> <br>
            <input type="text" name="second_number" placeholder="Enter second number"> <br> <br>

            <select name="operator" id="">
                <option value="" disabled selected>Select</option>
                <option value="sum">+</option>
                <option value="sub">-</option>
                <option value="mul">*</option>
                <option value="div">/</option>
            </select> <br> <br>

            <input type="submit" value="Calculate" name="calculate">
        </form>
    </div>
</body>

</html>