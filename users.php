<!DOCTYPE html>
<html lang="en">
<?php include '../include/session.php' ?>
<?php include '../include/db-config.php' ?>
<?php
if (!isset($_SESSION['Admin_ID'])) {
    $_SESSION['Admin_Error'] = "You must login first!";
    header('Location: Sign-in.php');
}

//to get users  count
$stmt1 = $conn->prepare('SELECT COUNT(*) FROM users WHERE User_status=0 ');
$stmt1->execute();
$usersCount = $stmt1->fetchColumn();
//to get users info
$stmt2 = $conn->prepare('SELECT * FROM users WHERE User_status=0');
$stmt2->execute();

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
<style>
.UsersMessage {
    font-size: 20px;
    font-weight: bold;
    margin-top: 10px;
    margin-bottom: 10px;
    padding: 5px;
    color: #EDEDED;
    border: 1px solid #329810;
    background-color: #63DC3A;
}
</style>

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

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Users</h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Users table (<?= $usersCount ?>)</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="UsersTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>User id</th>
                                            <th>User Name</th>
                                            <th>Full Name</th>
                                            <th>Books Count</th>
                                            <th>Comments Count</th>
                                            <th>Joind On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($stmt2 as $row) {
                                            //to get books count perr user
                                            $stmt3 = $conn->prepare('SELECT COUNT(*) FROM books WHERE User_id=' . $row['User_id']);
                                            $stmt3->execute();
                                            $number_of_books = $stmt3->fetchColumn();
                                            //to get books count perr user
                                            $stmt4 = $conn->prepare('SELECT COUNT(*) FROM comments WHERE User_id=' . $row['User_id']);
                                            $stmt4->execute();
                                            $number_of_comments = $stmt4->fetchColumn();
                                            echo "<tr>
                                                <td>" . $row['User_id'] . "</td>";
                                            echo "<td>" . $row['User_Name'] . "</td>";
                                            echo "<td>" . $row['User_FirstName'] . ' ' . $row['User_LastName'] . "</td>";
                                            echo "<td>" . $number_of_books . "</td>";
                                            echo "<td>" . $number_of_comments . "</td>";

                                            echo "<td>" . $row['User_Joind_On'] . "</td>";
                                            echo '<td>
                                                 
                                                 <a class="btn btn-danger btn-sm DeleteBtn" data-id="' . $row['User_id'] . '">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                 </a>
                                                 <a class="btn btn-info btn-sm InfoBtn" data-id="' . $row['User_id'] . '">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info"></i>
                                                </span>
                                                 </a>
                                                 <a class="btn btn-success btn-sm EditBtn" data-id="' . $row['User_id'] . '">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                 </a>
                                                </td>
                                                </tr>';
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
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
    <!-- Modal-->

    <!--Other Info modal -->
    <div class="modal fade" id="infomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Other user info </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="../include/UpdateUserInfo.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="V_User_id" id="V_User_id" value="">

                        <div class="form-group">
                            <label> Country </label>
                            <input type="text" name="V_User_Country" id="V_User_Country" class="form-control" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label> Gender </label>
                            <input type="text" name="V_User_Gender" id="V_User_Gender" class="form-control" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label> Date Birth </label>
                            <input type="date" name="V_User_DateBirth" id="V_User_DateBirth" class="form-control"
                                value="" readonly>
                        </div>
                        <div class="form-group">
                            <label> Phone Number </label>
                            <input type="text" name="V_User_PhoneNumber" id="V_User_PhoneNumber" class="form-control"
                                value="" readonly>
                        </div>
                        <div class="form-group">
                            <label> Email </label>
                            <input type="text" name="V_User_EmailAdress" id="V_User_EmailAdress" class="form-control"
                                value="" readonly>
                        </div>
                        <div class="form-group">
                            <label> Quotation </label>
                            <input type="text" name="V_User_Quotation" id="V_User_Quotation" class="form-control"
                                value="" readonly>
                        </div>
                        <div class="form-group">
                            <label> Favorite Book </label>
                            <input type="text" name="V_User_Fav_Book" id="V_User_Fav_Book" class="form-control" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label> Favorite Author </label>
                            <input type="text" name="V_User_Fav_Author" id="V_User_Fav_Author" class="form-control"
                                value="" readonly>
                        </div>
                        <div class="form-group">
                            <label> Bio </label>
                            <input type="text" name="V_User_Bio" id="V_User_Bio" class="form-control" value="" readonly>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- EDIT Info modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit User Info </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="include/UpdateUserInfo.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="User_id" id="User_id" value="">

                        <div class="form-group">
                            <label> User Name </label>
                            <input type="text" name="User_Name" id="User_Name" class="form-control" value="" required>
                        </div>

                        <div class="form-group">
                            <label> First Name </label>
                            <input type="text" name="User_FirstName" id="User_FirstName" class="form-control" value=""
                                required>
                        </div>

                        <div class="form-group">
                            <label> Last Name </label>
                            <input type="text" name="User_LastName" id="User_LastName" class="form-control" value=""
                                required>
                        </div>

                        <div class="form-group">
                            <label> Country </label>
                            <input type="text" name="User_Country" id="User_Country" class="form-control" value=""
                                required>
                        </div>


                        <div class="form-group row" style="margin-left: 5px;">
                            <label> Gender </label>

                            <div class="form-check col-3">
                                <label class="form-check-label" style="margin-left: 15px;">
                                    <input type="radio" class="form-check-input" name="User_Gender" value="Male">Male
                                </label>
                            </div>
                            <div class="form-check col-3">
                                <label class="form-check-label" style="margin-left: 5px;">
                                    <input type="radio" class="form-check-input" name="User_Gender"
                                        value="Female">Female
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label> Date Birth </label>
                            <input type="date" name="User_DateBirth" id="User_DateBirth" class="form-control" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label> Phone Number </label>
                            <input type="number" name="User_PhoneNumber" id="User_PhoneNumber" class="form-control"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label> Email </label>
                            <input type="email" name="User_EmailAdress" id="User_EmailAdress" class="form-control"
                                value="" required>
                        </div>
                        <div class="form-group">
                            <label> Quotation </label>
                            <input type="text" name="User_Quotation" id="User_Quotation" class="form-control" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label> Favorite Book </label>
                            <input type="text" name="User_Fav_Book" id="User_Fav_Book" class="form-control" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label> Favorite Author </label>
                            <input type="text" name="User_Fav_Author" id="User_Fav_Author" class="form-control" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label> Bio </label>
                            <input type="text" name="User_Bio" id="User_Bio" class="form-control" value="" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="submit" class="btn btn-success">Update
                            info</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Delete modal -->
    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Delete User </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="include/DeleteUser.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="D_User_id" id="D_User_id" value="">

                        <div class="form-group">
                            <label> Are you sure you want to delete this user ? </label>

                        </div>
                        <div class="form-group">
                            <label> User Name </label>
                            <input type="text" name="D_User_Name" id="D_User_Name" class="form-control" value=""
                                readonly>
                        </div>



                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" name="submit" value="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- Modal-->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
    <script>
    $(document).ready(function() {
        $('#UsersTable').DataTable();
        $('.InfoBtn').on('click', function() {
            $tr = $(this).closest('tr');
            var id = $(this).data('id');
            $.ajax({
                url: "include/GetUserInfo.php?id=" + id,
                type: 'GET',
                dataType: 'json',
                context: this,
                success: function(values) {
                    $('#V_User_id').val(values.User_id);
                    $('#V_User_Country').val(values.User_Country);
                    $('#V_User_Gender').val(values.User_Gender);
                    $('#V_User_DateBirth').val(values.User_DateBirth);
                    $('#V_User_PhoneNumber').val(values.User_PhoneNumber);
                    $('#V_User_EmailAdress').val(values.User_EmailAdress);
                    $('#V_User_Bio').val(values.User_Bio);
                    $('#V_User_Quotation').val(values.User_Quotation);
                    $('#V_User_Fav_Book').val(values.User_Fav_Book);
                    $('#V_User_Fav_Author').val(values.User_Fav_Author);
                    $('#infomodal').modal('show');
                }
            });
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
        });
        $('.EditBtn').on('click', function() {
            $tr = $(this).closest('tr');
            var id = $(this).data('id');
            $.ajax({
                url: "include/GetUserInfo.php?id=" + id,
                type: 'GET',
                dataType: 'json',
                context: this,
                success: function(values) {
                    $('#User_id').val(values.User_id);
                    $('#User_Name').val(values.User_Name);
                    $('#User_FirstName').val(values.User_FirstName);
                    $('#User_LastName').val(values.User_LastName);
                    $('#User_Country').val(values.User_Country);
                    $('input[name="User_Gender"][value="' + values.User_Gender + '"]').prop(
                        'checked', true);
                    $('#User_DateBirth').val(values.User_DateBirth);
                    $('#User_PhoneNumber').val(values.User_PhoneNumber);
                    $('#User_EmailAdress').val(values.User_EmailAdress);
                    $('#User_Bio').val(values.User_Bio);
                    $('#User_Quotation').val(values.User_Quotation);
                    $('#User_Fav_Book').val(values.User_Fav_Book);
                    $('#User_Fav_Author').val(values.User_Fav_Author);



                    $('#editmodal').modal('show');

                }
            });
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
        });
        $('.DeleteBtn').on('click', function() {
            $tr = $(this).closest('tr');
            var id = $(this).data('id');
            $.ajax({
                url: "include/GetUserInfo.php?id=" + id,
                type: 'GET',
                dataType: 'json',
                context: this,
                success: function(values) {
                    $('#D_User_id').val(values.User_id);
                    $('#D_User_Name').val(values.User_Name);




                    $('#deletemodal').modal('show');

                }
            });
            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            console.log(data);
        });
    });
    </script>
</body>

</html>