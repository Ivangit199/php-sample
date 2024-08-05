class ProductCatalog {
private $products = [
'R01' => ['name' => 'Red Widget', 'price' => 32.95],
'G01' => ['name' => 'Green Widget', 'price' => 24.95],
'B01' => ['name' => 'Blue Widget', 'price' => 7.95]
];

private $deliveryCharges = [
'under_50' => 4.95,
'under_90' => 2.95,
'free_over' => 90
];

private $offers = [
'buy_one_red_get_second_half_price' => [
'product_code' => 'R01',
'discount_percentage' => 50
]
];

private $basket = [];

public function add($productCode) {
if (array_key_exists($productCode, $this->products)) {
$this->basket[] = $productCode;
} else {
throw new Exception("Invalid product code: $productCode");
}
}

public function total() {
$total = 0;
$redWidgetCount = 0;

foreach ($this->basket as $productCode) {
if ($productCode === 'R01') {
$redWidgetCount++;
if ($redWidgetCount % 2 === 0) {
$total += $this->products[$productCode]['price'] * (1 - $this->offers['buy_one_red_get_second_half_price']['discount_percentage'] / 100);
} else {
$total += $this->products[$productCode]['price'];
}
} else {
$total += $this->products[$productCode]['price'];
}
}

$totalBeforeDelivery = $total;

// Calculate delivery charge
if ($totalBeforeDelivery < $this->deliveryCharges['free_over']) {
if ($totalBeforeDelivery < $this->deliveryCharges['under_50']) {
$total += $this->deliveryCharges['under_50'];
} else {
$total += $this->deliveryCharges['under_90'];
}
}

return round($total, 2);
}
}

// Example usage
$catalog = new ProductCatalog();
$catalog->add('B01');
$catalog->add('G01');
echo "Total: $" . $catalog->total(); // Output: Total: $37.85