<!DOCTYPE html>
<html>
    <head>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel='stylesheet' href='//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
        <script src='jquery.validate.min.js'></script>


        <style type="text/css">

            body,tr,th{
                color : #000;
            }
            body{
                background-color: #F0F0F0;
            }

            .style1{
                font-family: arial,helvetica,sans-serif;
                font-size: 14px;
                font-weight: bold;
                padding : 12px;
                text-decoration: none;
                color : sienna;
            }

            .style2{
                font-family: arial,helvetica,sans-serif;
                font-size: 17px;
                padding : 12px;
                line-height: 25px;
                border-radius: 5px ;
                text-decoration: none;
            }

        </style>

    </head>
    <body>

        <div class="container" style="margin-top: 12%;">

            <table width="100%" heigth="100%" border="0" cellpadding="0" align="center">
                <tr>
                    <td align="center" valign="middle">
                        <table width="400" cellpadding="3"  celspacing="3"  style="border:2px solid cadetblue;background: khaki;">

                            <form id="frm_login" name="frm_login">

                                <tr>
                                    <td height="25" colspan="2" align="left" valign="center" bgcolor="crimson" class="style2">
                                        <div align="center" style="color: bisque;">
                                            <strong>Login</strong>
                                        </div>

                                    </td>
                                </tr>

                                <tr>
                                <div id="err" style="color:red">

                                </div> 

                                </tr>

                                <tr>
                                    <td width="110" align="left" valign="middle" class="style1">Username</td>

                                    <td width="110" align="left" valign="middle" class="style1">

                                        <input type="text" class="form-control" size="10px" id="username" name="username" placeholder="Username">    
                                    </td>
                                </tr>

                                <tr>
                                    <td width="110px" align="left" valign="middle" class="style1">Password</td>

                                    <td width="110px" align="left" valign="middle" class="style1">

                                        <input type="text" class="form-control" size="10px" id="password" name="password" placeholder="Password">    
                                    </td>
                                </tr>

                                <tr>
                                    <td width="110px" align="left" valign="middle" class="style1">User Type</td>

                                    <td width="110px" align="left" valign="middle" class="style1">

                                        <select class="form-control" id="utype" name="utype" placeholder="User Type">

                                            <option value="">Please Select :</option>
                                            <option value="1">Pharmacist</option>
                                            <option value="2">Doctor</option>
                                            <option value="3">Receptionist</option>
                                        </select>

                                    </td>
                                </tr>

                                <!--Buttons-->
                                <tr>
                                    <td colspan="2" align="right" valign="middle" class="style1">


                                        <button type="button" class="btn btn-primary" onclick="login()">Sign In</button>
                                        <button type="button" class="btn btn-danger" onclick="reset()">Reset</button>

                                    </td>

                                </tr>
                                <tr>
                                    
                                    <td colspan="2" align="center" valign="middle">
                                        <a href="signup.php">Sign Up</a>     

                                    </td>
                                </tr>

                            </form>

                        </table>

                    </td>
                </tr>
            </table>


        </div>

        <!--scripts-->
        <script>

            function login() {

                if ($('#username').val() == "") {
                    $("username").parent('td').addClass("has-error");
                    return false;
                } else if ($('#password').val() == "") {
                    $("#password").parent('td').addClass("has-error");
                    return false;
                } else if ($('#utype').val() == "") {
                    $("#utype").parent('td').addClass("has-error");
                    return false;
                }

                var data = $("#frm_login").serialize();

                $.ajax({

                    type: "POST",
                    url: "php/login/validate_login.php",
                    data: data,
                    success: function (response) {

                        if (response == 1) {

                            window.location = "index.php";

                        } else if (response == 0) {

                            $("#err").html("Username or Password Wrong!!!").fadeIn("slow");
                        }
                    }


                });
            }


        </script>



    </body>

</html>
