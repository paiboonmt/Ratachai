<?php
    include('../asset/middleware.php');

    //Update
    if ( isset($_POST['update'])) 
    {
        $id = $_POST['id'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);
        $role = $_POST['role'];

        include('../../includes/connection.php');
        $sql = "UPDATE `tb_user` SET `username`= ?,`password`= ?,`role`=? WHERE `id` = ?";
        $stmt = $conndb->prepare($sql);
        $stmt->bindParam(1,$username , PDO::PARAM_STR);
        $stmt->bindParam(2,$password , PDO::PARAM_STR);
        $stmt->bindParam(3,$role,PDO::PARAM_STR);
        $stmt->bindParam(4,$id,PDO::PARAM_INT);
        
        try {
            if ( $stmt->execute()){
                $_SESSION['msg'] = true;
                header('location:../user_setting.php');
            }
        } catch (PDOException $e) {
            echo 'Error sql' . $e->getMessage();
        }
        
    }

    //Create
    if ( isset($_POST['create']))
    {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password = md5($password);
        $role = $_POST['role'];
        include('../../includes/connection.php');
        $sql = "INSERT INTO `tb_user` (`id`, `username`, `password`, `role`) VALUES (NULL, ?, ? ,? )";
        $stmt = $conndb->prepare($sql);
        $stmt->bindParam(1,$username,PDO::PARAM_STR);
        $stmt->bindParam(2,$password,PDO::PARAM_STR);
        $stmt->bindParam(3,$role,PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            $_SESSION['msg'] = true;
            header('location:../user_setting.php');
        } catch (PDOException $e) {
            echo 'Error sql' . $e->getMessage();
        }
    }

    //Delete
    if(isset($_GET['action']) == 'delete')
    {
        $id = $_GET['id'];
        include('../../includes/connection.php');
        $sql = "DELETE FROM `tb_user` WHERE id = ?";
        $stmt = $conndb->prepare($sql);
        $stmt->bindParam(1,$id,PDO::PARAM_INT);
        
        try {
            $stmt->execute();
            $_SESSION['msg'] = true;
            header('location:../user_setting.php');
        } catch (PDOException $e) {
            echo 'Error sql' . $e->getMessage();
        }
    }

    $conndb = null;
?> 