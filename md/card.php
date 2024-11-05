<?php
    require_once '../includes/connection.php';
    $stmt = $conndb->query("SELECT m.image ,m.fname,t.time,t.ref_m_card,m.id,
        m.date,m.phone,m.package,m.vaccine,m.accom,m.group,m.type_training,m.type_fighter,m.sponsored,m.nationalty,
        m.status_code
        FROM tb_time AS t
        LEFT JOIN member AS m ON t.ref_m_card = m.m_card
        WHERE date(t.time) =CURDATE()
        GROUP by `ref_m_card`
        ORDER BY t.time DESC LIMIT 24");
    $stmt->execute();
    $query_run = $stmt->fetchAll();
?>

<div class="row " id="cardddd">

    <?php foreach ($query_run as $row) {

    if ( $row['status_code'] == '1') {?>

    <div class="card ml-2 card_img_ticket" id="card_img">

        <div class="col text-center">
            <a href="#"><img src="<?= '../dist/img/' . $row['image'] ?>" width="110" height="110"
                    style="border-radius: 50%;" class="mt-2 mb-2"></a>
        </div>
        <span class="type_ticket">TICKET</span>
        <span class="txt" style="font-size: 6px; text-align: center;"><?= substr($row['fname'], 0, 16); ?></span>
        <span class="txt" style="font-size: 6px; text-align: center;"><?= substr($row['package'], 0, 15); ?></span>
    </div>

    <?php } else if ($row['status_code'] == '2' || $row['status_code'] == '4' ) {?>

        <div class="card ml-2 card_img">
            <div class="col">
                <a href="member_profile.php?id=<?= $row['id'] ?>" target="_blank">
                    <img src="<?= 'http://172.16.0.3/../memberimg/img/' . $row['image'] ?>" width="110" height="110" style="border-radius: 50%;" class="mt-2 mb-2">
                </a>
            </div>
            <span class="type_customer">CUSTOMER</span>
            <span class="txt" style="font-size: 6px; text-align: center;"><?= substr($row['fname'], 0, 16); ?></span>
            <span class="txt" style="font-size: 6px; text-align: center;"><?= substr($row['nationalty'], 0, 16); ?></span>
        </div>

    <?php } else if ($row['status_code'] == '3' ) {?>

        <div class="card ml-2 card_img_fighter">
            <div class="col">
                <a href="fighter_profile.php?id=<?= $row['id'] ?>" target="_blank"><img src=" <?= 'http://172.16.0.3/../fighterimg/img/' . $row['image'] ?>" width="110" height="110"style="border-radius: 50%;" class="mt-2 mb-2"></a>
            </div>
            <span class="type_fighter"> Sponsor Fighter </span>
            <span class="txt" style="font-size: 6px; text-align: center;"><?= $row['type_training']; ?></span>
            <span class="txt" style="font-size: 6px; text-align: center;"><?= substr($row['fname'], 0, 16); ?></span>
        </div>

        <?php }?>
<?php }?>

</div>