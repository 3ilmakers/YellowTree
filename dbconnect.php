<?php 

 class connection(){
    
     $cnnx;

    function __construct(){
        $this->cnnx  = new PDO('mysql:dbname=yellowtree;host=localhost', 'yellowtree', 'yellow');

    }

    function kill(){
    $this->cnnx = null;
    }

    function login($email , $password){
    $sql = $this->cnnx -> prepare("SELECT type , username FROM `USERS` WHERE email = :email AND password = :password ");
    $sql -> execute([':email' => $email, ':password' => md5($password)]);
    $type = $sql -> fetchAll();
    echo "TYPES : " . $types;
    if($types=="") header('location: ../index.php?login_status=wrong');
    foreach($type as $types){
      //if($types['type']=="" && $types['username']=="")   header('location: ../index.php');
         $_SESSION['type'] = $types['type'] ;
         $_SESSION['username'] = $types['username'] ;
    }
        if(isset($_SESSION['type']) && isset($_SESSION['username'])){
            header('location: ../index.php');
            
        }
    }

    function getNumberOf($type){
        if($type == "admin"){
            $nbadmin = 0;
            $sql = $this->cnnx->prepare("SELECT COUNT(username) as nbadmin FROM USERS WHERE type = \"admin\";");
            $sql->execute();
            $admins = $sql->fetchAll();
            foreach ($admins as $admin) {
              $nbadmin = $nbadmin + $admin['nbadmin'];
            }
            return $nbadmin;
        }

        if($type == "user"){
            $nbuser = 0;
            $sql = $this->cnnx->prepare("SELECT COUNT(username) as nbuser FROM USERS WHERE type = \"user\";");
            $sql->execute();
            $users = $sql->fetchAll();
            //print_r($users);
            foreach ($users as $user) {
                $nbuser = $nbuser + $user['nbuser'];
            }
        }
        

    }

}