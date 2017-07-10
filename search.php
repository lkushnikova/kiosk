<?php get_header();?>
<?php if ( have_posts() ) : ?>

	<div class="content-wrapper_news">


<div class="news" style="padding-left:20px;">
 <h1 class="page-title" style="font-weight:normal;"><?php _e( 'Результаты поиска для: ', 'it_proriv_new' ); ?><span><?php the_search_query(); ?></span></h1>

<?php while(have_posts()):the_post();?>

<a href="<?php the_permalink(); ?>" style="color:#000;">

<p><?php the_title();?></p>
</a>


 <?php endwhile; ?>
				<?php wp_reset_postdata();?> 
				        
<?php else : ?>
 
                
                    <h2 ><?php _e( 'Nothing Found', 'your-theme' ) ?></h2>
                    
                        <p><?php _e( 'К сожалению, по Вашему запросу ничего не найдено', 'it_proriv_new' ); ?></p>
    <?php get_search_form(); ?>                       
                 
                


<?php endif;?>
</div>


</div>

<?php get_footer();?>