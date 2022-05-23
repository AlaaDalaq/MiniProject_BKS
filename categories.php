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
$stmt1 = $conn->prepare('SELECT COUNT(*) FROM books_categories WHERE category_status=0 ');
$stmt1->execute();
$categoriesCount = $stmt1->fetchColumn();
//to get users info
$stmt2 = $conn->prepare('SELECT * FROM books_categories WHERE category_status=0');
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
        href="https://fonts.googleapis.com/css?family=Nunito:200,2000i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
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
    <div id="wrer">

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
                    <h1 class="h3 mb-2 text-gray-800">Categories</h1>
                    <?php
                    if (isset($_SESSION['CategMessage'])) {
                        echo '                    
                        <div class="UsersMessage">
                        ' . $_SESSION['CategMessage'] . '
                        </div>';
                        unset($_SESSION['CategMessage']);
                    } ?>


                    <!-- DataTales -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m0 font-weight-bold text-primary">categories table (<?= $categoriesCount ?>)
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="CategoriesTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Category id</th>
                                            <th>Category Name</th>
                                            <th>Books Count</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($stmt2 as $row) {
                                            //to get books count perr user
                                            $stmt3 = $conn->prepare('SELECT COUNT(*) FROM books WHERE Book_catigory=' . $row['category_id']);
                                            $stmt3->execute();
                                            $number_of_books = $stmt3->fetchColumn();
                                            echo "<tr><td>" . $row['category_id'] . "</td>";
                                            echo "<td>" . $row['category_title'] . "</td>";
                                            echo "<td>" . $number_of_books . "</td>";

                                            echo '<td>
                                                 
                                                 <a class="btn btn-danger btn-sm DeleteBtn" data-id="' . $row['category_id'] . '">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                 </a>

                                                 <a class="btn btn-success btn-sm EditBtn" data-id="' . $row['category_id'] . '">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-edit"></i>
                                                </span>
                                                 </a>
                                                </td></tr>';
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



    <!-- EDIT Info modal -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit category </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="include/UpdateCategoryName.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="category_id" id="category_id" value="">

                        <div class="form-group">
                            <label> Category Title </label>
                            <input type="text" name="category_title" id="category_title" class="form-control" value=""
                                required>
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

                <form action="include/DeleteCategory.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="D_category_id" id="D_category_id" value="">

                        <div class="form-group">
                            <label> Are you sure you want to delete this category ? </label>

                        </div>
                        <div class="form-group">
                            <label> Category Title </label>
                            <input type="text" name="D_category_title" id="D_category_title" class="form-control"
                                value="" readonly>
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
        $('#CategoriesTable').DataTable();

        $('.EditBtn').on('click', function() { // I made changes here
            $tr = $(this).closest('tr');
            var id = $(this).data('id');
            $.ajax({
                url: "include/GetCategoryInfo.php?id=" + id,
                type: 'GET',
                dataType: 'json',
                context: this,
                success: function(values) {
                    $('#category_id').val(values.category_id);
                    $('#category_title').val(values.category_title);
                    $('#editmodal').modal('show');

                }
            });
            var data = $tr.children("td").map(function() { // I made changes here
                return $(this).text();
            }).get();

            console.log(data);
        });
        $('.DeleteBtn').on('click', function() {
            $tr = $(this).closest('tr');
            var id = $(this).data('id');
            $.ajax({
                url: "include/GetCategoryInfo.php?id=" + id,
                type: 'GET',
                dataType: 'json',
                context: this,
                success: function(values) {
                    $('#D_category_id').val(values.category_id);
                    $('#D_category_title').val(values.category_title);

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
