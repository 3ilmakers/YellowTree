<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="./dashboard/dashboard.css">
    <title>YellowTree</title>
  </head>
  <body>
  <?php
  
  if(isset($_SESSION['username'])){
    $username = "";
    $email = "";
    $firstname = "";
    $lastname = "";
    $password ="";
    $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
    $sql = $cnnx -> prepare("SELECT * FROM `USERS` WHERE username = :username ");
    $sql -> execute([':username' => $_SESSION['username']]);
    $users = $sql -> fetchAll();
    foreach($users as $user){
      $username = $user['username'];
      $email = $user['email'];
      $firstname = $user['firstname'];
      $lastname = $user['lastname'];
      $password = $user['password'];

    }

    echo   "<div class=\"container-fluid rounded\" id=\"myaccount\">
    <div class=\"text-center\">
      <i id=\"userhead\" class=\"fas fa-user\"></i>
      <h1>My Account</h1>
      <div class=\"container\">
        <form action=\"./dashboard/update.php\" method=\"POST\">
        <div class=\"hr\"></div>
        <p>Username</p>
        <p>@".$username."</p>
        <br>
        <div class=\"hr\"></div>
        <p>First Name</p>
        <input name=\"firstname\" class=\"inputinverted rounded\" type=\"text\" value=\"".$firstname."\">
        <br>
        <div class=\"hr\"></div>
        <p>Last Name</p>
        <input name=\"lastname\" class=\"inputinverted rounded\" type=\"text\" value=\"".$lastname."\">
        <br>
        <div class=\"hr\"></div>
        <p>Email</p>
        <input name=\"email\" class=\"inputinverted rounded\" type=\"email\" value=\"".$email."\">
        <br>
        <div class=\"hr\"></div>
        <p>Password</p>
        <input name=\"password\" class=\"inputinverted rounded\" type=\"password\" value=\"".$password."\">
        <br>
        <div class=\"hr\"></div>
        <br>
        <input class=\"btninverted rounded\" type=\"submit\">
        <br>
        <div class=\"hr\"></div>
      </form>
      </div>
    </div>

  </div>";

  $cnnx = null;

  }
  else{
    header('location: ./index.php');
  }
  ?>

    <!-- Optional JavaScript -->
    <script src="dashboard.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://kit.fontawesome.com/4dded3e0b7.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
