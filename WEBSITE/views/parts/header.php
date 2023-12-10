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

    <!-- Bootstrap assets, fonts and icons. -->
    <link rel="stylesheet" href="../../assets/styles/bootstrap.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

    <!-- *SOME* JavaScript libraries that need priority loading -->
    <script src='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v0.53.0/mapbox-gl.css' rel='stylesheet' />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

    <!-- CSS -->
    <link href="../../assets/styles/style.css" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="../../assets/images/Logo_green.png">

</head>

<body>

<?php if ($loadParts) { require_once("navigation.php"); } ?>

<div class="wrapper">