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
    
    $fullname = $_POST["fullname"];
    $uname = $_POST["uname"];
    $password = $_POST["pass"];
    $utype = $_POST["utype"];
    
    $stmt = $conn->prepare("insert into user(fullname,uname,password,utype) VALUES(?,?,?,?)" ) ;
    
    $stmt->bind_param("ssss", $fullname,$uname,$password,$utype)  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>
