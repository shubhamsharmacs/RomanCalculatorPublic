<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<form <?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> method="post">
  First Roman value:<br>
  <input type="text" name="firstname">
  <br>
  Second Roman Value:<br>
  <input type="text" name="lastname">
<br>
<input type="radio" name="operator" value="+"> Plus<br>
  <input type="radio" name="operator" value="-"> Minus<br>
  <input type="radio" name="operator" value="*"> Multiply<br>
  <input type="radio" name="operator" value="/"> Division<br>
  <br>
  
   <input type="submit" value="Submit">
   <p name="answer"></p>
</form>

<?php

// define variables and set to empty values
$numberr=$operatorerr="";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
$firstvalue;
$secondvalue;
$firstval;
$secondval;
$operator;
$iop;
  if (empty($_POST["firstname"]) and empty($_POST["lastname"])) {
    $nameErr = "Roman value in both boxes are required";
  } else {
    $firstval = test_input($_POST["firstname"]);
	$secondval = test_input($_POST["lastname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$firstval)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["operator"])) {
    $operatorErr = "operator is required";
  } else {
    $operator = test_input($_POST["operator"]);
  }
  $firstvalue=$firstval;
  $secondvalue=$secondval;
  $ifirst=RomanTointeger($firstvalue);
  $isecond=RomanTointeger($secondvalue);
  if($operator == "+") {
$iop=$ifirst + $isecond;
}
else if($operator == "-") {
$iop=$ifirst - $isecond;
}
else if($operator == "*") {
$iop=$ifirst * $isecond;
}

else if($operator == "/") {
$iop=$ifirst / $isecond;
}
if($iop == 0)
{
	echo "In Roman We have nothing for zero";
}
else
{
 ECHO '<p style="background-color:#FF0000;">RESULT IS  '.int2roman($iop).'</p>';
}
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
///int to roman
function int2roman($number)
{
	if (!is_int($number) || $number < 1) return false; // ignore negative numbers and zero
 
	$integers = array(900, 500,  400, 100,   90,  50,   40,  10,    9,   5,    4,   1);
	$numerals = array('CM', 'D', 'CD', 'C', 'XC', 'L', 'XL', 'X', 'IX', 'V', 'IV', 'I');
	$major = intval($number / 1000) * 1000;
	$minor = $number - $major;
	$numeral = $leastSig = '';
 
	for ($i = 0; $i < sizeof($integers); $i++) {
		while ($minor >= $integers[$i]) {
			$leastSig .= $numerals[$i];
			$minor  -= $integers[$i];
		}
	}
 
	if ($number >= 1000 && $number < 40000) {
		if ($major >= 10000) {
			$numeral .= '(';
			while ($major >= 10000) {
				$numeral .= 'X';
				$major -= 10000;
			}
			$numeral .= ')';
		}
		if ($major == 9000) {
			$numeral .= 'M(X)';
			return $numeral . $leastSig;
		}
		if ($major == 4000) {
			$numeral .= 'M(V)';
			return $numeral . $leastSig;
		}
		if ($major >= 5000) {
			$numeral .= '(V)';
			$major -= 5000;
		}
		while ($major >= 1000) {
			$numeral .= 'M';
			$major -= 1000;
		}
	}
 
	if ($number >= 40000) {
		$major = $major/1000;
		$numeral .= '(' . int2roman($major) . ')';
	}
 
	return $numeral . $leastSig;
}
////roman to integer

function RomanTointeger($rom)
{
$romans = array( 'M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
 $roman = $rom;
 $result = 0; 
 foreach ($romans as $key => $value) 
 { while (strpos($roman, $key) === 0) 
 { $result += $value; $roman = substr($roman, strlen($key)); } 
 } 
 return $result;
}

?>

</body>
</html>
<html>
<body>

<form>