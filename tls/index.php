<?php
    include 'dbConnect.php';

    session_start();


?>

<!DOCTYPE html>
<html>
    <head>
        <title>TLS</title>
        <link rel="stylesheet" type="text/css" href="login.css?v=<?php echo time(); ?>" >
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" >
    </head>

    <body>
        <h1 class="text-center">Trucker Logger System</h1>
        <article class="col-sm-4 container grid ">
            <form id="submit" action="submit.php" method="POST">
                <h2 class="text-center">Employee Login</h2>
                <div class="d-grid gap-2 col-7 mx-auto">
                <?php
                        if (isset($_GET['error'])) {?>
                            <p class="error"> <?php echo $_GET['error']; ?> </p>
                    <?php
                        }
                    ?>
                    <input type="text" name="id" placeholder="Employee Id"  >
                    <br>
                    <input type="text" name="pwd"  placeholder="Password">
                </div>

                <div class="d-grid gap-2 col-7 mx-auto"><br>
                    <button type="submit" id="confirm" name="submit" class="btn btn-outline-primary">Confirm</button>
                </div>


            </form>


        </article>


    </body>
</html>
