<?php
    session_start();

    if(!isset( $_SESSION['fname']) || !isset($_SESSION['lname']) || !isset($_SESSION['EMAIL']) ){
        echo "<script> window.location.href = 'login.php' </script>";
    }
    
    if(isset($_POST['logout'])){
        session_destroy();
        echo "<script> window.location.href = 'login.php' </script>";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
</head>

<body>
    <form action="index.php" method="POST">
        <div>
            <div class="container" style="max-width: 900px;">
                <div class="row">
                    <div class="col-md-12">
                        <div class="right-content border border-4 border-dark rounded m-4 p-4">
                            <div class="container form-span">
                                <span>
                                    <h1>Welcome <?php echo $_SESSION['fname'].' '.$_SESSION['lname']; ?></h1>
                                </span>
                                <div class="row">

                                    <div class="col-md-12 text-center rounded mt-4 mb-4">
                                        <h6 class="bold text-white bg-primary p-2">Thank you for making an acount in our web system, Enjoy your day.</h6>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <fieldset>
                                            <button class="button bg-primary rounded border-primary text-white px-4 p-1"
                                                name="logout" type="submit" id="form-submit">Logout</button>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>