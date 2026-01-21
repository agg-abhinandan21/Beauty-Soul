const express = require("express");
const {
  createOrder,
  getAllOrders,
  trackOrder
} = require("../controllers/orderController");

const router = express.Router();

router.post("/", createOrder);
router.get("/", getAllOrders);
router.get("/track/:awb", trackOrder);

module.exports = router;
