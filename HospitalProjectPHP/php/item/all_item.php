<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}


$query = "select * FROM item" ;
$stmt = $conn->prepare($query) ;
$stmt->bind_result($id,$iname,$desc,$sprice,$bprice,$qty);


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        
        $output[] = array(
            
            "itemno"=>$id,
            "itemname"=>$iname,
            "desc"=>$desc,
            "sprice"=>$sprice,
            "bprice"=>$bprice,
            "qty"=>$qty,
            "edit"=>"<button class='btn btn-info' onclick=getDetails(" .$id. ")>Edit</button>",
            "delete"=>"<button class='btn btn-danger' onclick=removeDetails(" .$id. ")>Delete</button>"
                ) ;
        
    }
    
    //echo json_encode($output) ;
     $arr = ['data' => $output ];
    echo json_encode($arr) ;
}

$stmt->close() ;
$conn->close() ;

?>
