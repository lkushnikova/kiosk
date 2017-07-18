<?php include('header_main.php');
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
    $stmt = $conn->prepare('SELECT * FROM special');
    $stmt->execute();

    $result = $stmt->fetchAll();


    ?>


    <div class="big_banner" style="background-color:transparent; box-shadow:none;">
    <h1 class="for_h1_info">Запись на прием</h1>

    <div class="news">
    <?php
    if ( count($result) ) {
        foreach($result as $row) {
               echo '<div class="for_but for_but_dep"><a href="terapevt.php?spc_id=' . $row["special_id"] . '">' . $row["special_name"] . '</div>';
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

<?php include('footer.php');?>