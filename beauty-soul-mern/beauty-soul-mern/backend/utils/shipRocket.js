const axios = require("axios");

async function getShiprocketToken() {
  const res = await axios.post(
    "https://apiv2.shiprocket.in/v1/external/auth/login",
    {
      email: process.env.SR_EMAIL,
      password: process.env.SR_PASSWORD
    }
  );
  return res.data.token;
}

module.exports = { getShiprocketToken };
