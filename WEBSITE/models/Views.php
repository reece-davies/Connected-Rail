<?php

class Views {

    // Load (render) the view being requested by the user.
    public static function renderView($viewName, $data = array()) {
        $loadParts = true;
        $contentFileFullPath =  "../views/" . $viewName . ".php";

        $dialogs = array();

        // This makes sure passed in variables are in scope of the template.
        // Each key in the $variables array will become a scoped variable.
        if (count($data) > 0)
        {
            foreach ($data as $key => $value) {
                if (strlen($key) > 0) {
                    ${$key} = $value;
                }
            }
        }

        $shouldLoadPageSpecificScript = false;
        if (isset($hasScript)) $shouldLoadPageSpecificScript = $hasScript;

        if (file_exists($contentFileFullPath))
        {

            if ($loadParts) require_once("../views/parts/header.php");

            require_once($contentFileFullPath);

            if ($loadParts) require_once("../views/parts/footer.php");

        }
        else
        {
            //require_once("/views/error.php");
            // Inform the user that there has been an error when loading the page.
        }

    }

    // Load modals (dialog windows) used for the webpage being rendered.
    public static function RenderDialogs($dialogs = array()) {
        foreach ($dialogs as $dialog) {
            require_once("../views/dialogs/" . $dialog . "-dialog.php");
        }
    }
}