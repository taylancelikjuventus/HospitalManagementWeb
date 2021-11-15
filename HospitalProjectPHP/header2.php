    
<!DOCTYPE html>
<html>
    <head>

         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel='stylesheet' href='//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
        <script src='jquery.validate.min.js'></script>
        <script src='//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>

        <style>
           
            #tabs li:hover{
                background: cadetblue;
            }
        </style>
        
    </head>
    <body>
        <!--Nav Bar-->
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" style="color:#48ff33;">Receptionist Panel</a>
                </div>
                <ul class="nav navbar-nav" id="tabs">
                    <li class="nav-item" id="index"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item" id="user"><a class="nav-link" href="user.php">Users</a></li>
                    <li class="nav-item" id="patient"><a class="nav-link" href="patient.php">Patients</a></li>
                    <li class="nav-item" id="channel"><a class="nav-link" href="channel.php">Channels</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class='glyphicon glyphicon-user' style="color:#48ff33;"> <?php echo $_SESSION["uname"]; ?></span></a></li>
                    <li><a href="logout.php"><span class='glyphicon glyphicon-log-out'> Logout</span></a></li>
                </ul>
            </div>
        </nav>




    </body>
</html>