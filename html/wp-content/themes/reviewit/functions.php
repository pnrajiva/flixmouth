<?php
/*************************** File Directories ***************************/

define(MY_THEME, get_stylesheet_directory());
define(MY_THEME_URL, get_stylesheet_directory_uri());
define(ghostpool_inc, TEMPLATEPATH . '/lib/inc/');
define(ghostpool_scripts, TEMPLATEPATH . '/lib/scripts/');
define(ghostpool_admin, TEMPLATEPATH . '/lib/admin/inc/');


/*************************** Additional Functions ***************************/

// Main Theme Options
require_once(ghostpool_admin . 'theme-options.php');

// Meta Options
require_once(ghostpool_admin . 'theme-meta-options.php');

// Widgets
require_once(ghostpool_admin . 'theme-widgets.php');

// Sidebars
require_once(ghostpool_admin . 'theme-sidebars.php');

// Shortcodes
require_once(ghostpool_admin . 'theme-shortcodes.php');

// Custom Post Types
require_once(ghostpool_admin . 'theme-post-types.php');

// Language
require_once(ghostpool_inc . 'language.php');

// TinyMCE
require_once (ghostpool_admin . 'tinymce/tinymce.php');

// WP Show IDs
require_once(ghostpool_scripts . 'wp-show-ids/wp-show-ids.php');

// BuddyPress Functions
require_once(ghostpool_inc . '/functions-buddypress.php' );

// Update Notification
require_once(ghostpool_admin . 'theme-update-notification.php');


/*************************** Featured Image Sizes ***************************/

/*add_theme_support('post-thumbnails');
get_option('thumbnail_crop');
add_image_size('thumbnail', 120, 120, true);
add_image_size('ghostpool_thumbnail', 100, 130, true);
add_image_size('slider-image', 630, 344, true);
add_image_size('slider-thumbnail', 80, 65, true);
add_image_size('blog-image', 638, 238, true);
add_image_size('review-box-image', 212, 120, true);
add_image_size('review-page-image', 150, 180, true);*/


/*************************** Feed Links ***************************/

add_theme_support('automatic-feed-links');

/*************************** Capturing comments in review post in uddypress activity stream ***************************/
function pra_record_my_custom_post_type_comments( $post_types ) {
      $post_types[] = 'review'; // Add your custom post type name to the array. If you have a post type called 'dolphin' then you have a weird plugin
      return $post_types;
  }
  add_filter( 'bp_blogs_record_comment_post_types', 'pra_record_my_custom_post_type_comments' );
/*************************** Navigation Menus ***************************/

add_action( 'init', 'register_my_menus' );
function register_my_menus() {
register_nav_menus(array(
'header-nav' => __( 'Header Navigation' ),
'footer-nav' => __( 'Footer Navigation' )
));
}
/*************************** Removing Settings menu in buddy press - added by prashanth ***************************/
add_action( 'bp_setup_nav', 'pr_remove_settings_options' );
function pr_remove_settings_options(){
    bp_core_remove_nav_item('settings');
}
/*************************** Connecting friends in facebook login ***************************/
add_action('wpfb_login', 'join_flix_add_as_friends');
function join_flix_add_as_friends($arg)
{
    $potential_friend_id = $arg['WP_ID'];
    session_start();
    if(array_key_exists('join_flix_userid',$_SESSION) && !empty($_SESSION['join_flix_userid'])) {
        $requested_user_id = $_SESSION['join_flix_userid'];
        if ( !is_numeric( $potential_friend_id ) || !isset( $potential_friend_id ) ){

        }
        else{
            if ( $potential_friend_id == $requested_user_id ){

            }
            else{
                $friendship_status = BP_Friends_Friendship::check_is_friend( $requested_user_id, $potential_friend_id );
                if ( 'not_friends' == $friendship_status ) {
                    if ( !friends_add_friend( $requested_user_id, $potential_friend_id ) ) {
                        bp_core_add_message( __( 'Friendship could not be requested.', 'buddypress' ), 'error' );
                    } else {
                        $_SESSION['join_flix_userid'] = false;
                        unset($_SESSION['join_flix_userid']);
                        session_write_close();
                        bp_core_add_message( __( 'Friendship requested', 'buddypress' ) );
                    }
                } 
            }
        }
    }
}
/*************************** Custom Background ***************************/

