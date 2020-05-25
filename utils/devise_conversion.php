<?php

function moneyConvert($money, $source, $target)
{
    $url = 'json/devise.json';
    $data = file_get_contents($url);
    $infosApi = json_decode($data, true);

// Initialize CURL:
    $ch = curl_init('http://api.currencies.zone/v1/quotes/' . $source . '/' . $target . '/' . $infosApi['format'] . '?quantity=' . $infosApi['qte'] . '&key=' . $infosApi['key'] . '');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Store the data:
    $json = curl_exec($ch);
    curl_close($ch);

// Decode JSON response:
    $exchangeRates = json_decode($json, true);

// Return result
    return round($exchangeRates['result']['value'] * $money, 2);
}

