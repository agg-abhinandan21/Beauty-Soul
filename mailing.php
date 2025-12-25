<?php
header("Content-Type: application/json");

// Get raw JSON data
$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
  echo json_encode(["status" => "error", "message" => "Invalid data"]);
  exit;
}

// ---------------- BASIC DATA ----------------
$adminEmail = "agglucky779@gmail.com"; // 🔴 apna email daalo
$siteName = "Beauty & Soul";

$email = htmlspecialchars($data["email"]);
$name = htmlspecialchars($data["firstName"] . " " . $data["lastName"]);
$phone = htmlspecialchars($data["phone"]);
$address = htmlspecialchars(
  $data["address"] . ", " .
  $data["address2"] . ", " .
  $data["city"] . ", " .
  $data["state"] . " - " .
  $data["zip"] . ", " .
  $data["country"]
);

$paymentMethod = htmlspecialchars($data["paymentMethod"]);
$cartItems = $data["cartItems"];
$shipping = (int)$data["shippingCharge"];

// ---------------- CALCULATE TOTAL ----------------
$subtotal = 0;
$orderLines = "";

foreach ($cartItems as $item) {
  $lineTotal = $item["price"] * $item["qty"];
  $subtotal += $lineTotal;

  $orderLines .= "- {$item['name']} (Qty: {$item['qty']}) – ₹{$lineTotal}\n";
}

$total = $subtotal + $shipping;

// ---------------- ADMIN EMAIL ----------------
$adminSubject = "🛒 New Order Received – $siteName";

$adminMessage = "
New Order Received 🔥

Customer Name: $name
Email: $email
Phone: $phone

Address:
$address

Payment Method: $paymentMethod

Order Details:
$orderLines

Subtotal: ₹$subtotal
Shipping: ₹$shipping
Total: ₹$total
";

$headers = "From: $siteName <no-reply@$siteName.com>";

// ---------------- USER EMAIL ----------------
$userSubject = "✅ Order Confirmed – $siteName";

$userMessage = "
Hi $name 👋

Thank you for your order from $siteName!

🛍 Order Summary:
$orderLines

Subtotal: ₹$subtotal
Shipping: ₹$shipping
Total: ₹$total

Payment Method: $paymentMethod

Your order will be processed soon.
If you have any questions, just reply to this mail.

💖 Team $siteName
";

// ---------------- SEND EMAILS ----------------
$adminSent = mail($adminEmail, $adminSubject, $adminMessage, $headers);
$userSent  = mail($email, $userSubject, $userMessage, $headers);

if ($adminSent && $userSent) {
  echo json_encode(["status" => "ok"]);
} else {
  echo json_encode(["status" => "error", "message" => "Email failed"]);
}
