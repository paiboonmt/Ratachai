<?php   
    include("../includes/connection.php");              
    $date = date('Y-m-d'); 
    $sqlProduct = "SELECT order_details.product_name , COUNT(product_name) AS ccount ,  SUM(orders.total) AS sum
    FROM `orders` 
    INNER JOIN `order_details`
    ON order_details.order_id = orders.id
    WHERE date(orders.date) LIKE '%$date%'
    GROUP BY order_details.product_name
    ORDER BY ccount DESC
    LIMIT 5";
    $stmtProduct = $conndb->query($sqlProduct);
    $stmtProduct->execute();
    $sumTotal = 0; 
?> 
<div class="card p-1">
    <div class="card-header bg-primary">
        Best selling service today
    </div>
    <table class="table table-sm" id="popSale">
        <thead>
            <tr style="color: black;">
                <th>ประเภทรายการ</th>
                <th class="text-right">จำนวนครั้ง</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ( $stmtProduct AS $rowProduct ) :?>
            <tr style="color: black;">
                <td><?= $rowProduct['product_name'] ?></td>
                <td class="text-right"><?= $rowProduct['ccount'] ?></td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>