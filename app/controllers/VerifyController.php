<?php include_once 'app/db.php'; ?>

<?php

class VerifyController
{
    public $db;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function setVerify()
    {
        $query = 'SELECT * FROM verify WHERE id = 1';

        $data = $this->db->select($query);

        if($data === false){
            return 1;
        }else{
            return $data;
        }
    }

    public function getVerify($token)
    {
        $data = $this->setVerify();

        if(!empty($data)){
            foreach($data as $value){
                if($value['verify_token'] === $token){
                    header('Location: welcome.php');
                }else{
                    $msg = 'You have no subscription.!';
                    return $msg;
                }
            }
        }
    }

}