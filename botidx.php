<?php

/* create telegram bot webhook */

$data = file_get_contents('https://indodax.com/api/tickers');
$json = json_decode($data, true);
$TOKEN = "5016685464:AAGd9FG-F7ddTvEh5NEaoe6XUV3hPH34aLY";
$apiURL = "https://api.telegram.org/bot$TOKEN";
$update = json_decode(file_get_contents("php://input"), TRUE);
$chatID = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$token = $message;

if ($json['tickers'][$token] > 0) {
  $harga = $json['tickers'][$token]['last'];
  $pair = explode("_", $message);
  file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Harga " . $message . " di INDODAX saat ini adalah " . number_format($harga, 0) . " " . strtoupper($pair[1]));
} else {
  return false;
}

//if (strpos($message, "/BTCIDR") === 0) {
//  $hargacoin = file_get_contents('https://www.digiassetindo.com/api/v2/exchange/coinmarketcap/summary');
//  $json = json_decode($hargacoin, TRUE);
//  $keterangan = $json[0]["trading_pairs"];
//  $price = $json[0]["last_price"];
//  file_get_contents($apiURL . "/sendmessage?chat_id=" . $chatID . "&text=Harga " . $keterangan . " di Digiasset saat ini adalah " . $price);
//}
