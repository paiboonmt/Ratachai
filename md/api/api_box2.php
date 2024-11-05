<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-type:application/json; charset=UTF-8");
    try {
        require_once '../../includes/connection.php';
        $stmt = $conndb->query("SELECT `ref_m_card` FROM tb_time WHERE date(time) = curdate() GROUP by `ref_m_card` ");
        $stmt->execute();
        $result = $stmt->rowCount();  
        echo json_encode($result);
        $conndb = null;
    } catch ( PDOException $e ) {
        echo 'error' . $e->getMessage();
        die();
    } 
?>
