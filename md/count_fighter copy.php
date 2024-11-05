<?php 
    try {
        require_once '../includes/connection.php';
        $stmt = $conndb->query("SELECT  m.type_fighter , COUNT(m.type_fighter) , m.group 
        FROM tb_time AS t
        INNER JOIN member AS m ON t.ref_m_card = m.m_card
        WHERE  date(t.time)= curdate() AND m.group = 'fighter' 
        GROUP BY m.type_fighter
        ORDER BY COUNT(m.type_fighter) DESC ");
        $stmt->execute();
        $query_run = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
?>
    <div class="card p-1">
        <table class="table table-sm" id="table2">
            <thead>
                <tr style="color: black;">
                    <th>#</th>
                    <th>Type</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ( $query_run as $row ) :?>
                <tr style="color: black;">
                    <td><?php echo $i++ .'.';?></td>
                    <td><?php echo ($row['type_fighter'])?></td>
                    <td class="text-center">
                        <span class="badge badge-danger d-block p-1 text-center"><?php echo ($row[1])?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>