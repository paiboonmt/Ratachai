<?php 
    session_start();
    $page = 'report';
    $title = 'Report';
    include('../includes/connection.php');
    date_default_timezone_set('Asia/Bangkok');
    // วันปัจจุบัน
    $currentDate = date("Y-m-d");

    // ลดวันลง 1 วัน
    $newDate = date("Y-m-d", strtotime("-1 day", strtotime($currentDate)));

    // echo "วันที่ลดลง 1 วัน: " . $newDate;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../dist/img/logo.ico">
    <title><?=$title?></title>
    <link rel="stylesheet" href="../dist/css/font.css">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include './aside.php'?>
        <div class="content-wrapper">
            <div class="content">
                <div class="container-fluid">

                    <!-- from -->
                    <div class="row" id="formData">
                        <div class="col-md-4 mx-auto mt-2">
                            <form action="" method="post" id="form">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="input-group mb-1">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text">เลือกวัน</label>
                                            </div>
                                            <input type="date" name="date" class="form-control"
                                                value="<?= date("Y-m-d") ?>">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="submit" id="submit" class="form-control btn btn-success"
                                            name="search" value="ค้นหารายงาน">
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <?php if(isset($_POST['search'])) {
                            $date = $_POST['date'];
                            $_SESSION['date'] = $_POST['date'];
                            $sqlTotal = "SELECT * , SUM(total)AS sum 
                            FROM `orders`
                            WHERE date(date) LIKE '%$date%' ";
                            $stmtTotal = $conndb->query($sqlTotal);
                            $stmtTotal->execute();
                            $rowTotal = $stmtTotal->fetchAll();
                        ?>
                    <div class="row">
                        <!-- หัวบิล -->
                        <div class="col-md-12 mt-3">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ไทเกอร์ มวยไทย ( ไทยแลนด์ ) จำกัด</th>
                                        <!-- <th> <?= 'POS :' . ' ' . $computerName ?> </th> -->
                                        <th> <?= 'วันที่ :' . ' ' . date('d-m-Y') ?></th>
                                        <th> <?= 'ชื่อผู้ใช้งาน :' . ' ' . $_SESSION['username']  ?></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

                        <!-- ยอดขายสินค้า -->
                        <div class="col-md-12 mt-3">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>รายการ</th>
                                        <th class="text-right">ยอดรวม</th>
                                        <th class="text-right">หน่วย</th>
                                    </tr>
                                <tbody>
                                    <tr>
                                        <td>ยอดขายทั้งหมด</td>
                                        <td class="text-right"><?= number_format($rowTotal[0]['sum'],2)  ?></td>
                                        <td class="text-right">บาท</td>
                                    </tr>
                                </tbody>
                                </thead>
                            </table>
                        </div>

                        <!-- ยอดรวมส่วนลดวันนี้ -->
                        <div class="col-md-12">
                            <table class="table table-sm">
                                <thead>
                                    <th>หมายเลขบิล</th>
                                    <th class="text-right">ส่วนลด</th>
                                    <th class="text-right">จำนวนส่วนลด</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $totalDis = 0;
                                        $sqlDis = "SELECT `num_bill`,`fname`,`discount`,`price`
                                        FROM `orders` 
                                        WHERE  `discount` > 0  AND date(date) LIKE '%$date%'";
                                        $stmtDis = $conndb->query($sqlDis);
                                        $stmtDis->execute();
                                        foreach ( $stmtDis AS $rowDis ) :?>
                                    <tr>
                                        <td><?= $rowDis['num_bill'] ?></td>
                                        <td class="text-right"><?= $rowDis['discount'] ?> % </td>
                                        <td class="text-right">
                                            <?= number_format(($rowDis['price'] * $rowDis['discount']) / 100 ,2 )  ?>
                                        </td>
                                    </tr>
                                    <?php $totalDis = $totalDis += ($rowDis['price'] * $rowDis['discount']) / 100 ?>
                                    <?php endforeach ?>
                                    <tr>
                                        <td colspan="2">รวม</td>
                                        <td class="text-right"><?= number_format($totalDis,2) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- ยอดรับชำระแยกประเภท -->
                        <div class="col-md-12">
                            <?php echo $date ?>
                            <table class="table table-sm" id="tablePay">
                                <thead>
                                    <th>ประเภท การจ่าย</th>
                                    <th class="text-right">จำนวนครั้ง</th>
                                    <th class="text-right">ยอดขายรวม</th>
                                </thead>
                                <tbody>
                                    <?php 
                                        $sqlCash = $conndb->query("SELECT  `pay`, COUNT(pay) as count , SUM(total) AS total
                                        FROM `orders` 
                                        WHERE date(`date`) LIKE '%$date%'
                                        GROUP BY `pay`
                                        ORDER BY count DESC ");
                                        $sqlCash->execute();
                                        $totalAmount = 0;
                                        foreach ( $sqlCash AS $rowCash ) :?>
                                    <tr>
                                        <td><?= $rowCash['pay'] ?></td>
                                        <td class="text-right"><?= $rowCash['count'] ?></td>
                                        <td class="text-right"><?= number_format($rowCash['total'],2) ?></td>
                                    </tr>
                                    <?php $totalAmount =  $totalAmount += $rowCash['total']?>
                                    <?php endforeach ?>
                                    <tr>
                                        <th>ยอดรวมทั้งหมด</th>
                                        <th></th>
                                        <th class="text-right"><?= number_format($totalAmount,2) ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- รายการสินค้า ไม่รวมภาษี-->
                        <div class="col-md-12">
                            <table class="table table-sm">
                                <thead>
                                    <th>ประเภทรายการ</th>
                                    <th class="text-right">ขาย / จำนวนครั้ง</th>
                                    <th class="text-right">รายการสินค้า ไม่รวมภาษี</th>
                                </thead>
                                <tbody>
                                    <?php
                                        $sqlProduct = "SELECT order_details.product_name , orders.vat7 , orders.vat3 ,
                                        COUNT(product_name) AS count , 
                                        SUM(order_details.total) AS sum
                                        FROM `orders` 
                                        INNER JOIN `order_details`
                                        ON order_details.order_id = orders.id
                                        WHERE date(orders.date) LIKE '%$date%'
                                        GROUP BY order_details.product_id 
                                        ORDER BY count DESC ";
                                        $stmtProduct = $conndb->query($sqlProduct);
                                        $stmtProduct->execute();
                                        $sumTotal = 0;
                                        foreach ( $stmtProduct AS $rowProduct ) :?>


                                    <tr>
                                        <td><?= $rowProduct['product_name'] ?></td>
                                        <td class="text-right"><?= $rowProduct['count'] ?></td>
                                        <td class="text-right"><?= number_format($rowProduct['sum'],2) ?></td>
                                    </tr>
                                    <?php $sumTotal = $sumTotal += $rowProduct['sum'] ?>
                                    <?php endforeach ?>
                                    <tr>
                                        <td>ยอดรวมทั้งหมด</td>
                                        <td></td>
                                        <th class="text-right"><?= number_format($sumTotal,2) ?></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-12">
                            <button class="btn btn-success mb-3 form-control" id="printButton"><i
                                    class="fas fa-print">Print</i></button>
                        </div>
                        <?php } else {
                     
                      } ?>


                    </div>
                </div>
            </div>
        </div>

        <script src="../plugins/jquery/jquery.min.js"></script>
        <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../dist/js/adminlte.js"></script>

        <script>
        document.getElementById("printButton").addEventListener("click", function() {
            // ซ่อนปุ่มเมื่อคลิก
            this.style.display = "none";
            document.getElementById("formData").hidden = true;
            // พิมพ์
            window.print();
        });

        // document.getElementById("submit").addEventListener("click", function() {
        //     this.style.display = "hidden";
        //     document.getElementById("formData").hidden = true;
        // })
        </script>

</body>

</html>
<?php $conndb = null;?>