<?php
session_start();



$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $fullname = $_POST["fname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    
    $last_patno = 0;
    
   
   
    $stmt = $conn->prepare("insert into patient(patientno,name,phone,address) VALUES(?,?,?,?)" ) ;
    $stmt->bind_param("ssss",intval($last_patno),$fullname,$phone,$address)  ;

    if($stmt->execute()){
        echo 1;
          $_SESSION["appoint_no"] = mysqli_insert_id($conn);
       $_SESSION["appoint_name"] = $fullname;
        
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>
