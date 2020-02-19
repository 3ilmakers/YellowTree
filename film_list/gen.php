<?php

echo "<h1>Dump</h1>";



/*sep_actor("Tim Roth, Amanda Plummer, Laura Lovelace, John Travolta");
create_actor("Tim Roth");
create_actor("Nicolas Cage");
create_actor("Margot Robbie");*/
/*==============================
            FILE
read line by line
===============================*/
$file = fopen("film_lists","r");
$c=0;
while(! feof($file))
  {
      $c++;

      //echo fgets($file). "<br />";
      //echo str_replace( $c . ".", "", fgets($file)."<br>");
      $title_movie = str_replace( $c . ".", "", fgets($file));
      echo "<br><h2>".$title_movie."</h2>";
      dump_IMDb(str_replace( $c . ".", "", $title_movie));
      //if( $c > 6) return;
  }

fclose($file);





function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

   return preg_replace('/[^A-Za-z0-9\-\é\à\è\']/', '', $string); // Removes special chars.
}



/*===============================
                API
dump database IMDb
=================================*/
function dump_IMDb($arg_1)
{


            $url_film = "https://www.omdbapi.com/?i=tt3896198&apikey=ec6c939f&t=".str_replace( " ", "+", clean($arg_1))."&plot=full";
            echo "url_film_API:".$url_film."<br>";
            $dtls = file_get_contents($url_film);
            //echo $dtls;
            $obj = json_decode($dtls);
            //$obj->Title, $obj->Poster, $obj->Year, $obj->Released, $obj->Runtime, $obj->Genre, $obj->Writer, $obj->Director, $obj->Actors, $obj->Plot;
            //      *     ,     *     ,       *       ,     *       ,        *    ,     T      ,     T        ,      *        ,     T       ,     *     ,     *       ;
            //----------------------------------
            //----------cleaning
            $obj->Title = str_replace( "'", "\\'", $obj->Title);
            $obj->Actor = str_replace( "'", "", $obj->Actor);
            $obj->Director = str_replace( "'", "\\'", $obj->Director);
            $obj->Production = str_replace( "'", "\\'", $obj->Production);
            $obj->Plot = str_replace( "'", "\\'", $obj->Plot);
            $obj->Plot = str_replace( ";", "\\;", $obj->Plot);
            $obj->Poster = str_replace( "300.jpg", "3000.jpg", $obj->Poster);
            $obj->Year  = (int) preg_replace('/[^0-9]/', '', $obj->Year);

            if (strpos($obj->Title, 'Behind the Scene') ) {
                return;
            }

            $cnnx = mysqli_connect("localhost", "yellowtree", "yellow") or die("sql user error");
            mysqli_select_db($cnnx,"yellowtree") or die("db non trouver");

            if (exist_film($obj->Title, $obj->Year, $cnnx)) { echo "FILMEXIST"; return; }



            $rqt = "INSERT INTO MOVIE(title, releaseyear, posterurl , synopsis, runtime , genre, director, production) VALUES ( '$obj->Title', $obj->Year, '$obj->Poster', '$obj->Plot', '$obj->Runtime',  '$obj->Genre', '$obj->Director','$obj->Production');";
            echo $rqt."<br>";
            $qry = mysqli_query($cnnx,$rqt) or die("[ERROR] [0x0000] execution requette");

            $rqt =  "SELECT idmovie FROM MOVIE order by idmovie DESC limit 1 ";
            $qry = mysqli_query($cnnx,$rqt) or die("[ERROR] [0x0001]execution requette");
            $last_film = mysqli_fetch_object($qry);

            $idmovie = $last_film->idmovie;
            check_all_actors($obj->Actors,$cnnx,$idmovie);

}

function exist_film($titre, $date, $cnnx)
{

    //$titre = str_replace( "'", "\\'", $titre);
    echo $titre ." ". $date;
    $rqt =  "SELECT title, releaseyear FROM MOVIE where title like '%".$titre."%' and releaseyear=$date";
    $qry = mysqli_query($cnnx,$rqt) or die("[ERROR] [0x0005]execution requette");
    $film = mysqli_fetch_object($qry);

    if( $film->title == "") return False;
    else return True;
}



