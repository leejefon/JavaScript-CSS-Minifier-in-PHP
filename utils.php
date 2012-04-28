<?php

	function startsWith($haystack, $needle) {
    	$length = strlen($needle);
	    return (substr($haystack, 0, $length) === $needle);
	}

	function endsWith($haystack, $needle) {
		$length = strlen($needle);
		$start  = $length * -1; //negative
		return (substr($haystack, $start) === $needle);
	}

	function getBase($str) {
		$str = explode("?", $str);
		$str = explode("#", $str[0]);

		$str1 = explode("/", $str[0]);
		$res = str_replace($str1[count($str1) - 1], "", $str[0]);
		$res = str_replace($str1[0], "", $res);
		$res = str_replace($str1[1], "", $res);
		$res = str_replace($str1[2], "", $res);
		$res = str_replace("///", "", $res);
		return $res;
	}

/*
	$test1 = "http://leejefon.com/code/hello/world/";
	$test2 = "http://leejefon.com/code/hello/world/demo.php";
	$test3 = "http://leejefon.com/code/hello/world/demo.php?url=/jjiweji/jie/";
	$test4 = "http://leejefon.com/code/hello/world/demo.php?url=/jiejiejie/jiejie.php";
	$test5 = "http://leejefon.com/code/hello/world/demo.php#helloworld";

	header("content-type: text/plain");

	echo getBase($test1) . "\n";
	echo getBase($test2) . "\n";
	echo getBase($test3) . "\n";
	echo getBase($test4) . "\n";
	echo getBase($test5) . "\n";
*/

/*
	function bgurl($str) {
		$pattern = '/url\((?!http)(?!\'http)(?!\"http)(\"|\')?/';
		$replacement = 'url(\1/';
		return preg_replace($pattern, $replacement, $str);
	}

	$test1 = "background-image: url(image/bg.jpg);";
	$test2 = "background-image: url('image/bg.jpg');";
	$test3 = "background-image: url(\"image/bg.jpg\");";

	$test4 = "background-image: url(http://leejefon.com);";
	$test5 = "background-image: url('http://leejefon.com');";
	$test6 = "background-image: url(\"http://leejefon.com\");";

	header("content-type: text/plain");
	echo bgurl($test1) . "\n";
	echo bgurl($test2) . "\n";
	echo bgurl($test3) . "\n";
	echo bgurl($test4) . "\n";
	echo bgurl($test5) . "\n";
	echo bgurl($test6) . "\n";
*/
?>
