<?php
// Vérifier si le paramètre GET pour la ville existe
if (isset($_GET['ville'])) {

    // Récupérer la ville à partir du paramètre GET
    $ville = $_GET['ville'];

    // Construire l'URL de l'API OpenMeteo en utilisant la ville spécifiée
    //$url = "https://api.open-meteo.com/v1/forecast?city=" . urlencode($ville) . "&hourly=temperature_2m";
    $url ="https://api.open-meteo.com/v1/forecast?latitude=43.55&longitude=7.01&hourly=temperature_2m";
    // debug
    echo $url;
    // Envoyer une requête HTTP GET à l'API OpenMeteo
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);

    // Convertir la réponse JSON en tableau associatif
    $json = json_decode($response, true);

    // Récupérer la température à deux mètres
    $temperature = $json['hourly'][0]['temperature_2m'];

    // Afficher la température
    echo "La température à deux mètres pour la ville de " . $ville . " est de : " . $temperature . " degrés Celsius.";

} else {
    // Afficher un message d'erreur si le paramètre GET est manquant
    echo "Erreur : paramètre ville manquant.";
}
?>