<?php 


echo encrypt("Boa noite, Mestre Jaga.");
echo "<br><br>";
echo decrypt("Qm9hIG5vaXRlLCBNZXN0cmUgSmFnYS4");


// ===============================================================

$chars = array(
"0" => "A", "1" => "B", "2" => "C", "3" => "D", "4" => "E", "5" => "F", "6" => "G", "7" => "H", "8" => "I", "9" => "J", "10" => "K", "11" => "L", "12" => "M", "13" => "N", "14" => "O", "15" => "P", "16" => "Q", "17" => "R", "18" => "S", "19" => "T", "20" => "U", "21" => "V", "22" => "W", "23" => "X", "24" => "Y", "25" => "Z", "26" => "a", "27" => "b", "28" => "c", "29" => "d", "30" => "e", "31" => "f", "32" => "g", "33" => "h", "34" => "i", "35" => "j", "36" => "k", "37" => "l", "38" => "m", "39" => "n", "40" => "o", "41" => "p", "42" => "q", "43" => "r", "44" => "s", "45" => "t", "46" => "u", "47" => "v", "48" => "w", "49" => "x", "50" => "y", "51" => "z", "52" => "0", "53" => "1", "54" => "2", "55" => "3", "56" => "4", "57" => "5", "58" => "6", "59" => "7", "60" => "8", "61" => "9", "62" => "+", "63" => "/"
);
	 
function encrypt($str,  $perm = 0){
	global $chars;
	$xars = permuta($perm);
	$tamanho = strlen($str);
	$bin = "";
	$resultado = "";
	while($tamanho--){
		$bin = str_pad(decbin(ord($str[$tamanho])), 8, "0", STR_PAD_LEFT).$bin;
	}
	$teste = str_split($bin, 6);
	for($i=0;$i<=count($teste)-1;$i++){
		$resultado .= $xars[bindec(str_pad($teste[$i], 6, "0", STR_PAD_RIGHT))]; 
	}
	return ($resultado);//
}

function decrypt($str, $perm = 0){
	global $chars;
	$xars = permuta($perm);
	$chrs = str_split($str, 1); //
	$nums = "";
	$retorno = "";
	$bin = "";
	for($i=0;$i<=count($chrs)-1;$i++){
		foreach(($xars) as $key => $valor){ 
			if($chrs[$i] == $valor){
				$nums .= $key." ";
			}
		}
	}
	$nums = explode(" ", $nums);
	for($i=0;$i<=count($nums)-1;$i++){
		$bin .= str_pad(decbin($nums[$i]), 6, "0", STR_PAD_LEFT)." ";
	}
	$abc = str_split(str_replace(" ", "", $bin), 8);
	for($i=0;$i<=count($abc)-1;$i++){
		$retorno .= chr(bindec($abc[$i]));
	}
	return $retorno;
}

function permuta($nums, $direita = true){
	$letras = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z", "0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "+", "/");
	$novo = array();
	$permcoes = $nums;
	if($permcoes < 0){
		$permcoes = 64 + $permcoes;
	}
	for($i=0;$i<=64;$i++){
		if($i+$permcoes >= 64){
			$k = $i+$permcoes-64;
			$novo[(64-$k)] = $letras[$k];
		}else{
			$novo[$i] = $letras[$i+$permcoes];
		}
	}
	//sort($novo);
	return $novo;
}
?>
