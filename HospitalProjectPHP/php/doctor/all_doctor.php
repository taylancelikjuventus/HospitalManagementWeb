<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}

$logid = $_POST['logid'];
$query = "select doctorno,dname,special,qual,experience,phone,room FROM doctor WHERE log_id=?" ;
$stmt = $conn->prepare($query) ;
$stmt->bind_param("s",$logid);
$stmt->bind_result($doctorno,$dname,$special,$qual,$exp,$phone,$room);


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        
        $output[] = array(
            "doctorno"=>$doctorno,
            "dname"=>$dname,
            "special"=>$special,
            "qual"=>$qual,
            "exp"=>$exp,
            "phone"=>$phone,
            "room"=>$room
                ) ;
        
    }
    
    echo json_encode($output) ;
  
}

$stmt->close() ;
$conn->close() ;

?>
