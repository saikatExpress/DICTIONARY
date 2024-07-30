<?php

include_once '../../app/db.php';

class UserController
{
    public $dbObj;

    public function __construct()
    {
        $this->dbObj = new DB();    
    }
    public function index()
    {
        $query = "SELECT * FROM user_details LIMIT 20";

        $data = $this->dbObj->select($query);

        return $data;
    }
}

?>