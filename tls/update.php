<?php
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
?>