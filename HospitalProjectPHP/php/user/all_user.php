<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed ! Error:" . $conn->connect_error);
}

$query = "select id,fullname,uname,utype FROM user ORDER BY id ASC";
$stmt = $conn->prepare($query);
$stmt->bind_result($id, $fullname, $uname, $utype);

if ($stmt->execute()) {

    while ($stmt->fetch()) { //It fetches records once for every row
        if ($utype == 1) {
            $utype = "<b style=color:hotpink;>Pharmacist</b>";
        }
        if ($utype == 2) {
            $utype = "<b style=color:blue;>Doctor</b>";
        }
        if ($utype == 3) {
            $utype = "<b style=color:green;>Receptionist</b>";
        }

        $output[] = array(
            "id" => $id,
            "fullname" => $fullname,
            "uname" => $uname,
            "utype" => $utype,
            "edit" => "<button class='btn btn-info' onclick=getDetails(" . $id . ")>Edit</button>",
            "delete" => "<button class='btn btn-danger' onclick=removeDetails(" . $id . ")>Delete</button>"
                );
    }

    $arr = ['data' => $output];
    echo json_encode($arr);
}



$stmt->close();
$conn->close();
?>
