<?php include('header_info.php');
ini_set('error_reporting', E_ALL);
$id = $_GET["id"];
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
    $set_local = $conn->prepare('SET lc_time_names="ru_RU"');
    $set_local->execute();
    $stmt = $conn->prepare('SELECT schedule_id,dct_id, DATE_FORMAT(date,"%d.%m.%Y") AS date, DATE_FORMAT(date,"%W") AS weekday,time,special_id,status FROM schedule WHERE dct_id=:id GROUP BY date');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $doctor = $conn->prepare('SELECT * FROM doctor JOIN special ON doctor.special_id=special.special_id WHERE dct_id=:id ');
    $doctor->bindParam(':id', $id);
    $doctor->execute();
    $doctor_result = $doctor->fetchAll();


?>
  <div class="big_banner" style="background-color:transparent; box-shadow:none;">
  <h1 class="for_h1_info">Запись к врачу</h1>
<div class="news white_news">
	<?php
    if ( count($doctor_result) ) {
        foreach($doctor_result as $doctor_row) {
            $doc=$doctor_row["dct_lastname"].' '.$doctor_row["dct_firstname"].' '.$doctor_row["dct_midname"];
            echo '<h3 class="doctor_name" style="">'.$doc.'<strong>,'.$doctor_row["special_name"].'</strong></h3>';
        }
    } else {
        echo "Ничего не найдено.";
    }

    if ( count($result) ) {
        echo  '<p class="big_p">Выберите дату и время</p>';
        foreach($result as $row) {

            echo '<div class=" for_but for_datetime"><a href="#.php">'.$row['date'].'<br>'.$row['weekday'].'</a></div>';

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