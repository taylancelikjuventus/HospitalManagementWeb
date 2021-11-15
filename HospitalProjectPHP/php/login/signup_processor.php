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
    
    $fname = $_POST["fname"];
    $uname = $_POST["uname"];
    $pass = $_POST["pass"];
    $repass = $_POST["repass"];
    $utype = $_POST["userType"];
    
    $stmt = $conn->prepare("insert into user(fullname,uname,password,utype) VALUES(?,?,?,?)" ) ;
    
    $stmt->bind_param("ssss", $fname,$uname,$pass,$utype)  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>
