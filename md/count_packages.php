<?php 
    require_once '../includes/connection.php';
    $stmt = $conndb->query("SELECT  m.package , COUNT(t.ref_m_card) AS count  , m.group , t.time
    FROM tb_time AS t
    LEFT JOIN member AS m ON t.ref_m_card = m.m_card
    WHERE  date(t.time) =curdate() AND m.group = 'customer'
    GROUP BY package
    ORDER BY count DESC");
    $stmt->execute();
    $query_run = $stmt->fetchAll();
?>
<div class="card">
    <div class="card-header">
        
    </div>
    <div class="card-body">
        <table class="table table-sm" id="table1">
            <thead>
                <tr style="color: black;">
                    <th>#</th>
                    <th>TYPE</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; foreach ( $query_run as $row ) :?>
                <tr style="color: black;">
                    <td><?= $i++; ?></td>
                    <td><?= $row['package'] ?></td>
                    <td style="text-align:center ;">
                        <span class="badge badge-success d-block p-1 text-center"><?= $row[1] ?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>