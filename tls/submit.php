
<?php
session_start();

    require 'dbConnect.php';
use LDAP\Result;

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }



    if(isset($_POST['submit'])) {
        $empId = validate($_POST['id']);
        $password = validate($_POST['pwd']);

        $_SESSION['empId'] = $empId;
        $_SESSION['password'] = $password;

        if(isset($_SESSION['empId']) && isset($_SESSION['password'])) {

            // Check if the employee id and password is empty
            if (empty($empId)) {
                header("Location: index.php?error=Employee Id is required");
                exit();
            } else if (empty($password)) {
                header("Location: index.php?error=Password is required");
                exit();
            } else {
                $sql = "SELECT * FROM employee WHERE emp_ID ='$empId' AND emp_Pwd = '$password'";
                    $result = $conn->query($sql);
                    $row = $result->rowCount();
                    if( $row === 1) {
                        $result->setFetchMode(PDO::FETCH_ASSOC);
                        $row = $result->fetch();
                            if($row['emp_ID'] === $empId && $row['emp_Pwd'] === $password) {

                                $_SESSION['emp_ID'] = $row['emp_ID'];
                                $_SESSION['emp_Name'] = $row['emp_Name'];
                                $_SESSION['emp_Pwd'] = $row['emp_Pwd'];
                                header("Location: submit.php");
                                exit();
                            }
                    } else {
                        header("Location: index.php?error=Incorrect Employee Id or Password");
                        exit();
                    }
            }

        }
        if(!empty($_SESSION['remember'])) {
            session_start();
            $_SESSION['empId'] = $empId;
            $_SESSION['password'] = $password;
        } else {
            $_SESSION['empId'] = $empId;
            $_SESSION['password'] = $password;
        }


    } else  {
        header("Location: index.php");
        exit();
    }


?>





