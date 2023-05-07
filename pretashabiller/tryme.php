<?php
// Récupérer les données JSON depuis l'API OpenMeteo
$json_data = file_get_contents('https://api.open-meteo.com/v1/forecast?latitude=43.55&longitude=7.01&hourly=temperature_2m,weathercode,uv_index,is_day&daily=uv_index_max&start_date=2023-05-07&end_date=2023-05-07&timezone=auto');

// Convertir les données JSON en tableau PHP associatif
$data = json_decode($json_data, true);

// Récupérer les données de température, code météorologique, indice UV et jour/nuit pour chaque heure de la journée
$hourly_data = $data['hourly'];

// Parcourir les données de chaque heure et les stocker dans des tableaux
$hours = array();
$temperatures = array();
$uvIndices = array();
foreach ($hourly_data['time'] as $index => $heure) {
    $temperature = $hourly_data['temperature_2m'][$index];
    $indice_uv = $hourly_data['uv_index'][$index];
    $formated_hour = substr($heure, 11, 2);
    if ((int)$formated_hour >= 6 && (int)$formated_hour <= 21){
        $time_format = ' h';
        array_push($hours, $formated_hour.$time_format);
        array_push($temperatures, $temperature);
        array_push($uvIndices, $indice_uv);
    }
}

// Créer le graphique
$chartData = array(
    'labels' => $hours,
    'datasets' => array(
        array(
            'label' => 'Température (°C)',
            'backgroundColor' => 'rgba(255, 99, 132, 0.2)',
            'borderColor' => 'rgba(255, 99, 132, 1)',
            'borderWidth' => 1,
            'data' => $temperatures
        ),
        array(
            'label' => 'Indice UV',
            'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
            'borderColor' => 'rgba(54, 162, 235, 1)',
            'borderWidth' => 1,
            'data' => $uvIndices
        )
    )
);

$chartOptions = array(
    'responsive' => true,
    'scales' => array(
        'yAxes' => array(
            array(
                'ticks' => array(
                    'beginAtZero' => true
                )
            )
        )
    )
);

?>
<!-- Inclure la bibliothèque Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Créer l'élément canvas pour le graphique -->
<canvas id="meteoChart"></canvas>

<!-- Appeler la fonction createChart avec les données et options du graphique -->
<script>
    var chartData = <?php echo json_encode($chartData); ?>;
    var chartOptions = <?php echo json_encode($chartOptions); ?>;

    var createChart = function() {
        var ctx = document.getElementById('meteoChart').getContext('2d');
        var meteoChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: chartOptions
        });
    };

    createChart();
</script>

