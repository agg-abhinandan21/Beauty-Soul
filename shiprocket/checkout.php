<!DOCTYPE html>
<html>
<head>
<title>Checkout | Beauty & Soul</title>
</head>
<body>

<h2>Checkout</h2>

<form method="POST" action="create_order.php">
<input name="name" placeholder="Name" required><br><br>
<input name="email" placeholder="Email" required><br><br>
<input name="phone" placeholder="Phone" required><br><br>
<input name="address" placeholder="Address" required><br><br>
<input name="city" placeholder="City" required><br><br>
<input name="state" placeholder="State" required><br><br>
<input name="pincode" placeholder="Pincode" required><br><br>

<input name="product" value="Beauty & Soul Combo Pack" hidden>
<input name="total" value="1347" hidden>

<select name="payment_method">
    <option value="COD">Cash on Delivery</option>
    <option value="Prepaid">Online Payment</option>
</select><br><br>

<button type="submit">Place Order</button>
</form>

</body>
</html>
