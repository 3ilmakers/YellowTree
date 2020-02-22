<?php
include './dashboard/admin.php';
class connection
{

    public $cnnx;

    function __construct()
    {
        $this->cnnx  = new PDO('mysql:dbname=yellowtree;host=localhost', 'yellowtree', 'yellow');
    }

    function kill()
    {
        $this->cnnx = null;
    }

    function login($email, $password)
    {
        $sql = $this->cnnx->prepare("SELECT type , username FROM `USERS` WHERE email = :email AND password = :password ");
        $sql->execute([':email' => $email, ':password' => md5($password)]);
        $type = $sql->fetchAll();
        echo "TYPES : " . $types;
        if ($types == "") header('location: ../index.php?login_status=wrong');
        foreach ($type as $types) {
            //if($types['type']=="" && $types['username']=="")   header('location: ../index.php');
            $_SESSION['type'] = $types['type'];
            $_SESSION['username'] = $types['username'];
        }
        if (isset($_SESSION['type']) && isset($_SESSION['username'])) {
            header('location: ../index.php');
        }
    }

    function getNumberOf($type)
    {
        if ($type == "admin") {
            $nbadmin = 0;
            $sql = $this->cnnx->prepare("SELECT COUNT(username) as nbadmin FROM USERS WHERE type = \"admin\";");
            $sql->execute();
            $admins = $sql->fetchAll();
            foreach ($admins as $admin) {
                $nbadmin = $nbadmin + $admin['nbadmin'];
            }
            return $nbadmin;
        }

        if ($type == "user") {
            $nbuser = 0;
            $sql = $this->cnnx->prepare("SELECT COUNT(username) as nbuser FROM USERS WHERE type = \"user\";");
            $sql->execute();
            $users = $sql->fetchAll();
            //print_r($users);
            foreach ($users as $user) {
                $nbuser = $nbuser + $user['nbuser'];
            }
            return $nbuser;
        }
    }

    function getAllAdmin()
    {
        $sql = $this->cnnx->prepare("SELECT * FROM `USERS` WHERE type LIKE :admin ");
        $admin = "admin";
        $sql->execute([':admin' =>  $admin]);
        $users = $sql->fetchAll();
        $usersarray = null;
        foreach ($users as $user) {
            $usersarray[] = new user($user['username'], $user['firstname'], $user['lastname'], $user['email'], $user['type'], $user['password']);
        }
        return $usersarray;
    }

    function getAllUser()
    {
        $sql = $this->cnnx->prepare("SELECT * FROM `USERS` WHERE type LIKE :admin ");
        $admin = "user";
        $sql->execute([':admin' =>  $admin]);
        $users = $sql->fetchAll();
        $usersarray = null;
        foreach ($users as $user) {
            $usersarray[] = new user($user['username'], $user['firstname'], $user['lastname'], $user['email'], $user['type'], $user['password']);
        }

        return $usersarray;
    }

    function getUserByUsername($username)
    {

        $sql = $this->cnnx->prepare("SELECT * FROM `USERS` WHERE username LIKE :username ");
        $sql->execute([':username' =>  $username]);
        $users = $sql->fetchAll();
        $usersarray = null;
        foreach ($users as $user) {
            $usersarray[] = new user($user['username'], $user['firstname'], $user['lastname'], $user['email'], $user['type'], $user['password']);
        }

        return $usersarray;
    }

    function update($email,$firstname,$lastname,$password)
    {

        $sql = $this->cnnx->prepare("UPDATE `USERS` SET `email`= :email,`firstname`= :firstname,`lastname`= :lastname ,`password`= :password WHERE username = :username ");
        $sql->execute([':email' => $email, ':firstname' => $firstname, ':lastname' => $lastname, ':password' => $password, ':username' => $_SESSION['username']]);
        
    }
}