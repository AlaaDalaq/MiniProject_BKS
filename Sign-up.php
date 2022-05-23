<!doctype html>
<html lang="en">
<?php include 'include/session.php' ?>
<?php $_SESSION['Rout'] = "Sign-up"; ?>

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
    <link rel="stylesheet" type="text/css" href="css/Sign-up.css">
</head>
<style>
.message {
    color: red;
}

label {
    color: #b36e73;
    margin-left: 15px;
}

.Gender {
    color: #b36e73;
    padding-bottom: 15px;
}

.GRB {
    margin-left: 10px;
}
</style>

<body>
    <div id="coverOthersSU">

        <div class="d-flex pt-3 mx-auto flex-column">
            <?php include 'include/header.php'; ?>
            <div class="full-height">
                <div class="d-flex justify-content-center">
                    <div class="card">
                        <div class="card-header">
                            <h3>Sign up</h3>
                        </div>
                        <div class="card-body">
                            <form action="include/Sign-up.php" method="POST">
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
                                    <input type="text" class="form-control" placeholder="First Name" id="FirstName"
                                        name="FirstName">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Last Name" id="LastName"
                                        name="LastName">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-map-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Country" id="Country"
                                        name="Country">
                                </div>
                                <div class="btn-group btn-group-toggle Gender" data-toggle="buttons">
                                    <label class="form-control-label "> Gender : </label>
                                    <label class="btn btn-secondary GRB">
                                        <input type="radio" name="Gender" id="Male" value="Male" autocomplete="off">
                                        Male
                                    </label>
                                    <label class="btn btn-secondary GRB">
                                        <input type="radio" name="Gender" id="Female" value="Female" autocomplete="off">
                                        Female
                                    </label>
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="User name" id="UserName"
                                        name="UserName">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" class="form-control" placeholder="password" id="password"
                                        name="password">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    </div>
                                    <input type="date" class="form-control" placeholder="DateBirth" id="DateBirth"
                                        name="DateBirth">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="Phone number"
                                        id="PhoneNumber" name="PhoneNumber">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    </div>
                                    <input type="email" class="form-control" placeholder="Email adress" id="EmailAdress"
                                        name="EmailAdress">
                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-marker"></i></span>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Bio" id="User_Bio"
                                        name="User_Bio">
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="submit" name="submit" class="btn float-right login_btn">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
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