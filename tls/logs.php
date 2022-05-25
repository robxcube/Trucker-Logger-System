<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>



<?php require 'dbConnect.php' ?>
<?php

$sql = "SELECT * FROM package";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);


if($result >0) {
    return $result;
}

?>

<table class="table">
<head>

    <tr id="trDelete">
        <th>PkgID:</th>
        <th>Employee ID:</th>
        <th>warehouse ID:</th>
        <th>Client ID:</th>
        <th>Transaction Fee:</th>
        <th>Transaction Date:</th>
    </tr>
</head>

<tbody>
<div id="loadLogs">
<?php


    if($result) {

        while($row = $result->fetch()) {?>
            <tr>
            <td><?php echo $row['pkg_Id'] ?></td>
            <td><?php echo $row['emp_Id'] ?></td>
            <td><?php echo $row['warehouse_Id'] ?></td>
            <td><?php echo $row['client_Id'] ?></td>
            <td><?php echo $row['transaction_Fee'] ?></td>
            <td><?php echo $row['transaction_Date'] ?></td>
            <td><button class="btn btn-info" onclick="editData(<?php echo $row['client_Id']; ?>)">Edit</button>
            &nbsp;
            <button class="delete btn btn-danger" id="deleteData" onclick="deleteData(<?php echo $row['client_Id']; ?>)" >Delete</button></td>
        </tr>
<?php
        $id = $row['client_Id'];
        }
    }


?>


</div>
</tbody>
</table>
<?php

    $sql = "SELECT * FROM client WHERE client_Id ="
?>

<script type="text/javascript">


    function editData(id) {
        $.confirm({
            useBootstrap:true,
            offsetTop:10,
            offsetBottom:10,
            title: false,
            columnClass: 'col-md-9',
            dragWindowGap: 0,
            content: '' +
                '<form id ="submitForm"action="">'+
                    '<label>Client Name</label> &nbsp;'+
                    '<label> Client Phone No.</label><br>'+
                        '<input type="text" name="clientName[]" >'+
                            '<input type="number" name="clientPhoneNo[]" ><br>'+
                        '<div id="showItem">'+
                            '<div class="addItem">'+
                                    '<label>Item Name</label>'+
                                    '<label>Item Type</label> &nbsp;<br>'+
                                        '<input type="text"  name="itemName[]" required>'+
                                        '<select name="itemType[]">'+
                                            '<option >Raw Material</option>'+
                                            '<option >Work In Progress</option>'+
                                            '<option >Finished Goods</option>'+
                                            '<option >MRO Goods</option>'+
                                            '<option >Packaging Materials</option>'+
                                    '</select><br>'+
                                    '<label for="itemSize">Item Size</label>'+
                                    '<label for="qty">Qty.</label><br>'+
                                    '<select  name="itemSize[]" >'+
                                        '<option value="Small">S</option>'+
                                        '<option value="Medium">M</option>'+
                                        '<option value="Large">L</option>'+
                                        '<option value="X Large">XL</option>'+
                                        '<option value="2XL">2XL</option>'+
                                        '<option value="3XL">3XL</option>'+
                                    '</select>'+
                                        '<input type="number"  name="qty[]" required><br>'+
                                    '<label for="declaredValue">Declared Value</label>'+
                                        '<input type="number"  name="declaredValue[]" required> <br>'+
                            '</div>'+
                        '</div>'+
                        '<div>'+
                        '<label for="">Warehouse</label><br>'+
                        '<select>'+

                        '<?php

                            $sql = "SELECT warehouse_Id FROM warehouse WHERE warehouse_Id = '1'";
                            $q = $conn->query($sql);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $id = $q->fetch();

                            $sql1 = "SELECT warehouse_Id FROM warehouse WHERE warehouse_Id = '2'";
                            $q = $conn->query($sql1);
                            $q->setFetchMode(PDO::FETCH_ASSOC);
                            $id1 = $q->fetch();
                            ?>'+

                            '<option name="warehouse" value=""><?php echo $id['warehouse_Id']?>&nbsp;Cebu Warehouse</option>'+
                            '<option name="warehouse"><?php echo $id1['warehouse_Id']?>&nbsp;Dumaguete Warehouse</option>'+


                            '</select><br>'+
                            '</div>'+
                    '<label>Transaction Fee</label><input type="number" name="transacFee" required>'+
                                    '<label>Transaction Date</label><input type="date" name="transacDate" required><br>'+
                    '</form>',

                        buttons: {
                            formSubmit: {
                                text: 'Update',
                                btnClass: 'btn-blue',
                                action: function () {
                                        $.ajax({
                                            url: 'update.php',
                                            method: 'POST',
                                            data: $(this).serialize(),
                                            success: function(response) {
                                                $.alert('Updated');
                                            }
                                        });
                                }
                            },
                            cancel: function () {
                                $.alert('Canceled')
                            },
                        },
                        onContentReady: function () {
                            // bind to events
                            var jc = this;
                            this.$content.find('form').on('submit', function (e) {
                                // if the user submits the form by pressing enter in the field.
                                e.preventDefault();
                                jc.$$formSubmit.trigger('click'); // reference the button and click it
                            });
                        }

        });

    }

    function deleteData(id) {
        console.log(id);

        $.confirm({

            type: 'red',
            title: 'Alert!',
            content: 'Are you sure want to delete this?',

            buttons: {

                confirm: {

                    text: 'Confirm',
                    btnClass: 'btn-red',
                    action: function(){
                        $.ajax({
                                url: 'delete.php',
                                method: 'POST',
                                data: {delete_id:id},
                                success: function(response) {
                                    $.alert('Deleted!');
                                }
                            });
                    }
                },
                cancel: function () {
                    $.alert('Canceled!');
                }
            }
            });
        };


</script>