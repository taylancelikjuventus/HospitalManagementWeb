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
    
    $pid = $_POST["preno"];
    $cno = $_POST["cno"];
    $dtype = $_POST["dtype"];
    $des = $_POST["desc"];
    
    $stmt = $conn->prepare("insert into prescription(pid,cno,dtype,des) VALUES(?,?,?,?)" ) ;
    
    $stmt->bind_param("ssss", $pid,$cno,$dtype,$des)  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>
