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
    $stmt = $conn->prepare('SELECT * FROM doctor WHERE dep_id=:id AND dct_id<>1');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();


?>
  <div class="big_banner" style="background-color:transparent; box-shadow:none;">
  <h1 class="for_h1_info">Терапевтическое отделение</h1>
<div class="left_menu_about">
<div class="for_but for_but_menu"><a href="docs.php">Учредительные<br>ДОКУМЕНТЫ</a></div>
<div class="for_but for_but_menu"><a href="license.php">Лицензия</a></div>
<div class="for_but for_but_menu"><a href="admins.php">АДМИНИСТРАЦИЯ<br>поликлиники</a></div>

</div>
<div class="center_content">
	<?php

        if ( count($result) ) {
        foreach($result as $row) {
        $work_schedule=$row['work_schedule_all'];
        if ($work_schedule!==""){
            echo '
             <div class="for_but for_but_dep">
             <a href="">
             <p class="short_description " style="margin-top:-50px;">'.$row['dct_lastname'].' '.$row['dct_firstname'].' '.$row['dct_midname'].'</p>
             <p class="short_description for_but_desc">'.$row['dct_info'].'</p>
             <p class="short_description for_but_cert">Сертификаты: '.$row['dct_cert'].'</p>
             </a>
             <div class="work_schedule">
             <p style="font-size: 16px;padding-bottom:10px;"><strong>График работы:</strong></p>'.$row['work_schedule_all'].$work_schedule.'</div>
             </div>';
        }
else
{echo '
             <div class="for_but for_but_dep">
             <a href="">
             <p class="short_description " style="margin-top:-50px;">'.$row['dct_lastname'].' '.$row['dct_firstname'].' '.$row['dct_midname'].'</p>
             <p class="short_description for_but_desc">'.$row['dct_info'].'</p>
             <p class="short_description for_but_cert">Сертификаты: '.$row['dct_cert'].'</p>
             </a>
             <div class="work_schedule">
             <p style="font-size: 16px;padding-bottom:10px;"><strong>График работы:</strong></p>
             
             <b>Медосмотры:&nbsp;</b><br>'.$row['schedule_osmotr'].'<br><b>Прием пациентов:&nbsp;</b><br>'.$row['schedule_patient'].'</div>
             </div>';}
        }
    } else {
        echo "Ничего не найдено.";
    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
    ?>
</div>
<p style="clear:both;"></p>
</div>


<?php include('footer_info.php');?>