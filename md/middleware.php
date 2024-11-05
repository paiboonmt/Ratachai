<?php
    if ( $_SESSION['role'] != 4 && $_SESSION['id'] == '') {
        header('location:../');
    }
?> 