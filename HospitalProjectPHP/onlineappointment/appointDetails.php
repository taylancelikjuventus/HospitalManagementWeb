<?php
session_start() ;
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

       
        <div class="container">

            <div class="row">
                <div class="col-sm-8">
                    
                    <h3>Your Appointment Details</h3>
                
                <table border="1" cellspacing="1" cellpadding="1" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Patient No</th>
                            <th>Patient Name</th>
                            <th>Doctor Name</th>
                            <th>Room</th>
                            <th>Date</th>
                            <th>Hospital</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo  $_SESSION['appoint_patno'] ; ?></td>
                            <td><?php echo  $_SESSION['appoint_patname'] ; ?></td>
                            <td><?php echo  $_SESSION['appoint_dname'] ; ?></td>
                            <td><?php echo  $_SESSION['appoint_droom'] ;?></td>
                            <td><?php echo  $_SESSION['appoint_date'] ;?></td>
                            <td><?php echo  'Big Hospital' ;?></td>
                        </tr>
                    </tbody>
                </table>
                    
                    <h3>Get well soon <b><?php echo  $_SESSION['appoint_patname']  ;?></b> </h3>
                    <a href="../index.php" class="btn btn-success">Home</a>
            </div>
                
            </div>
            
        </div>
        
    </body>
</html>