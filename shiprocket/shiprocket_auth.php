<?php
include "config.php";

function getShiprocketToken() {
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
        CURLOPT_POSTFIELDS => json_encode([
            "email" => SHIPROCKET_EMAIL,
            "password" => SHIPROCKET_PASSWORD
        ])
    ]);

    $response = curl_exec($curl);
    curl_close($curl);

    $data = json_decode($response, true);
    return $data["token"] ?? null;
}
?>
