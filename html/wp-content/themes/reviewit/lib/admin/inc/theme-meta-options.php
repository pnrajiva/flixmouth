<?php // Meta Settings (WPShout.com)

require(ghostpool_inc . 'options.php');

add_action( 'admin_menu', 'ghostpool_create_meta_box' );
add_action( 'save_post', 'ghostpool_save_meta_data' );

function ghostpool_create_meta_box() {
	global $theme_name;

	add_meta_box( 'post-meta-boxes', __('Post Settings'), 'post_meta_boxes', 'post', 'normal', 'high' );
	add_meta_box( 'page-meta-boxes', __('Page Settings'), 'page_meta_boxes', 'page', 'normal', 'high' );
	add_meta_box( 'slide-meta-boxes', __('Slide Settings'), 'slide_meta_boxes', 'slide', 'normal', 'high');
	add_meta_box( 'review-meta-boxes', __('Review Settings'), 'review_meta_boxes', 'review', 'normal', 'high');

}


/*************************** Post Settings ***************************/

function ghostpool_post_meta_boxes() {

	$meta_boxes = array(

	'format_settings' => array( 'name' => 'format_settings', 'title' => __('Format Settings', 'ghostpool'), 'desc' => '', 'type' => 'open' ),
		
		'ghostpool_thumbnail' => array( 'name' => 'ghostpool_thumbnail', 'title' => __('Image URL', 'ghostpool'), 'desc' => 'The relative URL of the thumbnail e.g. <code>wp-content/uploads/image.jpg</code>.', 'extras' => 'getimage', 'type' => 'text'),	
		
		'ghostpool_layout' => array( 'name' => 'ghostpool_layout', 'title' => __('Layout', 'ghostpool'), 'desc' => 'Choose the layout for this page.', 'options' => array('Default', 'Full Width'), 'type' => 'select'),	
		
		'ghostpool_sidebar' => array( 'name' => 'ghostpool_sidebar', 'title' => __('Sidebar', 'ghostpool'), 'desc' => 'Choose which sidebar area to display on this page.', 'std' => 'Default Sidebar', 'type' => 'select_sidebar'),
		
	array('type' => 'close'),
	
	array('type' => 'clear'),
	
	);

	return apply_filters( 'ghostpool_post_meta_boxes', $meta_boxes );
}


/*************************** Page Settings ***************************/

function ghostpool_page_meta_boxes() {

	$meta_boxes = array(

	'format_settings' => array( 'name' => 'format_settings', 'title' => __('Format Settings', 'ghostpool'), 'desc' => '', 'type' => 'open' ),
		
		'ghostpool_thumbnail' => array( 'name' => 'ghostpool_thumbnail', 'title' => __('Image URL', 'ghostpool'), 'desc' => 'The relative URL of the thumbnail e.g. <code>wp-content/uploads/image.jpg</code>.', 'extras' => 'getimage', 'type' => 'text'),	
		
		'ghostpool_layout' => array( 'name' => 'ghostpool_layout', 'title' => __('Layout', 'ghostpool'), 'desc' => 'Choose the layout for this page.', 'options' => array('Default', 'Full Width'), 'type' => 'select'),	
		
		'ghostpool_sidebar' => array( 'name' => 'ghostpool_sidebar', 'title' => __('Sidebar', 'ghostpool'), 'desc' => 'Choose which sidebar area to display on this page.', 'std' => 'Default Sidebar', 'type' => 'select_sidebar'),

	array('type' => 'close'),
	
	'blog_settings' => array('name' => 'blog_settings', 'type' => 'open', 'title' => __('Blog Template Settings', 'ghostpool'), 'desc' => 'For use with the Blog page template.<br/>'),
	
		'ghostpool_blog_cats' => array( 'name' => 'ghostpool_blog_cats', 'title' => __('Category IDs', 'ghostpool'), 'desc' => 'Enter the IDs of the post categories you want to display (e.g. 25,56,7,10). Leave blank to display all categories.', 'type' => 'text' ),

		'ghostpool_blog_posts_per_page' => array( 'name' => 'ghostpool_blog_posts_per_page', 'title' => __('Posts Per Page', 'ghostpool'), 'desc' => 'Enter the number of blog posts you want to display per page.', 'type' => 'text_small', 'std' => "10"),

		'ghostpool_blog_text_display' => array( 'name' => 'ghostpool_blog_text_display', 'title' => __('Text Display', 'ghostpool'), 'desc' => 'Text display for your blog posts.', 'options' => array('Excerpt', 'Full Content'), 'type' => 'select'),	

	array('type' => 'close'),
	
	array('type' => 'clear'),
	
	);

	return apply_filters( 'ghostpool_page_meta_boxes', $meta_boxes );
}


