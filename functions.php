<?add_theme_support( 'post-thumbnails' );?>
<? add_theme_support('menus');
add_action('get_header', 'remove_admin_login_header');
function remove_admin_login_header() {
remove_action('wp_head', '_admin_bar_bump_cb');
}
?>
<?
if ( function_exists('register_sidebar') )
register_sidebar();
if ( function_exists('register_sidebar') )
register_sidebar(array(
'name' => 'vertical_menu',
));
?>
<?
if(function_exists('register_nav_menus')){
    register_nav_menus(array(
        'main_menu'=> 'Главное меню',
        'sub_menu' => 'Дополнительное меню',
        'left_menu' => 'Левое меню',
        'right_menu' => 'Правое меню',
        'footer_menu' => 'Меню в подвале'
    ));
}
?>
<?php
function wpb_reverse_comments($comments) {
        return array_reverse($comments);
    }
add_filter ('comments_array', 'wpb_reverse_comments');
?>
<?
add_filter('wp_list_categories','ccats');
function ccats($list) {
    if ( ! is_single() ) return $list;
    foreach((get_the_category()) as $category) { 
        $temp[] = $category->cat_ID;
    } 
    $temp = '/(cat-item-('.join('|',$temp).'))[ |"]/';
    $list = preg_replace($temp,' current-cat $1"',$list);
    return $list;
}
?>
<?php function kama_recent_comments($limit=10, $ex=45, $cat=0, $echo=1, $gravatar=''){
    global $wpdb;
    if($cat){
        $IN = (strpos($cat,'-')===false)?"IN ($cat)":"NOT IN (".str_replace('-','',$cat).")";
        $join = "LEFT JOIN $wpdb->term_relationships rel ON (p.ID = rel.object_id)
        LEFT JOIN $wpdb->term_taxonomy tax ON (rel.term_taxonomy_id = tax.term_taxonomy_id)";
        $and = "AND tax.taxonomy = 'category'
        AND tax.term_id $IN";
    }
    $sql = "SELECT comment_ID, comment_post_ID, comment_content, post_title, guid, comment_author, comment_author_email
    FROM $wpdb->comments com
        LEFT JOIN $wpdb->posts p ON (com.comment_post_ID = p.ID) {$join}
    WHERE comment_approved = '1'
        AND comment_type = '' {$and}
    ORDER BY comment_date DESC
    LIMIT $limit"; 

    $results = $wpdb->get_results($sql);

    $out = '';
    foreach ($results as $comment){
        if($gravatar)
            $grava = '<img src="http://www.gravatar.com/avatar/'. md5($comment->comment_author_email) .'?s=$gravatar&default=" alt="" width="'. $gravatar .'" height="'. $gravatar.'" />';
        $comtext = strip_tags($comment->comment_content);
        $leight = (int) iconv_strlen( $comtext, 'utf-8' );
        if($leight > $ex) $comtext =  iconv_substr($comtext,0,$ex, 'UTF-8').' …';
        $out .= "\n<li>$grava<b>".strip_tags($comment->comment_author). ": </b><a href='". get_comment_link($comment->comment_ID) ."' title='к записи: {$comment->post_title}'>{$comtext}</a></li>";
    }

    if ($echo) echo $out;
    else return $out;
}
function recent_comments_remak ($number=5, $length=150) {
        $args = array (
            'number' => $number,
            'status' => 'approve',
        );
        $comments = get_comments($args);
        echo '<ul>';
        foreach($comments as $comment) :
            $comment_content_short = strip_tags($comment->comment_content);
            $comment_content_short = substr($comment_content_short, 0, $length);
            echo '<li class="recentcomments">' . $comment->comment_author . '<br /><a href="' . get_comment_link($comment->comment_ID) . '">' . substr($comment_content_short, 0, strrpos($comment_content_short, ' ')) . '...</a></li>';
        endforeach;
        echo '</ul>';
}

function dateToRussian($date) {
    $month = array("january"=>"января", "february"=>"февраля", "march"=>"марта", "april"=>"апреля", "may"=>"мая", "june"=>"июня", "july"=>"июля", "august"=>"августа", "september"=>"сентября", "october"=>"октября", "november"=>"нояб", "december"=>"декабря");
    $days = array("monday"=>"Понедельник", "tuesday"=>"Вторник", "wednesday"=>"Среда", "thursday"=>"Четверг", "friday"=>"Пятница", "saturday"=>"Суббота", "sunday"=>"Воскресенье");
    return str_replace(array_merge(array_keys($month), array_keys($days)), array_merge($month, $days), strtolower($date));
}

add_filter('comment_form_default_fields', 'remove_url_from_comments');
function remove_url_from_comments ($fields){
    if(isset($fields['url']))
       unset($fields['url']);
       return $fields;
} 
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 ";
    }
    return $count;
}?>
<? function twentyfourteen_scripts() {
    
    // Load the Internet Explorer specific stylesheet.
    wp_enqueue_style( 'twentyfourteen-ie', get_template_directory_uri() . '/css/ie.css', array( 'twentyfourteen-style' ), '20131205' );
    wp_style_add_data( 'twentyfourteen-ie', 'conditional', 'lt IE 9' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    if ( is_singular() && wp_attachment_is_image() ) {
        wp_enqueue_script( 'twentyfourteen-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20130402' );
    }

    if ( is_active_sidebar( 'sidebar-3' ) ) {
        wp_enqueue_script( 'jquery-masonry' );
    }

    if ( is_front_page() && 'slider' == get_theme_mod( 'featured_content_layout' ) ) {
        wp_enqueue_script( 'twentyfourteen-slider', get_template_directory_uri() . '/js/slider.js', array( 'jquery' ), '20131205', true );
        wp_localize_script( 'twentyfourteen-slider', 'featuredSliderDefaults', array(
            'prevText' => __( 'Previous', 'twentyfourteen' ),
            'nextText' => __( 'Next', 'twentyfourteen' )
        ) );
    }

    wp_enqueue_script( 'twentyfourteen-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20140616', true );
}
add_action( 'wp_enqueue_scripts', 'twentyfourteen_scripts' );?>
<?php function page_excerpt() {
    add_post_type_support('page', array('excerpt'));
}
add_action('init', 'page_excerpt');
?>