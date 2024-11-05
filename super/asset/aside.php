<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#" style="text-transform: uppercase;">
                <?= $_SESSION['username'] ?>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">Account</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> Edit Profile
                    <span class="float-right text-muted text-sm">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
        
                    <a href="#" onclick="logout()" class="dropdown-item">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <span class="float-right text-muted text-sm">Logout</span>
                    </a>
            </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
       
    </ul>
</nav>

<aside class="main-sidebar sidebar-dark-primary elevation-4" style="text-transform: uppercase;">
    <a href="index.php" class="brand-link">
        <img src="../dist/img/logo.jpg" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">RATTACHAI GYM</span>
    </a>
    <div class="sidebar">
        <!-- <div class="user-panel py-2 d-flex">
            <div class="info">
                <a href="#" class="d-block" style="text-transform: uppercase;"><?= $_SESSION['username'] ?></a>
            </div>
        </div> -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

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
                    if ($page == 'user_setting') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>

                <li class="nav-item">
                    <a href="user_setting.php" class="nav-link <?= $active ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            user setting
                        </p>
                    </a>
                </li>

                <?php
                    if ($page == 'cart') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>

                <li class="nav-item">
                    <a href="cart.php" class="nav-link <?= $active ?>">
                        <i class="nav-icon fas fa-shopping-cart"></i>
                        <p>
                            Sale Ticket
                        </p>
                    </a>
                </li>

                <?php
                if ($page == 'product') {
                    $active = 'active';
                } else {
                    $active = '';
                }
                ?>

                <li class="nav-item">
                    <a href="product.php" class="nav-link <?= $active ?>">
                        <i class="nav-icon fab fa-product-hunt"></i>
                        <p>
                            products
                        </p>
                    </a>
                </li>

                <?php
                if ($page == 'payment') {
                    $active = 'active';
                } else {
                    $active = '';
                }
                ?>

                <li class="nav-item">
                    <a href="payment.php" class="nav-link <?= $active ?>">
                        <i class="nav-icon fab fa-cc-amazon-pay"></i>
                        <p>
                            Payment type
                        </p>
                    </a>
                </li>

                <?php
                if ($page == 'search') {
                    $active = 'active';
                } else {
                    $active = '';
                }
                ?>
                <li class="nav-item ">
                    <a href="search.php" class="nav-link <?= $active ?>">
                        <i class="nav-icon fas fa-search"></i>
                        <p>
                            search
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
                        <i class="nav-icon fas fa-user-check"></i>
                        <p>
                            Customer Active
                        </p>
                    </a>
                </li>

                <?php
                    if ($page == 'nationality') {
                        $active = 'active';
                    } else {
                        $active = '';
                    }
                ?>

                <li class="nav-item">
                    <a href="nationnality.php" class="nav-link <?= $active ?>">
                        <i class="nav-icon fas fa-language"></i>
                        <p>
                            Nationality
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="./report/reportTicket.php" class="nav-link">
                        <i class="nav-icon fas fa-print"></i>
                        <p>report</p>
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