/*************************** Review Settings ***************************/

function ghostpool_review_meta_boxes() {

	$meta_boxes = array(

	'format_settings' => array( 'name' => 'format_settings', 'title' => __('Format Settings', 'ghostpool'), 'desc' => '', 'type' => 'open'),
		
		'ghostpool_thumbnail' => array( 'name' => 'ghostpool_thumbnail', 'title' => __('Image URL', 'ghostpool'), 'desc' => 'The relative URL of the thumbnail e.g. <code>wp-content/uploads/image.jpg</code>.', 'extras' => 'getimage', 'type' => 'text'),	
		
		'ghostpool_sidebar' => array( 'name' => 'ghostpool_sidebar', 'title' => __('Sidebar', 'ghostpool'), 'desc' => 'Choose which sidebar area to display on this page.', 'std' => 'Default Sidebar', 'type' => 'select_sidebar'),

	array('type' => 'close'),
	
	'review_settings' => array( 'name' => 'review_settings', 'title' => __('Review Settings', 'ghostpool'), 'desc' => '', 'type' => 'open'),

		'ghostpool_search_tags' => array( 'name' => 'ghostpool_search_tags', 'title' => __('Search Tags', 'ghostpool'), 'desc' => '', 'std' => '', 'type' => 'search_tags'),
		
		'ghostpool_our_rating' => array( 'name' => 'ghostpool_our_rating', 'title' => __('Disable "Our Rating" Score', 'ghostpool'), 'desc' => 'Checking this disables the "Our Rating" score from displaying on the page.', 'type' => 'checkbox' ),

		'ghostpool_your_rating' => array( 'name' => 'ghostpool_your_rating', 'title' => __('Disable "Your Rating" Score', 'ghostpool'), 'desc' => 'Checking this disables the "Your Rating" score from displaying on the page.', 'type' => 'checkbox' ),

		'ghostpool_your_rating_comment' => array( 'name' => 'ghostpool_your_rating_comment', 'title' => __('Enable "Your Rating" Score In Comments', 'ghostpool'), 'desc' => 'Checking this moves the "Your Rating" section to the comment form and can only be used when a visitor makes a comment.', 'type' => 'checkbox' ),
		
		array('type' => 'divider'),

		'ghostpool_our_rating_id' => array( 'name' => 'ghostpool_our_rating_id', 'title' => __('"Our Rating" Multi Set ID', 'ghostpool'), 'desc' => 'The ID of the Multi Set you created <a href="admin.php?page=gd-star-rating-multi-sets">here</a>.', 'std' => '1', 'type' => 'text_small'),	
		
		'ghostpool_your_rating_id' => array( 'name' => 'ghostpool_your_rating_id', 'title' => __('"Your Rating" Multi Set ID', 'ghostpool'), 'desc' => 'The ID of the Multi Set you created <a href="admin.php?page=gd-star-rating-multi-sets">here</a>.', 'std' => '2', 'type' => 'text_small'),	
		
		'ghostpool_review_comments' => array( 'name' => 'ghostpool_review_comments', 'title' => __('One Comment Per Review', 'ghostpool'), 'desc' => 'Check this option to only allow a user to make one comment per review. Note: Only works with registered members.', 'type' => 'checkbox'),
		
		array('type' => 'divider'),
		
		'ghostpool_tab_type' => array( 'name' => 'ghostpool_tab_type', 'title' => __('Tab Type', 'ghostpool'), 'desc' => '', 'type' => 'tab_type' ),		
		'ghostpool_tab_title' => array( 'name' => 'ghostpool_tab_title', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_title' ),
		'ghostpool_tab_id' => array( 'name' => 'ghostpool_tab_id', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => 'This name has no spaces and will look something like this: <code>review-news</code>', 'type' => 'tab_id' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_1' => array( 'name' => 'ghostpool_tab_type_1', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_1' => array( 'name' => 'ghostpool_tab_title_1', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_1' => array( 'name' => 'ghostpool_tab_id_1', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_2' => array( 'name' => 'ghostpool_tab_type_2', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_2' => array( 'name' => 'ghostpool_tab_title_2', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_2' => array( 'name' => 'ghostpool_tab_id_2', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_3' => array( 'name' => 'ghostpool_tab_type_3', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_3' => array( 'name' => 'ghostpool_tab_title_3', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_3' => array( 'name' => 'ghostpool_tab_id_3', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_4' => array( 'name' => 'ghostpool_tab_type_4', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_4' => array( 'name' => 'ghostpool_tab_title_4', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_4' => array( 'name' => 'ghostpool_tab_id_4', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_5' => array( 'name' => 'ghostpool_tab_type_5', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_5' => array( 'name' => 'ghostpool_tab_title_5', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_5' => array( 'name' => 'ghostpool_tab_id_5', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		
		array('type' => 'clear'),
		
		'ghostpool_tab_type_6' => array( 'name' => 'ghostpool_tab_type_6', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_6' => array( 'name' => 'ghostpool_tab_title_6', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_6' => array( 'name' => 'ghostpool_tab_id_6', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_7' => array( 'name' => 'ghostpool_tab_type_7', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_7' => array( 'name' => 'ghostpool_tab_title_7', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_7' => array( 'name' => 'ghostpool_tab_id_7', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_8' => array( 'name' => 'ghostpool_tab_type_8', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_8' => array( 'name' => 'ghostpool_tab_title_8', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_8' => array( 'name' => 'ghostpool_tab_id_8', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_9' => array( 'name' => 'ghostpool_tab_type_9', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_9' => array( 'name' => 'ghostpool_tab_title_9', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_9' => array( 'name' => 'ghostpool_tab_id_9', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

		array('type' => 'clear'),
		
		'ghostpool_tab_type_10' => array( 'name' => 'ghostpool_tab_type_10', 'title' => __('Type', 'ghostpool'), 'desc' => '', 'options' => array('List of articles', 'Page', 'Media'), 'type' => 'tab_select'),		
		'ghostpool_tab_title_10' => array( 'name' => 'ghostpool_tab_title_10', 'title' => __('Tab Title', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),
		'ghostpool_tab_id_10' => array( 'name' => 'ghostpool_tab_id_10', 'title' => __('Page or Tag Slug', 'ghostpool'), 'desc' => '', 'type' => 'tab_text' ),

	array('type' => 'close'),
	
	array('type' => 'clear'),
	
	);

	return apply_filters( 'ghostpool_meta_boxes', $meta_boxes );
}


/*************************** Slide Settings ***************************/
	 
function ghostpool_slide_meta_boxes() {

	$meta_boxes = array(
	
	'general_settings' => array('name' => 'general_settings', 'type' => 'open', 'title' => __('General Settings', 'ghostpool')),
		
		'ghostpool_slide_url' => array( 'name' => 'ghostpool_slide_url', 'title' => __('Slide URL', 'ghostpool'), 'desc' => 'Enter the URL you want your slide to link to.', 'type' => 'text'),

		'ghostpool_slide_read_on' => array( 'name' => 'ghostpool_slide_read_on', 'title' => __('Display Read On button', 'ghostpool'), 'desc' => 'Choose whether to display a Read On button over the slide.', 'type' => 'checkbox'),
		
	array('type' => 'close'),

	'image_settings' => array('name' => 'image_settings', 'type' => 'open', 'title' => __('Image Settings', 'ghostpool')),
	
		'ghostpool_slide_image' => array( 'name' => 'ghostpool_slide_image', 'title' => __('Image URL', 'ghostpool'), 'desc' => 'The relative URL of the image e.g. <code>wp-content/uploads/image.jpg</code>.', 'extras' => 'getimage', 'type' => 'text'),

		'ghostpool_slide_zoom' => array( 'name' => 'ghostpool_slide_zoom', 'title' => __('Disable Image Zoom', 'ghostpool'), 'desc' => 'Choose this option to stop images being proportionately cropped to the slider dimensions.', 'type' => 'checkbox'),
	
	array('type' => 'close'),
		
	'video_settings' => array('name' => 'video_settings', 'type' => 'open', 'title' => __('Video Settings', 'ghostpool')),
	
		'ghostpool_slide_video' => array( 'name' => 'ghostpool_slide_video', 'title' => __('Video URL', 'ghostpool'), 'desc' => 'The URL of your video or audio file (YouTube/FLV/MP4/M4V/MP3 formats accepted).', 'extras' => 'getvideo', 'type' => 'text'),

	array('type' => 'close'),
	
	array('type' => 'clear'),
	
	);

	return apply_filters( 'ghostpool_slide_meta_boxes', $meta_boxes );
}

/*************************** Meta Fields ***************************/

function post_meta_boxes() {
	global $post;
	$meta_boxes = ghostpool_post_meta_boxes(); ?>

	<?php echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/lib/admin/css/meta.css" type="text/css" media="screen" />'; ?>

	<?php foreach ( $meta_boxes as $meta ) :
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if ( $meta['type'] == 'text' )
			get_meta_text( $meta, $value );
		if ( $meta['type'] == 'text_small' )
			get_meta_text_small( $meta, $value );			
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'select_sidebar' )
			get_meta_select_sidebar( $meta, $value );			
		elseif ( $meta['type'] == 'checkbox' )
			get_meta_checkbox( $meta, $value );			
		elseif ( $meta['type'] == 'open' )
			get_meta_open( $meta, $value );		
		elseif ( $meta['type'] == 'close' )
			get_meta_close( $meta, $value );
		elseif ( $meta['type'] == 'divider' )
			get_meta_divider( $meta, $value );			
		elseif ( $meta['type'] == 'clear' )
			get_meta_clear( $meta, $value );
	endforeach; ?>
	
<?php
}

function page_meta_boxes() {
	global $post;
	$meta_boxes = ghostpool_page_meta_boxes(); ?>

	<?php echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/lib/admin/css/meta.css" type="text/css" media="screen" />'; ?>

	<?php foreach ( $meta_boxes as $meta ) :
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if ( $meta['type'] == 'text' )
			get_meta_text( $meta, $value );
		if ( $meta['type'] == 'text_small' )
			get_meta_text_small( $meta, $value );			
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'select_sidebar' )
			get_meta_select_sidebar( $meta, $value );			
		elseif ( $meta['type'] == 'checkbox' )
			get_meta_checkbox( $meta, $value );			
		elseif ( $meta['type'] == 'open' )
			get_meta_open( $meta, $value );		
		elseif ( $meta['type'] == 'close' )
			get_meta_close( $meta, $value );
		elseif ( $meta['type'] == 'divider' )
			get_meta_divider( $meta, $value );			
		elseif ( $meta['type'] == 'clear' )
			get_meta_clear( $meta, $value );	
	endforeach; ?>

<?php
}

function review_meta_boxes() {
	global $post;
	$meta_boxes = ghostpool_review_meta_boxes(); ?>

	<?php echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/lib/admin/css/meta.css" type="text/css" media="screen" />'; ?>
	
	<?php foreach ( $meta_boxes as $meta ) :
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if ( $meta['type'] == 'text' )
			get_meta_text( $meta, $value );
		if ( $meta['type'] == 'text_small' )
			get_meta_text_small( $meta, $value );			
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'select_sidebar' )
			get_meta_select_sidebar( $meta, $value );			
		elseif ( $meta['type'] == 'checkbox' )
			get_meta_checkbox( $meta, $value );			
		elseif ( $meta['type'] == 'open' )
			get_meta_open( $meta, $value );		
		elseif ( $meta['type'] == 'close' )
			get_meta_close( $meta, $value );
		elseif ( $meta['type'] == 'divider' )
			get_meta_divider( $meta, $value );			
		elseif ( $meta['type'] == 'clear' )
			get_meta_clear( $meta, $value );
		elseif ( $meta['type'] == 'tab_type' )
			get_meta_tab_type( $meta, $value );			
		elseif ( $meta['type'] == 'tab_title' )
			get_meta_tab_title( $meta, $value );			
		elseif ( $meta['type'] == 'tab_id' )
			get_meta_tab_id( $meta, $value );
		elseif ( $meta['type'] == 'tab_text' )
			get_meta_tab_text( $meta, $value );
		elseif ( $meta['type'] == 'tab_select' )
			get_meta_tab_select( $meta, $value );
		elseif ( $meta['type'] == 'search_tags' )
			get_meta_search_tags( $meta, $value );			
	endforeach; ?>
	
<?php
}

function slide_meta_boxes() {
	global $post;
	$meta_boxes = ghostpool_slide_meta_boxes(); ?>

	<?php echo '<link rel="stylesheet" href="'.get_bloginfo('template_url').'/lib/admin/css/meta.css" type="text/css" media="screen" />'; ?>

	<?php foreach ( $meta_boxes as $meta ) :
		$value = get_post_meta( $post->ID, $meta['name'], true );
		if ( $meta['type'] == 'text' )
			get_meta_text( $meta, $value );
		if ( $meta['type'] == 'text_small' )
			get_meta_text_small( $meta, $value );			
		elseif ( $meta['type'] == 'textarea' )
			get_meta_textarea( $meta, $value );
		elseif ( $meta['type'] == 'select' )
			get_meta_select( $meta, $value );
		elseif ( $meta['type'] == 'checkbox' )
			get_meta_checkbox( $meta, $value );			
		elseif ( $meta['type'] == 'open' )
			get_meta_open( $meta, $value );		
		elseif ( $meta['type'] == 'close' )
			get_meta_close( $meta, $value );
		elseif ( $meta['type'] == 'divider' )
			get_meta_divider( $meta, $value );			
		elseif ( $meta['type'] == 'clear' )
			get_meta_clear( $meta, $value );			
	endforeach; ?>

<?php } function get_meta_open( $args = array(), $value = false ) {
extract( $args ); ?>
	
	<div class="meta-group">
	
	<h3><?php echo $title; ?></h3>
	<div class="group-desc"><?php echo $desc; ?></div><div class="clear"></div>
	<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />		
	
	
<?php } function get_meta_close( $args = array(), $value = false ) {
extract( $args ); ?>
	
	</div><div class="clear"></div>
	<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />		
	
	
<?php } function get_meta_divider( $args = array(), $value = false ) {
extract( $args ); ?>

	<div class="divider"></div>
	<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />		


<?php } function get_meta_clear( $args = array(), $value = false ) {
extract( $args ); ?>
	
	<div class="clear"></div>
	<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />		
	
	
<?php } function get_meta_text( $args = array(), $value = false ) {
extract( $args ); global $post; ?>

	<div class="meta-box">
		<strong><?php echo $title; ?></strong>
		<br/><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value, 1 ); ?>" size="30" tabindex="30" <?php if($extras == "getimage" OR $extras == "getvideo") { ?>class="uploadbutton"<?php } ?> />
		<?php if($extras == "getimage") { ?><a href="media-upload.php?post_id=<?php echo $post->ID; ?>&amp;type=image&amp;TB_iframe=true&amp;width=640&amp;height=790" id="add_image" class="thickbox button" title='Add an Image' onclick="return false;">Get Image</a><?php } elseif($extras == "getvideo") { ?><a href="media-upload.php?post_id=<?php echo $post->ID; ?>&amp;type=video&amp;TB_iframe=true&amp;width=640&amp;height=790" id="add_video" class="thickbox button" title='Add a Video' onclick="return false;">Get Video</a><?php } ?>
		<div class="meta-desc"><?php echo $desc; ?></div>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>


<?php } function get_meta_text_small( $args = array(), $value = false ) {
extract( $args ); ?>

	<div class="meta-box">
		<strong><?php echo $title; ?></strong>
		<br/><input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php if(esc_html( $value, 1 )) { echo esc_html( $value, 1 ); } else { echo esc_html( $std, 1 ); } ?>" size="30" tabindex="30" class="small-textbox" />
		<div class="meta-desc"><?php echo $desc; ?></div>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>
	
	
<?php } function get_meta_select( $args = array(), $value = false ) {
extract( $args ); ?>

	<div class="meta-box">
		<strong><?php echo $title; ?></strong>
		<br/><select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
		<?php foreach ( $options as $option ) : ?>
			<option <?php if(htmlentities($value, ENT_QUOTES) == $option) echo ' selected="selected"'; ?>>
				<?php echo $option; ?>
			</option>
		<?php endforeach; ?>
		</select>
		<div class="meta-desc"><?php echo $desc; ?></div>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>


<?php } function get_meta_select_sidebar( $args = array(), $value = false ) {
extract( $args );
global $post, $wp_registered_sidebars; ?>

	<div class="meta-box">
		<strong><?php echo $title; ?></strong><br/>		
		<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
			<?php $sidebars = $wp_registered_sidebars;
			if(is_array($sidebars) && !empty($sidebars)){ foreach($sidebars as $sidebar){ if($selected_sidebar[$i] == $sidebar['name']){ ?>
				<option value="<?php echo $sidebar['name']; ?>"<?php if($value == $sidebar['name']) { echo ' selected="selected"'; } ?>><?php echo $sidebar['name']; ?></option>
			<?php }else{ ?>
				<option value="<?php echo $sidebar['name']; ?>"<?php if($value == $sidebar['name']) { echo ' selected="selected"'; } ?>><?php echo $sidebar['name']; ?></option>
			<?php }}} ?>
		</select>
		<div class="meta-desc"><?php echo $desc; ?></div>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>
	
	
<?php } function get_meta_textarea( $args = array(), $value = false ) {
extract( $args ); ?>

	<div class="meta-box <?php if($size == "large") { ?>meta-box-large<?php } ?>">	
		<strong><?php echo $title; ?></strong>
		<br/><textarea name="<?php echo $name; ?>" id="<?php echo $name; ?>" cols="60" rows="4" tabindex="30"><?php echo esc_html( $value, 1 ); ?></textarea>
		<div class="meta-desc"><?php echo $desc; ?></div>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>


<?php } function get_meta_checkbox( $args = array(), $value = false ) {
extract( $args ); ?>

	<div class="meta-box">
		<strong><?php echo $title; ?></strong>
		<?php if( esc_html($value, 1 ) ){ $checked = "checked=\"checked\""; } else { if ( $std === "true" ){ $checked = "checked=\"checked\""; } else { $checked = ""; } } ?>
		<input type="checkbox" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="false" <?php echo $checked; ?> />
		<div class="meta-desc"><?php echo $desc; ?></div>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" /></p>			
	</div>


<?php }	function get_meta_tab_type( $args = array(), $value = false ) {
extract( $args ); ?>

	<div class="meta-box">
		<strong><?php echo $title; ?></strong> <em><?php echo $desc; ?></em>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>


<?php } function get_meta_tab_title( $args = array(), $value = false ) {
extract( $args ); ?>

	<div class="meta-box">
		<strong><?php echo $title; ?></strong> <em><?php echo $desc; ?></em>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>


<?php } function get_meta_tab_id( $args = array(), $value = false ) {
extract( $args ); ?>

	<div class="meta-box">
		<strong><?php echo $title; ?></strong> <span class="meta-desc"><?php echo $desc; ?></span>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div><div class="clear"></div>


<?php } function get_meta_tab_text( $args = array(), $value = false ) {

	extract( $args ); ?>

	<div class="meta-box">
		<input type="text" name="<?php echo $name; ?>" id="<?php echo $name; ?>" value="<?php echo esc_html( $value, 1 ); ?>" size="30" tabindex="30" />
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>
	

<?php } function get_meta_tab_select( $args = array(), $value = false ) {

	extract( $args ); ?>

	<div class="meta-box">
		<select name="<?php echo $name; ?>" id="<?php echo $name; ?>">
		<?php foreach ( $options as $option ) : ?>
			<option <?php if ( htmlentities( $value, ENT_QUOTES ) == $option ) echo ' selected="selected"'; ?>>
				<?php echo $option; ?>
			</option>
		<?php endforeach; ?>
		</select>
		<input type="hidden" name="<?php echo $name; ?>_noncename" id="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />
	</div>

<?php } function get_meta_search_tags( $args = array(), $value = false ) {

	extract( $args ); global $post; 
	
	require(ghostpool_inc . 'options.php');
	
?>
	
	<div class="meta-box" style="display: none;">
	
		<input type="text" name="<?php echo $name; ?>" value="<?php $terms = wp_get_object_terms($post->ID, 'director', 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, 'genre', 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, 'producer', 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, 'rating', 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, 'release_date', 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, 'screenwriter', 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, 'starring', 'hide_empty=0'); foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, 'studio', 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, $theme_review_tag_9_slug, 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?><?php $terms = wp_get_object_terms($post->ID, $theme_review_tag_10_slug, 'hide_empty=0'); ?><?php foreach ($terms as $term): ?><?php echo $term->name; ?>, <?php endforeach; ?>" />
		<input type="hidden" name="<?php echo $name; ?>_noncename" value="<?php echo wp_create_nonce( plugin_basename( __FILE__ ) ); ?>" />	
		
	</div>	
	
	
<?php }

function ghostpool_save_meta_data( $post_id ) {
	global $post;

	if ( 'page' == $_POST['post_type'] )
		$meta_boxes = array_merge( ghostpool_page_meta_boxes() );
	elseif ( 'post' == $_POST['post_type'] )
		$meta_boxes = array_merge( ghostpool_post_meta_boxes() );
	elseif ( 'review' == $_POST['post_type'] )
		$meta_boxes = array_merge( ghostpool_review_meta_boxes() );
	else
		$meta_boxes = array_merge( ghostpool_slide_meta_boxes() );
		
	foreach ( $meta_boxes as $meta_box ) :

		if ( !wp_verify_nonce( $_POST[$meta_box['name'] . '_noncename'], plugin_basename( __FILE__ ) ) )
			return $post_id;

		if ( 'page' == $_POST['post_type'] && !current_user_can( 'edit_page', $post_id ) )
			return $post_id;

		elseif ( 'post' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;

		elseif ( 'review' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
			
		elseif ( 'slide' == $_POST['post_type'] && !current_user_can( 'edit_post', $post_id ) )
			return $post_id;
			
		$data = stripslashes( $_POST[$meta_box['name']] );

		if ( get_post_meta( $post_id, $meta_box['name'] ) == '' )
			add_post_meta( $post_id, $meta_box['name'], $data, true );

		elseif ( $data != get_post_meta( $post_id, $meta_box['name'], true ) )
			update_post_meta( $post_id, $meta_box['name'], $data );

		elseif ( $data == '' )
			delete_post_meta( $post_id, $meta_box['name'], get_post_meta( $post_id, $meta_box['name'], true ) );

	endforeach;
}
?>