<?php

class VerifyController
{
    public $db;
    private $domain;

    public function __construct()
    {
        $this->db = new DB();
        $this->domain = $_SERVER['HTTP_HOST'];
    }


    public function setVerify()
    {
        $query = "SELECT * FROM verify WHERE domain_name = '$this->domain'";

        $data = $this->db->select($query);

        if ($data === false) {
            return false;
        } else {
            return $data;
        }
    }

    public function getVerify()
    {
        $data = $this->setVerify();

        if (!empty($data)) {
            foreach ($data as $value) {
                if ($value['domain_name'] != NULL) {
                    return true;
                }
            }
            return 'You have no subscription.!';
        }
        return false;
    }

    public function isVerified()
    {
        $data = $this->setVerify();
        return !empty($data);
    }
}
