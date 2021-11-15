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
    
    $drno = $_POST["dr_no"];
    $dname = $_POST["dname"];
    $special = $_POST["special"];
    $qual = $_POST["qual"];
    $exp = $_POST["exp"];
    $phone = $_POST["phone"];
    $room = $_POST["rno"];
    
    
    $stmt = $conn->prepare("update doctor SET dname=?,special=?,qual=?,experience=?,phone=?,room=? WHERE doctorno=?" ) ;
    
    $stmt->bind_param("sssssss",$dname,$special, $qual,$exp,$phone,$room,$drno )  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>

