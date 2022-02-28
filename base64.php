#!/usr/bin/env php
<?php

/*
Base64 implementation in PHP
Author: Nicholas Ferreira
27/02/2022
*/

//base64 alphabet [A-Za-z0-9+/]
$charset = array_merge(range("A", "Z"),range("a","z"),range(0,9),["+","/"]);

///returns $str in binary
function str2bin($str){
	$bin = "";
	for($i=0;$i<strlen($str);$i++)
		$bin .= str_pad(decbin(ord($str[$i])),8,"0",STR_PAD_LEFT);
	return $bin;
}

///does the same as base64_encode()
function encode($str){
	global $charset;
	if(!strlen($str)) return;
	$str = str_split(str2bin($str), 6);
	$encoded = "";
	foreach($str as $byte)
		if(strlen($byte) < 6) //add binary padding when needed
			$encoded .= $charset[bindec(str_pad($byte, 6, "0", STR_PAD_RIGHT))];
		else
			$encoded .= $charset[bindec($byte)];

	//add padding with '=' until strlen($encoded)%4 == 0
	$pad = 4 - strlen($encoded) % 4;
	$pad = $pad == 4 ? 0 : $pad;

	return $encoded.str_repeat("=", $pad);
}

///does the same as base64_decode()
function decode($str){
	global $charset;
	if(!strlen($str)) return;
	$sextets = "";
	//build the sextets
	for($i=0;$i<strlen($str);$i++)
		if($str[$i] !== "=")
			$sextets .= str_pad(decbin(array_search($str[$i],$charset)),6,"0",STR_PAD_LEFT);

	//recover octets from sextets
	$oct_arr = str_split($sextets,8);
	$decoded = "";
	foreach($oct_arr as $octet)
		if(strlen($octet) == 8)
			$decoded .= chr(bindec($octet));

	return $decoded;
}

///testing (stop on error)
/*
while(1){
	for($i=0;$i<9999999;$i++){
		echo "======".$i."======\n";
		$random = exec("head /dev/urandom | tr -dc A-Za-z0-9 | head -n $i");

		$a =  base64_encode($random);
		$b =  encode($random);

		$c = base64_decode($b);
		$d = decode($b);

		if($a != $b)
			die("Error:\nA:$a\nB:$b");
		if($c != $d)
			die("Error2:\nC:$c\nD:$d\n".strlen($c)." ".strlen($d));
	}
}
*/
