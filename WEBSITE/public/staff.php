<?php

require_once '../models/Views.php';
require_once '../models/Session.php';

// Construct pageData to pass into the page renderer.
$pageData = array(
    'name' => "Staff",
    'hasScript' => true,
    'loadParts' => true,
    'dialogs' => array
    (
        'staff-member-summary',
        'add-new-staff',
        'search-staff-accounts',
        'journey-staff-summary',
        'add-new-journey-staff',
        'journey-summary'
    )
);


Views::renderView("staff", $pageData);