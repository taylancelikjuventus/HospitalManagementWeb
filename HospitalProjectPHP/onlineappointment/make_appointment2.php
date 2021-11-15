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
    

    $patno = $_POST["patientno"];
    $patname = $_POST["patientname"];
    $docname = $_POST["doctorname"];
    $docroom = $_POST['roomno'] ;
    $date = $_POST["date"];
   
  
      $var = 1;
   
    $stmt = $conn->prepare("select * from channel" ) ;
    $stmt->bind_result($c,$d,$p,$r,$da)  ;
    
    if($stmt->execute()){
   
        echo 1;
      
        while($stmt->fetch()){
            $var = $var + 1;
        }
        
       
    }else{
        echo 0;
        
    }
    
    
    
    $stmt->close() ;
    
    
    $stmt = $conn->prepare("insert into channel(cno,docno,patno,rno,date) VALUES(?,?,?,?,?)" ) ;
    $stmt->bind_param("sssss",$var,intval($docname),intval($patno),intval($docroom),$date)  ;

    //session vars
    $_SESSION['appoint_dname'] = $docname;
    $_SESSION['appoint_patno'] = $patno;
    $_SESSION['appoint_patname'] = $patname;
    $_SESSION['appoint_droom'] = $docroom;
    $_SESSION['appoint_date'] = $date;
    
    
    if($stmt->execute()){
        echo 1;
        
    }else{
        echo 0;
        
    }
    
    $stmt->close() ;
    $conn->close() ;
}

?>
