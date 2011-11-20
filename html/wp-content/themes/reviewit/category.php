<?php get_header(); 

if($theme_gen_cat_sidebar == "1") { 
$style_classes = array('review-first','review-second','review-third', 'review-fourth');
} else {
$style_classes = array('review-first','review-second','review-third');
}
$style_index = 0;

?>

<?php if($theme_gen_cat_sidebar == "1") { ?>

	<h2 class="page-title"><?php single_cat_title(); ?></h2>

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<?php if($theme_gen_cat_display == "Compact Boxes" OR $theme_gen_cat_display == "Extended Boxes") { ?> 
	
		<?php require('box-loop.php'); ?>
	
	<?php } else { ?>
	
		<?php require('post-loop.php'); ?>
	
	<?php } ?>
	
	<?php endwhile; ?>
	
		<div class="clear"></div><?php gp_pagination(); ?>
		
	<?php endif; ?>

<?php } else { ?>

	<div id="main-content" class="<?php if($theme_gen_cat_display == "List") { ?>main-content-other<?php } else { ?>main-content-home<?php } ?>">
	
		<h2 class="page-title"><?php single_cat_title(); ?></h2>
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<?php if($theme_gen_cat_display == "Compact Boxes" OR $theme_gen_cat_display == "Extended Boxes") { ?> 
		
			<?php require('box-loop.php'); ?>
		
		<?php } else { ?>
		
			<?php require('post-loop.php'); ?>
		
		<?php } ?>
		
		<?php endwhile; ?>
		
			<div class="clear"></div><?php gp_pagination(); ?>
			
		<?php endif; ?>
	
	</div>
	
	<?php get_sidebar(); ?>
	
<?php } ?>


<?php get_footer(); ?>