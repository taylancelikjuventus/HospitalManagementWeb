
<?php
session_start() ;

$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $cno = $_POST["cno"];
    $docno = $_POST["dname"];
    $patno = $_POST["pname"];
    $rno = $_POST["rno"];
    $date = $_POST["date"];
    
    
    
    $stmt = $conn->prepare("insert into channel(cno,docno,patno,rno,date) VALUES(?,?,?,?,?)" ) ;
    
    $stmt->bind_param("sssss", $cno,$docno,$patno,$rno,$date)  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    
    }
    $conn->close() ;


?>
