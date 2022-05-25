<?php require 'dbConnect.php' ?>

<table class="table" id="table">
                    <head>
                        <tr>
                            <th>Transaction No.:</th>
                            <th>Item ID:</th>
                            <th>Package ID:</th>
                        </tr>
                    </head>

                <tbody>

                    <?php
                        $sql = "SELECT * FROM `transaction`";
                        $result = $conn->query($sql);

                            while($row = $result->fetch(PDO::FETCH_ASSOC)) :?>
                                <tr>
                                <td><?php echo $row['transac_No'] ?></td>
                                <td><?php echo $row['item_Id'] ?></td>
                                <td><?php echo $row['pkg_Id'] ?></td>
                            </tr>

                    <?php endwhile;  ?>

                </tbody>
            </table>
