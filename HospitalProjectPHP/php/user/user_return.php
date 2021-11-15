<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}

$query = "select fullname,uname,utype FROM user WHERE id=?" ;
$stmt = $conn->prepare($query) ;

$user_id = $_POST["user_id"] ;

$stmt->bind_param("s", $user_id) ;
$stmt->bind_result($fullname,$uname,$utype) ;


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        $output[] = array(
            "fullname"=>$fullname,
            "uname"=>$uname,
            "utype"=>$utype
                ) ;
        
    }
    
    echo json_encode($output) ;
    
}

$stmt->close() ;
$conn->close() ;

?>
