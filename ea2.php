<?
echo "<font size=1 face=Arial>";

$width = $_POST['width'];
$step = $_POST['step'];
$rule = $_POST['rule'];
$type = $_POST['ptype'];
$color_star = $_POST['color_star'];
$color_space = $_POST['color_space'];
$block = $_POST['block'];

function valNum($n){
	return preg_match('/\\A[0-9]*\\z/', $n);
}

function valRange($n,$min,$max){
	return ($min <= $n && $n <= $max);
}

function printArray($n,$a,$s,$dc,$sc,$block){
	switch($n){
		case 1:
			print1($a,$s);
			break;
		case 2:
			print2($a,$s);
			break;
		case 3:
			print3($a,$s,$dc,$sc,$block);
			break;
	}	
}

function print1($a,$s){
	for($i=0;$i<$s;$i++){
		echo $a[$i];
	}
	echo "<br>";
}

function print2($a,$s){
	for($i=0;$i<$s;$i++){
		if($a[$i] == 1){
			echo "*";
		}else{
			echo "&nbsp;";
		}
	}
	echo "<br>";
}

function print3($a,$s,$dc,$sc,$block){
	echo "<tr>";
	for($i=0;$i<$s;$i++){
		if($a[$i]==1){
			echo "<td bgcolor=$dc width=$block height=$block></td>";
		}else{
			echo "<td bgcolor=#$sc width=$block height=$block></td>";
		}
	}
	echo "</tr>";
}

if(valNum($width)){
	echo "Width: $width <br>";
}else{
	echo "Width Error <br>";
}

if(valNum($step)){
	echo "Step: $step <br>";
}else{
	echo "Step Error <br>";
}

if(valNum($rule)&&valRange($rule,0,255)){
	echo "Rule: $rule <br>";
}else{
	echo "Rule Error <br>";
}

echo "Print: $type <br>";

$bin = decbin($rule);
$bin = substr("00000000",0,8 - strlen($bin)) . $bin;
echo "Binary: $bin <br>";

echo "</font><hr><font size=1 face=Courier>";

$a[$width];
$b[$width];

for($i=0;$i<$width;$i++){
	$a[$i] = 0;
}

$middle = floor(($width-1)/2);
$a[$middle] = 1;

for($k=0;$k<8;$k++) $r[$k] = $bin[$k];

for($k=0;$k<$step;$k++){
	if($type==3) echo "<table border=0 cellspacing=0 cellpadding=0>";
	printArray($type,$a,$width,$color_star,$color_space,$block);
	if($type==3) echo "</table>";
	
	$b[0]= $a[0];
	$b[$width] = $a[$width];
	for($j=1;$j<$width-1;$j++)
		$b[$j]=$r[4*$a[$j-1]+2*$a[$j]+1*$a[$j+1]];

	for($i=0;$i<$width;$i++)
	{
		$a[$i] = $b[$i];
	}
}


echo "</font>";
?>