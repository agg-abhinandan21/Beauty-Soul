<?php
include "shiprocket_auth.php";

$token = getShiprocketToken();
if (!$token) {
   die("Token error");
}

$order = [
  "order_id" => "BS".time(),
  "order_date" => date("Y-m-d"),
  "pickup_location" => "Primary",

  "billing_customer_name" => $_POST["name"],
  "billing_last_name" => "",
  "billing_address" => $_POST["address"],
  "billing_city" => $_POST["city"],
  "billing_pincode" => $_POST["pincode"],
  "billing_state" => $_POST["state"],
  "billing_country" => "India",
  "billing_email" => $_POST["email"],
  "billing_phone" => $_POST["phone"],

  "payment_method" => "COD",

  "order_items" => [
    [
      "name" => "Beauty & Soul Product",
      "sku" => "BS001",
      "units" => 1,
      "selling_price" => 299
    ]
  ]
];

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_POST => true,
  CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "Authorization: Bearer $token"
  ],
  CURLOPT_POSTFIELDS => json_encode($order)
]);

$response = curl_exec($curl);
curl_close($curl);

echo $response;
?>
