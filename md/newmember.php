<?php
  session_start();
  include './middleware.php';
  $title = 'NEW MEMBER | TIGER APPLICATION';
  $page = 'newmember';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" type="image/x-icon" href="../dist/img/logo.ico">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../dist/css/font.css">
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>

  <style>
    img {
      border-radius: 50px;
      width: 50px;
      height: 50px;
    }
    .h {
      text-transform: uppercase;
      font-weight: 900;
      transition: 0.5s;
    }
    .h:hover {
      color: orangered;
      cursor: pointer;
    }
    .bb {
      text-transform: uppercase;
    }
  </style>

</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <?php include 'aside.php' ?>
    <div class="content-wrapper">
      <section class="content">
        <div class="container-fluid">
          <div class="row p-3">
            <h2 class="h"> New Member </h2>
            
            <div class="col-lg-12">
              <div class="card p-2 mt-2">
                <table id="example1" class="table table-sm table-hover">
                  <thead class="thead-dark">
                    <tr>
                      <th>ลำดับ</th>
                      <th>ภาพ</th>
                      <th>รหัส</th>
                      <th hidden>เพศ</th>
                      <th>ชื่อ </th>
                      <th hidden>วันเกิด</th>
                      <th hidden>อายุ</th>
                      <th>เลขใบเสร็จ</th>
                      <th>สัญชาติ</th>
                      <th>รายการ</th>
                      <th hidden>ที่อยู่</th>
                      <th>เริ่ม</th>
                      <th>สิ้นสุด</th>
                      <th>สร้างเมื่อ</th>
                      <th hidden>อีเมล</th>
                      <th hidden>เบอร์โทร</th>
                      <th>ผู้สร้าง</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        require_once '../includes/connection.php';
                        $sql = "SELECT m.image,m.m_card,m.sex,m.fname,m.birthday,m.age,
                        m.invoice,m.nationalty,p.product_name,m.accom,m.sta_date,m.exp_date,
                        m.date,m.email,m.phone,m.AddBy,m.id AS mid,m.package,p.id
                        FROM `member` AS m
                        LEFT JOIN `products` AS p ON p.id = m.package
                        WHERE `status_code` = 4 AND date(date) = curdate() ";
                        $stmt = $conndb->prepare($sql);
                        $stmt->execute();
                        $data = $stmt->fetchAll();
                        $i = 1;
                        foreach ($data as $row) : ?>
                      <tr>
                        <td><?= $i++ ?></td>
                        <td><a href="<?= 'member_profile.php?id='. $row['mid'] ?>" target="_bank">
                          <img src="<?= 'http://172.16.0.3/../memberimg/img/' . $row['image']; ?>" width="60" height="60"></a>
                        </td>
                        <td><?= $row['m_card'] ?> </td>
                        <td hidden><?= $row['sex'] ?></td>
                        <td><?= $row['fname'] ?> </td>
                        <td hidden><?= date('d/m/y', strtotime($row['birthday'])) ?> </td>
                        <td hidden><?= $row['age'] ?> </td>
                        <td><?= $row['invoice'] ?> </td>
                        <td><?= $row['nationalty'] ?> </td>
                        <td><?= $row['product_name'] ?> </td>
                        <td hidden><?= $row['accom'] ?> </td>
                        <td><?= date('d/m/Y', strtotime($row['sta_date'])); ?></td>
                        <td><?= date('d/m/Y', strtotime($row['exp_date'])); ?></td>
                        <td><?= $row['date'] ?> </td>
                        <td hidden><?= $row['email'] ?></td>
                        <td hidden><?= $row['phone'] ?></td>
                        <td><?= $row['AddBy'] ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>

  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../dist/js/adminlte.min.js"></script>
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
  
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ['excel']
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>

</body>
</html>
<?php $conndb = null; ?>