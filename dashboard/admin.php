<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <!--<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">-->


  <link rel="stylesheet" href="./dashboard/dashboard.css">


  <title>YellowTree</title>
</head>
<!--<body >-->
<?php

if (isset($_SESSION['type'])) {
  if ($_SESSION['type'] != "admin")
    if (!headers_sent())  header('location: ../index.php');
} else {

  if (!headers_sent()) header('location: ../index.php');
}


?>

<div class="container-fluid">
  <a id="top" style="display: hidden" ;></a>
  <div class="row">
    <div style="position: relative;" class="col-3 rounded"></div>
    <div id="sidebar" class="col-3 rounded">
      <ul>
        <li class="rounded">
          <h4>Welcome Back</h4>
        </li>
        <div class="hr"></div>
        <li class="rounded hover">
          <a href="#top"><i class="	fas fa-desktop"></i><span> Users</span></a>
        </li>
        <div class="hr"></div>
        <li class="rounded hover">
          <a href="#movieselection"><i class="	fas fa-video"></i><span> Movies</span></a>
        </li>
      </ul>
    </div>
    <div class="col-9 rounded" id="mainpanel">

      <h4 id="maintext">Change users type</h4>

      <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="text-center rounded">
        <input type="text" id="input" class="rounded" name="username" placeholder="Enter Username">
        <input type="hidden" name="dashboard" value="admin" />
        <input type="submit" id="btn" value="Search" class="rounded">
      </form>
      <div class="yellowhr"></div>
      <div id="userslider" class="container rounded overflow-auto">

        <div class="text-center">
          <div class="row">

            <?php


            class user
            {
              public $uname;
              public $fname;
              public $lname;
              public $email;
              public $type;
              public $pword;

              function __construct($username, $firstname, $lastname, $email, $type, $pword)
              {
                $this->uname = $username;
                $this->fname = $firstname;
                $this->lname = $lastname;
                $this->email = $email;
                $this->type = $type;
                $this->pword = $pword;
              }
              function getOpposite()
              {
                if ($this->type == "admin") {
                  return "user";
                } else {
                  return "admin";
                }
              }
              function display()
              {
                echo "<div class=\"col-4\">
          <div id=\"containeruser\" class=\"text-center rounded\">
            <div class=\"hr\"></div>
            <i  class=\"fas fa-user userimg\"></i>
            <div class=\"hr\"></div>
            <p name=\" usernametomodify \"  class=\"userdesc username\">Username : " . $this->uname . "</p>
            <div class=\"hr\"></div>
            <p class=\"userdesc\">First Name : " . $this->fname . "</p>
            <div class=\"hr\"></div>
            <p class=\"userdesc\">Last Name : " . $this->lname . "</p>
            <div class=\"hr\"></div>
            <p class=\"userdesc\">Email : " . $this->email . " </p>
            <div class=\"hr\"></div>
            <p name=\"typetomodify\" class=\"userdesc\">Type : " . $this->type . "</p>
            <div class=\"hr\"></div>
            <button onclick=\"updateType('" . $this->uname. "+" .  $this->type . "')\"  class=\"rounded changebtn\" type=\"button\" >switch to " . $this->getOpposite() . " </button>
          </div>
        </div>";
              }
            }
            ?>

            <script>
              function updateType(paramgen) {
                  var res = paramgen.split("+");
                $.post("./dashboard/changetype.php",
                  {
                    username: res[0],
                    type: res[1]
                  },
                  function(data, status) {
                    alert( data + "\nStatus: " + status + "\nancien type:"+res[0]+"+"+res[1]);

                  });
              }
            </script>

            <?php

            if ($_SESSION['type'] == "admin") {
              $count = 0;
              if (isset($_GET['username'])) {
                $username = $_GET['username'];
                if ($username == "") {
                  $username = "*********";
                }
                if ($username == ":all") {
                  $username = "";
                }

                if ($username == ":admin") {
                 /* $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost', 'yellowtree', 'yellow');
                  $sql = $cnnx->prepare("SELECT * FROM `USERS` WHERE type LIKE :admin ");
                  $admin = "admin";
                  $sql->execute([':admin' =>  $admin]);
                  $users = $sql->fetchAll();
                  $usersarray = null;
                  foreach ($users as $user) {
                    $usersarray[] = new user($user['username'], $user['firstname'], $user['lastname'], $user['email'], $user['type'], $user['password']);
                  }*/
                  $cnnx = new connection();
                  $usersarray = $cnnx->getAllAdmin();
                  $cnnx->kill();
                  if ($usersarray != null) {
                    if (sizeof($usersarray) > 3) {
                      foreach ($usersarray as $usertodisplay) {
                        $count++;
                        $usertodisplay->display();
                        if ($count % 3 == 0) {
                          echo "<div class=\"w-100\"></div>";
                        }
                      }
                    } else {
                      foreach ($usersarray as $usertodisplay) {
                        $usertodisplay->display();
                      }
                    }
                  }
                }
                if ($username == ":user") {
                /*  $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost', 'yellowtree', 'yellow');
                  $sql = $cnnx->prepare("SELECT * FROM `USERS` WHERE type LIKE :admin ");
                  $admin = "user";
                  $sql->execute([':admin' =>  $admin]);
                  $users = $sql->fetchAll();
                  $usersarray = null;
                  foreach ($users as $user) {
                    $usersarray[] = new user($user['username'], $user['firstname'], $user['lastname'], $user['email'], $user['type'], $user['password']);
                  }*/
                  $cnnx = new connection();
                  $usersarray = $cnnx->getAllUser();
                  $cnnx->kill();
                  if ($usersarray != null) {
                    if (sizeof($usersarray) > 3) {
                      foreach ($usersarray as $usertodisplay) {
                        $count++;
                        $usertodisplay->display();
                        if ($count % 3 == 0) {
                          echo "<div class=\"w-100\"></div>";
                        }
                      }
                    } else {
                      foreach ($usersarray as $usertodisplay) {
                        $usertodisplay->display();
                      }
                    }
                  }
                  $cnnx = null;
                }




                $username = "%" . $username . "%";

                //$usersarray[] = new user("","","","","","");
                //echo $_GET['username'];
               /* $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost', 'yellowtree', 'yellow');
                $sql = $cnnx->prepare("SELECT * FROM `USERS` WHERE username LIKE :username ");
                $sql->execute([':username' =>  $username]);
                $users = $sql->fetchAll();
                $usersarray = null;
                foreach ($users as $user) {
                  $usersarray[] = new user($user['username'], $user['firstname'], $user['lastname'], $user['email'], $user['type'], $user['password']);
                }*/
                $cnnx = new connection();
               $usersarray=  $cnnx->getUserByUsername($username);
                $cnnx->kill();
                if ($usersarray != null) {
                  if (sizeof($usersarray) > 3) {
                    foreach ($usersarray as $usertodisplay) {
                      $count++;
                      $usertodisplay->display();
                      if ($count % 3 == 0) {
                        echo "<div class=\"w-100\"></div>";
                      }
                    }
                  } else {
                    foreach ($usersarray as $usertodisplay) {
                      $usertodisplay->display();
                    }
                  }
                }
                $cnnx = null;
              }
            }
            ?>




          </div>

        </div>


        <div class="yellowhr"></div>
        <div width="40vh" height="40vh" class="container">
          <canvas id="myChart" width="40vh" height="40vh"></canvas>
        </div>
        <?php
        $nbadmin = 0;
        $nbuser = 0;
        $cnnx = new connection();
        $nbadmin = $cnnx->getNumberOf("admin");
        $nbuser = $cnnx->getNumberOf("user");

        $cnnx->kill();

        /*$cnnx = new PDO('mysql:dbname=yellowtree;host=localhost', 'yellowtree', 'yellow');
        $sql = $cnnx->prepare("SELECT COUNT(username) as nbadmin FROM USERS WHERE type = \"admin\";");
        $sql->execute();
        $admins = $sql->fetchAll();
        foreach ($admins as $admin) {
          $nbadmin = $nbadmin + $admin['nbadmin'];
        }
        $sql = null;
        $sql = $cnnx->prepare("SELECT COUNT(username) as nbuser FROM USERS WHERE type = \"user\";");
        $sql->execute();
        $users = $sql->fetchAll();
        //print_r($users);
        foreach ($users as $user) {
          $nbuser = $nbuser + $user['nbuser'];
        }*/

        echo "<script>
        console.log(\"herro\");
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Admin', 'User'],
                datasets: [{
                    label: '# of Votes',
                    data: [" . $nbadmin . " , " . $nbuser . "],
                    backgroundColor: [
                        'rgba(255, 239, 62, 0.2)',
                        'rgba(255, 255, 255, 0.2)'

                    ],
                    borderColor: [
                        'rgba(255, 239, 62, 1)',
                        'rgba(255, 255, 255, 1)'

                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {

                }
            }
        });
        </script>";








        ?>


        <div class="yellowhr"></div>
        <a id="movieselection" style="display : hidden; "></a>
        <form method="GET" action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="text-center rounded">
          <input type="text" id="inputmovie" class="rounded" name="title" placeholder="Enter movie title">
          <input type="submit" id="btnmovie" value="Search" class="rounded">
        </form>
        <div class="yellowhr"></div>

      </div>
    </div>
  </div>







  <!-- Optional JavaScript -->


  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://kit.fontawesome.com/4dded3e0b7.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!--</body>-->

</html>
