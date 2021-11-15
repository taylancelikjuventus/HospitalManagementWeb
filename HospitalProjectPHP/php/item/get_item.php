<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}


$query = "select * FROM item WHERE id=?" ;
$stmt = $conn->prepare($query) ;

$stmt->bind_param("s", $_POST['itemcode']);
$stmt->bind_result($id,$iname,$desc,$sprice,$bprice,$qty);


if($stmt->execute()){
    
    while($stmt->fetch()){
        
        
        $output[] = array(
            
            "itemno"=>$id,
            "itemname"=>$iname,
            "desc"=>$desc,
            "sprice"=>$sprice,
            "bprice"=>$bprice,
            "qty"=>$qty
                ) ;
        
    }
    
    echo json_encode($output) ;
    
}

$stmt->close() ;
$conn->close() ;

?>
