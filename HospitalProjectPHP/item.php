<?php

session_start() ;
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
        <?php include_once 'header.php'; ?> 

        <br><br>

        <div class='container-fluid'>
            <div class='row'>
                <div class='col-sm-4'>
                    <form id='frmitem' class='card'>
                        <div align='left'>
                            <h3>Add Item</h3>
                        </div>
                        <div align='left'>
                            <label class='form-label'>Item No</label>
                            <input type='text' class='form-control' placeholder="item number" id='ino' name='ino' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Item Name</label>
                            <input type='text' class='form-control' placeholder="item name" id='iname' name='iname' size='30px' required />
                        </div>

                        <div align='left'>
                            <label class='form-label'>Description</label>
                            <input type='text' class='form-control' placeholder="Description" id='des' name='des' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Sell Price</label>
                            <input type='number' class='form-control' placeholder="sell price" id='sprice' name='sprice' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Buy Price</label>
                            <input type='number' class='form-control' placeholder="buy price" id='bprice' name='bprice' size='30px' required />
                        </div>
                        <div align='left'>
                            <label class='form-label'>Quantity</label>
                            <input type='number' class='form-control' placeholder="quantity" id='qty' name='qty' size='30px' required />
                        </div>
                        <br>
                        <div align='right'>
                            <button type='button' id='save' class='btn btn-info' onclick="addItem()">Add </button>
                            <button type='button' id='save' class='btn btn-danger' onclick="reset()">Reset </button>
                        </div>

                    </form>

                </div>


                <div class='col-sm-8'>

                    <div class='panel-body'>
                        <table id='tbl-item' class='table table-responsive table-bordered' cellpadding='0' width='100%'>
                            <thead>
                                <h3>List Of All Items in Drug Store</h3>
                                <tr>
                                    <th>Item No</th>
                                    <th>Item Name</th>
                                    <th>Description</th>
                                    <th>Sell Price</th>
                                    <th>Buy Price</th>
                                    <th>Quantity</th>
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

            //list all items
            getAll();

            //when page is loaded Auto id should be appear
            getAutoID();

            function getAutoID() {

                $("#ino").empty();

                $.ajax({

                    type: "GET",
                    url: "php/item/autoid_item.php",
                    dataType: "JSON",

                    success: function (data) {

                        //alert(data);
                        $("#ino").val(data);

                    }

                });

            }



            var isNew = true;
            function addItem() {

                var url = "";
                var data = "";
                var method = "";
                if (isNew == true) {//pressing add will insert this record to DB

                    url = "php/item/add_item.php";
                    data = $("#frmitem").serialize();
                    method = "POST";

                } else {//pressing Add will edit/update the existing record

                    url = "php/edit_patient.php";
                    //we apend the selected id to the query parameters of processer file
                    data = $("#frmpatient").serialize() + "&patient_id=" + patient_id;
                    method = "POST";


                }


                $.ajax({

                    type: method,
                    url: url,
                    dataType: "JSON",
                    data: data,
                    success: function (data) {//this is returned data

                        
                        if (isNew == true) {

                            alert("item added...");

                        } else {

                            alert("item updated...");
                        }

                           //clear form fields
                            clearFormFields();
                            window.location = "item.php";

                    }
                });
            }


              //datatable 
            $(document).ready(function () {   //OK!!!

                $("#tbl-item").DataTable({

                    "ajax": {
                        "url": "php/item/all_item.php",
                        "type":"POST",
                        "dataType":"JSON"
                    },

                    "columns": [
                        {"data": "itemno"},
                        {"data": "itemname"},
                        {"data": "desc"},
                        {"data": "sprice"},
                        {"data": "bprice"},
                        {"data": "qty"},
                        {"data": "edit"},
                        {"data": "delete"}

                    ]

                });

            }); 


            //get all patients
            function getAll() {

                //$("#tbl-patient").dataTable().fnDestroy() ;
            /*
                $.ajax({

                    url: "php/item/all_item.php",
                    type: "GET",
                    dataType: "JSON",
                    success: function (data) {


                        var table = document.getElementById("tbl-item");

                        for (i = 0; i < data.length; i++) {
                            table.innerHTML += "<tr>" +
                                    "<td>" + data[i]['itemno'] + "</td>" +
                                    "<td>" + data[i]['itemname'] + "</td>" +
                                    "<td>" + data[i]['desc'] + "</td>" +
                                    "<td>" + data[i]['sprice'] + "</td>" +
                                    "<td>" + data[i]['bprice'] + "</td>" +
                                    "<td>" + data[i]['qty'] + "</td>" +
                                    "<td><button class='btn btn-info' onclick=getDetails(" + data[i]['itemno'] + ")>Edit</button></td>" +
                                    "<td><button class='btn btn-danger' onclick=removeDetails(" + data[i]['itemno'] + ")>Delete</button></td>" +
                                    "</tr>";
                        }


                    }

                });
                  */

            }

            //we defined to use in other scopes
            var patient_id = null;

            //if edit is clicked
            function getDetails(id) {
                patient_id = id;
                //alert("patient no :" + param) ;  //Ok

                $.ajax({

                    type: "POST",
                    url: "php/patient_return.php",
                    dataType: "JSON",
                    data: {patient_id: id},
                    success: function (data) {

                        isNew = false; //if this is true pressing add will 
                        //insert new record to DB
                        //if this variable is false pressing add button will
                        //update the record only.
                        //

                        //fill form fields

                        //alert("no : " + data[0]['patientno']) ;

                        $("#pno").val(data[0]['patientno']);
                        $("#pname").val(data[0]['name']);
                        $("#phone").val(data[0]['phone']);
                        $("#address").val(data[0]['address']);

                        //disable editing #pno
                        $("#pno").attr("disabled", "disabled");
                    }
                });

            }

            //if Delete button is clicked
            function removeDetails(id) {


                $.ajax({

                    type: "POST",
                    url: "php/patient_delete.php",
                    dataType: "JSON",
                    data: {patient_id: id},
                    success: function (data) {

                        alert("Patient is deleted ...");
                        window.location = "index.php";


                    }
                });


            }


            //clear form fields
            function clearFormFields() {
                $("#ino").val("");
                $("#iname").val("");
                $("#des").val("");
                $("#sprice").val("");
                $("#bprice").val("");
                $("#qty").val("");
            }
            
            
             //tab colors
            $(document).ready(function () {
                $("#tabs").find("li").removeClass("active");
                $("#tabs").find("#item").addClass("active");
            });
            

        </script>

    </body>
</html>
