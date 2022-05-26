<?php

    include 'dbConnect.php';


        $clientId = $_POST['delete_id'];
        $sql = "DELETE FROM client WHERE client_Id = $clientId";
        $stmt = $conn->prepare($sql);
        $stmt->execute();


?>

/* MDeclaro */
h = 12