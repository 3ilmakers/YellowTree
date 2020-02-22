<?php
    function formatTitle($title){
        $title = strtolower($title);
        return str_replace(" ", "-", $title);
    }

    echo formatTitle("u");

$upcoming = file_get_contents("https://api.themoviedb.org/3/search/movie?api_key=7b457abe8149f666a244bf5b9f51d79b&query=".formatTitle("forrest gump"));
print_r($upcoming);

