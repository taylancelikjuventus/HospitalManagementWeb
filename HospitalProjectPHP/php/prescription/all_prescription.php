<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed ! Error:" . $conn->connect_error);
}

$query = "select pid,cno,dtype,des FROM prescription ORDER BY pid ASC";
$stmt = $conn->prepare($query);
$stmt->bind_result($pno, $cno, $dtype, $des);

if ($stmt->execute()) {

    while ($stmt->fetch()) {

        $output[] = array(
            "pno" => $pno,
            "cno" => $cno,
            "dtype" => $dtype,
            "des" => $des,
            "invoice" => "<button class='btn btn-success' onclick='getInvoice(".$pno.")'>Invoice</button>"
                );
    }

    //  echo json_encode($output) ;
    $arr = ['data' => $output];
    echo json_encode($arr);
}

$stmt->close();
$conn->close();
?>