add_custom_background();


/*************************** Excerpts ***************************/

// WordPress Excerpt Length
function new_excerpt_length($length) {return 500;}
add_filter('excerpt_length', 'new_excerpt_length');

// Custom Excerpt Length
function excerpt($limit) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt)>=$limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }	
  $excerpt = preg_replace('`\[[^\]]*\]`','',$excerpt);
  return $excerpt;
}

// Replace Excerpt Ellipsis
function new_excerpt_more($more) {
	return '...';
}
add_filter('excerpt_more', 'new_excerpt_more');
remove_filter('the_excerpt', 'wpautop');

// Custom Content More Link
function new_more_link( $more_link, $more_link_text ) {
	return str_replace('more-link', 'more-link read-on', $more_link );
}
add_filter('the_content_more_link', 'new_more_link', 10, 2);


/*************************** Shortcode Support For Text Widget ***************************/

add_filter('widget_text', 'do_shortcode');


/*************************** Page Navigation ***************************/

function gp_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     
	 if (get_query_var('paged')) {
		 $paged = get_query_var('paged');
	 } elseif (get_query_var('page')) {
		 $paged = get_query_var('page');
	 } else {
		 $paged = 1;
	 }

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
	
     if(1 != $pages)
     {
        echo "<div class='wp-pagenavi'>";
		echo '<span class="pages">'.gp_page.' '.$paged.' '.gp_of.' '.$pages.'</span>';
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}


/*************************** Breadcrumbs ***************************/

// Breadcrumbs
function the_breadcrumb() {
global $post;
require(ghostpool_inc . 'options.php');

	if (!is_home()) {
		echo '<a href="'.get_option('home').'">'.gp_home.'</a>';
		if (is_category()) {
			echo " / ";
			echo single_cat_title();
		}
		elseif(function_exists('bp_get_options_nav') && !bp_is_blog_page()) {
			$site_title = get_bloginfo('name');
			$bp_title_1 = array($site_title, ' &#124; ', ' /  / ');
			$bp_title_2 = array('', ' / ', ' / ');
			$bp_title = str_replace($bp_title_1, $bp_title_2, bp_get_page_title());
			echo $bp_title;
		}
		elseif (is_singular('review')) {
			if(get_option("permalink_structure")) {
			echo ' / <a href="'.get_bloginfo('url').'/'.$theme_review_cat_slug.'">';
			} else {
			echo ' / <a href="'.get_bloginfo('url').'/?post_type='.$theme_review_slug.'">';
			}
			echo $theme_review_plural_name;
			echo "</a> / ";
			echo the_title();
		}
		elseif(is_singular('post') && !is_attachment()) {
			$cat = get_the_category(); $cat = $cat[0];
			echo " / ";
			echo get_category_parents($cat, TRUE, ' / ');
			echo the_title();
		}		
		elseif (is_search()) {
			echo " / " . gp_search;
		}		
		elseif (is_page() && $post->post_parent) {
			echo ' / <a href="'.get_permalink($post->post_parent).'">';
			echo get_the_title($post->post_parent);
			echo "</a> / ";
			echo the_title();		
		}
		elseif (is_page() OR is_attachment()) {
			echo " / "; 
			echo the_title();
		}
		elseif (is_author()) {
			echo wp_title(' / ');
			echo "'s " . gp_profile;
		}
		elseif (is_404()) {
			echo " / "; 
			echo gp_error_404;
		}		
		elseif(is_tax() && taxonomy_exists('review_categories')) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$tax_name = get_taxonomy(get_query_var('taxonomy'));
			if(get_option("permalink_structure")) {
			echo ' / <a href="'.get_bloginfo('url').'/'.$theme_review_cat_slug.'">';
			} else {
			echo ' / <a href="'.get_bloginfo('url').'/?review_categories='.$theme_review_cat_slug.'">';
			}
			echo $theme_review_plural_name;
			echo "</a> / ";
			if($tax_name && !$tax_name->hierarchical) {
			echo $tax_name->labels->name;
			echo " / ";
			}
			echo $term->name;
		}
		/*elseif (is_tax() && is_archive()) {
			$term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
			$tax_name = get_taxonomy(get_query_var('taxonomy'));
			if($term->name) {
			if(get_option("permalink_structure")) {
			echo ' / <a href="'.get_bloginfo('url').'/'.$theme_review_cat_slug.'">';
			} else {
			echo ' / <a href="'.get_bloginfo('url').'/?review_categories='.$theme_review_cat_slug.'">';
			}
			if($tax_name && !$tax_name->hierarchical) {
			echo ' / ';
			echo $tax_name->labels->name;
			}
			echo "</a>";
			echo $term->name;
			} else {
			echo " / ";
			echo $theme_review_plural_name;
			if($tax_name && !$tax_name->hierarchical) {
			echo " / ";
			echo $tax_name->labels->name;
			}
			}
		}*/		
		elseif (is_archive()) {
			echo wp_title(' / ');		
		}
	}
}


