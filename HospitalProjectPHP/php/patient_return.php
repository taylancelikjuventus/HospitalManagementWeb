<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

$output = [];
if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}

$query = "select patientno,name,phone,address FROM patient WHERE patientno=?" ;
$stmt = $conn->prepare($query) ;

if(isset($_POST['patient_id']))
   $patientno = $_POST["patient_id"] ;

$stmt->bind_param("s", $patientno) ;
$stmt->bind_result($patientno,$name,$phone,$address) ;


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        $output[] = array(
            "patientno"=>$patientno,
            "name"=>$name,
            "phone"=>$phone,
            "address"=>$address,
                ) ;
        
    }
    
    echo json_encode($output) ;
    
}

$stmt->close() ;
$conn->close() ;

?>
