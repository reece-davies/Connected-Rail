<!DOCTYPE html>
<html lang="en">
<head>

    <!-- META -->
    <meta charset="UTF-8">
    <title>ConnectedRail - <?php echo($name); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="format-detection" content="telephone=no">

    <!-- SEO -->
    <meta name="Description" content="Account management software designed for managers of train companies." />
    <meta name="Keywords" content="admin, manage, train, company, cargo, team, software, website" />
    <meta name="copyright"content="Integrating Project Group L" />
    <meta name="author" content="Integrating Project Group L, University of Plymouth - School of Computing, Electronics and Mathematics." />

    <!-- Links to JS / CSS CDNs + libraries used for this login page -->
    <link rel="stylesheet" href="../../assets/styles/bootstrap.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../assets/fonts/iconic/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/css-hamburgers/hamburgers.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/animsition/css/animsition.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/select2/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/vendor/daterangepicker/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../assets/styles/util.css">
    <link rel="stylesheet" type="text/css" href="../assets/styles/login.css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../assets/images/Logo_green.png">

</head>

<body>
<div class="limiter">
    <div class="container-login-form" style="background-image: url('../assets/images/train-login-background.jpg');">
        <div class="wrap-login-form">
            <form class="login-form validate-form" method="post" action="./login.php">
                <span class="login-form-logo"><i class="zmdi zmdi-account"></i></span>
                <span class="login-form-title p-b-34 p-t-27">Log in</span>
                <div class="wrap-login-input validate-input" data-validate="Enter email address">
                    <input class="login-input" type="text" name="email" placeholder="Email Address">
                    <span class="focus-login-input" data-placeholder="&#xf207;"></span>
                </div>
                <div class="wrap-login-input validate-input" data-validate="Enter password">
                    <input class="login-input" type="password" name="password" placeholder="Password">
                    <span class="focus-login-input" data-placeholder="&#xf191;"></span>
                </div>
                <div class="login-form-checkbox">
                    <input class="login-input-checkbox" id="ckb1" type="checkbox" name="remember-me">
                    <label class="login-checkbox-label" for="ckb1">Remember me</label>
                </div>
                <div class="login-form-button-container">
                    <button class="login-form-btn">Login</button>
                </div>
                <div class="text-center p-t-90">
                    <a class="txt1" href="#">Forgot Password?</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="dropDownSelect1"></div>

<script src="../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
<script src="../assets/vendor/animsition/js/animsition.min.js"></script>
<script src="../assets/vendor/bootstrap/js/popper.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/select2/select2.min.js"></script>
<script src="../assets/vendor/daterangepicker/moment.min.js"></script>
<script src="../assets/vendor/daterangepicker/daterangepicker.js"></script>
<script src="../assets/vendor/countdowntime/countdowntime.js"></script>
<script src="../assets/scripts/login.js"></script>
</body>
</html>