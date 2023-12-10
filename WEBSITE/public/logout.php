<?php
require_once '../models/Views.php';
require_once '../models/Session.php';

// Get the current user session.
$session = new Session();

// Logout the user.
$session->Logout();

// Redirect the user.
header("Location: ./login.php");
exit();