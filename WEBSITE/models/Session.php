<?php

class Session {
    private $isLoggedIn = false;
    public $user = null;

    public function __construct() {

        // Start a session for this page:
        session_name("session");
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        // Check to see if the current session has a logged in user.
        $this->CheckSession();
    }

    /*
     * Set the currently logged in user.
     */
    public function setLoggedInUser($admin) {

        $_SESSION['email'] = $admin['EMAIL_ADDRESS'];
        $this->user = $admin;
        $this->checkSession();

    }

    /*
     *  Logout resets the state of the session regardless of its status.
     */
    public function Logout() {
        session_unset();
        session_destroy();
        $this->isLoggedIn = false;
    }

    /*
     *  CheckSession checks to see if a user's session has been set
     *  and stores the result in the isLoggedIn variable.
     */
    private function CheckSession() {

        if (!empty($_SESSION['email']))  {

//            if (is_null($this->user))
//            {
//                $this->isLoggedIn = false;
//            }
//            else
//            {
//                $this->isLoggedIn = true;
//            }
            $this->isLoggedIn = true;

        } else {
            $this->isLoggedIn = false;
            $this->user = null;
        }
    }

    /*
     *  isLoggedIn checks to see if the user is logged in.
    */
    public function isLoggedIn() {
        return $this->isLoggedIn;
    }
}