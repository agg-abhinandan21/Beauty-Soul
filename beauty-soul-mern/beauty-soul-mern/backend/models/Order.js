const mongoose = require("mongoose");

const orderSchema = new mongoose.Schema({
  items: Array,
  shippingAddress: Object,
  totalPrice: Number,
  shiprocketAWB: String,
  status: { type: String, default: "Processing" }
}, { timestamps: true });

module.exports = mongoose.model("Order", orderSchema);
