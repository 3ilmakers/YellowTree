<?php

include '../dbconnect.php';
class movie
{

    public $title;
    public $releaseyear;
    public $posterurl;
    public $synopsis;
    public $runtime;
    public $genre;
    public $director;
    public $production;

    function __construct($title, $releaseyear, $posterurl, $synopsis, $runtime, $genre, $director, $production)
    {
        $this->title = $title;
        $this->releaseyear = $releaseyear;
        $this->posterurl = $posterurl;
        $this->synopsis = $synopsis;
        $this->runtime = $runtime;
        $this->genre = $genre;
        $this->director = $director;
        $this->production = $production;
    }

    function post()
    {
        print_r($this);
        $cnnx = new connection();
        $cnnx->addMovie($this->title, $this->releaseyear, $this->posterurl, $this->synopsis, $this->runtime, $this->genre, $this->director, $this->production);
        $cnnx->kill();
        header('location: ../index.php');
    }
}
    if (isset($_POST['title'])) {
        $title = $_POST['title'];

        if (isset($_POST['releaseyear'])) {
            $releaseyear = $_POST['releaseyear'];

            if (isset($_POST['posterurl'])) {
                $posterurl = $_POST['posterurl'];

                if (isset($_POST['synopsis'])) {
                    $synopsis = $_POST['synopsis'];

                    if (isset($_POST['runtime'])) {
                        $runtime = $_POST['runtime'];

                        if (isset($_POST['genre'])) {
                            $genre = $_POST['genre'];

                            if (isset($_POST['director'])) {
                                $director = $_POST['director'];

                                if (isset($_POST['production'])) {
                                    $production = $_POST['production'];
                                    if ($title != null && $releaseyear != null && $posterurl != null && $synopsis != null  && $runtime != null && $genre != null && $director != null && $production != null) {
                                        $movie = new movie($title, $releaseyear, $posterurl, $synopsis, $runtime, $genre, $director, $production);
                                        $movie->post();
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }




    ?>
