<!DOCTYPE html>
<html lang="en">
<?php include '../include/session.php' ?>
<?php include '../include/db-config.php' ?>
<?php
if (!isset($_SESSION['Admin_ID'])) {
    $_SESSION['Admin_Error'] = "You must login first!";
    header('Location: Sign-in.php');
}
//to get books  count
$stmt = $conn->prepare('SELECT COUNT(*) FROM books WHERE Book_satuts=0');
$stmt->execute();
$booksCount = $stmt->fetchColumn();
//to get ctegories  count
$stmt1 = $conn->prepare('SELECT COUNT(*) FROM books_categories WHERE category_status=0 ');
$stmt1->execute();
$categoriesCount = $stmt1->fetchColumn();
//to get comments  count
$stmt2 = $conn->prepare('SELECT COUNT(*) FROM comments WHERE Comment_satuts =0 ');
$stmt2->execute();
$commentsCount = $stmt2->fetchColumn();
//to get users  count
$stmt3 = $conn->prepare('SELECT COUNT(*) FROM users WHERE User_status=0');
$stmt3->execute();
$usersCount = $stmt3->fetchColumn();
//to get pie chart1 value books count per Category
$stmt4 = $conn->prepare('SELECT books.Book_catigory,  count(*) as number, books_categories.category_title FROM books INNER JOIN books_categories ON books.Book_catigory=books_categories.category_id WHERE books.Book_satuts=0 GROUP BY books.Book_catigory');
$stmt4->execute();
//to get pie chart2 value books count per user
$stmt5 = $conn->prepare('SELECT books.User_id,  count(*) as number, users.User_Name, users.User_FirstName, users.User_LastName FROM books INNER JOIN users ON books.User_id=users.User_id WHERE books.Book_satuts=0 GROUP BY books.User_id');
$stmt5->execute();
$color = ['#dc7877', '#9cbb73', '#9ee2d9', '#9f9ee2', '#e29eba', '#e2e19e', '#e2c49e'];


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



                    <!-- Content Row -->
                    <div class="row">

                        <!-- Books count -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Added books count</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $booksCount ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Categories count -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Categories count</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $categoriesCount ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- comments count -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Comments count
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?= $commentsCount ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- users count -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                User accounts count</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $usersCount ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-users fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Pie Chart1 -->
                        <div class="col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Books per categories</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <span id="Books_categories">
                                    </span>

                                </div>
                            </div>
                        </div>
                        <!-- Pie Chart2 -->
                        <div class="col-xl-6 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Books per users</h6>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">

                                    <span id="Books_Users">
                                    </span>

                                </div>
                            </div>
                        </div>


                        <!-- Content Row -->
                        <div class="row">




                        </div>

                    </div>
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

        <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            //Books per category
            var data = google.visualization.arrayToDataTable([
                ['category_title', 'number'],
                <?php
                    $i = 0;
                    foreach ($stmt4 as $row) {
                        echo "['" . $row["category_title"] . "', " . $row['number'] . "],";
                        $i++;
                    }
                    ?>
            ]);
            var options = {

                is3D: true,
                //label style
                chartArea: {
                    left: 0,
                    height: 250,
                    width: 600
                },
                legend: {
                    maxLines: 1,
                    textStyle: {
                        color: '#428bca',
                        fontSize: 16
                    }
                },
                colors: [
                    <?php

                        for ($x = 0; $x < $i; $x++) {
                            echo "'" . $color[$x] . "',";
                        }
                        ?>
                ],
                titleTextStyle: {
                    color: '#428bca', // any HTML string color ('red', '#cc00cc')
                    fontSize: 13, // 12, 18 whatever you want (don't specify px)
                    bold: true, // true or false
                    italic: false // true of false
                }

            };
            var chart = new google.visualization.PieChart(document.getElementById('Books_categories'));
            chart.draw(data, options);
            //Books per use
            var data = google.visualization.arrayToDataTable([
                ['User_Name', 'number'],
                <?php
                    $i = 0;
                    foreach ($stmt5 as $row2) {
                        echo "['" . $row2["User_Name"] . "(" . $row2["User_FirstName"] . " " . $row2["User_LastName"] . ")" . "', " . $row2['number'] . "],";
                        $i++;
                    }
                    ?>
            ]);
            var options = {
                is3D: true,
                //label style
                chartArea: {
                    left: 0,
                    height: 250,
                    width: 800
                },
                legend: {
                    maxLines: 1,
                    textStyle: {
                        color: '#428bca',
                        fontSize: 16
                    }
                },
                colors: [
                    <?php

                        for ($x = 0; $x < $i; $x++) {
                            echo "'" . $color[$x] . "',";
                        }
                        ?>
                ],
                titleTextStyle: {
                    color: '#428bca', // any HTML string color ('red', '#cc00cc')
                    fontSize: 13, // 12, 18 whatever you want (don't specify px)
                    bold: true, // true or false
                    italic: false // true of false
                }
            };
            var chart = new google.visualization.PieChart(document.getElementById('Books_Users'));
            chart.draw(data, options);

        }
        </script>
</body>

</html>