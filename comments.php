
<?php // Ничего тут не удаляйте!
if ('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])) die ('Please do not load this page directly. Thanks!');
if (!empty($post->post_password)) { // если установлен пароль
	if ($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {  // и он не совпадает с cookie
?>

<h2><?php _e('Защищено Паролем'); ?></h2>
<p><?php _e('Введите пароль чтобы отобразить комментарии.'); ?></p>

<?php return;
	}
}

$oddcomment = 'alt';

?>

<!-- Отсюда можно начинать редактировать. -->
<?php if ('open' == $post->comment_status) : ?>

		<h3 id="respond" style="font-weight:normal; font-size:24.5px;"></h3>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>Вы должны <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php the_permalink(); ?>">авторизироваться</a> чтобы оставлять отзывы.</p>

<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
<?php if ( $user_ID ) : ?>

<p>Вы вошли как: <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php" style="color:#af000f;"><?php echo $user_identity; ?></a>. <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" style="color:#af000f;" title="Выйти из этого аккаунта">Выйти &raquo;</a></p>

<?php else : ?>

<p>
<label for="author"><small>Имя <?php if ($req) echo "<span style='color:red;'>*</span>"; ?></small></label>
<input type="text" name="author" id="author" style="width:30%;" value="<?php echo $comment_author; ?>" size="40" tabindex="1" />
</p>

<p>
<label for="email"><small>Еmail (<span style="color:rgb(120,120,120); font-style:italic;">не будет опубликован</span>) <?php if ($req) echo "<span style='color:red;'>*</span>"; ?></small></label>
<input type="text" name="email" id="email" style="width:30%;" value="<?php echo $comment_author_email; ?>" size="40" tabindex="2" />
</p>


<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> <?php _e('You can use these tags&#58;'); ?> <?php echo allowed_tags(); ?></small></p>-->

<p><textarea name="comment" id="comment" style="width:30%;" cols="60" rows="4" tabindex="4"></textarea></p>

<p><input name="submit" type="submit" id="submit" tabindex="5" value="Отправить" />
<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
</p>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>

<?php endif; // if you delete this the sky will fall on your head ?>
<?php if ($comments) : ?>
<h3 id="comments" style="font-weight:normal;">Отзывы (<?php comments_number('0','1','%'); ?>)</h3>
<ol class="commentlist">
<?php foreach ($comments as $comment) : ?>

	<li class="<?php echo $oddcomment; ?>" id="comment-<?php comment_ID() ?>">

<div class="commentmetadata">
<span style="font-size:20px; color:#c21522;"><?php comment_author_link() ?></span><br><a href="#comment-<?php comment_ID() ?>" style="color:rgb(120,120,120);" title=""> <?php comment_date() ?> <?php _e('в');?> <?php comment_time() ?></a> <?php edit_comment_link(' Редактировать','',''); ?>
 		<?php if ($comment->comment_approved == '0') : ?>
		<em><?php _e('Ваш комментарий ожидает модерации.'); ?></em>
 		<?php endif; ?>
</div>

<?php comment_text(); ?>

	</li>
<hr/>
<?php 
	if ('alt' == $oddcomment) $oddcomment = '';
	else $oddcomment = 'alt';
?>

<?php endforeach; ?>
	</ol>

<?php else : // это отображается, если пока нет комментариев ?>

<?php if ('open' == $post->comment_status) : ?>
	<!-- Если комментарии открыты, но их нет. -->
	<?php else : // comments are closed ?>

	<!-- Если комментарии закрыты. -->
<p class="nocomments">Комментарии запрещены.</p>

	<?php endif; ?>
<?php endif; ?>


