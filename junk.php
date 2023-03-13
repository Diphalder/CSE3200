<?php
// Example data
$data = array(10, 20, 30, 40, 50);

// Set up the HTML canvas
echo '<canvas id="myChart"></canvas>';

// Generate the JavaScript code to render the chart
echo '<script>';
echo 'var ctx = document.getElementById("myChart").getContext("2d");';
echo 'var myChart = new Chart(ctx, {';
echo 'type: "bar",';
echo 'data: {';
echo 'labels: ["Label 1", "Label 2", "Label 3", "Label 4", "Label 5"],';
echo 'datasets: [{';
echo 'label: "Data",';
echo 'data: ['.implode(',', $data).'],';
echo 'backgroundColor: "rgba(255, 99, 132, 0.2)",';
echo 'borderColor: "rgba(255, 99, 132, 1)",';
echo 'borderWidth: 1';
echo '}]';
echo '},';
echo 'options: {';
echo 'scales: {';
echo 'yAxes: [{';
echo 'ticks: {';
echo 'beginAtZero: true';
echo '}';
echo '}]';
echo '}';
echo '}';
echo '});';
echo '</script>';
?>

<!-- Add any other HTML content you want to display on the website here -->
<p>This is my website.</p>
