<?php
session_start();

if (!isset($_SESSION['isLogin']))
    include './headerFirst.php';

if (isset($_SESSION['isLogin'])) {
//if Login is wrong
    if ($_SESSION['isLogin'] != true) {

        //redirect to login page
        header("Location: login.php");
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Main Page</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel='stylesheet' href='https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css'>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <link rel="stylesheet" href="css/mystyle.css">

        <link rel="stylesheet" href="owl/owl.carousel.css">
        <link rel="stylesheet" href="owl/owl.theme.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 
        <script src='jquery.validate.min.js'></script>
        <!--Data table--> 
        <script src='https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js'></script>

        <!--Owl Carousel-->
        <script src="owl/owl.carousel.min.js"></script>


    </head>
    <body>

        <?php
//the navbar of this page changes according to the user type.

        if (isset($_SESSION['isLogin'])) {
            if ($_SESSION["utype"] == 1) { //phar
                include 'header.php';
            }
            if ($_SESSION["utype"] == 2) { //doc
                include 'header1.php';
            }
            if ($_SESSION["utype"] == 3) {//receptionist
                include 'header2.php';
            }
        }
        ?>


        <div class="container-fluid">
            <div class="row image-panel">

                <img src="images/hospitalimage1.png">
                <img src="images/hospitalimage2.jpg">
                <img src="images/nurse.png">
                <img src="images/surgery.png">
                <img src="images/surgery2.png">
                <img src="images/health.jpg">

            </div>

        </div>        

        <div class="container">


            <div  class="row">

                <div class="col-sm-2 ">

                    <div class="side_container">

                        <ul>
                            <li><a href="#aboutus">About Us</a></li> 
                            <li><a href="#services">Our Services</a></li> 
                            <li><a href="#staff">Our Staff</a></li> 
                            <li><a href="#loc">Location</a></li> 
                            <li><a href="#hours">Online Appointment</a></li> 
                            <li><a href="#contact">Contact Us</a></li> 
                            <li><a href="#img_galery">Image Galery</a></li> 
                        </ul>

                    </div>


                    <div class="social-links">
                        <ul>
                            <li><a href="#"><i  class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        </ul>

                    </div> 



                </div>

                <div class="col-sm-8">

                    <div class="main_container  setscrolbar">

                        <div id="aboutus" class="panel panel-body">
                            <h4>About US</h4> 
                            <p> Big Hospital is located somewhere, providing a full range GP services including Doctor appointment, Blood Tests, Travel and Menopause clinics, Ear Wax Removal, Hearing Tests and Hearing Aids, Varicose Vein Surgery, Joint Injections and Sexual Health clinics. </p><p>We are Care Quality Commission regulated.

                                No referral required. Appointments booked at your convenience, same day and evening appointments often available. Walk-ins welcome. The clinic has grown through its reputation of having an expert team of experienced and advanced professionals.</p><p>

                                We are a well-known hospital which embraces patients from other countries as well.</p>

                        </div>



                        <div id="services" class="panel panel-body">
                            <h4>Services</h4>   

                            <div class="row">
                                <div class="col-sm-4">

                                    <ul>
                                        <li>Blood Tests</li>
                                        <li>Health Checks Men/Women</li>
                                        <li>Hearing Aids</li>
                                        <li>Immunisations</li>
                                        <li>Diets</li>
                                    </ul>     
                                </div>
                                <div class="col-sm-4">
                                    <ul>
                                        <li>Hearing Tests</li>
                                        <li>Menopause Clinic</li>
                                        <li>Sexual Health Clinic</li>
                                        <li>Ear Wax Removal</li>
                                        <li>Varicose Treatment</li>
                                    </ul>     
                                </div>
                                <div class="col-sm-4">
                                    <ul>
                                        <li>Plastic Surgery</li>
                                        <li>Medicals</li>
                                        <li>Joint Injections</li>
                                        <li>Eye Surgery Clinic</li>
                                        <li>Ear,Nose and Throat Clinic </li>
                                    </ul>     
                                </div>
                            </div>
                        </div>



                        <div id="staff" class="panel panel-body">
                            <h4>Staff</h4>   

                            <div class="row"> 
                                <div class="col-sm-2">
                                    <img src="images/doctoricon.png" width="120">       
                                </div>
                                <div class="col-sm-6">
                                    <p><b>Dr Jack Powder</b></p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                                </div>

                            </div>
                            <div class="row"> 
                                <div class="col-sm-2">
                                    <img src="images/doctorWicon.png" width="120">       
                                </div>
                                <div class="col-sm-6">
                                    <p><b>Dr Julia Brown</b></p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                                </div>

                            </div>
                            <div class="row"> 
                                <div class="col-sm-2">
                                    <img src="images/doctoricon.png" width="120">       
                                </div>
                                <div class="col-sm-6">
                                    <p><b>Dr Biff Tannen</b></p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                                </div>

                            </div>
                            <div class="row"> 
                                <div class="col-sm-2">
                                    <img src="images/nurseicon.png" width="120">       
                                </div>
                                <div class="col-sm-6">
                                    <p><b>Nurse Barbara Brown </b></p>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. </p>
                                </div>

                            </div>



                        </div>


                        <div id="loc" class="panel panel-body">
                            <h4>Location</h4>
                            <div class="row">
                                <div class="col-md-8">
                                    <img id="loc_img" src="images/ourlocation.png" width="90%" onclick="mag()">       
                                </div>
                            </div>
                            <p>Abc Street, somewhere</p>

                        </div>


                        <div id="hours" class="panel panel-body">

                            <h4>Online Appointment</h4>

                            <div class="row">
                                <div class="col-sm-8">
                                    <p> You can arrange online appointment with ease.
                                        Just click the link below.</p>
                                    <a href="appointment.php">Online Appointment</a>
                                </div>

                            </div>


                        </div>


                        <!--------->

                        <div id="test">

                        </div>

                        <div id="contact" class="panel panel-body">
                            <h4>Contact</h4>
                            <div class="row">
                                <div class="col-sm-4">
                                    <p><i class="glyphicon glyphicon-phone">  </i> 123 456</p>
                                    <p><i class="glyphicon glyphicon-envelope">  </i>  bighospital@abc.com</p>
                                </div>
                            </div>
                        </div>

                        <div id="img_galery" class="panel panel-body">
                            <h4>Images</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="owl-carousel owl-theme">

                                        <div class="owl-item" > <img src="images/owlimages/RamboFirstAid.jpg" > </div>
                                        <div class="owl-item"> <img src="images/owlimages/owl1.jpg"> </div>
                                        <div class="owl-item"> <img src="images/owlimages/owl2.jpg"> </div>
                                        <div class="owl-item"> <img src="images/owlimages/owl3.jpg"> </div>
                                        <div class="owl-item"> <img src="images/owlimages/owl4.jpg"> </div>
                                        <div class="owl-item"> <img src="images/owlimages/owl5.jpg"> </div>
                                        <div class="owl-item"> <img src="images/owlimages/owl6.jpg"> </div>
                                        <div class="owl-item"> <img src="images/owlimages/owl7.jpg"> </div>
                                        <div class="owl-item"> <img src="images/owlimages/owl8.jpg"> </div>
                                    </div>
                                </div>
                            </div>


                        </div>








                    </div>


                </div>

            </div>











        </div>

        <br><br>
        <?php include 'footer.php'; ?>

        <script>

            //tab colors
            $(document).ready(function () {
                $("#tabs").find("li").removeClass("active");
                $("#tabs").find("#index").addClass("active");


                //owl
                $(".owl-carousel").owlCarousel({

                    //Basic Speeds
                    // slideSpeed: 200,
                    // paginationSpeed: 800,

                    //Autoplay
                    autoPlay: false,
                    goToFirst: true,
                    goToFirstSpeed: 1000,

                    margin: 0,

                    // Navigation
                    navigation: false,
                    navigationText: ["prev", "next"],
                    pagination: true,
                    paginationNumbers: true,

                    // Responsive
                    responsive: true,
                    items: 2,
                    itemsDesktop: [1199, 2],
                    itemsDesktopSmall: [980, 2],
                    itemsTablet: [768, 2],
                    itemsMobile: [479, 1]



                });

            });




        </script>






    </body>
</html>
