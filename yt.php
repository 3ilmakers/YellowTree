<?php
/*youtube trailer API (c)Philippe KREJCI*/	
	function yt_trailer_kern($search) 
    {
		$search = str_replace(' ','+',$search);
		$search = str_replace('\'s','',$search);
		$wget = file_get_contents('https://www.google.fr/search?q=trailer+'.$search);

		$words = explode('https://www.youtube.com/watch?v=', $wget);
		$words = explode(' ', $words[1]);
		$words = explode('</div>', $words[0]);
		return $words[0];
	}
	
	function yt_trailer($title) {
		$codeyt = yt_trailer_kern($title);
		if( strlen($codeyt) > 12 | strlen($codeyt) < 1 )		$codeyt = yt_trailer_kern('trailer+'.$title);
		return 'https://www.youtube.com/embed/'.$codeyt;
	}
?>
