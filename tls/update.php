<?php
    include 'dbConnect.php';


    $clientId = $_POST['client_Id'];
    $pkgId = $_POST['pkg_Id'];
    $itemId = $_POST['item_Id'];
    $clientName = $_POST['clientName'];
    $clientPhoneNo = $_POST['clientPhoneNo'];
    $itemName = $_POST['itemName'];
    $itemType = $_POST['itemType'];
    $itemSize = $_POST['itemSize'];
    $qty = $_POST['qty'];
    $declaredValue = $_POST['declaredValue'];
    $warehouse = $_POST['warehouse'];
    $transacFee = $_POST['transacFee'];
    $transacDate = $_POST['transacDate'];



        $sql ="UPDATE client SET name= '$clientName',phoneNo='$clientPhoneNo' WHERE client_Id = '$clientId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql ="UPDATE item SET item_Name= '$itemName',item_Type='$itemType', item_Size='$itemSize', quantity='$qty', declared_Value = '$declaredValue' WHERE item_Id = '$itemId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

        $sql ="UPDATE package SET warehouse_Id = '$warehouse', transaction_Fee = '$transacFee', transaction_Date = '$transacDate' WHERE pkg_Id = '$pkgId'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();





?>