function exist_actor($arg_1, $cnnx)
{

    $arg_1 = str_replace( "'", "", $arg_1);
    $rqt =  "SELECT name FROM ACTOR where name like '%" .$arg_1."%'";
    $qry = mysqli_query($cnnx,$rqt) or die("[ERROR] [0x0002]execution requette");
    $actor = mysqli_fetch_object($qry);

    if( $actor->name == "") return False;
    else return True;
}


function create_actor($arg_1,$cnnx)
{

  echo "<br>CREATION ACTOR<br>";
  $url = "https://en.wikipedia.org/w/api.php?action=query&prop=pageimages&format=json&pithumbsize=300&titles=".str_replace( " ", "+", $arg_1)."&indexpageids";
  //paramètre important pageids qui permet de récupérer la pageid pour accéder au thumbnail

  $json = file_get_contents($url);
  $data = json_decode($json);
  $pageid = $data->query->pageids[0];
  $actorurl = $data->query->pages->$pageid->thumbnail->source;

  $arg_1 = str_replace( "'", "", $arg_1);
  $rqt = "INSERT INTO ACTOR(name, actorurl) VALUES ('$arg_1', '$actorurl')";
  echo $rqt;
  $qry = mysqli_query($cnnx,$rqt) or die("[ERROR] [0x0003] execution requette");
}



function check_all_actors($arg_1,$cnnx,$idmovie)
{
  $arg_1 = str_replace( "'", "", $arg_1);
  $nom = explode(',', $arg_1);


  foreach ($nom as &$actor) {
    $actor = str_replace( "'", "", $actor);
   // if($actor[0]==" ") $actor = str_replace( " ", "", $actor,1);
      echo "actor :".$actor."<br>";
      if( exist_actor($actor,$cnnx) )  echo "EXIST";
      else create_actor($actor,$cnnx);

      $rqt =  "SELECT idactor FROM ACTOR where name like '%$actor%' ";
      $qry = mysqli_query($cnnx,$rqt) or die("execution requette");
      $last_actor = mysqli_fetch_object($qry);
      $idactor = $last_actor->idactor;
      $rqt = "INSERT INTO ACT(idactor,idmovie) VALUES($idactor,$idmovie)";
      echo "<br>".$rqt;
      $qry = mysqli_query($cnnx,$rqt) or die("[ERROR] [0x0004] execution requette");
  }


}



/*


DELETE FROM ACT where 1;
DELETE FROM ACTOR where 1;
DELETE FROM MOVIE where 1;

{"Title":"Pulp Fiction",
"Year":"1994",
"Rated":"R",
"Released":"14 Oct 1994",
"Runtime":"154 min",
"Genre":"Crime, Drama",
"Director":"Quentin Tarantino",
"Writer":"Quentin Tarantino (stories), Roger Avary (stories), Quentin Tarantino",
"Actors":"Tim Roth, Amanda Plummer, Laura Lovelace, John Travolta",
"Plot":"The lives of two mob hitmen, a boxer, a gangster and his wife, and a pair of diner bandits intertwine in four tales of violence and redemption.",
"Language":"English, Spanish, French",
"Country":"USA",
"Awards":"Won 1 Oscar. Another 68 wins & 74 nominations.",
"Poster":"https://m.media-amazon.com/images/M/MV5BNGNhMDIzZTUtNTBlZi00MTRlLWFjM2ItYzViMjE3YzI5MjljXkEyXkFqcGdeQXVyNzkwMjQ5NzM@._V1_SX300.jpg",
"Ratings":[{"Source":"Internet Movie Database","Value":"8.9/10"},{"Source":"Rotten Tomatoes","Value":"92%"},{"Source":"Metacritic","Value":"94/100"}],
"Metascore":"94",
"imdbRating":"8.9",
"imdbVotes":"1,710,921",
"imdbID":"tt0110912",
"Type":"movie",
"DVD":"19 May 1998",
"BoxOffice":"N/A",
"Production":"Miramax Films",
"Website":"N/A",
"Response":"True"}


*/
 ?>