<!DOCTYPE html>
<html>
    <head>
        <title>
            TLS
        </title>


        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >

        <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
        <script type="text/javascript" src="main.js"></script>


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>



        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


    </head>

    <body>


        <!--Create a tab-->
            <div class="tab">
                <button class="tablinks" onclick="openTab(event, 'Menu')" id="defaultOpen">Menu</button>
                <button class="tablinks" onclick="openTab(event, 'Transactions')">Transactions</button>
                <button class="tablinks" id="log" onclick="openTab(event, 'Logs')">Logs</button>
                <!--<button class="offset-9" disabled><?php echo $row['emp_Name'] ?></button>-->

            </div>


        <!--Create a form to save data and send to database-->
            <div id="Menu" class="tabcontent">
                <div id="show_alert"></div>
                <form id ="submitForm"action="send.php" method="POST">
                    <label id="clientName">Client Name</label> &nbsp;
                    <label id="clientPhone"> Client Phone No.</label><br>
                        <input type="text" id=clientFieldName name="clientName[]" >
                            <input type="number" id="clientFieldNo" name="clientPhoneNo[]" ><br>
                        <div id="showItem">
                            <div class="addItem">
                                    <label id="itemName">Item Name</label>
                                    <label id="itemTypeLabel">Item Type</label> &nbsp;<br>
                                        <input type="text" id="itemName" name="itemName[]" required>
                                        <select id="itemType" name="itemType[]">
                                            <option >Raw Material</option>
                                            <option >Work In Progress</option>
                                            <option >Finished Goods</option>
                                            <option >MRO Goods</option>
                                            <option >Packaging Materials</option>
                                    </select><br>
                                    <label id="itemSizeLabel" for="itemSize">Item Size</label>
                                    <label id="qty" for="qty">Qty.</label><br>
                                    <select id="itemSize" name="itemSize[]" >
                                        <option value="Small">S</option>
                                        <option value="Medium">M</option>
                                        <option value="Large">L</option>
                                        <option value="X Large">XL</option>
                                        <option value="2XL">2XL</option>
                                        <option value="3XL">3XL</option>
                                    </select>
                                        <input type="number" id="qty"  name="qty[]" required><br>
                                    <label id="declaredValueLabel" for="declaredValue">Declared Value</label>
                                        <input type="number" id="declaredValue" name="declaredValue[]" required> <br>
                            </div>
                        </div>

                        <div class="col-md-1 mb-3 d-grid">
                            <input type="button" class="add_item_btn" id="btnAdd" value="Add New Item">
                        </div>
                        <div>
                        <label id="warehouseLabel" for="">Warehouse</label><br>
                        <select id="warehouse" name=warehouse>
                                <?php

                                    $sql = "SELECT warehouse_Id FROM warehouse WHERE warehouse_Id = '1'";
                                    $q = $conn->query($sql);
                                    $q->setFetchMode(PDO::FETCH_ASSOC);
                                    $id = $q->fetch();

                                    $sql1 = "SELECT warehouse_Id FROM warehouse WHERE warehouse_Id = '2'";
                                    $q = $conn->query($sql1);
                                    $q->setFetchMode(PDO::FETCH_ASSOC);
                                    $id1 = $q->fetch();
                                ?>

                                <option value="1"><?php echo $id['warehouse_Id']?>&nbsp;Cebu Warehouse</option>
                                <option value="2"><?php echo $id1['warehouse_Id']?>&nbsp;Dumaguete Warehouse</option>

                            </select><br>
                            </div>
                    <label id="transacFeeLabel">Transaction Fee</label><input type="number" id="transacFee" name="transacFee" required>
                                    <label id="transacDateLabel">Transaction Date</label><input type="date" id="transacDate" name="transacDate" required><br>
                        <input type="submit" id="submitBtn" value="submit" name="submit" for="submitForm"><br>
                    </form>
            </div>

            <script>
                $(document).ready(function() {
                    $(".add_item_btn").click(function(e) {
                        e.preventDefault();
                        $("#showItem").append(`                            <div class="addItem append_items">
                                        <label for="itemName">Item Name</label>
                                        <label for="itemType">Item Type</label> &nbsp;<br>
                                            <input type="text" id="itemName" name="itemName[]">
                                            <select name="itemType[]">
                                                <option >Raw Material</option>
                                                <option >Work In Progress</option>
                                                <option >Finished Goods</option>
                                                <option >MRO Goods</option>
                                                <option >Packaging Materials</option>
                                    </select><br>
                                        <label for="itemSize">Item Size</label>
                                        <label for="qty">Qty.</label><br>
                                        <select>
                                        <option name="itemSize[]">S</option>
                                        <option name="itemSize[]">M</option>
                                        <option name="itemSize[]">L</option>
                                        <option name="itemSize[]">XL</option>
                                        <option name="itemSize[]">2XL</option>
                                        <option name="itemSize[]">3XL</option>
                                    </select>
                                            <input type="number" id="qty" name="qty[]"><br>
                                        <label for="declaredValue">Declared Value</label>
                                            <input type="number" id="declaredValue" name="declaredValue[]"> <br>
                                        <div class="col-md-1 mb-3 d-grid">
                                            <input type="button" class="remove_item_btn" value="Remove Item"><br>
                                        </div>
                            </div>`)
                    });

                    $(document).on('click', '.remove_item_btn', function(e) {
                        e.preventDefault();
                        let addItem = $(this).parent().parent();
                        $(addItem).remove();
                    });



                    $("#submitForm").submit(function(e) {
                        e.preventDefault();
                            $("#submit").val('Submiting.....');
                            $.ajax({
                                url: 'send.php',
                                method: 'POST',
                                data: $(this).serialize(),
                                success: function(response) {
                                    $("#submit").val('submit');
                                    $("#submitForm")[0].reset();
                                    $(".append_items").remove();
                                    $("#show_alert").html(`<div class="alert alert-success" role="alert">Submitted succesfully</div>`);
                                    setInterval(function() {
                                        $("#show_alert").html(`<div id="show_alert"></div>`);
                                    },6000);
                                }
                            });




                    });
                });
            </script>


            <div id="Transactions" class="tabcontent">
                <input type="button" id="transacButton">

                <script>
                    function loadTransactions(){

                        $("#Transactions").load('transaction.php',function () {
                            $(this).unwrap();
                        });
                    }

                    loadTransactions(); // This will run on page load
                        setInterval(function(){
                            loadTransactions() // this will run after every 3 seconds
                        }, 3000);
                </script>

            </div>


            <!-- For showing the recorded packages -->
            <div id="Logs" class="tabcontent">

            <script>

                    $('#log').click(function() {

                    $("#Logs").load('Logs.php',function () {
                        $(this).unwrap();
                    });

                    });

/**
                    function loadLogs(){

                    $("#Logs").load('logs.php',function () {
                        $(this).unwrap();
                    });
                    }

                    loadLogs(); // This will run on page load
                    setInterval(function(){
                        loadLogs() // this will run after every 5 seconds
                    }, 3000);

*/
                </script>


            </div>


        <script>
            function openTab(evt, tabName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(tabName).style.display = "block";
                evt.currentTarget.className += " active";
                }

                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();


        </script>
                        <button class="logout offset-11 btn btn-outline-danger" onclick="location.href='logout.php'">Logout</button>
    </body>
</html>

<script>

</script>