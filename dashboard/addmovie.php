<!DOCTYPE html>
<html>

<head>
<link rel="stylesheet" href="dashboard.css">
<script src="https://kit.fontawesome.com/4dded3e0b7.js" crossorigin="anonymous"></script>
  </head>
</head>

<body>
   <?php
    include '../header.php';
    ?>

    <div class="container-fluid rounded" id="myaccount">
        <div class="text-center">
          
            <h1>Add a movie</h1>
            <div class="container">
                <form action="insertmovie.php" method="POST">
                    <div class="hr"></div>
                    <br>
                    <div id="moviecontainer" class="rounded">
                        <img width="300px" class="rounded" src="" id="poster">
                    </div>
                    <div class="hr"></div>
                    <p>Title</p>
                    <input name="title" class="inputinverted rounded" type="text" value="">
                    <br>
                    <div class="hr"></div>


                    <p>Release Year</p>
                    <input name="releaseyear" value="" class="inputinverted rounded">
                    <br>
                    <div class="hr"></div>
                    <p>Poster url</p>
                    <input id="urlposter" value="" onmouseout="showPoster()" name="posterurl" class="inputinverted rounded" type="text">
                    <br>
                    <div class="hr"></div>
                    <p>Synopsis</p>
                    <input name="synopsis" value="" class="inputinverted rounded">
                    <br>
                    <div class="hr"></div>
                    <p>Runtime</p>
                    <input name="runtime" value="" class="inputinverted rounded">
                    <br>
                    <div class="hr"></div>
                    <p>Genre</p>
                    <input name="genre" value="" class="inputinverted rounded">
                    <br>
                    <div class="hr"></div>
                    <p>Director</p>
                    <input name="director" value="" class="inputinverted rounded">
                    <br>
                    <div class="hr"></div>
                    <p>Production</p>
                    <input name="production" value="" class="inputinverted rounded">
                    <br>
                    <div class="hr"></div>
                    <br>
                    <input class="btninverted rounded"  type="submit">
                    <br>
                    <div class="hr"></div>
                </form>
            </div>
        </div>

        <script>
            function showPoster() {
                if (document.getElementById("urlposter").value != null) {
                    let url = document.getElementById("urlposter").value;
                    document.getElementById("poster").src = url
                }
            }
        </script>

    </div>
   
</body>

</html>