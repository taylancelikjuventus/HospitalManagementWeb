<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = mysqli_connect($servername, $username, $password, $dbname) ;

if($conn == null){
    die("connection failed ! Error:".$conn->connect_error) ;
}

$query = "select MAX(doctorno ) as id from doctor" ;//select it and assign it to 'id' variable

if($result = mysqli_query($conn, $query)){
    
    $row = mysqli_fetch_assoc($result);
    $count = $row['id'] ;
    $count = $count + 1 ;
    
    echo json_encode($count) ;
    
}

    
    $conn->close() ;


?>
