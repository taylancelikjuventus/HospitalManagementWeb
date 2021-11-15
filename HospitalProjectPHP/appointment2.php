<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "hospitalproject";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("connection failed ! Error:" . $conn->connect_error);
}

$myform = "";
$myform .= '   <div class="container">
              
                  <div class="row">
                <div class="col-md-8">

                    <h3>Continued...</h3>
                    <p>3.Fill the following form select Doctor and Date</p>
                    <p>4.Click Details button that will appear after you submit this form successfuly.
                        There you will see your details ...</p>
                    <a href="appointment.php" class = "btn btn-primary">Back</a>    
                </div>
            </div>

            <div class="row">


                <div class="col-sm-4">

                    <h3>Appointment</h3>
                    <div class="appointment">

                        <form id="myform-app">';

////////////Session vars////////////

$patient_no = $_SESSION['appoint_no'];
$patient_name = $_SESSION['appoint_name'];

       $myform.=   '<div class="form-group">
                                <label for="patientno">Patient No:</label>';

$myform .= '<input name="patientno" type="text"  class="form-control" id="patientno" value='.$patient_no.' disabled>';
$myform .= '</div>';
       
$myform.=   '<div class="form-group">
                                <label for="patientname">Patient Name:</label>';

$myform .= '<input name="patientname" type="text" class="form-control" id="patientname" value='.$patient_name.' disabled>';
$myform .= '</div>';

//$myform .= '<input name="patientname" type="text" min="0" class="form-control" id="patientname" value="'.$patient_name.'" disabled>';

//doctor
$myform .= ' 
                   <div class="form-group">
                         <label for="doctors">Select Doctor :</label>';

$stmt = $conn->prepare("select * from doctor");
$stmt->bind_result($docno, $doctorname, $speciality,$qual,$exp,$phone,$roomno,$x);


$docstr = "";

$myform .= '<select name="doctorname" id="doctors" class="form-control">'
        . '<option value="None">None</option>';

if ($stmt->execute()) {
   
   
    
    while ($stmt->fetch()) {

        $docstr = $doctorname . "," . $speciality ;
        $myform .= '<option value="' . $docno . '">' . $docstr . '</option>';
    }
} else {
    $docstr .= "No available Doctor found !";
}

$myform .= ' </select>';

/*
   <div class="form-group">
                                <label for="date">Select Date :</label>
                                <input id="date" type="date" name="date">
                            </div>
                            <div class="form-group">
                                <label for="time">Select Time :</label>
                                <input id="time" type="time" name="time">
                            </div> 
 
 */

$myform .= ' </div>

                            <div class="form-group">
                                <label for="date">Select Date :</label>
                                <input id="date" type="date" name="date">
                            </div>
                          

                            <button type="button" id="submit" class="btn btn-success">Submit</button>
                        </form> 

                    </div>


                </div>

                <div class="col-sm-4" id="result">

                    <h3>Results</h3>

                    <p>You made the appointment ...</p>
                    <p>Please click next to see details .</p>
                    <a type="submit" class="btn btn-danger" href="onlineappointment/appointDetails.php">Details</a>


                </div>


            </div>

        </div>';


$stmt->close();
$conn->close();
?>


<!DOCTYPE html>
<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="css/mystyle.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
        <script src='jquery.validate.min.js'></script>
        <!--Data table--> 
        <script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>

        <style>
            .appointment{
                border: 2px solid cadetblue ;
                padding:10px ;
                margin: 5px;
            }
            #result{
                visibility: hidden;
            }
        </style>

    </head>
    <body>

        <!--

        <div class="container">

            <div class="row">


                <div class="col-sm-4">

                    <h3>Appointment</h3>
                    <div class="appointment">

                        <form id="myform-app">

                            <div class="form-group">
                                <label for="patientno">Patient No:</label>
                                <input name="patientno" type="text" min="0" class="form-control" id="patientno" disabled>
                            </div>

                            <div class="form-group">
                                <label for='doctors'>Select Doctor :</label>
                                <select name='doctorname' id="doctors" class='form-control'>

                                </select>
                            </div>

                            <div class='form-group'>
                                <label for='date'>Select Date :</label>
                                <input id='date' type="date" name='date'>
                            </div>
                            <div class='form-group'>
                                <label for=time'>Select Time :</label>
                                <input id='time' type="time" name='time'>
                            </div>

                            <button type="button" id="submit" class="btn btn-success">Submit</button>
                        </form> 

                    </div>


                </div>

                <div class="col-sm-4" id="result">

                    <h3>Results</h3>

                    <p>You made the appointment ...</p>
                    <p>Please go to last step by clicking 'Next' .</p>
                    <a type="submit" class='btn btn-danger' href='appointment2.php'>Next</a>


                </div>


            </div>

        </div>

                -->
           <?php echo $myform ;?>
        
        
        <script>
            $(document).ready(function () {

                $(document).on("click","#submit",function () {
                    
                    var patname = $("#patientname").val();
                    var patno = $("#patientno").val();
                       
                    var mydata = $("#myform-app").serialize() + "&patientname="+patname+"&patientno="+patno+"&roomno="+<?php echo $roomno;?>;

                    $.ajax({

                        url: "onlineappointment/make_appointment2.php",
                        type: "POST",
                        dataType: "JSON",
                        data: mydata,
                        success: function (data) {

                            if (data != 0) {
                             
                                clearFormFields();
                                $("#result").css("visibility", "visible");
                            } else {
                                alert("Some error happened!")
                            }
                        },
                        error: function (xhr, status, error) {
                            alert(error);


                        }

                    });


//end
            });
            
            });


            function clearFormFields() {
                $("#patientname").val("");
                $("#patientno").val("");
                $("#doctorname").val("None");
                $("#date").val("");
            }


        </script>


    </body>
</html>
