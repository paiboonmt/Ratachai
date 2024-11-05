<?php
    include("../includes/connection.php");
    $sqlTotal = " SELECT `date` , SUM(total) AS sum 
    FROM `orders`
    GROUP BY date(date)
    ORDER BY date DESC 
    LIMIT 6"; 
    $stmtTotal = $conndb->query($sqlTotal);
    $stmtTotal->execute();
?>
<div class="card">
    <div class="card-header bg-info">
        Daily sale summary
    </div>
    <div class="card-body">
        <table class="table table-sm">
            <thead>
                <tr style="color: black;">
                    <th>Date</th>
                    <th class="text-right">Amount</th>
                    <th class="text-right">$</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $stmtTotal AS $row ) : ?>
                <tr style="color: black;">
                    <td><?= date('d / m / Y',strtotime($row['date'])) ?></td>
                    <td class="text-right"><?= number_format($row['sum'],2)  ?></td>
                    <td class="text-right">
                        <img src="https://cdn-icons-png.flaticon.com/512/1490/1490834.png" width="25px">
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>