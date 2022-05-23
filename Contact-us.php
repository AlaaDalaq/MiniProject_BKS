<!doctype html>
<html lang="en">
<?php include 'include/session.php' ?>
<?php $_SESSION['Rout'] = "Contact-us"; ?>

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
    color: green;
}

.ConCard {
    background-color: #fff;
    border-radius: 15px;
    padding: 30px;
}

.ConCard .ContactInfo {
    font-size: 12px;
}

.ConCard .ContactInfo .fas {
    color: #c27070;
}
</style>

<body>
    <div id="coverOthers">

        <div class="d-flex pt-3 mx-auto flex-column">
            <?php include 'include/header.php'; ?>
            <div class="full-height">
                <div class="d-flex justify-content-center">
                    <div class="row ConCard">

                        <?php
                        if (isset($_SESSION['ContactMessage'])) {
                            echo '
                                    <div class="input-group form-group">
                                        <label class="form-control message" id="message" name="message"> ' . $_SESSION['ContactMessage'] . ' </label>
                                    </div>
                                ';
                        }
                        unset($_SESSION['ContactMessage']);
                        ?>

                        <div class="col-md-9 mb-md-0 mb-5">
                            <form id="contact-form" name="contact-form" action="include/Contact-us.php" method="POST">

                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="text" id="Sender_Name" name="Sender_Name" class="form-control"
                                                required>
                                            <label for="Sender_Name" class="">Your name</label>
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                    <!--Grid column-->
                                    <div class="col-md-6">
                                        <div class="md-form mb-0">
                                            <input type="email" id="Sender_Email" name="Sender_Email"
                                                class="form-control" required>
                                            <label for="Sender_Email" class="">Your email</label>
                                        </div>
                                    </div>
                                    <!--Grid column-->

                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="md-form mb-0">
                                            <input type="text" id="Message_subject" name="Message_subject"
                                                class="form-control" required>
                                            <label for="Message_subject" class="">Subject</label>
                                        </div>
                                    </div>
                                </div>
                                <!--Grid row-->

                                <!--Grid row-->
                                <div class="row">

                                    <!--Grid column-->
                                    <div class="col-md-12">

                                        <div class="md-form">
                                            <textarea type="text" id="Message" name="Message" rows="2"
                                                class="form-control md-textarea" required></textarea>
                                            <label for="Message">Your message</label>
                                        </div>

                                    </div>
                                </div>
                                <!--Grid row-->
                                <div class="text-center text-md-left">
                                    <input type="submit" value="submit" name="submit" class="btn btn-primary">
                                </div>
                            </form>


                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col-md-3 text-center ContactInfo">
                            <ul class="list-unstyled mb-0">
                                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                                    <p>Abu dhabi, UAE</p>
                                </li>

                                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                                    <p>+ 01 234 567 89</p>
                                </li>

                                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                                    <p>contact@Book.com</p>
                                </li>
                            </ul>
                        </div>
                        <!--Grid column-->

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
