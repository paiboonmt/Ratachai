<?php 
  include('./asset/middleware.php');
  $title = 'Dashboard';
  $page = 'index';
?>

  <?php include('./asset/header.php') ?>
  <div class="wrapper">
      <?php include('./asset/aside.php') ?>
      <div class="content-wrapper">
          <div class="content">
              <div class="container-fluid">
                   <?php include('./box/small-box1.php') ?> 
                   <?php include('./table/typeofpay.php') ?> 
                   <?php include('./table/salerecord.php') ?> 
              </div>
          </div>
      </div>
  </div>
  <?php include('./asset/footer.php') ?>
  </body>

  </html>
  <?php $conndb = null;?>