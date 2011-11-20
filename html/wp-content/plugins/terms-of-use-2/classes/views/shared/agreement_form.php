<?php 
global $tou_settings;

if (isset($error) and $error){ ?>
<div class="error">
    <span><strong><?php _e('ERROR', 'terms_of_use') ?></strong>: <?php echo $error ?></span>
</div>
<?php } ?> 
<div id="post-body-content">

<?php if (is_admin()){ ?>
<div id="icon-edit-pages" class="icon32"><br></div>        
<?php }?>

<h2><?php _e('Member Agreement', 'terms_of_use') ?></h2>
<?php include(TOU_VIEWS_PATH.'/shared/nav.php'); ?>
<div id="postdiv" class="postarea"><?php echo $member_agreement; ?></div>

<?php if ($terms and trim($terms) != ''){ ?>  
  <h2><?php _e('Terms of Use', 'terms_of_use') ?></h2>
  <div style="width:95%; height:250px; border:1px solid #C6D9E9; padding:5px; overflow:auto;"><?php echo $terms; ?></div><br/>
<?php } ?>  

<?php if ($privacy_policy and trim($privacy_policy) != ''){ ?>  
  <h2><?php _e('Privacy Policy', 'terms_of_use') ?></h2>
  <div style="width:95%; height:250px; border:1px solid #C6D9E9; padding:5px; overflow:auto;"><?php echo $privacy_policy ?></div>
<?php } ?>

<?php if ($show_buttons){ ?>
    <h2><?php _e('The Agreement', 'terms_of_use') ?></h2>
    <p><?php echo $agree; ?></p>
    <form id="post" method="post" action="" name="post">
    	<input type="hidden" name="terms-and-conditions" value="true" />
    	<input type="hidden" name="tou_referrer" value="<?php echo $referer ?>" />
    	<?php if ($tou_settings->initials){?>
    	    <?php _e('Initials', 'terms_of_use') ?> <input type="text" name="initials" size="4" value="<?php echo (isset($_POST['initials'])) ? $_POST['initials'] : ''; ?>" />
    	<?php } ?>
    	<p class="submit">
    	    <input id="agree" type="submit" value="<?php _e('I Agree', 'terms_of_use') ?>" name="agree"/> 
    	    <input type="button" value="<?php _e('I Disagree', 'terms_of_use') ?>" onClick="window.location='<?php echo $disagree_url ?>'" />
    	</p>
    </form>   
<?php } ?>
</div>