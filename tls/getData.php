
<?php


use LDAP\Result;

    include 'dbConnect.php';

      $clientId = $_POST['client_id'];
      $pkg_id = $_POST['pkg_id'];
      $itemId = " ";

      $itemName = " ";
      $itemType = " ";
      $itemSize = " ";
      $quantity = " ";
      $declaredValue = " ";

      $transacFee = $_POST['transacFee'];
      $transacDate = $_POST['transacDate'];






      $sql = "SELECT * FROM client WHERE client_Id = $clientId";
      $result = $conn->query($sql);
      $result->setFetchMode(PDO::FETCH_ASSOC);


      if($result) {

        while($row = $result->fetch()) {
         $client_Id = $row['client_Id'];

         $name = $row['name'];
         $phoneNo = $row['phoneNo'];
        }

      }




      $sql1 = "SELECT * FROM transaction WHERE pkg_Id = $pkg_id";
      $result1 = $conn->query($sql1);
      $result1->setFetchMode(PDO::FETCH_ASSOC);


      if($result1) {

        while($row1 = $result1->fetch()) {
            $itemId = $row1['item_Id'];

        }

        }


    $sql2 = "SELECT * FROM item WHERE item_Id = $itemId";
    $result2 = $conn->query($sql2);
    $result2->setFetchMode(PDO::FETCH_ASSOC);

    if($result2) {

        while($row2 = $result2->fetch()) {
            $itemName = $row2['item_Name'];
            $itemType = $row2['item_Type'];
            $itemSize = $row2['item_Size'];
            $quantity = $row2['quantity'];
            $declaredValue = $row2['declared_Value'];

        }

    }


?>
<form action="#" method="POST" id ="updateForm">
            <input type="hidden" name="item_Id" value="<?php echo $itemId; ?>">
                <input type="hidden" name="pkg_Id" value="<?php echo $pkg_id; ?>">
                    <input type="hidden" name="client_Id" value="<?php echo $client_Id; ?>">
                        <label>Client Name</label> &nbsp;
                        <label style="left:105px;position: relative;"> Client Phone No.</label><br>
                            <input type="text" name="clientName" value="<?php echo $name; ?>" />
                                <input type="number" name="clientPhoneNo" value="<?php echo $phoneNo; ?>" style="left:10px;position: relative;"><br>

                            <div id="showItem">
                                <div class="addItem">
                                        <label>Item Name</label>
                                        <label style="left:121px;position: relative;" >Item Type</label> &nbsp;<br>
                                            <input type="text"  name="itemName"  value="<?php echo $itemName; ?>">
                                            <select style="left:11px;position: relative;" name="itemType" >
                                                <option selected><?php echo $itemType; ?></option>
                                                <option >Raw Material</option>
                                                <option >Work In Progress</option>
                                                <option >Finished Goods</option>
                                                <option >MRO Goods</option>
                                                <option >Packaging Materials</option>
                                        </select><br>
                                        <label for="itemSize">Item Size</label>
                                        <label for="qty">Qty.</label><br>
                                        <select  name="itemSize" value="<?php echo $itemSize ?>">
                                            <option selected><?php echo $itemSize; ?></option>
                                            <option value="Small">S</option>
                                            <option value="Medium">M</option>
                                            <option value="Large">L</option>
                                            <option value="X Large">XL</option>
                                            <option value="2XL">2XL</option>
                                            <option value="3XL">3XL</option>
                                        </select>
                                            <input type="number"  name="qty" value="<?php echo $quantity; ?>"><br>
                                        <label for="declaredValue">Declared Value</label>
                                            <input type="number"  name="declaredValue" value="<?php echo $declaredValue; ?>"> <br>
                                </div>
                            </div>
                            <div>
                            <label for="">Warehouse</label><br>
                            <select name="warehouse">

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


                                <option name="warehouse"><?php echo $id['warehouse_Id']?>&nbsp;Cebu Warehouse</option>
                                <option name="warehouse"><?php echo $id1['warehouse_Id']?>&nbsp;Dumaguete Warehouse</option>

                                </select><br>
                                </div>
                        <label>Transaction Fee</label><input type="number" name="transacFee"  value="<?php echo $transacFee; ?>"><br>
                                        <label>Transaction Date</label><input type="date" name="transacDate"  value="<?php echo $transacDate; ?>"><br>

                                        </form>

<script>

</script>
