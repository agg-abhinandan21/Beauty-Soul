const Order = require("../models/Order");
const axios = require("axios");
const { getShiprocketToken } = require("../utils/shipRocket");

exports.createOrder = async (req, res) => {
  const order = await Order.create(req.body);

  const token = await getShiprocketToken();

  const shipData = {
    order_id: order._id.toString(),
    order_date: new Date(),
    pickup_location: "Primary",
    billing_customer_name: "Customer",
    billing_address: req.body.shippingAddress.address,
    billing_city: req.body.shippingAddress.city,
    billing_pincode: req.body.shippingAddress.pincode,
    billing_state: req.body.shippingAddress.state,
    billing_country: "India",
    billing_phone: req.body.shippingAddress.phone,
    payment_method: "Prepaid",
    order_items: req.body.items
  };

  const response = await axios.post(
    "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
    shipData,
    { headers: { Authorization: `Bearer ${token}` } }
  );

  order.shiprocketAWB = response.data.shipment_id;
  await order.save();

  res.json(order);
};

exports.getAllOrders = async (req, res) => {
  const orders = await Order.find().sort({ createdAt: -1 });
  res.json(orders);
};

exports.trackOrder = async (req, res) => {
  const token = await getShiprocketToken();
  const response = await axios.get(
    `https://apiv2.shiprocket.in/v1/external/courier/track?awb=${req.params.awb}`,
    { headers: { Authorization: `Bearer ${token}` } }
  );
  res.json(response.data);
};
