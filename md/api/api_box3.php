<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type:application/json; charset=UTF-8");
    try {
        require_once '../../includes/connection.php';
        $stmt = $conndb->query("SELECT * FROM `member` WHERE `group` = 'customer' AND date(date)=curdate() AND `status` != '1' ");
        $stmt->execute();
        $result = $stmt->rowCount();
        echo json_encode($result);
        $conndb = null;
    } catch ( PDOException $e ) {
        echo 'error' . $e->getMessage();
        die();
    } 
?>
