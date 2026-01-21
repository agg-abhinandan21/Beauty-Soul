require("dotenv").config();const express=require("express");const mongoose=require("mongoose");const cors=require("cors");
const app=express();app.use(cors());app.use(express.json());
mongoose.connect(process.env.MONGO_URI);
app.use("/api/auth",require("./routes/authRoutes"));
app.use("/api/products",require("./routes/productRoutes"));
app.use("/api/orders",require("./routes/orderRoutes"));
app.listen(5000,()=>console.log("API 5000"));