/*************************** Shorten Titles ***************************/

// Review Box Titles
function review_box_title($text) {
	$chars_limit = 32;
	$chars_text = strlen($text);
	$text = $text." ";
	$text = substr($text,0,$chars_limit);
	$text = substr($text,0,strrpos($text,' '));
	if ($chars_text > $chars_limit) {
	$text = $text."...";
	}
	return $text;
}


/*************************** Search Reviews Only ***************************/

require(ghostpool_inc . 'options.php');

if($theme_search_criteria == "1") {

	function SearchFilter($query) {
		if ($query->is_search) {
			$query->set('post_type','review');
		}
		return $query;
	}	
	add_filter('pre_get_posts','SearchFilter');
	
}


/*************************** Shortcode Empty Paragraph Fix ***************************/

// Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
add_filter('the_content', 'shortcode_empty_paragraph_fix');
function shortcode_empty_paragraph_fix($content)
{   
	$array = array (
		'<p>[' => '[', 
		']</p>' => ']', 
		']<br />' => ']'
	);

	$content = strtr($content, $array);

	return $content;
}


/*************************** TimThumb Image Directory ***************************/

function get_image_path ($post_id = null) {
	if ($post_id == null) {
		global $post;
		$post_id = $post->ID;
	}
	$theImageSrc = get_post_meta($post_id, 'ghostpool_thumbnail', true);
	global $blog_id;
	if (isset($blog_id) && $blog_id > 0) {
		$imageParts = explode('/files/', $theImageSrc[0]);
		if (isset($imageParts[1])) {
			$theImageSrc = '/blogs.dir/' . $blog_id . '/files/' . $imageParts[1];
		}
	}
	return $theImageSrc;
}


/*************************** Password Protected Form ***************************/

add_filter( 'the_password_form', 'custom_password_form' );
function custom_password_form() {
	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$form =  '<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-pass.php" method="post">
	' . gp_password_protected. '<br/><input name="post_password" id="' . $label . '" type="password" size="20" /><input type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
	</form>';
	return $form;
}


/*************************** Redirect to Theme Options after Activation ***************************/

if (is_admin() && isset($_GET['activated'] ) && $pagenow == "themes.php" ) {
    //Call action that sets
    add_action('admin_head','ct_option_setup');
    //Do redirect
    header( 'Location: '.admin_url().'admin.php?page=theme-options.php' ) ;
}

?>
