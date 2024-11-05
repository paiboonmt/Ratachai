<?php
  session_start();
  include("middleware.php");
  $title = 'DASHBOARD | TIGER APPLICATION';
  $page = 'index';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <link rel="icon" type="image/x-icon" href="../dist/img/logo.ico">
    <link rel="stylesheet" href="../dist/css/font.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Montserrat&family=Poppins:wght@400;800;900&display=swap');

        #cardddd {
            display: flex;
            justify-content: center;
        }
        .card-header{
            background: rgba(0, 0, 0, 0.712);
            color: white;
        }

        .card_img {
            position: relative;
            background: linear-gradient(57deg,rgb(0, 0, 0) 50%,rgb(221, 77, 10) 50%);
            overflow: hidden;
            box-shadow: 0 0 15px rgb(221, 77, 10);
            transition: transform 0.6s;
        }
        .card_img:hover{
            transform: scale(1.1);
        }
        .card_img::before{
            content: '';
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(to left,rgba(255, 255, 255, 0.123),transparent);
            transform: skewX(33deg) translateX(0);
            transition: 0.5s;
        }
        .card_img:hover:before{
            transform: skewX(33deg) translateX(200%);
        }
        .card_img .type_customer {
            background: rgb(3, 194, 3);
            height: 15px;
            text-align: center;
            color: white;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .card_img span {
            color: white;
            font-size: 10px;
            font-weight: bl;
            padding: 0 5px;
            font-family: 'Montserrat', sans-serif;
            transition: .4s;
            cursor: pointer;
        }
        .card_img span:hover {
            color: #f9e800;
        }

        .card_img_fighter {
            background: linear-gradient(58deg,rgb(0, 0, 0) 50%,rgb(17, 0, 255) 50%);
            overflow: hidden;
            box-shadow: 0 0 15px rgb(17, 0, 255);
            transition: transform 0.6s;
        }
        .card_img_fighter:hover{
            transform: scale(1.1);
        }
        .card_img_fighter::before{
            content: '';
            position: absolute;
            top: 0;
            width: 50%;
            height: 100%;
            background: linear-gradient(to left,rgba(255, 255, 255, 0.123),transparent);
            transform: skewX(33deg) translateX(0);
            transition: 0.4s;
        }
        .card_img_fighter:hover:before{
            transform: skewX(33deg) translateX(200%);
        }
        .card_img_fighter .type_fighter {
            background: gold;
            text-align: center;
            color: rgb(0, 0, 0);
            font-weight: bold;
            letter-spacing: 1px;
        }
        .card_img_fighter span {
            color: white;
            font-size: 10px;
            font-weight: bl;
            padding: 0 5px;
            font-family: 'Montserrat', sans-serif;
            transition: .4s;
            cursor: pointer;
        }
        .card_img_fighter span:hover {
            color: #f9004d;
        }

        .card_img_ticket {
            position: relative;
            background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(245,213,0,1) 50%, rgba(111,0,255,1) 100%);
            overflow: hidden;
            box-shadow: 0 0 15px rgb(238, 131, 8);
            transition: transform 0.6s;
        }
        .card_img_ticket:hover{
            transform: scale(1.1);
        }
        .card_img_ticket::before{
        content: '';
        position: absolute;
        top: 0;
        width: 50%;
        height: 100%;
        background: linear-gradient(to left,rgba(255, 255, 255, 0.120),transparent);
        transform: skewX(33deg) translateX(0);
        transition: 0.5s;
        }
        .card_img_ticket:hover:before{
            transform: skewX(33deg) translateX(200%);
        }
        .card_img_ticket .type_ticket {
            background: rgb(210, 25, 25);
            height: 15px;
            text-align: center;
            color: white;
            font-weight: bold;
            letter-spacing: 2px;
        }
        .card_img_ticket span {
            color: white;
            font-size: 10px;
            font-weight: bl;
            padding: 0 5px;
            font-family: 'Montserrat', sans-serif;
            transition: .4s;
            cursor: pointer;
        }
        .card_img_ticket span:hover {
            color: #f9e800;
        }

    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include 'aside.php' ?>
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">

                    <div class="row">
                        <?php include("./box.php") ?>
                    </div>

                    <div class="row">
                        <div class="col-4"><?php include('sum1.php') ?></div>
                        <div class="col-4"><?php include("sum2.php") ?> </div>
                        <div class="col-4"><?php include("count_fighter.php") ?></div>
                    </div>
                    <div class="row">
                        <div id="load_card"><?php include("card.php"); ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../plugins/jquery/jquery.min.js"></script>
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../dist/js/chart.js"></script>
    <script src="../dist/js/adminlte.min.js"></script>
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- datatables -->
    <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../plugins/jszip/jszip.min.js"></script>
    <script src="../plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
</body>
</html>
<script>
      $(function() {
        $("#table1").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "pageLength": 5,
          "searching": false
        })
        $("#table2").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "pageLength": 5,
          "searching": false
        })
        $("#table3").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "pageLength": 5,
          "searching": false
       
        })
        $("#popSale").DataTable({
          "responsive": true,
          "lengthChange": false,
          "autoWidth": false,
          "pageLength": 5,
          "searching": false
        })
      });

    function load_card() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("load_card").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "card.php", true);
      xhttp.send();
    }
    setInterval(function() {
      load_card();
    }, 50000);

    setInterval( function() {
        location.reload();
    },500000);
</script>
<?php $conndb = null; ?>