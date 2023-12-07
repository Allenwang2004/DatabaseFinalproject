<?php
// 取得 API 金鑰
$apiKey = getenv("API_KEY");

// 從 Google Maps API 取得數據
$url = "https://maps.googleapis.com/maps/api/js?key=" . $apiKey . "&libraries=geometry";
$response = file_get_contents($url);

// 將數據返回給客戶端
header("Content-Type: application/javascript");
echo $response;
?>