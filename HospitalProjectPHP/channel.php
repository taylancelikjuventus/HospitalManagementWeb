<?php
session_start();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Main Page</title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel='stylesheet' href='//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
        <script src='jquery.validate.min.js'></script>
        <script src='//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>


    </head>
    <body>

        <!--header-->
        <?php
//the navbar of this page changes according to the user type.

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
                    <form id='frmchannel' class='card'>
                        <div align='left'>
                            <h3>Add Channel</h3>
                        </div>
                        <div align='left'>
                            <label class='form-label'>Channel No</label>
                            <input type='text' class='form-control' placeholder="channel number" id='cno' name='cno' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Doctor Name</label>
                            <select class='form-control' id='dname' name='dname'>
                                <option value=''>Please Select Doctor</option>
                            </select>
                        </div>

                        <div align='left'>
                            <label class='form-label'>Patient Name</label>
                            <select class='form-control' id='pname' name='pname'>
                                <option value=''>Please Select Patient</option>
                            </select>

                        </div>
                        <div align='left'>
                            <label class='form-label'>Room No</label>
                            <input type='text' class='form-control' placeholder="room number" id='rno' name='rno' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Channel Date</label>
                            <input type='date' class='form-control' placeholder="date" id='date' name='date' size='30px' required />
                        </div>
                        <br>
                        <div align='right'>
                            <button type='button' id='save' class='btn btn-info' onclick="addChannel()">Save</button>
                            <button type='button' id='save' class='btn btn-danger' onclick="reloadPage()">Reset </button>
                        </div>

                    </form>

                </div>


                <div class='col-sm-8'>

                    <div class='panel-body'>
                        <table id='tbl-channel' class='table table-responsive table-bordered' cellpadding='0' width='100%'>
                            <thead>
                            <h3>List Of All Channels</h3>
                            <tr>
                                <th>Channel No</th>
                                <th>Doctor Name</th>
                                <th>Patient Name</th>
                                <th>Room No</th>
                                <th>Date</th>
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
            //getAll();
            refresh();
            
            
            getDoctors();
            getPatients();

            //when page is loaded Auto id should be appear
            getAutoID();



            //get list of doctors
            function getDoctors() {

                $.ajax({

                    type: "GET",
                    url: "php/doctor/get_doctor.php",
                    dataType: "JSON",

                    success: function (data) {

                        for (var i = 0; i < data.length; i++) {
                            /*
                             document.getElementById("dname").innerHTML += 
                             "<option value='"+data[i].doctorno+"'>"+data[i].dname+"</option>";
                             */

                            //OR USE JQ   
                            $("#dname").append($("<option>", {//select option and properties
                                value: data[i].doctorno,
                                text: data[i].dname
                            }));
                        }
                    }

                });

            }


            //get list of doctors
            function getPatients() {

                $.ajax({

                    type: "GET",
                    url: "php/doctor/get_patients.php",
                    dataType: "JSON",

                    success: function (data) {

                        for (var i = 0; i < data.length; i++) {
                            /*
                             document.getElementById("dname").innerHTML += 
                             "<option value='"+data[i].doctorno+"'>"+data[i].dname+"</option>";
                             */

                            //OR USE JQ   
                            $("#pname").append($("<option>", {//select option and properties
                                value: data[i].patientno,
                                text: data[i].name
                            }));
                        }
                    }

                });

            }

            function getAutoID() {

                $("#cno").empty();

                $.ajax({

                    type: "GET",
                    url: "php/channel/autoid_channel.php",
                    dataType: "JSON",

                    success: function (data) {

                        //alert(data);
                        $("#cno").val(data);


                    }



                });


            }



            var isNew = true;
            function addChannel() {

                var url = "";
                var data = "";
                var method = "";
                if (isNew == true) {//pressing add will insert this record to DB



                    if (
                            $("#cno").val() != "" &&
                            $("#dname").val() != "" &&
                            $("#pname").val() != "" &&
                            $("#rno").val() != "" &&
                            $("#date").val() != ""
                            ) {
                        url = "php/channel/add_channel.php";
                        data = $("#frmchannel").serialize();
                        method = "POST";
                    } else {
                        alert("Please fill all fields !");
                        return;
                    }



                } else {//pressing Add will edit/update the existing record

                    if (
                            $("#cno").val() != "" &&
                            $("#dname").val() != "" &&
                            $("#pname").val() != "" &&
                            $("#rno").val() != "" &&
                            $("#date").val() != ""
                            ) {

                        url = "php/channel/edit_channel.php";
                        //we append the selected id to the query parameters of processer file
                        data = $("#frmchannel").serialize() + "&c_no=" + c_no;
                        method = "POST";
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

                            alert("channel created...");

                        } else {

                            alert("channel updated...");
                        }

                        //clear form fields
                        clearFormFields();
                        window.location = "channel.php";

                    }
                });
            }

     function refresh(){
            //get all channels
            $(document).ready(function () {

                $("#tbl-channel").DataTable({

                    "ajax": "php/channel/all_channel.php",
                    "columns": [
                        {"data": "cno"},
                        {"data": "dname"},
                        {"data": "pname"},
                        {"data": "rno"},
                        {"data": "date"},
                        {"data": "edit"},
                        {"data": "delete"}


                    ]

                });


            });
     }

            //get all channels
            function getAll() {

                /*
                 $.ajax({
                 
                 url: "php/channel/all_channel.php",
                 type: "GET",
                 dataType: "JSON",
                 success: function (data) {
                 
                 
                 var table = document.getElementById("tbl-channel");
                 
                 
                 table.innerHTML += "<tbody>";
                 for (i = 0; i < data.length; i++) {
                 table.innerHTML += "<tr>" +
                 "<td>" + data[i]['cno'] + "</td>" +
                 "<td>" + data[i]['dname'] + "</td>" +
                 "<td>" + data[i]['pname'] + "</td>" +
                 "<td>" + data[i]['rno'] + "</td>" +
                 "<td>" + data[i]['date'] + "</td>" +
                 "<td><button class='btn btn-info' onclick=getDetails(" + data[i]['cno'] + ")>Edit</button></td>" +
                 "<td><button class='btn btn-danger' onclick=removeDetails(" + data[i]['cno'] + ")>Delete</button></td>" +
                 "</tr>";
                 }
                 table.innerHTML += "</tbody>";
                 
                 
                 
                 
                 
                 }
                 
                 });
                 
                 */
            }

            //we defined to use in other scopes
            var c_no = null;

            //if edit is clicked
            function getDetails(id) {
                c_no = id;

                $.ajax({

                    type: "POST",
                    url: "php/channel/channel_return.php",
                    dataType: "JSON",
                    data: {c_no: id},
                    success: function (data) {

                        isNew = false; //if this is true pressing add will 
                        //insert new record to DB
                        //if this variable is false pressing add button will
                        //update the record only.
                        //

                    
                        $("#cno").val(c_no);


                        //disable editing #pno
                        $("#cno").attr("disabled", "disabled");
                    }
                });

            }

            //if Delete button is clicked
            function removeDetails(id) {


                $.ajax({

                    type: "POST",
                    url: "php/channel/channel_delete.php",
                    dataType: "JSON",
                    data: {c_no: id},
                    success: function (data) {

                        alert("Channel is deleted ...");
                        window.location = "channel.php";


                    }
                });


            }

           
            //clear form fields
            function clearFormFields() {
                $("#cno").val("");
                $("#dname").val("");
                $("#pname").val("");
                $("#rno").val("");
                $("#date").val("");
            }
          
            function reloadPage(){
                
                window.location = "channel.php";
            }



            //tab colors
            $(document).ready(function () {
                $("#tabs").find("li").removeClass("active");
                $("#tabs").find("#channel").addClass("active");
            });




        </script>

    </body>
</html>
