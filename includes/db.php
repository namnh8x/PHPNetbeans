<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class WishDB extends mysqli {

    // single instance of self shared among all instances
    //The "static" keyword means that functions in the class 
    //can access the variable even when there is no instance of the class.
    private static $instance = null;
    //db parameters
    private $user = "b7_10443524";
    private $pass = "ngunhubo";
    private $dbName = "b7_10443524_wishlist";
    private $dbHost = "sql201.byethost7.com";

    //This method must be static, and must return an instance of the object if the object
    //does not already exist.
    //using singleton, only 1 instance exists, to prevent duplicates
    public static function getInstance() {
        if (!self::$instance instanceof self) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    // The clone and wakeup methods prevents external instantiation of copies of the Singleton class,
    // thus eliminating the possibility of duplicate objects.
    public function __clone() {
        trigger_error("Clone is not allowed", E_USER_ERROR);
    }
    
    public function __wakeup() {
        trigger_error("Deserializing is not allowed", E_USER_ERROR);
    }
    
    private function __construct() {
        parent::__construct ($this->dbHost, $this->user, $this->pass, $this->dbName);
        if (mysqli_connect_error()) {
            exit ('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
        }
        parent::set_charset('utf-8');
    }
    
    public function get_wisher_id_by_name($name) {
        $name = $this->real_escape_string($name);
        
        $wisher = $this->query("SELECT id FROM wishers WHERE name = '" . $name . "'");
        if ($wisher->num_rows > 0) {
            $row = $wisher->fetech_row();
            return $row[0];
        }
        else {
            return null;
        }
    }
    
    public function get_wishes_by_wisher_id($wisherID) {
        return $this->query("SELECT id, description, due_date FROM wishes WHERE wisher_id=" . $wisherID);
    }
    
    public function create_wisher ($name, $password) {
        $name = $this->real_escape_string($name);
        $password = $this->real_escape_string($password);
        $this->query("INSERT INTO wishers (name, password) VALUES ('" . $name . "', '" . $password . "')");
    }
}
    