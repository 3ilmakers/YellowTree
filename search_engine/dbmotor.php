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
    
    function alpha_num_clear() {
    	return array(':a'=> 0,':b'=> 0,':c'=> 0,':d'=> 0,':e'=> 0,':f'=> 0,':g'=> 0,':h'=> 0,':i'=> 0,':j'=> 0,':k'=> 0,':l'=> 0,':m'=> 0,':n'=> 0,':o'=> 0,':p'=> 0,':q'=> 0,':r'=> 0,':s'=> 0,':t'=> 0,':u'=> 0,':v'=> 0,':w'=> 0,':x'=> 0,':y'=> 0,':z'=> 0,':0'=> 0,':1'=> 0,':2'=> 0,':3'=> 0,':4'=> 0,':5'=> 0,':6'=> 0,':7'=> 0,':8'=> 0,':9'=> 0,':sum'=>0);
    }

    //deamon side - write letter by letter from title
    function write_word()
    {
		$sql = $this->cnnx->prepare("SELECT idmovie, title FROM `MOVIE`");
		if($sql->execute()) echo "<br><span style='background:#000'><font color=#00FF>[OK] Fetching from SEARCH</font></span><br>";
		else echo "<br><span style='background:#000'><font color=#FF0000>[FAIL] Fetching from SEARCH</font></span><br>";
		$elems = $sql->fetchAll();
		foreach ($elems as $elem) {
			//init
			$alpha_num = $this->alpha_num_clear();
			//word
			$arr1 = str_split(strtolower($elem['title']." "));
			echo "<h2>".strtolower($elem['title'])."</h2>";
			
			foreach ($arr1 as $letter) {
				  $alpha_num[':idmovie'] = $elem['idmovie'];
				  if(ctype_alnum($letter) & $letter != " " ) 
				  {
					$alpha_num[':sum']++;
					$alpha_num[':'.$letter]++;
					echo $letter;
		          }
		          if( $letter == " ") 
		          {
		          	var_dump($alpha_num);
		            $sqla = $this->cnnx->prepare("INSERT INTO `SEARCH` (`idmovie`,`a`,`b`,`c`,`d`,`e`,`f`,`g`,`h`,`i`,`j`,`k`,`l`,`m`,`n`,`o`,`p`,`q`,`r`,`s`,`t`,`u`,`v`,`w`,`x`,`y`,`z`,`0`,`1`,`2`,`3`,`4`,`5`,`6`,`7`,`8`,`9`,`sum` ) VALUES (:idmovie,:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k,:l,:m,:n,:o,:p,:q,:r,:s,:t,:u,:v,:w,:x,:y,:z,:0,:1,:2,:3,:4,:5,:6,:7,:8,:9,:sum)");
		            $state = $sqla->execute($alpha_num);
					
					print_r($sqla->errorInfo());
					if($state)	echo "<span style='background:#000'><font color=#00FF00>Ø</font></span>";
					else	echo "<span style='background:#000'><font color=#FF0000>Ø</font></span>";
					$alpha_num = $this->alpha_num_clear();
		          }
          	}
        }
    }

    //search matching title
	function search_word($word,$max=5,$details=0) 
	{
		//echo "<h2>searching word is ".strtolower($word)."</h2>";
		//init
		$alpha_num = $this->alpha_num_clear();
		
		//prepare search word
		$arr1 = str_split(strtolower($word." "));
	
		$output = array();
		foreach ($arr1 as $letter) 
		{
			if(ctype_alnum($letter) & $letter != " " ) 
			{
				$alpha_num[':sum']++;
				$alpha_num[':'.$letter]++;
				//echo $letter;
            }
			if( $letter == " ") {
				$req = "SELECT idmovie, `a`-:a as `a`, `b`-:b as `b`, `c`-:c as `c`, `d`-:d as `d`, `e`-:e as `e`, `f`-:f as `f`, `g`-:g as `g`, `h`-:h as `h`, `i`-:i as `i`, `j`-:j as `j`, `k`-:k as `k`, `l`-:l as `l`, `m`-:m as `m`, `n`-:n as `n`, `o`-:o as `o`, `p`-:p as `p`, `q`-:q as `q`, `r`-:r as `r`, `s`-:s as `s`, `t`-:t as `t`, `u`-:u as `u`, `v`-:v as `v`, `w`-:w as `w`, `x`-:x as `x`, `y`-:y as `y`, `z`-:z as `z`, `0`-:0 as `0`, `1`-:1 as `1`, `2`-:2 as `2`, `3`-:3 as `3`, `4`-:4 as `4`, `5`-:5 as `5`, `6`-:6 as `6`, `7`-:7 as `7`, `8`-:8 as `8`, `9`-:9 as `9`,".
				"abs(`a`-:a)+abs(`b`-:b)+abs(`c`-:c)+abs(`d`-:d)+abs(`e`-:e)+abs(`f`-:f)+abs(`g`-:g)+abs(`h`-:h)+abs(`i`-:i)+abs(`j`-:j)+abs(`k`-:k)+abs(`l`-:l)+abs(`m`-:m)+abs(`n`-:n)+abs(`o`-:o)+abs(`p`-:p)+abs(`q`-:q)+abs(`r`-:r)+abs(`s`-:s)+abs(`t`-:t)+abs(`u`-:u)+abs(`v`-:v)+abs(`w`-:w)+abs(`x`-:x)+abs(`y`-:y)+abs(`z`-:z)+abs(`0`-:0)+abs(`1`-:1)+abs(`2`-:2)+abs(`3`-:3)+abs(`4`-:4)+abs(`5`-:5)+abs(`6`-:6)+abs(`7`-:7)+abs(`8`-:8)+abs(`9`-:9) as `possum`,".
				"abs(`sum`-:sum) as `neosum`, `sum` as `origsum` ".
				"FROM `SEARCH` ORDER BY `possum`+`neosum`  ASC LIMIT ".$max;
				
				$sql = $this->cnnx->prepare($req);
				$state = $sql->execute($alpha_num);
				/*if($state) echo "<br><span style='background:#000'><font color=#00FF>[OK] Fetching from SEARCH</font></span><br>";
				else echo "<br><span style='background:#000'><font color=#FF0000>[FAIL] Fetching from SEARCH</font></span><br>";*/
				$elems = $sql->fetchAll();
				//foreach($elems as $elem)	echo $elem['idmovie']."possum=".$elem['possum'].";neosum=".$elem['neosum']."<br>";
				foreach($elems as $elem)	$output[] = $elem['idmovie'];
			}
		}
		if($details == 0)	return $output;
		else	return $elems;
	}
	
	function search_presentation($word,$max=5) 
	{
		$out = array();
		$elems = $this->search_word($word,$max);
		foreach ( $elems as $elem ) 
		{
			$sql = $this->cnnx->prepare("SELECT * FROM `MOVIE` WHERE idmovie=:idmovie");
			$state = $sql->execute([':idmovie' => $elem]);
			/*if($state) echo "<br><span style='background:#000'><font color=#00FF>[OK] Fetching from MOVIE</font></span><br>";
			else echo "<br><span style='background:#000'><font color=#FF0000>[FAIL] Fetching from MOVIE</font></span><br>";*/
			$out[] = $sql->fetchAll();
			
		}
		return $out;
	}
}
