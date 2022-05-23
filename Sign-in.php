<!doctype html>
<html lang="en">
<?php include 'include/session.php' ?>
<?php $_SESSION['Rout'] = "Sign-in"; ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Book Store Bootstrap template">
    <meta name="author" content="Andrija Mićić">
    <link rel="icon" href="img/logo.ico">
    <title>Book Keeping System</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="css/cover.css" rel="stylesheet">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/Sign-in.css">
</head>
<style>
.message {
    color: red;
}
</style>

<body>
    <div id="coverOthers">

        <div class="d-flex pt-3 mx-auto flex-column">
            <?php include 'include/header.php'; ?>
            <div class="full-height">
                <div class="d-flex justify-content-center">
                    <div class="card">
                        <div class="card-header">
                            <h3>Sign In</h3>
                        </div>
                        <div class="card-body">
                            <form action="include/Sign-in.php" method="POST">
                                <?php
                                if (isset($_SESSION['Error'])) {
                                    echo '
                                    <div class="input-group form-group">
                                        <label class="form-control message" id="message" name="message"> ' . $_SESSION['Error'] . ' </label>
                                    </div>
                                ';
                                }
                                unset($_SESSION['Error']);
                                ?>

                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="User Name" id="User_Name"
                                        name="User_Name">
                                </div>

                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="User Password"
                                        id="User_Password" name="User_Password">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="submit" name="submit" class="btn float-right login_btn">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">
                                Don't have an account?<a href="Sign-up.php">Sign Up</a>
                            </div>
                            <div class="d-flex justify-content-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <?php include 'include/footer.php'; ?>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>