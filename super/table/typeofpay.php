<?php 
    include('../includes/connection.php');
    $date = date('Y-m-d');
    try {
        $sql = $conndb->query("SELECT  `pay`, COUNT(pay) as count , SUM(total) AS total FROM tigerbranch2.orders
        WHERE date LIKE '%$date%'
        GROUP BY `pay`
        ORDER BY count DESC");
        $sql->execute();
    } catch (PDOException $e) {
        throw $e;
    }
?> 

<div class="card">
    <div class="card-header">
        ประเภทการชำระ
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>ประเภท</th>
                    <th class="text-right">ครั้ง</th>
                    <th class="text-right">รวม</th>
                </tr>
            </thead>
            <tbody>
                 <?php $totalAmount = null; foreach ( $sql AS $row) : ?> 
                    <tr>
                        <td><?= $row['pay'] ?></td>
                        <td class="text-right"><?= $row['count'] ?></td>
                        <td class="text-right"><?= number_format($row['total'],2) ?></td>
                    </tr>
                    <?php $totalAmount =  $totalAmount += $row['total']?>
                 <?php endforeach ?> 
                 <tr>
                    <th>ยอดรวม</th>
                    <th></th>
                    <th class="text-right"><?= number_format($totalAmount,2) ?></th>
                </tr>
            </tbody>
        </table>
    </div>
</div>