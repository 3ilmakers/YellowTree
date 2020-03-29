
<html>
  <head>

      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
      <link rel="icon" href="../assets/logo.jpg">
      <!-- CSS poster -->
    <link rel="stylesheet" href="style_poster.css">

    <?php

    $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');
    $sql = $cnnx -> prepare("SELECT * FROM `MOVIE` where idmovie=:idmovie");
    $sql -> execute([':idmovie' => $_GET['idmovie']]);
    $posters = $sql -> fetchAll();
    foreach ($posters as $postered) {
      $poster = $postered['posterurl'];
      $title = $postered['title'];
      $synopsis = $postered['synopsis'];
      $runtime = $postered['runtime'];
      $genre = $postered['genre'];
      $director = $postered['director'];
      $production = $postered['production'];
      $releaseyear = $postered['releaseyear'];
    }


    ?>

    <script>
    function video() {
    <?php 	
    function yt_trailer($search) 
    {
		$search = str_replace(' ','+',$search);
		$search = str_replace('\'s','',$search);
		$wget = file_get_contents('https://www.google.fr/search?q=trailer+'.$search);

		$words = explode('https://www.youtube.com/watch?v=', $wget);
		$words = explode(' ', $words[1]);
		$words = explode('</div>', $words[0]);
		return $words[0];
	}
	$codeyt = yt_trailer($title);
	if( strlen($codeyt) > 12 | strlen($codeyt) < 1 )		$codeyt = yt_trailer('trailer+'.$title);
	
	$urltrailer =  'https://www.youtube.com/embed/'.$codeyt;

    echo "document.getElementById('poster_img').innerHTML = \"<iframe width='900' height='400' src='".$urltrailer."' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>\""; 
    ?>
     
    }

    function video_trON() {
      document.getElementById('poster_img').innerHTML = "<img src=\"fleche.png\" width=100 height=100 style=\"margin-top:150\" >"
    }
    function video_trOFF() {
      document.getElementById('poster_img').innerHTML = ""
    }

    function scoreplus() {
      var score= parseInt(document.getElementById("score").innerHTML) + 1;
      if(score > 100){
        score = 100;
      }
      document.getElementById("score").innerHTML = score;

    }

    function scoremoins() {
      var score= parseInt(document.getElementById("score").innerHTML) - 1;
      if(score < 0){
        score = 0;
      }
      document.getElementById("score").innerHTML = score;

    }
    </script>



  </head>
  <body>



    <div id="poster_img" style="background-image: url('<?php echo $poster; ?>'); text-align: center;" onclick="video()" > <!---onmouseover="video_trON()" onmouseout="video_trOFF()">-->

    </div>


    <div id=burn>
      <div id=vote>
            <table>
              <tr>
                <td  colspan="2"><span id="score" >75</span> ⭐</td>
              </tr>
              <tr>
                  <td><a href="#" onclick="scoremoins()" >&nbsp;&nbsp;-&nbsp;&nbsp;</a></td>
                  <td><a href="#" onclick="scoreplus()">&nbsp;&nbsp;+&nbsp;&nbsp;</a></td>
              </tr>
            </table>
          </div></div>
    <div id=corpus>
      <!----------------------------->
      <h2><?php echo $title; ?></h2>
      <p><?php echo $synopsis; ?></p>
      <!----------------------------->
      <h2>Technical details</h2>
      <table width="60%" >
      <tr>
          <td>Runtime</td>
          <td ><?php echo $runtime; ?></td>
      </tr>
      <tr>
          <td>Release year</td>
          <td><?php echo $releaseyear; ?></td>
      </tr>
      <tr>
          <td>Genre</td>
          <td><?php echo $genre; ?></td>
      </tr>
      <tr>
          <td>Director</td>
          <td><?php echo $director; ?></td>
      </tr>
      <tr>
          <td>Production</td>
          <td><?php echo $production; ?></td>
      </tr>
    </table>

      <h2>Actor</h2>
      <?php

      $cnnx = new PDO('mysql:dbname=yellowtree;host=localhost','yellowtree','yellow');


      $sql = $cnnx -> prepare("SELECT * FROM `ACTOR` INNER JOIN `ACT` ON ACTOR.idactor=ACT.idactor where idmovie=:idmovie");
      $sql -> execute([':idmovie' => $_GET['idmovie']]);
      $actors = $sql -> fetchAll();
      foreach ($actors as $actor) {

        echo "    <div class='actor'>
              <img class='thumbnail' src='".$actor['actorurl']."'></img>
              <p>".$actor['name']."</p>
            </div>";
      }


      ?>

    </div>

  </body>

</html>
