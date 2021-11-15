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

$query = "select patientno,name,phone,address FROM patient ORDER BY patientno ASC" ;
$stmt = $conn->prepare($query) ;
$stmt->bind_result($patientno,$name,$phone,$address) ;



if($stmt->execute()){
    
    while($stmt->fetch()){
        
        $output[] = array( 
            
         
            "patientno"=>$patientno,
            "name"=>$name,
            "phone"=>$phone,
            "address"=>$address,
            "edit"=>"<button class='btn btn-info' onclick=getDetails(" . $patientno . ")>Edit</button>",
            "delete"=>"<button class='btn btn-danger' onclick=removeDetails(" . $patientno . ")>Delete</button>"
            
                );
        
    }
 
    
    //get JSON in following format to use it with DataTable !!!
    $arr = ['data' => $output ];
    echo json_encode($arr) ;
    
}

$stmt->close() ;
$conn->close() ;

?>
