<!DOCTYPE html>
<html lang="en">
<?php include '../include/session.php' ?>
<?php include '../include/db-config.php' ?>
<?php
if (!isset($_SESSION['Admin_ID'])) {
    $_SESSION['Admin_Error'] = "You must login first!";
    header('Location: Sign-in.php');
}
//to get categories for books categories
$stmt = $conn->prepare('SELECT * FROM books_categories');
$stmt->execute();
$roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
//to get books  count
$stmt1 = $conn->prepare('SELECT COUNT(*) FROM books WHERE Book_satuts=0');
$stmt1->execute();
$booksCount = $stmt1->fetchColumn();
//to get books info
$stmt2 = $conn->prepare('SELECT * FROM books INNER JOIN users ON books.User_id = users.User_id INNER JOIN books_categories ON books.Book_catigory= books_categories.category_id WHERE Book_satuts=0 ORDER BY Post_date');
$stmt2->execute();
$booksRows = $stmt2->fetchAll(PDO::FETCH_ASSOC);
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
                    <h1 class="h3 mb-2 text-gray-800">Books</h1>
                    <?php
                    if (isset($_SESSION['BookMessage'])) {
                        echo '                    
                        <div class="UsersMessage">
                        ' . $_SESSION['BookMessage'] . '
                        </div>';
                        unset($_SESSION['BookMessage']);
                    } ?>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Books table (<?= $booksCount ?>)</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="UsersTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Book id</th>
                                            <th>Book Title</th>
                                            <th>Post Owner</th>
                                            <th>Comments Count</th>
                                            <th>Category</th>
                                            <th>Post Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($booksRows as $row) {

                                            //to get comments count per book
                                            $stmt4 = $conn->prepare('SELECT COUNT(*) FROM comments WHERE Book_id=' . $row['Book_id']);
                                            $stmt4->execute();
                                            $number_of_comments = $stmt4->fetchColumn();
                                            echo "<tr>
                                                <td>" . $row['Book_id'] . "</td>";
                                            echo "<td>" . $row['Book_title'] . "</td>";
                                            echo "<td>" . $row['User_Name'] . "</td>";
                                            echo "<td>" . $number_of_comments . "</td>";
                                            echo "<td>" . $row['category_title'] . "</td>";
                                            echo "<td>" . $row['Post_date'] . "</td>";
                                            echo '<td>
                                                 <a class="btn Book_btn btn-danger btn-sm DeleteBtn" data-id="' . $row['Book_id'] . '">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                                 </a>
                                                 <a class="btn Book_btn btn-info btn-sm InfoBtn" data-id="' . $row['Book_id'] . '">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-info"></i>
                                                </span>
                                                 </a>
                                                 <a class="btn Book_btn btn-success btn-sm EditBtn" data-id="' . $row['Book_id'] . '">
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

                        <input type="hidden" name="V_Book_id" id="V_Book_id" value="">

                        <div class="form-group">
                            <label> Author name </label>
                            <input type="text" name="V_Book_author_name" id="V_Book_author_name" class="form-control"
                                value="" readonly>
                        </div>
                        <div class="form-group">
                            <label> Publish date </label>
                            <input type="date" name="V_Book_publish_date" id="V_Book_publish_date" class="form-control"
                                value="" readonly>
                        </div>
                        <div class="form-group">
                            <label> Abstract </label>
                            <input type="date" name="V_Book_abstract" id="V_Book_abstract" class="form-control" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label> Book Quote </label>
                            <input type="text" name="V_Book_quote" id="V_Book_quote" class="form-control" value=""
                                readonly>
                        </div>
                        <div class="form-group">
                            <label> Book rate </label>
                            <input type="text" name="V_Book_rate" id="V_Book_rate" class="form-control" value=""
                                readonly>
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
                    <h5 class="modal-title" id="exampleModalLabel"> Edit Book Info </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="include/UpdateBookInfo.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="Book_id" id="Book_id" value="">

                        <div class="form-group">
                            <label> Book title </label>
                            <input type="text" name="Book_title" id="Book_title" class="form-control" value="" required>
                        </div>

                        <div class="form-group">
                            <label> Book author name </label>
                            <input type="text" name="Book_author_name" id="Book_author_name" class="form-control"
                                value="" required>
                        </div>

                        <div class="form-group">
                            <label> Book publish date </label>
                            <input type="date" name="Book_publish_date" id="Book_publish_date" class="form-control"
                                value="" required>
                        </div>

                        <div class="form-group">
                            <label for="Book_catigory">Books categories :</label>
                            <select name="Book_catigory" id="Book_catigory" class="form-control">
                                <?php foreach ($roles as $role) {

                                    echo ' <option value=' . $role['category_id']  . '>' . $role["category_title"] . '</option> ';
                                } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label> Abstract </label>
                            <input type="text" name="Book_abstract" id="Book_abstract" class="form-control" value=""
                                required>
                        </div>
                        <div class="form-group">
                            <label> Book quote </label>
                            <input type="text" name="Book_quote" id="Book_quote" class="form-control" value="" required>
                        </div>
                        <div class="form-group">
                            <label> Book rate </label>
                            <input type="range" value="" min="1" max="10" class="slider" name="Book_rate" id="Book_rate"
                                oninput="this.nextElementSibling.value = this.value + '/10'">
                            <output id="BRate"></output>

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

                <form action="include/DeleteBooks.php" method="POST">

                    <div class="modal-body">

                        <input type="hidden" name="D_Book_id" id="D_Book_id" value="">

                        <div class="form-group">
                            <label> Are you sure you want to delete this user ? </label>

                        </div>
                        <div class="form-group">
                            <label> Book Title </label>
                            <input type="text" name="D_Book_title" id="D_Book_title" class="form-control" value=""
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
                url: "include/GetbookInfo.php?id=" + id,
                type: 'GET',
                dataType: 'json',
                context: this,
                success: function(values) {
                    $('#V_Book_id').val(values.Book_id);
                    $('#V_Book_author_name').val(values.Book_author_name);
                    $('#V_Book_publish_date').val(values.Book_publish_date);
                    $('#V_Book_abstract').val(values.Book_abstract);
                    $('#V_Book_quote').val(values.Book_quote);
                    $('#V_Book_rate').val(values.Book_rate);

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
                url: "include/GetbookInfo.php?id=" + id,
                type: 'GET',
                dataType: 'json',
                context: this,
                success: function(values) {
                    $('#Book_id').val(values.Book_id);
                    $('#Book_title').val(values.Book_title);
                    $('#Book_author_name').val(values.Book_author_name);
                    $('#Book_publish_date').val(values.Book_publish_date);
                    $('#Book_catigory').val(values.Book_catigory);
                    $('#Book_abstract').val(values.Book_abstract);
                    $('#Book_quote').val(values.Book_quote);
                    $('#Book_rate').val(values.Book_rate);
                    $('#BRate').html(values.Book_rate + '/10');

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
                url: "include/GetbookInfo.php?id=" + id,
                type: 'GET',
                dataType: 'json',
                context: this,
                success: function(values) {
                    $('#D_Book_id').val(values.Book_id);
                    $('#D_Book_title').val(values.Book_title);




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