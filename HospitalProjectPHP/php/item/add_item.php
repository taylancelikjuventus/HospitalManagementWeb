
<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed ! Error:" . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST['ino'];
    $itemname =  $_POST['iname'];
    $description= $_POST['des'];
    $sellprice= $_POST['sprice'];
    $buyprice= $_POST['bprice'];
    $qty= $_POST['qty'];



    $stmt = $conn->prepare("insert into item(id,itemname,description,sellprice,buyprice,qty) VALUES(?,?,?,?,?,?)");

    $stmt->bind_param("ssssss", $id, $itemname, $description, $sellprice, $buyprice, $qty);

    if ($stmt->execute()) {
        echo 1;
    } else {
        echo 0;
    }

    $stmt->close();


    $conn->close();
}
?>
