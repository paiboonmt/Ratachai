<?php 
    try {
        require_once '../includes/connection.php';
        $stmt = $conndb->query("SELECT type_training , COUNT(type_training) AS count FROM member 
        WHERE `group` = 'fighter'
        AND `exp_date` >= curdate() 
        GROUP BY type_training ORDER BY count DESC");
        $stmt->execute();
        $query_run = $stmt->fetchAll();
    } catch (PDOException $e) {
        echo 'Error: '.$e->getMessage();
    }
?>
    <div class="card p-1">
        <div class="card-header">
            Sponsor fighter type training
        </div>
        <table class="table table-sm" id="table2">
            <thead>
                <tr style="color: black;">
                    <th>#</th>
                    <th>type_training</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ( $query_run as $row ) :?>
                <tr style="color: black;">
                    <td><?php echo $i++ .'.';?></td>
                    <td><?php echo ($row['type_training'])?></td>
                    <td class="text-center">
                        <span class="badge badge-danger d-block p-1 text-center"><?php echo ($row['count'])?></span>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>