// Récupérer les données de température et d'indice UV
var temperatures = json_encode($temperatures);
var uvIndices = json_encode($uv_indices);
var hours = json_encode($hours);

// Créer le graphique
var chartData = {
  labels: hours,
  datasets: [
    {
      label: "Température (°C)",
      backgroundColor: "rgba(255, 99, 132, 0.2)",
      borderColor: "rgba(255, 99, 132, 1)",
      borderWidth: 1,
      data: temperatures,
    },
    {
      label: "Indice UV",
      backgroundColor: "rgba(54, 162, 235, 0.2)",
      borderColor: "rgba(54, 162, 235, 1)",
      borderWidth: 1,
      data: uvIndices,
    },
  ],
};

var chartOptions = {
  responsive: true,
  scales: {
    yAxes: [
      {
        ticks: {
          beginAtZero: true,
        },
      },
    ],
  },
};

var ctx = document.getElementById("meteoChart").getContext("2d");
var meteoChart = new Chart(ctx, {
  type: "line",
  data: chartData,
  options: chartOptions,
});
createChart();
