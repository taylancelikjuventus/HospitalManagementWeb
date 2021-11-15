<?php
session_start();

//if Login is wrong
if ($_SESSION['isLogin'] != true) {

    //redirect to login page
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Main Page</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel='stylesheet' href='//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
        <script src='jquery.validate.min.js'></script>
        <!--Data table--> 
        <script src='//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>

    </head>
    <body>

        <!--header-->
        <?php
        if ($_SESSION["utype"] == 1) { //phar
            include 'header.php';
        }
        if ($_SESSION["utype"] == 2) { //doc
            include 'header1.php';
        }
        if ($_SESSION["utype"] == 3) {//receptionist
            include 'header2.php';
        }
        ?>

        <br><br>

        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-4'>
                    <form id='frmdoctor' class='card'>
                        <div align='left'>
                            <h3>Register/Edit Yourself</h3>
                        </div>
                        <div align='left'>
                            <label class='form-label'>Doctor No</label>
                            <input type='text' class='form-control' placeholder="doctor number" id='dno' name='dno' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Doctor Name</label>
                            <input type='text' class='form-control' placeholder="doctor name" id='dname' name='dname' size='30px' required />
                        </div>

                        <div align='left'>
                            <label class='form-label'>Specialization</label>
                            <input type='text' class='form-control' placeholder="specialization" id='special' name='special' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Qualification</label>
                            <input type='text' class='form-control' placeholder="qualification" id='qual' name='qual' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Years of Experience</label>
                            <input type='text' class='form-control' placeholder="experience" id='exp' name='exp' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Phone</label>
                            <input type='text' class='form-control' placeholder="Phone" id='phone' name='phone' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Room No</label>
                            <input type='text' class='form-control' placeholder="Room Number" id='rno' name='rno' size='30px' required />
                        </div>

                        <input type='hidden' id='logidx' name='logid' value="<?php echo $_SESSION['id']; ?>"/>

                        <br>
                        <div align='right'>
                            <button type='button' id='save' class='btn btn-info' onclick="addDoctor()">Save </button>
                            <button type='button' id='save' class='btn btn-danger' onclick="reset()">Reset </button>
                        </div>

                    </form>



                </div>


                <div class='col-sm-8'>

                    <div class='panel-body'>
                        <table id='tbl-doctor' class='table table-responsive table-bordered' cellpadding='0' width='100%'>
                            <thead>
                            <h3>Your Details</h3>
                            <tr>
                                <th>Doctor No</th>
                                <th>Doctor Name</th>
                                <th>Specialization</th>
                                <th>Qualification</th>
                                <th>Fee</th>
                                <th>Phone</th>
                                <th>Room No</th>
                                <th>Action</th>
                                <th>Action</th>
                            </tr>

                            </thead>



                        </table>
                    </div>


                </div>


            </div>


        </div>

        <!--scripts-->    
        <script>

            //clear form
            clearFormFields();
            //list all patients
            getAll();
            //when page is loaded Auto id should be appear
            getAutoID();
            function getAutoID() {  //ok

                $("#dno").empty();
                $.ajax({

                    type: "GET",
                    url: "php/doctor/autoid_doctor.php",
                    dataType: "JSON",
                    success: function (data) {

                        //alert(data);
                        $("#dno").val(data);
                    }



                });
            }



            var isNew = true;
            function addDoctor() { //ok

                var url = "";
                var data = "";
                var method = "";
                if (isNew == true) {//pressing add will insert this record to DB

                    if (
                            $("#dname").val() != "" &&
                            $("#special").val() != "" &&
                            $("#qual").val() != "" &&
                            $("#exp").val() != "" &&
                            $("#phone").val() != "" &&
                            $("#rno").val() != ""
                            ) {


                        url = "php/doctor/add_doctor.php";
                        data = $("#frmdoctor").serialize();
                        method = "POST";
                    } else {
                        alert("Please fill all fields !");
                        return;
                    }

                } else {//pressing Add will edit/update the existing record


                    if (
                            $("#dname").val() != "" &&
                            $("#special").val() != "" &&
                            $("#qual").val() != "" &&
                            $("#exp").val() != "" &&
                            $("#phone").val() != "" &&
                            $("#rno").val() != ""
                            ) {

                        url = "php/doctor/edit_doctor.php";
                        //we apend the selected id to the query parameters of processer file
                        method = "POST";
                        data = $("#frmdoctor").serialize() + "&dr_no=" + dr_no;


                    } else {
                        alert("Please fill all fields !");
                        return;

                    }



                }


                $.ajax({

                    type: method,
                    url: url,
                    dataType: "JSON",
                    data: data,
                    success: function (data) {//this is returned data

                        if (isNew == true) {

                            if (data == 2) { //2 means user as doctor has already added
                                //himself as a doctor
                                alert("Doctor has already been added ");
                                return;
                            }

                            alert("doctor added...");
                        } else {

                            alert("doctor updated...");
                        }

                        //clear form fields
                        clearFormFields();
                        window.location = "doctor.php";
                    }


                });
            }


            //get all doctors
            function getAll() { //ok


                var logid = $("#logidx").val();
                $.ajax({

                    url: "php/doctor/all_doctor.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {logid: logid},
                    success: function (d) {


                        var table = document.getElementById("tbl-doctor");
                        for (i = 0; i < d.length; i++) {
                            table.innerHTML += "<tr>" +
                                    "<td>" + d[i]['doctorno'] + "</td>" +
                                    "<td>" + d[i]['dname'] + "</td>" +
                                    "<td>" + d[i]['special'] + "</td>" +
                                    "<td>" + d[i]['qual'] + "</td>" +
                                    "<td>" + d[i]['exp'] + "</td>" +
                                    "<td>" + d[i]['phone'] + "</td>" +
                                    "<td>" + d[i]['room'] + "</td>" +
                                    "<td><button class='btn btn-info' onclick=getDetails(" + d[i]['doctorno'] + ")>Edit</button></td>" +
                                    "<td><button class='btn btn-danger' onclick=removeDetails(" + d[i]['doctorno'] + ")>Delete</button></td>" +
                                    "</tr>";
                        }


                    }

                });
            }





            //we defined to use in other scopes
            var dr_no = null;
            //if edit is clicked
            function getDetails(id) { // OK
                dr_no = id;
                $.ajax({

                    type: "POST",
                    url: "php/doctor/get_doctor.php",
                    dataType: "JSON",
                    data: {drno: dr_no},
                    success: function (data) {

                        isNew = false;
                        $("#dno").val(data[0]['doctorno']);
                        $("#dname").val(data[0]['dname']);
                        $("#special").val(data[0]['special']);
                        $("#qual").val(data[0]['qual']);
                        $("#exp").val(data[0]['expe']);
                        $("#phone").val(data[0]['phone']);
                        $("#rno").val(data[0]['room']);
                        //disable editing #pno
                        $("#dno").attr("disabled", "disabled");
                    }
                });
            }

            //if Delete button is clicked
            function removeDetails(id) {  //ERROR

                    dr_no = id ;
                $.ajax({

                    type: "POST",
                    url: "php/doctor/doctor_delete.php",
                    dataType: "JSON",
                    data: {dr_no: dr_no},
                    success: function (data) {

                        alert("Doctor is deleted ...");
                        window.location = "doctor.php";
                    }
                });
            }


            //clear form fields
            function clearFormFields() {
                $("#dno").val("");
                $("#dname").val("");
                $("#special").val("");
                $("#qual").val("");
                $("#exp").val("");
                $("#phone").val("");
                $("#rno").val("");
            }

    //tab colors
            $(document).ready(function () {
                $("#tabs").find("li").removeClass("active");
                $("#tabs").find("#doctor").addClass("active");
            });


        </script>

    </body>
</html>
