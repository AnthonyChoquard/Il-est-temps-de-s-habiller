 <body>
    <div class="container">
      <h1 class="text-center">Météo</h1>
      <h2>Météo du <?= $current_date ?> à <?= $current_time ?></h2>
      <!-- Tableau des données horaires -->
      <h2>Prévisions horaires</h2>
      <div class="table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Heure</th>
              <th>Température (°C)</th>
              <th>Code météorologique</th>
              <th>Indice UV</th>
              <th>Jour/Nuit</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($table_data as $row) : ?>
              <tr>
                <td><?= $row['heure'] ?></td>
                <td><?= $row['temperature'] ?></td>
                <td><?= $row['code_meteo'] ?></td>
                <td><?= $row['indice_uv'] ?></td>
                <td><?= $row['jour_nuit'] ?></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
     
      </div>

      <!-- Graphique de température et indice UV pour la journée -->
      <h2>Graphique de la journée</h2>
      <canvas id="meteoChart"></canvas>

    </div>

    <!-- JavaScript et librairies -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="meteo-chart.js"></script>
  </body>
</html>

