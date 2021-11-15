<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

$output = [] ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}

if(isset($_POST['logid']) )
  $logid = $_POST['logid'] ;


$query = "select c.cno,c.docno,c.patno,c.rno,c.date,d.dname,p.name FROM channel c JOIN doctor d ON c.docno=d.doctorno JOIN patient p ON c.patno=p.patientno WHERE d.log_id=?" ;
$stmt = $conn->prepare($query) ;

$stmt->bind_param("s", $logid);

$stmt->bind_result($cno,$docno,$patno,$rno,$date,$dname,$pname);


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        
        $output[] = array(
            "cno"=>$cno,
            "docno"=>$docno,
            "patno"=>$patno,
            "rno"=>$rno,
            "date"=>$date,
            "dname"=>$dname,
            "pname"=>$pname,
           "pres"=>"<button class='btn btn-success' data-toggle='modal' data-target='#exampleModal'  onclick=getPrescription(" .$cno.")>Prescription</button>"
                ) ;
        
    }
    
    //echo json_encode($output) ;
      
    
       $arr = ['data' => $output ];
       echo json_encode($arr) ;
     
     
}

$stmt->close() ;
$conn->close() ;

?>
