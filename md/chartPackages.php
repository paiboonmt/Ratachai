<?php 
    require_once '../includes/connection.php';
    $sql = "SELECT `quantity`,`date` FROM `totel` ORDER BY date DESC LIMIT 7 ";
    $stmt = $conndb->prepare($sql);
    $stmt ->execute();
    $result = $stmt ->fetchAll();
    $quantity = array();
    $date = array();
    foreach($result as $total) {
        $quantity[] = $total['quantity'];
        $date[] = date('d/M',strtotime($total['date']));
    }
?>
<div class="col-md-4">
    <div class="card card-danger">
        <div class="card-header">
            <h3 class="card-title">Chart TIGER APP</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="chartjs-size-monitor">
                <div class="chartjs-size-monitor-expand">
                    <div class=""></div>
                </div>
                <div class="chartjs-size-monitor-shrink">
                    <div class=""></div>
                </div>
            </div>
            <canvas id="myChart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 326px;"
                width="326" height="250" class="chartjs-render-monitor">
            </canvas>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    chartJs();
    function chartJs(){
        const labels = <?php echo json_encode($date)?>;
        const data = {
            labels: labels,
            datasets: [{
                label: 'Total Checkin Per Day',
                data: <?php echo json_encode($quantity) ?>,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 150, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(255, 159, 70)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)'
                ],
                borderWidth: 4
            }]
        };

        const config = {

            type: 'line',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            },
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    }

    setInterval(function(){
        chartJs();
    },50000);
</script>





