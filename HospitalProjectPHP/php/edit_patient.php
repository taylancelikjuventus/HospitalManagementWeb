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
    
    $patientno = $_POST["patient_id"];
    $name = $_POST["pname"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    
    $stmt = $conn->prepare("update patient set name=?,phone=?,address=? WHERE patientno=?" ) ;
    
    $stmt->bind_param("ssss",$name,$phone,$address, $patientno)  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>

