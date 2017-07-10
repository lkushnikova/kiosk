<?/*
Template Name: department_without
*/?>
<?php get_header(); ?>

<div class="white" style="background-color:#fff; margin-top:-10px; margin-bottom:60px;">
<div class="row">
<div class="span3" style="min-height:600px; background-color:#fff; padding-top:20px;">
<div class="left_menu">

<?php get_sidebar();?>

</div>
</div>

<div class="span9" style="background-color:#fff; padding-left:10px;padding-right:10px;">
<?php while(have_posts()):the_post();?>
	<div class="title_head">
<h3 style="font-weight:normal; float:left; margin-top:10px;"><?php the_title();?></h3>
</div>
<p style="font-size:16px;clear:both;">
  
<?php the_content();?>


</p>
<?php endwhile;?>
</div>

</div>
<div class="row" style="margin-left:0px;">

</div>
<?php get_footer(); ?>