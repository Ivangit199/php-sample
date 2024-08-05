declare(strict_types=1);
function my_max(
array $xs
): int {
$maxValue = PHP_INT_MIN;

foreach ($xs as $value) {
if (is_array($value)) {
$subMaxValue = my_max($value);
$maxValue = max($maxValue, $subMaxValue);
} elseif (is_int($value)) {
$maxValue = max($maxValue, $value);
}
}

return $maxValue;
}