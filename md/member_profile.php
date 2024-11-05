<?php
    session_start();
    include('./middleware.php');
    $title = 'PROFILE | TIGER APPLICATION';
    $page = 'allmember';
if (isset($_GET['id'])) {
    require_once "../includes/connection.php";
    $id = $_GET['id'];
    $sql_data = $conndb->prepare("SELECT * FROM member WHERE id = :id");
    $sql_data->bindParam(":id",$id);
    $sql_data->execute();
    $result = $sql_data->fetchAll();
    $mm_card = $result[0]['m_card'];
    $exp_date = $result[0]['exp_date'];

    function datediff($str_start,$str_end){
        $str_start = strtotime($str_start); // ทำวันที่ให้อยู่ในรูปแบบ timestamp
        $str_end = strtotime($str_end); // ทำวันที่ให้อยู่ในรูปแบบ timestamp
        $nseconds = $str_end - $str_start; // วันที่ระหว่างเริ่มและสิ้นสุดมาลบกัน
        $ndays = round($nseconds / 86400); // หนึ่งวันมี 86400 วินาที
        return $ndays;
    }

    $today = date('Y-m-d');
    $df = datediff($today, $exp_date);

    $birthday = $result[0]['birthday'];
    $today = date('Y-m-d');
    list($byear, $bmonth, $bday)= explode("-",$birthday);
    list($tyear, $tmonth, $tday)= explode("-",$today);
        
    $mbirthday = mktime(0, 0, 0, $bmonth, $bday, $byear);
    $mnow = mktime(0, 0, 0, $tmonth, $tday, $tyear );
    $mage = ($mnow - $mbirthday);
    
    $u_y=date("Y", $mage)-1970;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="../dist/img/logo.ico">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../dist/css/adminlte.min.css">
    <!-- sweetalert2 -->
    <script src="../plugins/sweetalert2/sweetalert2.all.min.js"></script>
    <!-- fancyapps -->
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css"/>
     <!-- datatables -->
    <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

<style>
    .content-wrapper {
        background: #fff ;
    }
    .content-wrapper .content .container-fluid .row .col-4 .into {
        font-weight: bold;
        text-align: center;
        margin-top: 1px;
    }
    label{
        position: relative;
        /* color: white; */
        font-size: 19px;
        cursor: pointer;
    }
    label::after{
        position: absolute;
        content: '';
        background: orangered;
        height: 2px;
        width: 0;
        left: 0;
        bottom: -2px;
        transition: .6s;
    
    }
    label:hover::after{
        width: 100%;
    }
    .content-wrapper .img_aa{
        /* display: block; */
        /* align-items: center; */
        margin: auto;
        border-radius: 15px;
    }

    .content-wrapper .top-menu {
        display: flex;
        justify-content: space-around;
    }
    .content-wrapper .top-menu ul li {
        margin-left:10px;
        text-transform: uppercase;
        list-style: none;
    }
    .content-wrapper .top-menu ul li a {
        color:#fff;
    }
    .content-wrapper .top-menu  .ttb {
       width: 100px;
    }

</style>

</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<?php include 'aside.php' ?>

    <!-- Modal History -->
    <div class="modal fade" id="history" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-body">
                    <?php

                        $SQL_HISTORY = $conndb->query("SELECT t.date,t.time,t.time_id,m.id

                        FROM tb_time AS t
                        
                        INNER JOIN member AS m ON t.ref_m_card = m.m_card
                        
                        WHERE  m.id = $id 
                        
                        ORDER BY t.time_id DESC ");

                        $SQL_HISTORY->execute();

                        $SQL_HISTORY_FETCH = $SQL_HISTORY->fetchAll(); 
                        
                    ?>

                    <table class="table" id="example1">
                        <thead>
                            <tr>
                                <th>Day</th>
                                <th>Time</th>
                                <th>ID</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($SQL_HISTORY_FETCH as $SQL_HISTORY_ROW) : ?>
                            <tr>
                                <td><?= date('d/m/Y',strtotime($SQL_HISTORY_ROW[1])) ?></td>
                                <td><?= date('H:i:s',strtotime($SQL_HISTORY_ROW[1])) ?></td>
                                <td><?= $SQL_HISTORY_ROW[2]; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal document upload-->
    <div class="modal fade" id="document" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel" style="text-transform: uppercase;font-size: 25px;font-weight: bold;">upload document</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="sql/upload_file.php" enctype="multipart/form-data">
                    <!-- ตัวแปร input จำเป็นที่จะต้องใส่ [] ไว้ในแอตทริบิวต์ name ด้วยเสมอตามตัวอย่าง -->
                    <input type="file" name="upload[]" class="form-control" id="upload" multiple="multiple" required>
                    
                    <input type="hidden" name="img_id" value="<?= $result[0]['id']?>">

                    <input name="submit" type="submit" class="btn btn-info form-control mt-2" value="CLICK UPLOAD">
                </form>
            </div>
            <div class="modal-footer">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">image</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $sql_qury_files = $conndb->query("SELECT * FROM tb_files WHERE product_id = $id ");
                            $sql_qury_files->execute();
                            $result_files = $sql_qury_files->fetchAll();
                            foreach($result_files as $datar) : ?>
                            <tr>
                                <td>
                                    <a href="#"><img src="<?php echo '../memberimg/file/'.$datar['image'];?>" width="10%" /></a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm delete_file" id="<?= $datar['id'] ?>"><i class="fas fa-trash"></i></button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
    
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
            
                    <div class="row p-2">
                         <!-- รายระเอียด -->
                         <div class="col-8 ">
                            <div class="form-row mb-1"> 
                                <div class="top-menu col-12 mt-4 ">
                                    <ul>
                                        <li class="btn btn-warning ttb"> <a href="sql/code_run1.php?id=<?= $result[0]['m_card']?>">check in</a></li>
                                        <li class="btn btn-success " data-toggle="modal" data-target="#document" >Upload Files</li>
                                        <li class="btn btn-primary ttb"><a href="member_profile_edit.php?id=<?= $result[0]['id']?>">edit</a></li>
                                        <li class="btn btn-info ttb" data-toggle="modal" data-target="#history">History</li>
                                        <li class="btn btn-danger ttb   del_id" id="<?= $result[0]['id'] ?>">delete</li>
                                    </ul>
                                </div>

                                    <?php if($result[0]['package'] == '10 Drop In'){?>
                                        <div class="form-group col-6">
                                            <label for="dropin"> DROP IN </label>
                                            <input type="text" class="form-control bg-success"  value="<?= $result[0]['dropin'] ?>">
                                        </div>
                                    <?php } ?>
                                
                            </div>
                            <div class="card p-2">
                               
                            <!-- UMBER CARD / INVOCE /PASSPORT -->
                            <div class="row mb-1">
                                <div class="form-group col-4">
                                    <label>NUMBER CARD</label>
                                    <input type="text" name="m_card" disabled class="form-control"  value="<?= $result[0]['m_card'] ?>">
                                </div>
                                <div class="form-group col-4 ">
                                    <label>INVOCE NO.</label>
                                    <input type="text" name="invoice" class="form-control"  value="<?= $result[0]['invoice'] ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label>PASSPORT NUMBER</label>
                                    <input type="text" name="p_visa" class="form-control"  value="<?= $result[0]['p_visa'] ?>">
                                </div>
                            </div>
                            <!-- PICTURES / EMAIL /PHONE -->
                            <div class="form-row mb-1">
                                <div class="form-group col-4">
                                    <label> PICTURES </label>
                                    <input type="file" class="form-control"  id="file" name="image" onchange="readURL(this)"  >
                                </div>
                                <div class="form-group col-4">
                                    <label>EMAIL</label>
                                    <input type="email" name="email" class="form-control"   value="<?= $result[0]['email'] ?>">
                                </div>
                                <div class="form-group col-4">
                                    <label>PHONE NUMBER</label>
                                    <input type="number" name="phone" class="form-control"   value="<?= $result[0]['phone'] ?>">
                                </div>
                            </div>
                            <!-- SEX / FULL NAME -->
                            <div class="form-row mb-1">
                                <div class="form-group col-2 ">
                                    <label>SEX</label>
                                    <select name="sex" class="custom-select" >
                                        <option selected><?= $result[0]['sex'] ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-5">
                                    <label for="floatingFull Name">FULL NAME</label>
                                    <input type="text" name="fname" class="form-control"  value="<?= $result[0]['fname'] ?>">
                                </div>
                                <div class="form-group col-3">
                                    <label>BIRTH DAY</label>
                                    <input type="date" name="birthday"  class="form-control"  value="<?= $result[0]['birthday'] ?>">
                                </div>
                                <div class="form-group col">
                                    <label>AGE</label>
                                    <?php
                                        if ($u_y < 0 ) { ?>
                                            <input type="text" class="form-control"  value="0">
                                     <?php }else { ?>
                                            <input type="text" class="form-control"  value="<?php echo $u_y ?>">
                                     <?php }?>
                                </div>
                            </div>
                            <!-- NATIONALITY BIRTH DAY -->
                            <div class="form-row mb-1">
                                <div class="form-group col-4">
                                    <label>NATIONALITY</label>
                                    <select name="nationalty" class="custom-select"  >
                                        <option selected><?= $result[0]['nationalty'] ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label>PACKAGE</label>
                                    <select name="package" class="custom-select"  >
                                        <option selected><?=$result[0]['package']?></option>
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <label for="new-package">NEW PACKAGE</label>
                                    <input type="text" name="new_package" class="form-control"  value="<?= $result[0]['new_package'] ?>">
                                </div>
                            </div>
                        
                            <!-- ACCOMMODATION -->
                            <div class="form-row mb-1">
                                <div class="form-group col-6">
                                    <label>ACCOMMODATION / ADDRESS </label>
                                    <textarea class="form-control" rows="4"  name="accom"><?=$result[0]['accom']?></textarea>
                                </div>
                                <div class="form-group col-6">
                                    <label>COMMENTS</label>
                                    <textarea class="form-control" rows="4"  name="comment"><?= $result[0]['comment']?></textarea>
                                </div>
                            </div>
                             <!-- START TRAINING / EXPIR TRAINING-->
                             <div class="form-row mb-1">
                                <div class="form-group col-4 ">
                                    <label>START TRAINING</label>
                                    <input type="date" name="sta_date" class="form-control"  value="<?=$result[0]['sta_date']?>">
                                </div>
                                <div class="form-group col-4 ">
                                    <label>EXPIR TRAINING</label>
                                    <input type="date" name="exp_date" class="form-control"  value="<?=$result[0]['exp_date']?>">
                                </div>
                                <div class="form-group col-4">
                                    <?php
                                        if( $df < 0 ){?>
                                            <label>EXPIRED</label>
                                        <input type="text" class="form-control bg-danger"  value="<?= $df ?>">
                                    <?php } else { ?>
                                        <label> WILL EXPIRY IN</label>
                                        <input type="text" class="form-control bg-success"  value="<?= $df ?>">
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- COMMENTS  EMERGENCY NUMBER -->
                            <div class="form-row mb-1">
                                <!-- VACCINE  -->
                                <div class="form-group col-2">
                                    <label>VACCINE</label>
                                    <select name="vaccine" class="form-control" >
                                        <option value=""><?=$result[0]['vaccine']?></option>
                                    </select>
                                </div>      
                                <div class="form-group col">
                                    <label>EMERGENCY NUMBER</label>
                                    <input type="text" class="form-control"  name="emergency" value="<?=$result[0]['emergency']?>">
                                </div>
                                <div class="form-group col">
                                    <label>HEIGHT</label>
                                    <input type="text" name="height" class="form-control"  value="<?=$result[0]['height']?>">
                                </div>
                                <div class="form-group col">
                                    <label>WEIGH</label>
                                    <input type="text" name="weigh" class="form-control"   value="<?=$result[0]['weigh']?>">
                                </div>
                                <div class="form-group col">
                                    <label>PAYMRNT</label>
                                    <select name="payment" class="form-control"   >
                                        <option value=""><?=$result[0]['payment']?></option>
                                    </select>
                                </div>
                            </div>
                            </div>
                        </div>
                        <!-- ภาพ และ ปุ่มกด -->
                        <div class="col-4">
                            <h1 class="into">PICTURES</h1>
                            <div class="card p-3">
                           
                            <div class="form-row">
                                <img src="<?= 'http://172.16.0.3/../memberimg/img/'.$result[0]['image'] ?>" width="80%" class="img_aa">  
                            </div>
                            <hr style="background-color: orangered;">
                            <div class="row">
                                <div class="col">
                                    <?php  foreach($result_files as $datar1) : ?>
                                    
                                    <a class="ml-3" href="#" data-fancybox="gallery" data-src="<?= 'http://172.16.0.3/../memberimg/file/'.$datar1['image'];?>"><img src="<?= '../memberimg/file/'.$datar1['image'];?>" width="10%" /></a>
                                        
                                    <?php endforeach; ?>
                                </div>    
                            </div>
                            </div>
                        </div>
                    </div>
               
                <!-- form -->
            </div>
        </section>
    </div>

</div>

<script src="../plugins/jquery/jquery.min.js"></script>
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["excel","print"]
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

<script>
    // Customization example
    Fancybox.bind('[data-fancybox="gallery"]', {
    infinite: false
    });
</script>

<!-- insert_files_success -->
<?php if (isset($_SESSION['insert_files_success'])){?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Good...',
        text: ' Upload Document Successfully.',
      })
    </script>
<?php } unset($_SESSION['insert_files_success']); ?>

<!-- update_success -->
<?php if (isset($_SESSION['update_success'])){?>
    <script>
      Swal.fire({
        icon: 'success',
        title: 'Good...',
        text: 'Update Data Successfully !',
      })
    </script>
<?php } unset($_SESSION['update_success']); ?>

<!-- delete_file -->
<script>
    $(document).ready(function(){
        $('.delete_file').click(function(){
            let uid = $(this).attr("id");
            console.log(uid);
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url:"sql/precess.php",
                        method: 'POST',
                        data:{
                            "del_file":1,
                            "id":uid,
                        },
                        success: function (response) {
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success',
                            '1500'
                            ).then((result)=>{
                                location.reload();
                            });
                        }
                    });
                }
            });
        });
    });
</script>

<!-- delete-id -->
<script>
    $(document).ready(function(){
        $('.del_id').click(function(){
            let uid = $(this).attr("id");
            console.log(uid);
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    ).then((result)=>{
                        $.ajax({
                            url:"sql/customer/delete-id.php",
                            method: 'POST',
                            data:{
                                "del_id":1,
                                "id":uid,
                            },
                            success: function (response) {
                                window.location.href = 'allmember.php';
                            
                            }
                        });     
                    });
                  
                }
            });
        });
    });
</script>
<?php $conndb = null; ?>
</body>
</html>
