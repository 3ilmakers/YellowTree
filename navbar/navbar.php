<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../navbar/style.css">
    
  </head>
  <body>
    <header>
      <nav class="navbar sticky-top navbar-expand-lg ">
        <a class="navbar-brand" href="#">
          <img src="../assets/logo.jpg" width="40" height="40" class="d-inline-block align-top" alt="">
  
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
  
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">News</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Movies</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Tv Shows</a>
            </li>
  
          </ul>
          <form method="GET" action="search.php" class="form-inline my-2 my-lg-0">
            <input  class="btn my-2 my-sm-0 btn-outline searchbtn" name="search" type="text">
            <button id="lookupbtn"  type="submit" class="btn my-2 my-sm-0 btn-outline">search</button>
          </form>
          <form class="form-inline my-2 my-lg-0">
            
          </form>
          <?php
          session_start();
      if(isset($_SESSION['username']) && isset($_SESSION['type'])){
        echo " <form action=\"logout.php\" class=\"form-inline my-2 my-lg-0\">
        <button id=\"logoutbtn\" class=\"btn my-2 my-sm-0 btn-outline\" type=\"submit\">Log Out</a>
      </form>";
      if($_SESSION['type'] == "admin"){
        echo " <form action=\"logout.php\" class=\"form-inline my-2 my-lg-0\">
        <button id=\"dashboardbtn\" class=\"btn my-2 my-sm-0 btn-outline\" type=\"button\"><i class=\"fas fa-chart-line\"></i></a>
      </form>";

        }
        else{
          echo " <form action=\"logout.php\" class=\"form-inline my-2 my-lg-0\">
        <button id=\"myaccountbtn\" class=\"btn my-2 my-sm-0 btn-outline\" type=\"button\"><i class=\"fas fa-user\"></i></a>
      </form>";


        }
      }
      else{
        echo "<form class=\"form-inline my-2 my-lg-0\">
            <button id=\"loginbtn\" class=\"btn my-2 my-sm-0 btn-outline\" type=\"button\" data-toggle=\"modal\"
              data-target=\"#loginModal\">Login</a>
          </form>
          <form class=\"form-inline my-2 my-lg-0\">
            <button id=\"signupbtn\" class=\"btn my-2 my-sm-0 btn-outline\" type=\"button\" data-toggle=\"modal\"
              data-target=\"#signupModal\">Sign Up</a>
          </form>";
      }
    ?>
        </div>
      </nav>
    </header>
  
    <script>
      function closemodal() {
        console.log($('#loginModal'));
        $('#loginModal').modal();
  
      }
    </script>
    
    <div class="modal" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  
  
  
      <div id="loginform" tabindex="-1" role="dialog" width="100%" class="container rounded">
        <form action="login.php" method="POST" class="text-center">
          <div class="form-group">
            <img src="../assets/logosmallinverted.jpg" width="130px">
            <h2>Login</h2>
          </div>
          <br>
          <div class="form-group">
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <br>
          <button  type="submit" class="btn btn-dark submitbtn">Login</button>
          <button data-target="#signupModal" data-dismiss="modal" aria-label="Close" type="button"
            class="btn btn-dark closebtn">Close</button>
        </form>
  
      </div>
  
  
  
  
    </div>
  
    <div class="modal" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
      aria-hidden="true">
      <div id="signupform" width="100px" class="container rounded">
        <form action="../navbar/signup.php" method="POST" class="text-center">
          <div class="form-group">
            <img src="../assets/logosmallinverted.jpg" width="130px">
            <h2>Sign Up</h2>
          </div>
          <br>
          <div class="form-group">
            <input type="text" class="form-control" name="username" placeholder="Username">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="firstname" placeholder="First Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="lastname" placeholder="Last Name">
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="form-group">
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
  
          <button  type="submit" class="btn btn-dark submitbtn">Sign Up</button>
          <button  type="button" data-target="#loginModal" data-dismiss="modal" aria-label="Close"
            class="btn btn-dark closebtn">Close</button>
  
        </form>
      </div>
    </div>
  
  

    <!-- Optional JavaScript -->
    <script src="https://kit.fontawesome.com/4dded3e0b7.js"></script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>
