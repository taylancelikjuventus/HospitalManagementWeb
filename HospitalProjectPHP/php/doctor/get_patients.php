<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}


$stmt =$conn->prepare( "select patientno,name from patient"); ;


$stmt->bind_result($patientno,$name);


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        
        $output[] = array(
            "patientno"=>$patientno,
            "name"=>$name,
            
                ) ;
        
    }
    
    echo json_encode($output) ;
    
}

$stmt->close() ;
$conn->close() ;

?>
