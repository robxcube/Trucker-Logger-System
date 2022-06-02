<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

<?php require 'dbConnect.php' ?>
<?php

$sql = "SELECT * FROM package";
$result = $conn->query($sql);
$result->setFetchMode(PDO::FETCH_ASSOC);


if($result >0) {
    return $result;
}

?>

<script>


</script>

<!doctype html>

<table id="dtBasicExample" class="table" width="100%" >
<head>


    <tr id="trDelete">
        <th class="th-sm">PkgID:</th>
        <th class="th-sm">Employee ID:</th>
        <th class="th-sm">warehouse ID:</th>
        <th class="th-sm">Client ID:</th>
        <th class="th-sm">Transaction Fee:</th>
        <th class="th-sm">Transaction Date:</th>
    </tr>
</head>

<tbody>
    <script>


</script>
<div id="loadLogs">
<?php


    if($result) {

        while($row = $result->fetch()) {?>
            <tr>
            <td class="pkg_id"><?php echo $row['pkg_Id'] ?></td>
            <td><?php echo $row['emp_Id'] ?></td>
            <td><?php echo $row['warehouse_Id'] ?></td>
            <td class="client_id"><?php echo $row['client_Id'] ?></td>
            <td><?php echo $row['transaction_Fee'] ?></td>
            <td><?php echo $row['transaction_Date'] ?></td>
            <td><a href="#" class="btn btn-info editbtn" data-toggle="modal" data-target="#myModal" >Edit</a>
            <!--onclick="getData(<?php echo $row['client_Id']; ?>,<?php echo $row['pkg_Id']; ?>,<?php echo $row['warehouse_Id']; ?>)" -->
            &nbsp;
            <button class="delete btn btn-danger" id="deleteData" onclick="deleteData(<?php echo $row['client_Id']; ?>)" >Delete</button></td>
        </tr>
<?php

        }
    }


?>
</div>

<body>

<div class="container">
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>


</body>

</div>
</tbody>
</table>
<?php


?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script >



    $(document).on('click', '.editbtn', function() {

        var client_id = $(this).closest('tr').find('.client_id').text();
        console.log("pressed");

        $.ajax({
            url: "getData.php",
            type:"POST",
            data: {'client_id': client_id},

            success: function(data) {
                $(".modal-body").html(data);

            }
        });

    });




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

