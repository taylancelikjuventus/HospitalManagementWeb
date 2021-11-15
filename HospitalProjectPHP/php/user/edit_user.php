<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $user_id = $_POST["user_id"];
    $fullname = $_POST["fullname"];
    $uname = $_POST["uname"];
    $utype = $_POST["utype"];
    
    $stmt = $conn->prepare("update user set fullname=?,uname=?,utype=? WHERE id=?" ) ;
    
    $stmt->bind_param("ssss",$fullname,$uname,$utype, $user_id)  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>

