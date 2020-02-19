<?php
    function formatTitle($title){
        $title = strtolower($title);
        return str_replace(" ", "-", $title);
    }

    echo formatTitle("OnCe Upon A Time In Hollywood");

$upcoming = file_get_contents("http://api.traileraddict.com/?film=".formatTitle("OnCe Upon A Time In Hollywood"));
print_r($upcoming);

