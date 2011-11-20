<?php require(ghostpool_inc . 'options.php'); ?>

</div>
<!--End Content Wrapper-->	

<?php if(is_active_sidebar('footer-1') OR is_active_sidebar('footer-2') OR is_active_sidebar('footer-3') OR is_active_sidebar('footer-4')) { ?>

<div class="clear"></div>

	<!--Begin Footer Widgets-->
	<div id="footer-widgets">
			
		<?php
		if(is_active_sidebar('footer-1') && is_active_sidebar('footer-2') && is_active_sidebar('footer-3') && is_active_sidebar('footer-4')) { $footer_widgets = "footer-fourth"; }
		elseif(is_active_sidebar('footer-1') && is_active_sidebar('footer-2') && is_active_sidebar('footer-3')) { $footer_widgets = "footer-third"; }
		elseif(is_active_sidebar('footer-1') && is_active_sidebar('footer-2')) {
		$footer_widgets = "footer-half"; }	
		elseif(is_active_sidebar('footer-1')) { $footer_widgets = "footer-whole"; }
		?>
	
		<?php if(is_active_sidebar('footer-1')) { ?>
			<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
				<?php dynamic_sidebar('footer-1'); ?>
			</div>
		<?php } ?>
	
		<?php if(is_active_sidebar('footer-2')) { ?>
			<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
				<?php dynamic_sidebar('footer-2'); ?>
			</div>
		<?php } ?>
		
		<?php if(is_active_sidebar('footer-3')) { ?>
			<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
				<?php dynamic_sidebar('footer-3'); ?>
			</div>
		<?php } ?>
		
		<?php if(is_active_sidebar('footer-4')) { ?>
			<div class="footer-widget-outer <?php echo($footer_widgets); ?>">
				<?php dynamic_sidebar('footer-4'); ?>
			</div>
		<?php } ?>
		
	</div>
	<!--End Footer Widgets-->

<?php } ?>

<div class="clear"></div>

<!--Begin Footer-->
<div id="footer">

	<div id="footer-content">
	
	<?php wp_nav_menu('sort_column=menu_order&container=ul&theme_location=footer-nav&fallback_cb=null'); ?>

	<div id="copyright">
		<?php if($theme_footer_content) { echo stripslashes($theme_footer_content); } else { ?>Copyright &copy; 2010 ReviewIt. Designed and coded by GhostPool.<?php } ?>
	</div>
	
	</div>
	
	<a href="#top" id="top_arrow"></a>
		
</div>
<!--End Footer-->

		
</div>
<!--End Page Wrap-->

<?php wp_footer(); ?>

<?php if($theme_leaguegothic OR $theme_quicksand OR $theme_sansation OR $theme_journal OR $theme_chunkfive OR $theme_vegur) { ?>
	<script>Cufon.now();</script>
<?php } ?>

</body>
</html>