<?php 
    include('../includes/connection.php');
    $date = date('Y-m-d');
    try {
        $sql1 = $conndb->query("SELECT id FROM orders WHERE `date` LIKE '%$date%' ");
        $sql1->execute();
        $count1 = $sql1->rowCount();
    } catch (PDOException $e) {
        echo 'Error sql' . $e->getMessage();
    }

    try {
       $sql2 = $conndb->query("SELECT total, SUM(total) AS sum FROM `orders` WHERE `date` LIKE '%$date%'");
       $sql2->execute();
    foreach ( $sql2 as $sum ){
        $sum = $sum['sum'];
    }
    } catch (PDOException $e) {
        echo 'Error sql' . $e->getMessage();
    }
?>

<div class="row p-1">
    <div class="col-lg-6 col-6">

        <div class="small-box bg-info">
            <div class="inner">
                <h4> <?php echo $count1 ?> </h4>
                <p>New Orders</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

    <div class="col-lg-6 col-6">

        <div class="small-box bg-success">
            <div class="inner">
                <h4><?= number_format($sum,2) ?></h4>
                <p>Sale Rate</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>

  

</div>