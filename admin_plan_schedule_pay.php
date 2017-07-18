<? ob_start(); ?>
<?php
session_start();
include ("interface.php");
include('db.php');
mysql_query("SET NAMES utf8");
if (isset($_SESSION['id'])) {
?>

<!Doctype html>
<html>
	
    <head>
    	<meta charset="UTF-8">
    	<title>Формирование расписания работы специалистов</title>
		<link rel="stylesheet" href="dkb/style.css">
	</head>



	<body>
		<div class="content-wrapper">
<div class="content-small">
  <div class="top_head">
<div class="mid_head">
<div class="logo">
<a class="brand" href="index.php"><img src="dkb/img/logo.png"></a>
</div>


<h2><p> НУЗ «Дорожная клиническая больница<br/>  на станции Саратов-II ОАО «РЖД»</p></h2>
<p class="red">Клиника, которую знают. Врачи, которым доверяют</p>
</div>

<div class="right_head">
<p>Справочная служба<br/>(8452) 41-73-61</p>
<p>Скорая помощь (круглосуточно)<br/>(8452) 41-97-17, (8452) 41-97-07</p>
<p>410004, г. Саратов<br/>1-й Станционный проезд, 7</p>
</div>



</div>
    				
					<?
						show_adminmenu("adm");
					?>
       					<div class="news">
         					
                             
							<h3>Формирование расписания приема врачей </h3>							
								<?php 
								
									include('plan_schedule_new.php');
								?>
							
                           

    
						</div>

				

		
</div>
</div>
	
    </body>


</html>
<?php
}
else
{
 header('Location: login.php');
}


 ?>
<? ob_flush(); ?>