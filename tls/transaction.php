<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.css">


<?php require 'dbConnect.php' ?>

<table id="dtBasicExample" class="table" width="100%">
                    <head>
                        <tr>
                            <th class="th-sm">Transaction No.:</th>
                            <th class="th-sm">Item ID:</th>
                            <th class="th-sm">Package ID:</th>
                        </tr>
                    </head>
                    <script src="https://unpkg.com/bootstrap-table@1.20.2/dist/bootstrap-table.min.js"></script>
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
