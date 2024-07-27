<?php include_once 'app/db.php'; ?>
<?php include_once 'auth/session.php'; ?>
<?php

class AuthController
{
    public function setSession($email, $password)
    {
        $dbObj = new DB();

        $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
        $result = $dbObj->select($query);
        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set("user_login", true);
            Session::set("msg", "Invalid Code");
            Session::set("id", $value['id']);
            Session::set("name", $value['name']);
            Session::set("email", $value['email']);
            header('Location: views/welcome.php');
        } else {
            $loginmsg = "User email and password does not match";
            return $loginmsg;
        }

    }
}