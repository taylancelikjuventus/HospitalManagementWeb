

<?php
$servername = "localhost";
$username = "root";
$password = "" ;
$dbname = "hospitalproject" ;

$conn = new mysqli($servername, $username, $password, $dbname) ;

if($conn->connect_error){
    die("connection failed ! Error:".$conn->connect_error) ;
}

if($_SERVER['REQUEST_METHOD'] == "POST") {
//start session variable
session_start() ;

$username = $_POST['username'];
$password = $_POST['password'];
$utype = $_POST['utype'];


$stmt = $conn->prepare("select id,uname,password,utype from user WHERE uname=? and password=? and utype=?");

$stmt->bind_param("sss", $username,$password,$utype) ;

$stmt->execute() ;
$stmt->store_result();
$stmt->bind_result($id,$uname,$password,$utype) ;
$stmt->fetch() ;

 

if($stmt->num_rows() == 1){
    
   
    //Those variables are used for users untill they logout
    $_SESSION["isLogin"] =true;
    $_SESSION["utype"] = $utype;
    $_SESSION["id"] = $id;
    $_SESSION["uname"] =$uname;
    
    echo 1;
    
}else{
    
    echo 0;
    
}

$stmt->close();
$conn->close() ;
}

?>
