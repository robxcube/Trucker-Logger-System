<?php
require 'dbConnect.php';
include 'index.php';


    foreach($_POST['clientName'] as $key => $value){
        $sql = "INSERT INTO client (name, phoneNo) VALUES (:name,:phoneNo)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'name'=> $value,
            'phoneNo'=> $_POST['clientPhoneNo'][$key]
        ]);
    }

    foreach($_POST['itemName'] as $key => $value){
        $sql = 'INSERT INTO item (item_Name, item_Type, item_Size,quantity, declared_Value) VALUES (:item_Name, :item_Type, :item_Size,:qty, :declared_Value)';
        $stmt = $conn->prepare($sql);
        $stmt->execute([
        'item_Name' => $value,
        'item_Type' => $_POST['itemType'][$key],
        'item_Size' => $_POST['itemSize'][$key],
        'qty' => $_POST['qty'][$key],
        'declared_Value' => $_POST['declaredValue'][$key]
        ]);
    }



        getPkg($conn);
        getId($conn);


    function getPkg ($conn) {
                $sql = "SELECT client_Id FROM `client` ORDER BY `client_Id` DESC LIMIT 1";
                $q = $conn->query($sql);
                $q->setFetchMode(PDO::FETCH_ASSOC);
                $id = $q->fetch();

                $transacFee = $_POST['transacFee'];
                $transacDate = $_POST['transacDate'];
                $selection = $_POST['employee'];
                $warehouse = $_POST['warehouse'];

                $sql1 = "INSERT INTO `package` (pkg_Id,emp_Id,warehouse_Id,client_Id,transaction_Fee,transaction_Date) VALUES (NULL,1,1,$id[client_Id],$transacFee,'$transacDate')";
                $stmt1 = $conn->prepare($sql1);
                $stmt1->execute();


    }

    function getId($conn) {
            $sql = "SELECT item_Id FROM `item` ORDER BY `item_Id` DESC LIMIT 1";
            $q = $conn->query($sql);
            $q->setFetchMode(PDO::FETCH_ASSOC);
            $id = $q->fetch();

            $sql1 = "SELECT pkg_Id FROM `package` ORDER BY `pkg_Id` DESC LIMIT 1";
            $q1 = $conn->query($sql1);
            $q1->setFetchMode(PDO::FETCH_ASSOC);
            $id1 = $q1->fetch();

            $sql = "INSERT INTO `transaction` (`transac_No`, `item_Id`, `pkg_Id`) VALUES (NULL, $id[item_Id], $id1[pkg_Id])";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
        }


?>
