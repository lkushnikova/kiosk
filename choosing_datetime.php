<?php include('header_info.php');
ini_set('error_reporting', E_ALL);
$id = $_GET["id"];
$date_for_time=$_GET['date_for_time'];
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
            echo '<a name="doc"><h3 class="doctor_name" style="">'.$doc.'<strong>,'.$doctor_row["special_name"].'</strong></h3></a>';
        }
    } else {
        echo "Ничего не найдено.";
    }

    if ( count($result) ) {
        echo  '<p class="big_p">Выберите дату</p>';
        foreach($result as $row) {
$formatted_date=$row['date1'];
            echo '<div class=" for_but for_datetime"><a href="choosing_datetime.php?id='.$row['dct_id'].'&date_for_time='.$formatted_date.'#doc">'.$row['date'].'<br>'.$row['weekday'].'</a></div>';

        }
    } else {
        echo "Ничего не найдено.";
    }

    echo '<hr style="width:100%;clear:both; margin-top:30px;background-color:#006fa8;">';
    if(isset($date_for_time)){
        $for_time = $conn->prepare('SELECT schedule_id,dct_id,DATE_FORMAT(date,"%d.%m.%Y") AS date,DATE_FORMAT(time, "%H:%i") AS time,special_id,status FROM schedule WHERE dct_id=:id AND date=:date_for_time ORDER BY time');
        $for_time->bindParam(':id', $id);
        $for_time->bindParam(':date_for_time', $date_for_time);
        $for_time->execute();
        $result_for_time = $for_time->fetchAll();

        if ( count($result_for_time) ) {
            echo  '<p class="big_p">Выберите время</p>';
            ?>
            <?php foreach($result_for_time as $row_time) {
                $status=$row_time['status'];
            if ($status=='1')
            { echo '<div style="background:#006fa8!important;" class=" for_but for_datetime" ><a href="confirm_appointment.php?dct_id='.$id.'&time='.$row_time['time'].'&date='.$formatted_date.'">'.$row_time['time'].'</a></div>';
            }
                elseif ($status=='2')
                { echo '<div class=" for_but for_datetime" style="background:darkgrey;"><a href="#.php">'.$row_time['time'].'</a></div>';
                }
                elseif ($status=='3')
                { echo '<div class=" for_but for_datetime" ><a href="#.php">'.$row_time['time'].'</a></div>';
                }
            }
        } else {
            echo "Ничего не найдено.";
        }


    }
} catch(PDOException $e) {
    echo 'ERROR: ' . $e->getMessage();
}
    ?>
<p style="clear:both;"></p>
</div>

</div>


<?php include('footer_info.php');?>