const O=require('../models/Order');const {createShipment,track}=require('../utils/shiprocket');
exports.create=async(req,res)=>res.json(await O.create(req.body));exports.all=async(req,res)=>res.json(await O.find());
exports.ship=async(req,res)=>{const o=await O.findById(req.params.id);const s=await createShipment(o);o.shipmentId=s.shipment_id;o.status='Shipped';await o.save();res.json(s);}
exports.trackOrder=async(req,res)=>{const o=await O.findById(req.params.id);if(!o||!o.shipmentId) return res.status(404).send('Not shipped');res.json(await track(o.shipmentId));}