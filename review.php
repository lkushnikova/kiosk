<?/*
Template Name: review
*/?>
<?php get_header();?>
<?php while(have_posts()):the_post();?>
	<div class="news" style="width:97%; border-radius:0px; margin:-8px auto; margin-bottom:60px; padding-left:50px;">
<h1 style="font-weight:normal;"><?php the_title();?></h1>
<hr/>
<?php the_content();?>
<?php comments_template(); ?>
</div>
<?php endwhile;?>
<?php get_footer();?>