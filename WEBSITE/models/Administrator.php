<?php

class Administrator {

    // Object properties:
    public $id;
    public $email;
    public $password;
    public $first_name;
    public $last_name;
    public $dob;
    public $gender;

    // Database connection properties:
    private $conn;
    private $table = 'ADMINISTRATORS';

    // Constructor method:
    public function __construct($db) {

        $this->conn = $db;

    }

    // Methods etc etc...

}