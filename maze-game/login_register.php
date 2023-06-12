<?php
session_start();
if (isset($_SESSION['id']) != "") {
    header("Location: index.php");
}

include_once 'config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap Login &amp; Register Templates</title>

    <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/form-elements.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    <!-- Favicon and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

</head>

<body>

    <!-- Top content -->
    <div class="top-content">

        <div>
            <div class="container">

                <div class="row">
                    <div class="col-sm-8 col-sm-offset-2 text">
                        <h1><strong>Maze Game</strong></h1>
                        <div class="description">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-5">

                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Login to our site</h3>
                                    <p>Enter username and password to log on:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-key"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <?php
                                if (isset($_POST['loginbtn'])) {
                                    $uname = mysqli_real_escape_string($conn, $_POST['form-username']);
                                    $upass = mysqli_real_escape_string($conn, $_POST['form-password']);
                                    $res = mysqli_query($conn, "SELECT * FROM maze_user WHERE username='$uname'");
                                    if ($res && mysqli_num_rows($res) > 0) {
                                        $row = mysqli_fetch_array($res);
                                        if ($row['password'] == md5($upass)) {
                                            $_SESSION['id'] = $row['id'];
                                            header("Location: index.php");
                                            exit();
                                        } else {
                                ?>
                                            <script>
                                                alert('Wrong password');
                                            </script>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <script>
                                            alert('User not found');
                                        </script>
                                <?php
                                    }
                                }
                                ?>

                                <form role="form" action="" method="post" class="login-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="form-password" placeholder="Password..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn" name="loginbtn">Sign in!</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-1 middle-border"></div>
                    <div class="col-sm-1"></div>

                    <div class="col-sm-5">
                        <div class="form-box">
                            <div class="form-top">
                                <div class="form-top-left">
                                    <h3>Sign up now</h3>
                                    <p>Fill in the form below to get instant access:</p>
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-pencil"></i>
                                </div>
                            </div>

                            <?php
                            if (isset($_POST['registerbtn'])) {
                                $uname = mysqli_real_escape_string($conn, $_POST['form-username']);
                                $upass = mysqli_real_escape_string($conn, $_POST['form-password']);
                                $res = mysqli_query($conn, "SELECT * FROM maze_user WHERE username='$uname'");
                                if ($res && mysqli_num_rows($res) > 0) {
                            ?>
                                    <script>
                                        alert('Username already exists');
                                    </script>
                                    <?php
                                } else {
                                    $res = mysqli_query($conn, "INSERT INTO maze_user(username,password) VALUES('$uname','" . md5($upass) . "')");
                                    if ($res) {
                                    ?>
                                        <script>
                                            alert('User registered successfully');
                                        </script>
                                    <?php
                                    } else {
                                    ?>
                                        <script>
                                            alert('Error in registration');
                                        </script>
                            <?php
                                    }
                                }
                            }
                            ?>
                            <div class="form-bottom">
                                <form role="form" action="" method="post" class="registration-form">
                                    <div class="form-group">
                                        <label class="sr-only" for="form-username">Username</label>
                                        <input type="text" name="form-username" placeholder="Username..." class="form-username form-control" id="form-username">
                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="form-password">Password</label>
                                        <input type="password" name="form-password" placeholder="password..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn" name="registerbtn">Sign me up!</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">

                <div class="col-sm-8 col-sm-offset-2">
                    <div class="footer-border"></div>
                    <p>Made by Rijan and Rakesh</p>
                </div>

            </div>
        </div>
    </footer>

    <!-- Javascript -->
    <script src="assets/js/jquery-1.11.1.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.min.js"></script>
    <script src="assets/js/scripts.js"></script>

    <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

</body>

</html>