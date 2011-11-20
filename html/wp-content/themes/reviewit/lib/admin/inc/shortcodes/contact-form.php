<?php

//*************************** Contact Form ***************************//

function ghostpool_contact($atts, $content = null) {
	extract(shortcode_atts(array(
		'email' => '#'
	),$atts));
	
	// Form Submitted
	if(isset($_POST['submittedContact'])) {
		require(ghostpool_inc . "/contact.php");
	}
	
	if(isset($emailSent) && $emailSent == true) {
		
		$out .= '<a id="contact_"></a>';
		$out .= '<p class="contact-success">'.gp_thanks.' '.$name.'. '.gp_email_success.'</p>';
		
	} else {
		
		if(isset($captchaError)) {
			$out .= '<a id="contact_"></a>';
			$out .= '<p class="contact-error">'.gp_email_error.'<p>';
		}
				
		// Name
		$out .= '<a id="contact_"></a>';
		$out .= '<form action="' .get_permalink($post->ID). '#contact_" id="contact-form" method="post">';
		$out .= '<p><input type="text" name="contactName" id="contactName" value="';
		
		if(isset($_POST['contactName'])) {
			$out .= $_POST['contactName'];
		}
		$out .= '"';
		$out .= ' class="requiredFieldContact textfield';
		
		if(isset($nameError)) {
			$out .= ' input-error';
		}
		$out .= '"';
		$out .= ' size="22" /><label class="textfield_label" for="contactName">'.gp_name.'  <span class="required">*</span></label></p>';

		
		// Email
		$out .= '<p><input type="text" name="contactEmail" id="contactEmail" value="';
		
		if(isset($_POST['contactEmail'])) {
			$out .= $_POST['contactEmail'];
		}
		$out .= '"';
		$out .= ' class="requiredFieldContact email textfield';
		
		if(isset($emailError)) {
			$out .= ' input-error';
		}
		$out .= '"';
		$out .= ' size="22" /><label class="textfield_label" for="email">'.gp_email.' <span class="required">*</span></label></p>';

		
		// Comments
		$out .= '<p><textarea name="comments" id="commentsText" rows="5" cols="40" class="requiredFieldContact textarea';
		
		if(isset($commentError)) {
			$out .= ' input-error';
		}
		$out .= '">';
		
		if(isset($_POST['comments'])) { 
			if(function_exists('stripslashes')) { 
				$out .= stripslashes($_POST['comments']); 
				} else { 
					$out .= $_POST['comments']; 
				} 
			}
		$out .= '</textarea></p>';
		
		$out .= '<div class="contact-verify"><label for="verify" accesskey=V>3 + 1 = </label><input name="verify" type="text" id="verify" value="';

		
		// Verify
		if(isset($_POST['verify'])) {
			$out .= $_POST['verify'];
		}
		$out .= '"';
		$out .= ' class="requiredFieldContact verify';
		
		if(isset($verifyError)) {
			$out .= ' input-error';
		}
		$out .= '"';
		$out .= ' size="2" /></div>';
		
		
		// Submit
		$out .= '<input name="submittedContact" id="submittedContact" class="contact-submit" value="'.gp_submit.'" type="submit" />';
		$out .= '<p class="loader"></p>';

		$out .= '<input id="submitUrl" type="hidden" name="submitUrl" value="'. ghostpool_inc . 'contact.php" />';
		$out .= '<input id="emailAddress" type="hidden" name="emailAddress" value="' .$email. '" />';
	
		$out .= '</form>';

	}
	return $out;
}

add_shortcode("contact", "ghostpool_contact");

?>
