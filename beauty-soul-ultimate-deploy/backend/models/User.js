const mongoose=require('mongoose');const bcrypt=require('bcryptjs');
const s=new mongoose.Schema({email:String,password:String,role:{type:String,default:'user'}});
s.pre('save',async function(){if(this.isModified('password')) this.password=await bcrypt.hash(this.password,10)});
module.exports=mongoose.model('User',s);