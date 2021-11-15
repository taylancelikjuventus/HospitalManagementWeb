
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
    
    //doctor cannot add details twice
    $log_id = $_SESSION["id"];
    
    $result = mysqli_query($conn, "select * from doctor WHERE log_id = '$log_id'");
    
    if(mysqli_num_rows($result) == 1){
        
        echo 2;
    }else{
    
    $doctorno = $_POST["dno"];
    $dname = $_POST["dname"];
    $special = $_POST["special"];
    $qual = $_POST["qual"];
    $exp = $_POST["exp"];
    $phone = $_POST["phone"];
    $room = $_POST["rno"];
    
    
    $stmt = $conn->prepare("insert into doctor(doctorno,dname,special,qual,experience,phone,room,log_id) VALUES(?,?,?,?,?,?,?,?)" ) ;
    
    $stmt->bind_param("ssssssss", $doctorno,$dname,$special,$qual,$exp,$phone,$room,$log_id)  ;

    if($stmt->execute()){
        echo 1 ;
    }else{
        echo 0;
    }
    
    $stmt->close() ;
    
    }
    $conn->close() ;
}

?>
