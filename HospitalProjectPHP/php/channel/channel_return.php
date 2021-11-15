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

$query = "select cno,docno,patno,rno,date FROM channel WHERE cno=?" ;
$stmt = $conn->prepare($query) ;

if(isset($_POST['c_id']))
   $cno = $_POST["c_id"] ;

$stmt->bind_param("s", $cno) ;
$stmt->bind_result($cno,$docno,$patno,$rno,$date) ;


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        $output[] = array(
            "cno"=>$cno,
            "docno"=>$docno,
            "patno"=>$patno,
            "rno"=>$rno,
            "date"=>$date
                ) ;
        
    }
    
    echo json_encode($output) ;
    
}

$stmt->close() ;
$conn->close() ;

?>
