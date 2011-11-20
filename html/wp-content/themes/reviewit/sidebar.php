<?php require(ghostpool_inc . 'options.php'); ?>

<?php if(is_home()) { ?>

	<div id="sidebar" class="sidebar-home">

		<?php if(function_exists( 'bp_message_get_notices')) { ?>
			<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
		<?php } ?>
		
		<?php dynamic_sidebar('Homepage Sidebar (Right)'); ?>
		
	</div>

<?php } elseif((is_category() && $theme_gen_cat_display != "List") OR (is_tax('review_categories') && $theme_review_cat_display != "List")) { ?>

	<div id="sidebar" class="sidebar-home">
	
		<?php dynamic_sidebar('Default Sidebar'); ?>
	
	</div>
	
<?php } else { ?>

	<?php if(is_singular() && get_post_meta($post->ID, 'ghostpool_layout', true) == "Full Width") {} else { ?>

		<div id="sidebar" class="sidebar-other">
	
			<?php if ( function_exists( 'bp_message_get_notices' ) ) : ?>
				<?php bp_message_get_notices(); /* Site wide notices to all users */ ?>
			<?php endif; ?>
			
			<?php if(is_singular() && get_post_meta($post->ID, 'ghostpool_sidebar', true)) { dynamic_sidebar(get_post_meta($post->ID, 'ghostpool_sidebar', true)); } else { dynamic_sidebar('Default Sidebar'); } ?>
			
		</div>	

	<?php } ?>
	
<?php } ?>