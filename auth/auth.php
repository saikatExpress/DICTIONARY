<?php include_once 'app/db.php'; ?>
<?php

class Auth
{
    public $auth = 2;

    public function __construct()
    {
        
    }

    public function guard($authValue)
    {
        if($authValue == 2){
            return header('Location: views/calculator/calculate.php');
        }else{
            return header('Location: /RawPHP');
        }

    }

    public static function verifyGuard($email, $pass)
    {
        $dbObj = new DB();
        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$pass'";

        $data = $dbObj->select($query);
        if($data === false){
            return false;
        }else{
            foreach($data as $value){
                if($value['role'] === 'admin'){
                    header('Location: views/admin/index.php');
                    return;
                }
                if($value['is_verified'] == 1 && $value['role'] === 'user'){
                    return $data;
                }
            }
            return 555;
        }
    }
}