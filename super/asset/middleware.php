<?php
    session_start();
    if ( $_SESSION['role'] != 'super' && $_SESSION['id'] == '') {
        header('location:../');
    }
?> 