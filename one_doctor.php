<?php include('header_info.php');
ini_set('error_reporting', E_ALL);
$id = $_GET["id"];
$id=intval($id);
try {
    $host = 'localhost';
    $db   = 'kiosk';
    $user = 'root';
    $pass = '123';
    $charset = 'utf8';
    $port='8080';

    $dsn = "mysql:host=$host;port=8080;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];
    $conn = new PDO($dsn, $user, $pass, $opt);
    $stmt = $conn->prepare('SELECT * FROM doctor WHERE dct_id=:id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $num_rows = $conn->prepare('SELECT * FROM doctor');
    $num_rows->execute();
    $row1 = $num_rows->rowCount();


?>
  <div class="big_banner" style="background-color:transparent; box-shadow:none;">
  <h1 class="for_h1_info">Терапевтическое отделение</h1>
<div class="left_menu_about">
<div class="for_but for_but_menu"><a href="docs.php">Учредительные<br>ДОКУМЕНТЫ</a></div>
<div class="for_but for_but_menu"><a href="license.php">Лицензия</a></div>
<div class="for_but for_but_menu"><a href="admins.php">АДМИНИСТРАЦИЯ<br>поликлиники</a></div>

</div>
<section class="center_content">
	<?php
    echo count($result);
        if ( count($result) ) {
        foreach($result as $row) {
            $next_doc=$id+1;
            if ($next_doc>$row1)
            {
                $next_doc=1;
            }
            if ($row['work_schedule_all']!==""){
                $string=$row['work_schedule_all'];

            }
            if ($row['work_schedule_all']=="")
            {
                $string='<p><b>Медосмотры:</b></p>'.$row['schedule_osmotr'].'<br><p><b>Прием пациентов:</b></p>'.$row['schedule_patient'];

            }
            echo '
             	 <section class="one_person">
                 <h3>'.$row['dct_lastname'].' '.$row['dct_firstname'].' '.$row['dct_midname'].'</h3>
                 <img src="img/noimage.gif" class="for_avatar">
                 <div class="person_description">
                 <p>'.$row['dct_info'].'</p>
                <em>'.$row['dct_cert'].'</em>
                <div class="for_but for_but_one_doctor"><a href="choosing_datetime.php?id=' . $row["dep_id"] . '">Записаться на прием</a></div>
                 </div>
                <a href="one_doctor.php?id=' .$next_doc. '"><i class=" fa fa-caret-right fa-4x right_button" aria-hidden="true" style="float:right;font-weight:bold;"></i></a>
                <p style="clear:both;"></p>
                <div class="bottom_button">';
             echo '<p style="font-size: 16px;padding-bottom:10px;"><strong>График работы:</strong></p>'.$string.$a.'</div>  
                </div>
                </section>';


        }
    } else {
        echo "Ничего не найдено.";
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
    ?>
</section>
<p style="clear:both;"></p>
</div>


<?php include('footer_info.php');?>