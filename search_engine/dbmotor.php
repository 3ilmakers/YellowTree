<?php
class motor
{

	public $cnnx;

	function __construct()
    {
		$this->cnnx  = new PDO('mysql:dbname=yellowtree;host=localhost', 'yellowtree', 'yellow');
    }

	function kill()
    {
		$this->cnnx = null;
    }



    //deamon side - write letter by letter from title
    function write_word()
    {
		$sql = $this->cnnx->prepare("SELECT idmovie, title FROM `MOVIE`");
		$sql->execute();
		$elems = $sql->fetchAll();
		echo "[OK] Fetching from MOVIE <br>";
		foreach ($elems as $elem) {
		//init
		$alpha_num = array('idmovie'=>0,'a' => 0,'b' => 0,'c' => 0,'d' => 0,'e' => 0,'f' => 0,'g' => 0,'h' => 0,'i' => 0,'j' => 0,'k' => 0,'l' => 0,'m' => 0,'n' => 0,'o' => 0,'p' => 0,'q' => 0,'r' => 0,'s' => 0,'t' => 0,'u' => 0,'v' => 0,'w' => 0,'x' => 0,'y' => 0,'z' => 0,'0' => 0,'1' => 0,'2' => 0,'3' => 0,'4' => 0,'5' => 0,'6' => 0,'7' => 0,'8' => 0,'9' => 0,'sum' =>0);
		//word
		$arr1 = str_split(strtolower($elem['title']." "));
		echo "<h2>".strtolower($elem['title'])."</h2>";
		$alpha_num['idmovie'] = $elem['idmovie'];
		foreach ($arr1 as $letter) {
			  if(ctype_alnum($letter) & $letter != " " ) {
				$alpha_num['sum']++;
				$alpha_num[$letter]++;
				echo $letter;
              }
              if( $letter == " ") {
                //$sqla = $this->cnnx->prepare("INSERT INTO `SEARCH` (`idmovie`,`a`,`b`,`c`,`d`,`e`,`f`,`g`,`h`,`i`,`j`,`k`,`l`,`m`,`n`,`o`,`p`,`q`,`r`,`s`,`t`,`u`,`v`,`w`,`x`,`y`,`z`,`0`,`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`sum` ) VALUES (:idmovie,:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q,:r,:s,:t,:u,:v,:w,:x,:y,:z,:0,:1,:2,:3,:4,:5,:6,:7,:8,:9,:sum)");
                //var_dump($sqla->execute($alpha_num));

               	$brute = "INSERT INTO `SEARCH` (`idmovie` , `a` , `b` , `c` , `d` , `e` , `f` , `g` , `h` , `i` , `j` , `k` , `l` , `m` , `n` , `o` , `p` , `q` , `r` , `s` , `t` , `u` , `v` , `w` , `x` , `y` , `z` , `0` , `1` , `2` , `3` , `4` , `5` , `6` , `7` , `8` , `9` , `sum` ) VALUES (";
                foreach ( $alpha_num as $k)     $brute = $brute." ".$k.", ";
                $brute[-2]=')';
                //echo $brute;
                $sqla = $this->cnnx->prepare($brute);
				if($sqla->execute())	echo "<span style='background:#000'><font color=#00FF>Ø</font></span>";
				else	echo "<span style='background:#000'><font color=#FF0000>Ø</font></span>";
				foreach($alpha_num as $k)	$k=0;
              }
          }
        }
    }

    //search ranking


}
