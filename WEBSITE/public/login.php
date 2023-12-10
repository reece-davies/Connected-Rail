<?php

require_once '../models/Views.php';
require_once '../models/Session.php';

// Construct pageData to pass into the page renderer.
$pageData = array(
    'name' => "Login",
    'hasScript' => true,
    'loadParts' => false
);

// Check the current user session.
$session = new Session();
$pageData["session"] = $session;

if ($session->IsLoggedIn()) {
    header("Location: ./index.php");
    exit();
}

$shouldLogin = false;

if (isset($_POST['email']) && isset($_POST['password']))
{
    if (!empty($_POST['email']) && !empty($_POST['password']))
    {
        $shouldLogin = true;
    }
}

if ($shouldLogin)  {

    // Get all admins currently in the system:
    $admins = json_decode(file_get_contents('http://web.socem.plymouth.ac.uk/IntProj/PRCS252L/api/administrators'), true);
    $salt = 'PRC$252GROUPL';

    foreach ($admins as $admin)
    {
        if (($_POST['email'] == $admin['EMAIL_ADDRESS']) && (hash('sha256', $salt.$_POST['password']) === $admin['PASSWORD']))
        {
            $session->setLoggedInUser($admin);
            header('Location: ./index.php');
            exit();
        }
    }
}



// Render the page from the data using a template.
Views::renderView("login", $pageData);