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
    'name' => "Trains",
    'hasScript' => true,
    'loadParts' => true,
    'dialogs' => array
    (
        'add-new-train-company',
        'company-summary',
        'add-new-location',
        'add-new-train',
        'add-new-carriage',
        'carriage-summary',
        'add-new-journey',
        'journey-summary'
    )
);


Views::renderView("trains", $pageData);