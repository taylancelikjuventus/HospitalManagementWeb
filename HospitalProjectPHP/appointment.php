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
                <div class="col-md-8">

                    <h3>Steps to arrange online appointment</h3>
                    <p>1.Fill the following form</p>
                    <p>2.Click Next button that will appear after you are registered successfuly.</p>
                 <a href="index.php" class = "btn btn-primary">Back</a>   
                </div>
            </div>

            <div class="row">


                <div class="col-sm-4">

                    <h3>Registration Form</h3>
                    <div class="appointment">

                        <form id="myform-app">
                            <div class="form-group">
                                <label for="fullname">Name :</label>
                                <input name="fname" type="text" class="form-control" id="fullname">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone :</label>
                                <input name="phone" type="number" min="0" class="form-control" id="phone">
                            </div>
                            <div class="form-group">
                                <label for="address">Address :</label>
                                <textarea name="address" rows="3" cols="20" id="address" class="form-control"></textarea>
                            </div>
                            <button type="button" id="submit" class="btn btn-success">Submit</button>
                        </form> 

                    </div>


                </div>

                <div class="col-sm-4" id="result">

                    <h3>Results</h3>

                    <p>You have successfully registered ...</p>
                    <p>Please go to last step by clicking 'Next' .</p>
                    <a type="submit" class='btn btn-danger' href='appointment2.php'>Next</a>


                </div>


            </div>

        </div>

        <script>
            $(document).ready(function () {

                $("#submit").click(function () {

                    var appoint_no = "";
                    var mydata = $("#myform-app").serialize();

                    $.ajax({

                        url: "onlineappointment/make_appointment.php",
                        type: "POST",
                        dataType: "JSON",
                        data: mydata,
                        success: function (data) {

                            if (data != 0) {
                                alert("You have registered successfully ...");
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


                });
//end
            });


            function clearFormFields() {
                $("#fullname").val("");
                $("#phone").val("");
                $("#address").val("");
            }


        </script>


    </body>
</html>
