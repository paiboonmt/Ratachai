<?php 
    include('../includes/connection.php');
    $date = date('Y-m-d');
    try {
        $sql = $conndb->query("SELECT order_details.product_name , orders.vat7 , orders.vat3 ,
                                        COUNT(product_name) AS count , 
                                        SUM(order_details.total) AS sum
                                        FROM `orders` 
                                        INNER JOIN `order_details`
                                        ON order_details.order_id = orders.id
                                        WHERE date(orders.date) LIKE '%$date%'
                                        GROUP BY order_details.product_id 
                                        ORDER BY count DESC");
    } catch (PDOException $e) {
        throw $e;
    }
?> 
<div class="card">
    <div class="card-header bg-dark">
        รายการสินค้า
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>รายการ</th>
                    <th class="text-right">ครั้ง</th>
                    <th class="text-right">รวม</th>
                </tr>
            </thead>
            <tbody>
                 <?php $sumTotal = null; foreach ( $sql AS $row) : ?> 
                    <tr>
                        <td><?= $row['product_name'] ?></td>
                        <td class="text-right"><?= $row['count'] ?></td>
                        <td class="text-right"><?= number_format($row['sum'],2) ?></td>
                    </tr>
                    <?php $sumTotal = $sumTotal += $row['sum'] ?>
                    <?php endforeach ?>
                    <tr>
                        <td>รวม</td>
                        <td></td>
                        <th class="text-right"><?= number_format($sumTotal,2) ?></th>
                    </tr>
            </tbody>
        </table>
    </div>
</div>