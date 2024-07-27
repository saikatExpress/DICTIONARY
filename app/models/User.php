<?php
include_once '../app/db.php';

class User
{
    private $table = 'users';
    private $db;

    public $id;
    public $username;
    public $password;
    public $email;

    public function __construct()
    {
        $this->db = new DB();
    }

    public function register($username, $password, $email, $mobile)
    {

        $username = htmlspecialchars(strip_tags($username));
        $email = htmlspecialchars(strip_tags($email));

        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO users(name,email,mobile,role,password)VALUES('$username','$email','$mobile','user','$password_hash')";

        $res = $this->db->registration($query);

        if($res === true){
            return true;
        }else{
            return false;
        }
    }

    public function login($email, $password)
    {
        $email = htmlspecialchars(strip_tags($email));

        $query = "SELECT * FROM users WHERE email = '$email'";

        $data = $this->db->select($query);

        if($data !== false){
            $value = $data->fetch_assoc();

            if (password_verify($password, $value['password'])) {
                $this->id = $value['id'];
                $this->username = $value['name'];
                $this->email = $value['email'];
                return true;
            }
        }

        return false;
    }
}

?>