<?php

class DB
{
    public $hostName = 'localhost';
    public $userName = 'root';
    public $password = '';
    public $dbName = 'dictionary';

    public $link;
    public $error;

    public function __construct()
    {
        $this->connectDB();
    }

    private function connectDB()
    {
        $this->link = new mysqli($this->hostName, $this->userName, $this->password, $this->dbName);
        if (!$this->link) {
            $this->error = "Connection Error" . $this->link->connect_error;
            return false;
        }
    }

    public function registration($query)
    {
        $regData = $this->link->query($query) or die($this->link->error . __LINE__);

        if ($regData) {
            return true;
        } else {
            echo "Something Wrong";
        }
    }

    public function select($query)
    {
        $data = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($data->num_rows > 0) {
            return $data;
        } else {
            return false;
        }
    }

    public function insert($query)
    {
        $insertData = $this->link->query($query) or die($this->link->error . __LINE__);
        if ($insertData) {
            return true;
        } else {
            die("Error : (" . $this->link->errno . ")" . $this->link->error);
        }
    }
}