<?php
    // $servername = "localhost";
    // $username = "admin";
    // $password = "9itonly";
    // $dbname = "member";
    // $servername = "172.16.0.254";
    // $username = "admin";
    // $password = "9itonly";
    // $dbname = "member";
    // $servername = "146.190.92.118:3324";
    // $username = "admin";
    // $password = "tiger";
    // $port = "3324";
    // $dbname = "db";
    
    $servername = "27.254.145.135";
    $username = "tiger_branch2";
    $password = "admin!@#$9itonly";
    $dbname = "tigerbranch2";

    date_default_timezone_set('Asia/Bangkok');
    try {
        $conndb = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conndb->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>