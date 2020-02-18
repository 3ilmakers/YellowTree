<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="./dashboard/dashboard.css">

    <title>YellowTree</title>
  </head>
  <body>
    <?php
    session_start();
    if(isset($_SESSION['type']) && $_SESSION['type'] == "admin"){}
    else{
      header('location: ../index.php');
    }
    ?>
    <div class="container-fluid">
    <div  class="row">
      <div id="sidebar" class="col-3 rounded">
        <ul>
          <li class="rounded">
            <h4>Welcome Back</h4>
          </li>
          <div class="hr"></div>
          <li class="rounded hover">
            <a><i class="	fas fa-desktop"></i><span> Users</span></a>
          </li>
          <div class="hr"></div>
          <li class="rounded hover">
            <a><i class="	fas fa-video"></i><span> Movies</span></a>
          </li>
        </ul>
      </div>
      <div class="col-9 rounded" id="mainpanel">

        <h4 id="maintext">Change users type</h4>

        <form method="GET" action="<?php echo $_SERVER["PHP_SELF"];?>" class="text-center rounded">
        <input type="text" id="input" class="rounded" name="username" placeholder="Enter Username">
        <input type="submit" id="btn" value="Search" class="rounded">
        </form>
        <div class="yellowhr"></div>
        <div id="userslider" class="container rounded">

          <div class="text-center">
            <div class="row">
           <?php
     class user{
       public $uname ;
       public $fname ;
       public $lname ;
       public $email ;
       public $type ;
       public $pword;

        function construct( $username , $firstname , $lastname, $email, $type, $pword){
          $this -> uname = $username;
          $this -> fname = $firstname;
          $this -> lname = $lastname;
          $this -> email = $email;
          $this -> type = $type;
          $this -> pword = $pword;
        }

        function display() {
          echo "<div class=\"col-4\">
          <div id=\"containeruser\" data-toggle=\"modal\" data-target=\"#modifyusertype\" class=\"text-center rounded\">
            <div class=\"hr\"></div>
            <i  class=\"fas fa-user userimg\"></i>
            <div class=\"hr\"></div>
            <p  class=\"userdesc username\">Username :".$this->uname."</p>
            <div class=\"hr\"></div>
            <p class=\"userdesc\">First Name :".$this->fname."</p>
            <div class=\"hr\"></div>
            <p class=\"userdesc\">Last Name :".$this->lname."</p>
            <div class=\"hr\"></div>
            <p class=\"userdesc\">Email :".$this->email." </p>
            <div class=\"hr\"></div>
            <p class=\"userdesc\">Password :".$this->pword."</p>
            <div class=\"hr\"></div>
            <p class=\"userdesc\">Type :".$this->type."</p>
            <div class=\"hr\"></div>
          </div>
        </div>";
        }
     }

if($_SESSION['type'] == "admin"){
    $username = $_GET['username'];
    $username = "%".$username."%" ;
    $usersarray[] = new user("","","","","","");
    $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
    $sql = $cnnx -> prepare("SELECT * FROM `users` WHERE username LIKE :username ");
    $sql -> execute([':username' =>  $username]);
    $users = $sql -> fetchAll();
    foreach($users as $user){
      $usersarray[] = new user($user['username'] , $user['firstname'], $user['lastname'], $user['email'], $user['type'],$user['password']);



    }

    var_dump($usertodisplay);
    foreach($usersarray as $usertodisplay){
     // $usertodisplay -> display();
    }
    $cnnx = null ;

}
else {
    echo "get lost son of a bitch";
}
    ?>




            </div>

          </div>

        </div>
        <div class="yellowhr"></div>
        <?php
          $nbadmin = 0;
          $nbuser = 0;
          $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
          $sql = $cnnx -> prepare("SELECT COUNT(username) as nbadmin FROM USERS WHERE type = \"admin\";");
          $sql -> execute();
          $admins = $sql -> fetchAll();
          foreach($admins as $admin){
            $nbadmin =$nbadmin + $admin['nbadmin'];
          }
          $sql = null;
          $sql = $cnnx -> prepare("SELECT COUNT(username) as nbuser FROM USERS WHERE type = \"user\";");
          $sql -> execute();
          $users = $sql -> fetchAll();
          //print_r($users);
          foreach($users as $user){
            $nbuser = $nbuser + $user['nbuser'];
          }
          echo "<script type=\"text/javascript\" src=\"https://www.gstatic.com/charts/loader.js\"></script>" ;
          echo "<script type=\"text/javascript\">
          google.charts.load('current', {'packages':['corechart']});
          google.charts.setOnLoadCallback(drawChart);

          function drawChart() {

            var data = google.visualization.arrayToDataTable([
              ['Users', 'Type of users'],
              ['User', '".$nbuser."'],
              ['Admin', '".$nbadmin."']
            ]);

            var options = {
              title: 'User Repartition'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
          }
        </script>
        <div id=\"piechart\" style=\"width: 900px; height: 500px;\"></div>"








        ?>
      </div>
    </div>
  </div>

  <div class="modal" tabindex="-1" role="dialog" id="modifyusertype">
    <div id="modalbg" class="container rounded" width="50px">
      <div class="text-center">
        <img src="./assets/logotop.png" width="160px" height="160px">
        <div class="hr"></div>

        <br>
        <p id="targetusername"> Username </p>
        <div class="hr"></div>


        <div class="custom-control custom-switch">

          <input type="checkbox" class="custom-control-input" id="customSwitch1">

        </div>
        <br>
        <div class="yellowhr"></div>
      </div>
      </div>
    </div>

  </div>

    <!-- Optional JavaScript -->

    <script src="dashboard.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://kit.fontawesome.com/4dded3e0b7.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
