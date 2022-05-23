<!doctype html>
<html lang="en">
<?php include 'include/session.php' ?>
<?php include 'include/db-config.php' ?>
<?php $_SESSION['Rout'] = "Main";
$stmt = $conn->prepare('SELECT Book_title,Book_id,Book_photo,Book_rate FROM books order by Book_rate	DESC LIMIT 5 ');
$stmt->execute();
$booksRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt1 = $conn->prepare('SELECT Book_title,Book_id,Book_photo,Post_date FROM books order by Post_date	DESC LIMIT 5 ');
$stmt1->execute();
$booksRows2 = $stmt1->fetchAll(PDO::FETCH_ASSOC);

?>

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
</head>
<style>
label {
    color: white !important;
    margin-left: 15px;
    font-size: 16px !important;
    font-weight: bold !important;
    background-color: rgba(89, 255, 125, 0.8) !important;
    border: 0.5px solid green !important;
    border-radius: 20px !important;

}
</style>

<body>
    <div id="cover">

        <div class="cover-container d-flex h-100 pt-3 mx-auto flex-column">
            <?php include 'include/header.php'; ?>
            <?php

            if (isset($_SESSION['Message'])) {
                echo '
                    <div class="input-group form-group">
                        <label class="form-control message" id="message" name="message"> ' . $_SESSION['Message'] . ' </label>
                    </div>
                    ';
            }
            unset($_SESSION['Message']);
            ?>
            <div role="main" class="inner cover">
                <h1 class="cover-heading">BOOK KEEPING SYSTEM BKS</h1>
                <p class="lead2"> keep your books in a safe place.Keys to the past gateway to the future.
				you can find many other books and see other users comments.
				
				
                </p>
                <p class="lead2">
                    <a href="books hall/main.php" class="btn btn-lg btn-secondary">Books hall</a>
                    <?php
                    if (!isset($_SESSION['user_id'])) {
                        echo '<a href="Sign-in.php" class="btn btn-lg btn-primary">Sign in</a>';
                    } else {
                    } ?>
                </p>
            </div>
        </div>
        <div id="two">
            <div class="future px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
                <h2 class="display-4"><img src="img/sq2.png" alt="sq2" width="55" height="55"><span>OUR FEATURED
                        SERVICES</span></h2>
                <p class="lead">Booking system will aid in managing books in an effecient way</p>
            </div>
            <div class="future card-deck mb-3 text-center">
                <div class="card mb-4 box-shadow">
                    <div class="card-body">
                        <img src="img/download.png" alt="Download" width="80" height="90">
                        <h3 class="card-title pricing-card-title">Upload your Book</h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Aenean ultricies iaculis cursus. Mauris enim tellus, finibus in felis solAenean
                                ultricies iaculis curs. Maur is enim tellus, finibus in felis sol</li>
                        </ul>
                    </div>
                </div>
                <div class="card mb-4 box-shadow">
                    <div class="card-body">
                        <img src="img/leaf.png" alt="Leaf" width="80" height="90">
                        <h3 class="card-title pricing-card-title">Write comments</h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Aenean ultricies iaculis cursus. Mauris enim tellus, finibus in felis solAenean
                                ultricies iaculis curs. Maur is enim tellus, finibus in felis sol</li>
                        </ul>
                    </div>
                </div>
                <div class="card mb-4 box-shadow">
                    <div class="card-body">
                        <img src="img/devices.png" alt="Devices" width="100" height="90">
                        <h3 class="card-title pricing-card-title">Visit our book hall</h3>
                        <ul class="list-unstyled mt-3 mb-4">
                            <li>Aenean ultricies iaculis cursus. Mauris enim tellus, finibus in felis solAenean
                                ultricies iaculis curs. Maur is enim tellus, finibus in felis sol</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>




        <div class="three">
            <h2 class="text-center"> Top Rated Books</h2>
            <div class="row">
                <?php
                foreach ($booksRows as $book) {
                    echo '
                <div class="col-xl-2 col-lg-4 col-md-6 col-12 box displaybook">
                <img src="img/books/' . $book['Book_photo'] . '" alt="book1" width="170" height="250">
                <div class="TopRated">
                    <a href="books hall/book.php?Book_id=' . $book['Book_id'] . '">' . $book['Book_title'] . '</a><br>
                    <small>(' . $book['Book_rate'] . '/10)</small>
                    </div>
                </div>
                ';
                }
                ?>

            </div>
        </div>


        <div>
            <h3 class="display-5 text-center "><img src="img/sq2.png" alt="sq2" width="55" height="55"><span>Our Happy
                    Customers</span></h3>
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-20" src="img/Person1.jpg" alt="First slide">
                        <div class="name">
                            <h4>Nale Lastnaem</h4>
                            <p>booklover</p>
                            <p>Aenean ultricies iaculis cursus. Mauris enim tellus,
                                finibus in felis sollicitu din iaculis dolor. Donec sollicitudin orci id efficitur
                                dapibus. Aliq uamtem por ien sed condimentum fringilla. In magna elit, ultrices a eros
                                it amet, iaculis hendrerit tellusn iaculis nisi, nec maximus lorem.
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-20" src="img/Person1.jpg" alt="First slide">
                        <div class="name">
                            <h4>Nale Lastnaem</h4>
                            <p>booklover</p>
                            <p>Aenean ultricies iaculis cursus. Mauris enim tellus,
                                finibus in felis sollicitu din iaculis dolor. Donec sollicitudin orci id efficitur
                                dapibus. Aliq uamtem por ien sed condimentum fringilla. In magna elit, ultrices a eros
                                it amet, iaculis hendrerit tellusn iaculis nisi, nec maximus lorem.
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="three">
            <h2 class="text-center"> Latest Books</h2>
            <div class="row justify-content-md-center">
                <?php
                foreach ($booksRows2 as $book) {
                    echo '
                <div class="col-xl-2 col-lg-4 col-md-6 col-12 box displaybook">
                <img src="img/books/' . $book['Book_photo'] . '" alt="book1" width="170" height="250">
                <div class="TopRated">
                    <a href="books hall/book.php?Book_id=' . $book['Book_id'] . '">' . $book['Book_title'] . '</a><br>
                    <small>Added on:' . $book['Post_date'] . '</small>
                    </div>
                </div>
                ';
                }
                ?>
            </div>
        </div>

        <?php include 'include/footer.php'; ?>
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