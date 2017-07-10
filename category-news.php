<?php get_header(); ?>
  <div class="news">
<?php /* Start the Loop */?>
<? query_posts("cat=2");?>
				<?php if ( have_posts() ) : ?>
<p class="cat_title"><?php single_cat_title(''); ?></p>					
<?php /* Start the Loop */?>
			<?php while ( have_posts() ) : the_post(); ?>	
				<div class="one_news">
<div class="for_news_img" style="width:281px; height:195px;">
<?php the_post_thumbnail(); ?>
</div>
<div class="news_text">
<div class="news_date">
<?php echo get_the_date('d.m.Y'); ?>
</div>
<div class="news_header">
<a href="<?php the_permalink(); ?>" class="for_index_a">
<?php the_title(); ?>
</a>
</div>
	<p><?php the_excerpt(); ?></p>
</div>
</div>
			<?php endwhile; ?>


		<?php else : ?>

			<?echo "sorry"?>



		<?php endif; // end have_posts() check ?>

</div>
<?php get_footer(); ?>