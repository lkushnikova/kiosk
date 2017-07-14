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
    $stmt = $conn->prepare('SELECT * FROM department WHERE dep_id=:id');
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetchAll();


?>
  <div class="big_banner" style="background-color:transparent; box-shadow:none;">
    <?php if ($id=='2') {
        echo '
    <h1 class="for_h1_info">Отделение восстановительной медицины и реабилитации</h1>
    
    ';}
    elseif($id=='3')
    {
        echo '
    <h1 class="for_h1_info"> Стоматологическое отделение</h1>
    
    ';}
    elseif($id=='4')
    {
        echo '
    <h1 class="for_h1_info">Клинико-диагностическая лаборатория</h1>
    
    ';}
    ?>

<div class="left_menu_about">
<div class="for_but for_but_menu"><a href="docs.php">Учредительные<br>ДОКУМЕНТЫ</a></div>
<div class="for_but for_but_menu"><a href="license.php">Лицензия</a></div>
<div class="for_but for_but_menu"><a href="admins.php">АДМИНИСТРАЦИЯ<br>поликлиники</a></div>

</div>
<div class="center_content">
	<?php
        if ( count($result) ) {
        foreach($result as $row) {


            echo '
             <p >'.$row['dep_description'].'</p>
             ';

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