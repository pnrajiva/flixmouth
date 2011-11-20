<?php // Custom Post Types

function post_type_review() {

	require(ghostpool_inc . 'options.php');
	
	/*************************** Review Post Type ***************************/
	
	register_post_type('review', array(
		'labels' => array('name' => __($theme_review_plural_name), 'singular_label' => __($theme_review_singular_name), 'add_new_item' => __('Add '.$theme_review_plural_name), 'edit_item' => __('Edit '.$theme_review_plural_name), 'search_items' => __('Search '.$theme_review_plural_name)),
		'public' => true,
		'show_ui' => true,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => $theme_review_slug),
		'menu_position' => 20,
		'with_front' => true,
		'has_archive' => $theme_review_cat_slug,
		'supports' => array('title', 'editor', 'comments', 'author')
	));
	
	
	/*************************** Review Categories ***************************/
	
	register_taxonomy('review_categories', 'review', array('hierarchical' => true, 'labels' => array('name' => __($theme_review_cat_plural_name), 'singular_label' => __($theme_review_cat_singular_name), 'add_new_item' => __('Add '.$theme_review_cat_plural_name), 'search_items' => __('Search '.$theme_review_cat_plural_name)), 'rewrite' => array('slug' => $theme_review_cat_slug)));
	
	
	/*************************** Review Tags ***************************/

	if($theme_review_tag_1 == "0") {
		register_taxonomy('release_date', 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_1_plural_name), 'singular_label' => __($theme_review_tag_1_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_1_plural_name), 'search_items' => __('Search '.$theme_review_tag_1_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_1_slug)));
	}
	
	if($theme_review_tag_2 == "0") {
		register_taxonomy('genre', 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_2_plural_name), 'singular_label' => __($theme_review_tag_2_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_2_plural_name), 'search_items' => __('Search '.$theme_review_tag_2_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_2_slug)));
	}
	
	if($theme_review_tag_3 == "0") {
		register_taxonomy('rating', 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_3_plural_name), 'singular_label' => __($theme_review_tag_3_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_3_plural_name), 'search_items' => __('Search '.$theme_review_tag_3_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_3_slug)));
	}
	
	if($theme_review_tag_4 == "0") {
		register_taxonomy('director', 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_4_plural_name), 'singular_label' => __($theme_review_tag_4_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_4_plural_name), 'search_items' => __('Search '.$theme_review_tag_4_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_4_slug)));
	}
	
	if($theme_review_tag_5 == "0") {
		register_taxonomy('producer', 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_5_plural_name), 'singular_label' => __($theme_review_tag_5_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_5_plural_name), 'search_items' => __('Search '.$theme_review_tag_5_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_5_slug)));
	}
	
	if($theme_review_tag_6 == "0") {
		register_taxonomy('screenwriter', 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_6_plural_name), 'singular_label' => __($theme_review_tag_6_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_6_plural_name), 'search_items' => __('Search '.$theme_review_tag_6_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_6_slug)));
	}
	
	if($theme_review_tag_7 == "0") {
		register_taxonomy('studio', 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_7_plural_name), 'singular_label' => __($theme_review_tag_7_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_7_plural_name), 'search_items' => __('Search '.$theme_review_tag_7_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_7_slug)));
	}
	
	if($theme_review_tag_8 == "0") {
		register_taxonomy('starring', 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_8_plural_name), 'singular_label' => __($theme_review_tag_8_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_8_plural_name), 'search_items' => __('Search '.$theme_review_tag_8_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_8_slug)));
	}

	if($theme_review_tag_9 == "1") {
		register_taxonomy($theme_review_tag_9_slug, 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_9_plural_name), 'singular_label' => __($theme_review_tag_9_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_9_plural_name), 'search_items' => __('Search '.$theme_review_tag_9_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_9_slug)));
	}

	if($theme_review_tag_10 == "1") {
		register_taxonomy($theme_review_tag_10_slug, 'review', array('hierarchical' => false, 'labels' => array('name' => __($theme_review_tag_10_plural_name), 'singular_label' => __($theme_review_tag_10_singular_name), 'add_new_item' => __('Add '.$theme_review_tag_10_plural_name), 'search_items' => __('Search '.$theme_review_tag_10_plural_name)), 'rewrite' => array('slug' => $theme_review_tag_10_slug)));
	}
	
}
	
add_action('init', 'post_type_review');


function post_type_slide() {

	/*************************** Slide Post Type ***************************/
	
	register_post_type('slide', array(
		'labels' => array('name' => __('Slides'), 'singular_label' => __('Slide'), 'add_new_item' => __('Add Slide'), 'search_items' => __( 'Search Slides' ),'edit_item' => __('Edit Slide')),
		'public' => true,
		'exclude_from_search' => true,
		'show_ui' => true,
		'show_in_nav_menus' => false,
		'_builtin' => false,
		'_edit_link' => 'post.php?post=%d',
		'capability_type' => 'post',
		'hierarchical' => false,
		'rewrite' => array("slug" => "slide"),
		'menu_position' => 20,
		'with_front' => true,
		'supports' => array('title', 'editor', 'comments', 'author')
	));
	
	
	/*************************** Slide Categories ***************************/
	
	register_taxonomy('slide_categories', 'slide', array('show_in_nav_menus' => false, 'hierarchical' => true, 'labels' => array('name' => __( 'Slide Categories' ), 'singular_label' => __('Slide Category'), 'add_new_item' => __( 'Add New Slide Category' ), 'search_items' => __( 'Search Slide Categories' )), 'rewrite' => array('slug' => 'slide-categories')));


	/*************************** Slide Page Layout ***************************/
	
	add_filter("manage_edit-slide_columns", "slide_edit_columns");
	add_action("manage_posts_custom_column",  "slide_custom_columns");
	
	function slide_edit_columns($columns){
			$columns = array(
				"cb" => "<input type=\"checkbox\" />",
				"title" => "Title",
				"slide_desc" => "Description",	
				"slide_categories" => "Categories",
				"slide_image" => "Image",			
				"date" => "Date"
			);
	
			return $columns;
	}
	
	function slide_custom_columns($column){
			global $post;
			require(ghostpool_inc . 'options.php');			
			switch ($column)
			{
				case "slide_desc":
					echo excerpt(10);
					break;
				case "slide_categories":
					echo get_the_term_list($post->ID, 'slide_categories', '', ', ', '');
					break;
				case "slide_image":			
				
					if(get_post_meta($post->ID, 'ghostpool_slide_image', true)) {

						echo '<img src="';					
						if($theme_timthumb == "0") {
							echo get_bloginfo('template_directory').'/lib/scripts/timthumb.php?src=';
						}					
						echo get_post_meta($post->ID, 'ghostpool_slide_image', true);					
						if($theme_timthumb == "0") {
							echo '&amp;h=75&amp;w=100&amp;zc=1';
						}
						echo '" alt="" width="100" height="75" />';	
						
					}
					
					break;				
			}
	}

}

add_action('init', 'post_type_slide');

?>