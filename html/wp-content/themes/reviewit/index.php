<?php get_header(); ?>

<?php if($theme_homepage_sidebar == "1") { ?>

	<?php if(is_active_sidebar('homepage')) { dynamic_sidebar('homepage'); } else { echo "<strong>To display your reviews and/or posts here, go to Appearance > Widgets and drag the desired widgets into the Homepage (Left) widget area.</strong>"; } ?>

<?php } else { ?>

	<div id="main-content" class="main-content-home">
	
		<?php if(is_active_sidebar('homepage')) { dynamic_sidebar('homepage'); } else { echo "<strong>To display your reviews and/or posts here, go to Appearance > Widgets and drag the desired widgets into the Homepage (Left) widget area.</strong>"; } ?>
	
	</div>
	
	<?php get_sidebar(); ?>
	
<?php } ?>

<?php get_footer(); ?>