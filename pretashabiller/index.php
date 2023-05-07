<?php

$current_time = date("h:i");
$current_date = date("Y/m/d");

// Récupérer les données JSON depuis l'API OpenMeteo
$json_data = file_get_contents('https://api.open-meteo.com/v1/forecast?latitude=43.55&longitude=7.01&hourly=temperature_2m,weathercode,uv_index,is_day&daily=uv_index_max&start_date=2023-05-07&end_date=2023-05-07&timezone=auto');

// Convertir les données JSON en tableau PHP associatif
$data = json_decode($json_data, true);

// Récupérer les données de température, code météorologique, indice UV et jour/nuit pour chaque heure de la journée
$hourly_data = $data['hourly'];

// Parcourir les données de chaque heure et les stocker dans un tableau
$table_data = [];
foreach ($hourly_data['time'] as $index => $heure) {
    $temperature = $hourly_data['temperature_2m'][$index];
    $indice_uv = $hourly_data['uv_index'][$index];
    $jour_nuit = $hourly_data['is_day'][$index] ? 'Jour' : 'Nuit';
    $formated_hour = substr($heure, 11, 2);
    if ((int)$formated_hour >= 6 && (int)$formated_hour <= 21){
        $time_format = ' h';
        $table_data[] = [
            'heure' => $formated_hour.$time_format,
            'temperature' => $temperature,
            'indice_uv' => $indice_uv,
            'jour_nuit' => $jour_nuit
        ];
    }
}

// Inclure le code HTML de l'en-tête et du corps
include 'header.php';
include 'body.php';
include 'tryme.php';
?>