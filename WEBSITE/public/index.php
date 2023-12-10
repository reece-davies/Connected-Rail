<?php

require_once '../models/Session.php';
require_once '../models/Views.php';
require_once '../models/Session.php';

// Construct pageData to pass into the page renderer.
$pageData = array(
    'name' => "Home",
    'hasScript' => true,
    'loadParts' => true
);

// Check the current user session.
$session = new Session();
$pageData["session"] = $session;

if (!$session->IsLoggedIn()) {
    header("Location: ./login.php");
    exit();
}

Views::renderView("index", $pageData);