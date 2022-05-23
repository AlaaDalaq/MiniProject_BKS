<!DOCTYPE html>
<html lang="en">
<?php include '../include/session.php' ?>
<?php include '../include/db-config.php' ?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin panel</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>
<style>
.Message {
    text-align: center;
    font-size: 18;
    font-weight: bold;
    border: 1px solid #b30000;
    color: #fff;
    background-color: #ff4d4d;
    margin-top: 5px;
    margin-bottom: 5px;
    padding: 5px;
    border-radius: 30px;
}
</style>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">BKS Admin panel</h1>
                                    </div>
                                    <form class="user" action="include/Admin-sign-in.php" method="POST">
                                        <?php
                                        if (isset($_SESSION['Admin_Error'])) {
                                            echo '<div class="Message">' . $_SESSION['Admin_Error'] . '</div>';
                                            unset($_SESSION['Admin_Error']);
                                        }
                                        ?>
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user"
                                                name="Admin_U_Name" id="Admin_U_Name" aria-describedby="Admin_U_Name"
                                                placeholder="Enter User Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                id="Admin_Password" name="Admin_Password" placeholder="Password">
                                        </div>
                                        <button type="submit" value="submit" name="submit"
                                            class="btn btn-primary btn-user btn-block">
                                            Login
                                        </button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
