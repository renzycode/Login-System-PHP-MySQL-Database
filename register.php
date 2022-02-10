<?php
    require_once("config.php");

    if(isset($_POST['submit'])){
        if(!isset($conn)){
            //error connecting from database
            echo "<script> window.location.href = 'register.php?error=connection' </script>";
        }else if($_POST['password']!=$_POST['confirmpassword']){
            echo "<script> window.location.href = 'register.php?error=password' </script>";
        }else{
            try{
                $fname = $_POST['fname'];
                $lname = $_POST['lname'];
                $email = $_POST['email'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

                $sql = "SELECT * FROM users WHERE EMAIL = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $email);
                $stmt->execute();
                $email_exist = $stmt->fetch();

                if(isset($email_exist['EMAIL'])){
                    echo "<script> window.location.href = 'register.php?error=email' </script>";
                }

                $sql = "INSERT INTO users (FNAME,LNAME,EMAIL,PASS) VALUES (?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(1, $fname);
                $stmt->bindParam(2, $lname);
                $stmt->bindParam(3, $email);
                $stmt->bindParam(4, $password);
                $stmt->execute();

                echo "<script> window.location.href = 'register.php?register=success' </script>";

            }catch(Exeption $e){
                echo "<script> window.location.href = 'register.php?error=tryagain' </script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Register</title>
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
    <form action="register.php" method="POST">
        <div>
            <div class="container" style="max-width: 900px;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="right-content border border-4 border-dark rounded m-4 p-4">
                            <div class="container form-span">
                                <span>
                                    <h1>Register</h1>
                                </span>
                                <div class="row">
                                    
                                    <?php
                                        if(isset($_GET['error'])){
                                            if($_GET['error']=='connection'){
                                                echo '
                                                <div class="col-md-12 text-center rounded">
                                                    <h6 class="bold text-white bg-danger p-2">Database Error</h6>
                                                </div>';
                                            }else if($_GET['error']=='password'){
                                                echo '
                                                <div class="col-md-12 text-center rounded">
                                                    <h6 class="bold text-white bg-danger p-2">Password Didn\'t Match</h6>
                                                </div>';
                                            }else if($_GET['error']=='email'){
                                                echo '
                                                <div class="col-md-12 text-center rounded">
                                                    <h6 class="bold text-white bg-danger p-2">Email Already Exist</h6>
                                                </div>';
                                            }else{
                                                echo '
                                                <div class="col-md-12 text-center rounded">
                                                    <h6 class="bold text-white bg-danger p-2">Error, Try Again Later</h6>
                                                </div>';
                                            }
                                        }

                                        if(isset($_GET['register'])){
                                            if($_GET['register']=='success'){
                                                echo '
                                                <div class="col-md-12 text-center rounded">
                                                    <h6 class="bold text-white bg-success p-2">Registered Successfully</h6>
                                                </div>';
                                            }
                                        }

                                    ?>

                                    <div class="col-md-12 mb-2">
                                        <fieldset>
                                            <h6>First Name: <span class="text-danger">*</span></h6>
                                            <input name="fname" type="text" class="form-control"
                                                placeholder="Enter your first name" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <fieldset>
                                            <h6>Last Name: <span class="text-danger">*</span></h6>
                                            <input name="lname" type="text" class="form-control"
                                                placeholder="Enter your last name" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <fieldset>
                                            <h6>Email: <span class="text-danger">*</span></h6>
                                            <input name="email" type="text" class="form-control"
                                                placeholder="Enter your email" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <fieldset>
                                            <h6>Password: <span class="text-danger">*</span></h6>
                                            <input name="password" type="password" class="form-control"
                                                placeholder="Enter your password" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <fieldset>
                                            <h6>Confirm Password: <span class="text-danger">*</span></h6>
                                            <input name="confirmpassword" type="password" class="form-control"
                                                placeholder="Reenter your password" required>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12 ">
                                        <fieldset>
                                            <h6>Already have an account? <a href="login.php">Login</a></h6>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12 mt-2">
                                        <fieldset>
                                            <button class="button bg-primary rounded border-primary text-white px-4 p-1"
                                                name="submit" type="submit" id="form-submit">Register</button>
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