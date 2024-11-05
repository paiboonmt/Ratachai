<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type:application/json; charset=UTF-8");
    try {
        require_once '../../includes/connection.php';
        $today = date('Y-m-d');
        $stmt = $conndb->query("SELECT * FROM `member` WHERE `group` = 'fighter' AND `exp_date`>= '$today'");
        $stmt->execute();
        $result = $stmt->rowCount(); 
        echo json_encode($result);
        $conndb = null;
    } catch ( PDOException $e ) {
        echo 'error' . $e->getMessage();
        die();
    } 
?>
