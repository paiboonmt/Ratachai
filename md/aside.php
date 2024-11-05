<?php
    require_once '../includes/connection.php';
    $UserID = $_SESSION['UserID'];
    $pro = $conndb->query("SELECT * FROM `tb_user` WHERE id = $UserID");
    $pro->execute();
    $rows = $pro->fetchAll();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4" style="text-transform: uppercase;">
    <a href="index.php" class="brand-link">
        <img src="../dist/img/logo.png" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">tiger application</span>
    </a>
    <div class="sidebar">
        <div class="user-panel py-2 d-flex">
            <div class="image">
                <img src="<?= '../user/img/' . $rows[0]['img'] ?>" class="img-thumbnail img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="user.php" class="d-block" style="text-transform: uppercase;"><?= $rows[0]['username'] ?></a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" >

                <?php
                if ($page == 'index') {
                    $active = 'active';
                } else {
                    $active = '';
                }
                ?>
                <li class="nav-item ">
                    <a href="index.php" class="nav-link <?= $active ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <?php
                    if ($page == 'report') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>

                <li class="nav-item">
                    <a href="report.php" class="nav-link <?= $active ?>">
                    <i class="nav-icon fas fa-print"></i>
                        <p>
                            Report
                        </p>
                    </a>
                </li>
                
                <?php
                    if ($page == 'newmember') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>

                <li class="nav-item">
                    <a href="newmember.php" class="nav-link <?= $active ?>">
                    <i class="nav-icon fas fa-users"></i>
                        <p>
                            new member
                        </p>
                    </a>
                </li>

                <?php
                    if ($page == 'allmember') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>

                <li class="nav-item">
                    <a href="allmember.php" class="nav-link <?= $active ?>">
                    <i class="nav-icon fas fa-users"></i>
                        <p>
                            Customer
                        </p>
                    </a>
                </li>
      
                <?php
                    if ($page == 'sponsor') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>
                <li class="nav-item">
                    <a href="sponsor.php" class="nav-link <?= $active ?>">
                    <i class="nav-icon fas fa-users"></i>
                        <p>
                            Sponsor
                        </p>
                    </a>
                </li>
                
                <!-- <?php
                    if ($page == 'trainersTH') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>
                <li class="nav-item">
                    <a href="trainersth.php" class="nav-link <?= $active ?>">
                    <i class="nav-icon fas fa-users"></i>
                        <p>
                            Muay Thai trainers
                        </p>
                    </a>
                </li> -->

                <?php
                    if ($page == 'telephone') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>
                <li class="nav-item">
                    <a href="telephone.php" class="nav-link <?= $active ?>">
                    <i class="nav-icon fas fa-phone"></i>
                        <p>
                            Telephone
                        </p>
                    </a>
                </li>

                <?php
                    if ($page == 'reportticket') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>
                <li class="nav-item">
                    <a href="reportticket.php" class="nav-link <?= $active ?>">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                        report ticket
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="#" onclick="logout()" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>

<script>
    function logout() {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to leave the program?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'logout.php';
            }
        })
    }
</script>

