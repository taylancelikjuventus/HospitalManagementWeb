<?php
session_start();
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

            <div class="row">
                <div class="col-sm-8">
                    <p>1.Please enter the item code into "Item Code" cell.If such an item is present other cells are filled automatically</p>  
                    <p>2.Then select quantity</p>  
                    <p>3.Then click "Add" button</p>  
                    <p>4.Enter amount into table invoice's 'pay' cell and click print</p>  

                </div>
            </div>
            <div class='row'>

                <div class="col-sm-8">
                    <h3>Enter Item to Sell</h3>
                    <form id="frm-invoice">

                        <table class="table table-bordered">

                            <tr>
                                <th>Item Code</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Amount</th>
                                <th>Option</th>

                            </tr>

                            <tr>
                                <td>
                                    <input type="text" class="form-control" placeholder="Enter item code" id="icode" name="icode" size="30px" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="item name" id="iname" name="iname" size="30px" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="price" id="price" name="price" size="30px" >
                                </td>
                                <td>
                                    <input type="number" class="form-control" placeholder="quantity" id="qty" name="qty" size="30px" >
                                </td>
                                <td>
                                    <input type="text" class="form-control" placeholder="amount" id="amount" name="amount" size="30px" >
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info" onclick="addItem()">Add</button>
                                </td>


                            </tr>

                        </table>

                    </form>

                    <table id="tbl-item" class="table table-bordered">
                        <thead>
                        <h4>Products in Cart</h4>
                            <tr>
                                <th>Delete</th>
                                <th>Item No</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>

                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>




                </div>                
                <div class="col-sm-4">
                    <h3>Invoice</h3>
                    <div class="form-group" align="left">
                        <label>Total</label>
                        <input type="text" class="form-control" placeholder="total" id="total" name="total" size="30px" >
                    </div>
                    <div class="form-group" align="left">
                        <label>Pay</label>
                        <input type="text" class="form-control" placeholder="Enter amount paid" id="pay" name="pay" size="30px" >
                    </div>
                    <div class="form-group" align="left">
                        <label>Balance</label>
                        <input type="text" class="form-control" placeholder="balance" id="bal" name="bal" size="30px" >
                    </div>

                    <div class="form-group" align="right">

                        <button type="button" class="btn btn-success" onclick="goBack()">Back</button>
                        <button type="button" class="btn btn-info">Print</button>
                        <button type="button" class="btn btn-danger" onclick="reset()">Reset</button>
                    </div>


                </div>                

            </div>
        </div>

        <!--scripts-->    
        <script>

            getItemCode();

            function getItemCode() {



                //first table
                $("#icode").empty();

                $("#icode").keyup(function (e) {

                    //if #icode is empty reset form
                    if ($("#icode").val() == "") {
                        $("#frm-invoice")[0].reset();
                    }


                    $.ajax({

                        type: "POST",
                        url: "php/item/get_item.php",
                        dataType: "JSON",
                        data: {itemcode: $("#icode").val()},
                        success: function (data) {

                            $("#iname").val(data[0].itemname);
                            $("#price").val(data[0].sprice);
                            $("#qty").focus();
                        }

                    });

                });


            }

            var sum = 0;
            var total = 0;
            $(function () {

                $("#price,#qty").on("keyup keydown click", CalcTotal);

                function CalcTotal() {

                    sum = $("#price").val() * $("#qty").val();

                    $("#amount").val(sum);

                }

            });

            //second table that shows items in Cart
            function addItem() {

                var itemcode = $("#icode").val();
                var iname = $("#iname").val();
                var price = $("#price").val();
                var qty = $("#qty").val();


                var table =
                        "<tr>" +
                        "<td><button type='button' name='delete' class='btn btn-danger' onclick='del(this)'>Delete</button></td>" +
                        "<td>" + itemcode + "</td>" +
                        "<td>" + iname + "</td>" +
                        "<td>" + price + "</td>" +
                        "<td>" + qty + "</td>" +
                        "<td>" + sum + "</td>" +
                        "</tr>";


                total += sum;
                $("#total").val(total);

                //append row to #table-item
                $("#tbl-item tbody").append(table);

                //clear table above
                $("#frm-invoice")[0].reset();
            }


            //if delete is clicked
            function del(element) {

                //get subtotal of row
                var currow = element.parentNode.parentNode;
                currow.setAttribute("id", "delrow");
                //5th is the last cell that shows total of current row
                var deleteFromTotal = currow.childNodes[5].innerHTML;

                //update new total
                total -= deleteFromTotal;
                $("#total").val(total);

                //delete row from table
                var delrow = document.getElementById("delrow");//row element
                delrow.parentNode.removeChild(delrow);

                /*
                 //OR USE Jquery
                 //updating total
                 totalcost= $(element).parent().parent().find("td:last").text();
                 total -= totalcost;
                 
                 //delete row
                 $(element).parent().remove();               
                 */
            }


            $(function () {

                $("#total,#pay").on("keyup keydown click", CalcTotal);

                function CalcTotal() {

                    sum = $("#pay").val() - $("#total").val();

                    $("#bal").val(sum);


                    if ($("#pay").val() == "") {
                        $("#bal").val("");
                    }

                }


            });


            //if reset button is clicked
            function reset() {

                window.location.href = "invoice.php";

            }

            //if back button is clicked
            function goBack() {

                window.location.href = "view_prescription.php";


            }



        </script>

    </body>
</html>
