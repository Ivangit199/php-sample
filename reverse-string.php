function my_rev($str) {
$len = strlen($str);
$result = "";

//insert from the last to the first
for ($i = $len - 1; $i >= 0; $i--) {
$result .= $str[$i];
}
return $result;
}