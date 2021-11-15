<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}


$query = "select c.cno,c.docno,c.patno,c.rno,c.date,d.dname,p.name FROM channel c JOIN doctor d ON c.docno=d.doctorno JOIN patient p ON c.patno=p.patientno" ;
$stmt = $conn->prepare($query) ;
$stmt->bind_result($cno,$docno,$patno,$rno,$date,$dname,$pname);


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        
        $output[] = array(
            "cno"=>$cno,
            "dname"=>$dname,
            "pname"=>$pname,
            "rno"=>$rno,
            "date"=>$date,
            "edit"=>"<button class='btn btn-info' onclick=getDetails(" .$cno. ")>Edit</button>" ,
           "delete"=>"<button class='btn btn-danger' onclick=removeDetails(" . $cno . ")>Delete</button>"
                ) ;
        
    }
    
  
    
    $arr = ['data' => $output ];
    echo json_encode($arr) ;
    
    //echo json_encode($output) ;
    
}

$stmt->close() ;
$conn->close() ;

?>
