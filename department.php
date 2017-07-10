<?php include('header_info.php');
ini_set('error_reporting', E_ALL);
include('db.php'); // подключаем скрипт
 
// подключаемся к серверу

$link = mysqli_connect($host, $user, $password, $database)
or die("Ошибка " . mysqli_error($link));
 
// выполняем операции с базой данных
//$query ="SELECT * FROM department";
//$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
//if($result)
//{
//    echo "Выполнение запроса прошло успешно";
//}
 
// закрываем подключение
//mysqli_close($link);
?>
  <div class="big_banner" style="background-color:transparent; box-shadow:none;">
  <h1 class="for_h1_info">Отделения поликлиники</h1>
<div class="left_menu_about">
<div class="for_but for_but_menu"><a href="docs.php">Учредительные<br>ДОКУМЕНТЫ</a></div>
<div class="for_but for_but_menu"><a href="license.php">Лицензия</a></div>
<div class="for_but for_but_menu"><a href="admins.php">АДМИНИСТРАЦИЯ<br>поликлиники</a></div>

</div>
<div class="center_content">
	  
</div>
<p style="clear:both;"></p>
</div>


<?php include('footer_info.php');?>