<?php include('header_info.php');
ini_set('error_reporting', E_ALL);
$id = 1;
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
    $stmt = $conn->prepare('SELECT * FROM department ');
    $stmt->execute();

    $result = $stmt->fetchAll();


?>
  <div class="big_banner" style="background-color:transparent; box-shadow:none;">
  <h1 class="for_h1_info">Отделения поликлиники</h1>
<div class="left_menu_about">
<div class="for_but for_but_menu"><a href="docs.php">Учредительные<br>ДОКУМЕНТЫ</a></div>
<div class="for_but for_but_menu"><a href="license.php">Лицензия</a></div>
<div class="for_but for_but_menu"><a href="admins.php">АДМИНИСТРАЦИЯ<br>поликлиники</a></div>

</div>
<div class="center_content">
	<?php
    if ( count($result) ) {
        foreach($result as $row) {
if ($row["dep_id"]=='1') {
    echo '<div class="for_but for_but_dep"><a href="terapevt.php?id=' . $row["dep_id"] . '">' . $row["dep_name"] . '</div>';
}
else {
    echo '<div class="for_but for_but_dep"><a href="other_department.php?id=' . $row["dep_id"] . '">' . $row["dep_name"] . '</div>';
}
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