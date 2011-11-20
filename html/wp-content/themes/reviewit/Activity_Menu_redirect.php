<?php
/**
 * Template Name: Act_Redir
 *
 * Page to users to activity
 *
 * Written by: Prashanth
 * Contact Info: 
 *
 * Version: 1.0 2010-01-15
 */
?>
<?php if(is_user_logged_in()) { ?>
		
		<?php if(function_exists('bp_get_options_nav')) { echo "test";?>

		
		<?php } else { ?>
		
		<?php } ?>
                

	<?php }else{ ?>
<?php echo "Please Login"?>
            <?php }?>


