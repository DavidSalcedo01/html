<?php
    require_once "Connection.php";

    $userName = $_GET['userName'];
    $prdName = $_GET['prdName'];
    $price = $_GET['price'];
    $amount= $_GET['amount'];

    $sqlDelete = mysqli_query($connection, "DELETE FROM sales WHERE costumerUser='$userName' AND productName='$prdName'AND amount='$amount'");
    header("Location: shoppingCart.php");

    mysqli_close($connection);
?>