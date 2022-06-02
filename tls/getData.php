
<?php


use LDAP\Result;

    include 'dbConnect.php';

      $clientId = $_POST['client_id'];


      $sql = "SELECT * FROM client WHERE client_Id = $clientId";
      $result = $conn->query($sql);
      $result->setFetchMode(PDO::FETCH_ASSOC);


      if($result) {

        while($row = $result->fetch()) {

         $name = $row['name'];
         $phoneNo = $row['phoneNo'];
        }

      }


?>

            <form id ="submitForm"action="">
                        <label>Client Name</label> &nbsp;
                        <label style="left:105px;position: relative;"> Client Phone No.</label><br>
                            <input type="text" name="clientName" value="<?php echo $name; ?>" />
                                <input type="number" name="clientPhoneNo[]" value="<?php echo $phoneNo; ?>" style="left:10px;position: relative;"><br>

                            <div id="showItem">
                                <div class="addItem">
                                        <label>Item Name</label>
                                        <label style="left:121px;position: relative;" >Item Type</label> &nbsp;<br>
                                            <input type="text"  name="itemName[]" required>
                                            <select style="left:11px;position: relative;" name="itemType[]">
                                                <option >Raw Material</option>
                                                <option >Work In Progress</option>
                                                <option >Finished Goods</option>
                                                <option >MRO Goods</option>
                                                <option >Packaging Materials</option>
                                        </select><br>
                                        <label for="itemSize">Item Size</label>
                                        <label for="qty">Qty.</label><br>
                                        <select  name="itemSize[]" >
                                            <option value="Small">S</option>
                                            <option value="Medium">M</option>
                                            <option value="Large">L</option>
                                            <option value="X Large">XL</option>
                                            <option value="2XL">2XL</option>
                                            <option value="3XL">3XL</option>
                                        </select>
                                            <input type="number"  name="qty[]" required><br>
                                        <label for="declaredValue">Declared Value</label>
                                            <input type="number"  name="declaredValue[]" required> <br>
                                </div>
                            </div>
                            <div>
                            <label for="">Warehouse</label><br>
                            <select>

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
                        <label>Transaction Fee</label><input type="number" name="transacFee" required>
                                        <label>Transaction Date</label><input type="date" name="transacDate" required><br>

                        </form>