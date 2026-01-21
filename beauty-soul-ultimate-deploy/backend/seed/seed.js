require('dotenv').config();const mongoose=require('mongoose');const User=require('../models/User');const Product=require('../models/Product');
(async()=>{await mongoose.connect(process.env.MONGO_URI);await User.deleteMany({});await Product.deleteMany({});
await User.create({email:'admin@beautysoul.com',password:'Admin@123',role:'admin'});
await Product.insertMany([{name:'Ubtan Face Scrub',price:499,image:'https://images.unsplash.com/photo-1522335789203-aabd1fc54bc9'}]);
console.log('Seeded');process.exit();})();