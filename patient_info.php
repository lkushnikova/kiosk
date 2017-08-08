<?php include('header_info.php');
ini_set('error_reporting', E_ALL);
$dct_id = $_GET["dct_id"];
$date=$_GET["date_for_time"];
$time=$_GET["time"];
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
    $stmt = $conn->prepare('SELECT schedule_id,dct_id, DATE_FORMAT(date,"%d.%m.%Y") AS date, date AS date1, DATE_FORMAT(date,"%W") AS weekday,time,special_id,status FROM schedule WHERE dct_id=:id GROUP BY date');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $doctor = $conn->prepare('SELECT * FROM doctor JOIN special ON doctor.special_id=special.special_id WHERE dct_id=:id ');
    $doctor->bindParam(':id', $dct_id);
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
            echo '<a name="doc"><h3 class="doctor_name" style="">'.$doc.'<strong>,'.$doctor_row["special_name"].'</strong></h3></a>';
            echo '<h4>'.$doctor_row['dct_cert'].'</h4>';
            echo '<hr>';
            echo '<p>Дата приема: '.date_create($date)->Format('d.m.Y').'</p>';
            echo '<p>Время приема: '.$time.'</p>';
        }?>
        <form method="post" action="#.php" name="patient_info">
            <input type="text" name="patient_fio" placeholder="ФИО пациента" required>
            <select name="patient_status" required>
                <option>
                    Выберите статус пациента
                </option>
            </select>
            <input type="text" name="patient_house" placeholder="Номер дома пациента" required>
            <input type="text" name="patient_fio" placeholder="Номер для смс-оповещения" required pattern="+7">
        </form>
       <?php echo '<div class=" for_but for_confirm"><a href="confirm_appointment.php?id='.$row['dct_id'].'&date_for_time='.$formatted_date.'#doc">Записаться</a></div>';

    } else {
        echo "Ничего не найдено.";
    }



} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
    ?>
<p style="clear:both;"></p>
</div>

</div>


<?php include('footer_info.php');?>