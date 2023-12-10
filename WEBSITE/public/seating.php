<?php

require_once '../models/Session.php';

// Check the current user session.
$session = new Session();
$pageData["session"] = $session;

if (!$session->IsLoggedIn()) {
    header("Location: ./login.php");
    exit();
}

require_once '../models/Views.php';
require_once '../models/Session.php';

// Construct pageData to pass into the page renderer.
$pageData = array(
    'name' => "Seating",
    'hasScript' => true,
    'loadParts' => true,
    'dialogs' => array(
        'booking-summary',
        'passenger-summary'
    )
);


Views::renderView("seating", $pageData);