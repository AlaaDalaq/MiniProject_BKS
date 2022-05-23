<!DOCTYPE html>
<html lang="en">
<?php include '../include/session.php' ?>
<?php include '../include/db-config.php' ?>
<?php
if (!isset($_SESSION['Admin_ID'])) {
    $_SESSION['Admin_Error'] = "You must login first!";
    header('Location: Sign-in.php');
}

//to get contacts  count
$stmt = $conn->prepare('SELECT COUNT(*) FROM contact_us');
$stmt->execute();
$contactsCount = $stmt->fetchColumn();
//to get contact info
$stmt2 = $conn->prepare('SELECT * FROM contact_us');
$stmt2->execute();
$contactsRows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
?>

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

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <!-- End of Sidebar -->
        <?php include 'include/SideBar.php'; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'include/Header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800"> Contacts (<?= $contactsCount ?>) </h1>


                    <!-- Content Row -->


                    <?php
                    foreach ($contactsRows as $row) {
                        echo '
                        
                        <div class="row">
                        <div class="col-lg-12">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">ID : (' . $row['id'] . ') - Subject : ' . $row['Message_subject'] . '</h6>
                                </div>
                                <div class="card-body">
                                ' . $row['Message'] . '
                                </div>
                                <div class="card-footer">
                                Sned date  : ' . $row['Send_date'] . ' || 
                                Sneder name : ' . $row['Sender_Name'] . ' || 
                                Sneder email : ' . $row['Sender_Email'] . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                        
                        ';
                    }
                    ?>

                    <!-- /.container-fluid -->

                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                <?php include 'include/Footer.php'; ?>
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Bootstrap core JavaScript-->
        <script src="vendor/jquery/jquery.min.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/chart.js/Chart.min.js"></script>

        <!-- Page level custom scripts -->
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</body>

</html>