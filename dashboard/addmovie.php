<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <?php 
    
    class movie{
        public $idmovie;
        public $title;
        public $releaseyear;
        public $posterurl;
        public $synopsis;
        public $runtime;
        public $genre;
        public $director;
        public $production;

       function __construct($idmovie,$title,$releaseyear,$posterurl,$synopsis,$runtime,$genre,$director,$production){
           $this->idmovie = $idmovie;
           $this->title = $title;
           $this->releaseyear = $releaseyear;
           $this->posterurl = $posterurl;
           $this->synopsis = $synopsis;
           $this->runtime = $runtime;
           $this->genre = $genre;
           $this->director = $director;
           $this->production = $production;
           
           

        }
    }
    
    
    ?>
</body>
</html>