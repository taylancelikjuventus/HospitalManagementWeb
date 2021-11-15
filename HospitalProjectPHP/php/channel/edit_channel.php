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
    
    //YAP 
    
    $cno = $_POST["c_no"];
    $dno = $_POST["dname"];
    $pno = $_POST["pname"];
    $rno = $_POST["rno"];
    $date = $_POST["date"];
    
    $stmt = $conn->prepare("update channel set docno=?,patno=?,rno=?,date=? WHERE cno=?" ) ;
    
    $stmt->bind_param("sssss",$dno,$pno, $rno,$date,$cno)  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>

