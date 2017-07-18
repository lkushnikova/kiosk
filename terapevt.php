<?php include('header_info.php');
ini_set('error_reporting', E_ALL);
$id = $_GET["id"];
$spc_id = $_GET["spc_id"];
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
    if (isset($spc_id))
    {$stmt = $conn->prepare('SELECT * FROM doctor WHERE special_id=:id AND dct_id<>1');
     $stmt->bindParam(':id', $spc_id);
    }
    if (!isset($spc_id))
    {$stmt = $conn->prepare('SELECT * FROM doctor WHERE dep_id=:id AND dct_id<>1');
        $stmt->bindParam(':id', $id);}

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
if ($row['work_schedule_all']!==""){
    $string=$row['work_schedule_all'];

}
if ($row['work_schedule_all']=="")
{
    $string='<p><b>Медосмотры:</b></p>'.$row['schedule_osmotr'].'<br><p><b>Прием пациентов:</b></p>'.$row['schedule_patient'];

}

            echo '
             <div class="for_but for_but_dep">
             <a href="one_doctor.php?id=' . $row["dct_id"] . '">
             <p class="short_description " style="margin-top:-50px;">'.$row['dct_lastname'].' '.$row['dct_firstname'].' '.$row['dct_midname'].'</p>
             <p class="short_description for_but_desc">'.$row['dct_info'].'</p>
             <p class="short_description for_but_cert">Сертификаты: '.$row['dct_cert'].'</p>
             </a>
             <div class="work_schedule">';
             echo '<p style="font-size: 16px;padding-bottom:10px;"><strong>График работы:</strong></p>'.$string.$a.'</div>
             </div>';


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