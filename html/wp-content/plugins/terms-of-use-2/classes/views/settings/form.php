<div class="wrap">
    <div id="icon-edit-pages" class="icon32"><br></div>
	<h2><?php _e('Terms of Use Settings', 'terms_of_use') ?></h2>
	
	<?php require(TOU_VIEWS_PATH.'/shared/errors.php'); ?>
    <?php require(TOU_VIEWS_PATH.'/shared/nav.php'); ?>
    
    <form name="tou_settings_form" action="" method="post">
        <div id="poststuff" class="metabox-holder has-right-sidebar">
        <div class="inner-sidebar">
            <div id="submitdiv" class="postbox">
                <h3 class="hndle"><span><?php _e('Shortcode Options', 'terms_of_use') ?></span></h3>
                <div class="inside">
                    <div class="submitbox">
                        <div id="minor-publishing">
                            <div class="misc-pub-section">
                                <p class="howto"><?php _e('Insert terms on a page or post', 'terms_of_use') ?>:</p>
                            	<p><input type="text" style="font-weight:bold;width:98%;text-align:center;" readonly="true" onclick='this.select();' onfocus='this.select();' value='[terms-of-use]' />
                            	</p>

                            	<p class="howto"><?php _e('Insert in a template', 'terms_of_use') ?>:</p>
                            	<p><input type="text" style="font-size:10px;width:98%;text-align:center;" readonly="true" onclick='this.select();' onfocus='this.select();' value="&lt;?php echo TouAppController::get_terms(); ?&gt;" /></p>
                            </div>
                            <div class="misc-pub-section" style="border:none;">	
                            	<p class="howto"><?php _e('Insert only privacy policy on a page or post', 'terms_of_use') ?>:</p>
                            	<p><input type="text" style="font-weight:bold;width:98%;text-align:center;" readonly="true" onclick='this.select();' onfocus='this.select();' value='[privacy-policy]' />
                            	</p>

                            	<p class="howto"><?php _e('Insert in a template', 'terms_of_use') ?>:</p>
                            	<p><input type="text" style="font-size:10px;width:98%;text-align:center;" readonly="true" onclick='this.select();' onfocus='this.select();' value="&lt;?php echo TouAppController::get_privacy_policy(); ?&gt;" /></p>

                            </div>
                        </div>
                        <div id="major-publishing-actions">
                        	<div id="publishing-action">
                                <input type="submit" name="Submit" value="<?php _e('Save Changes', 'terms_of_use') ?>" class="button-primary" />
                            </div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="postbox">
                <div class="handlediv"><br/></div><h3 class="hndle"><span><?php _e('Placeholders', 'terms_of_use') ?></span></h3>
                <div class="inside">
                    <table width="100%">
                    <tr><td><code>[website-name]</code></td><td><?php _e('Website Name Value', 'terms_of_use') ?></td></tr>
                    <tr><td><code>[website-url]</code></td><td><?php _e('Site URL', 'terms_of_use') ?></td></tr>
                    </table>
                </div>
            </div>
            
        </div>
        
        <div id="post-body">
        <div id="post-body-content" class="categorydiv">

        <div class="postbox ">
        <div class="handlediv" title="Click to toggle"><br/></div><h3 class="hndle"><span><?php _e('Terms of Use', 'terms_of_use') ?></span></h3>
        <div class="inside">

        <input type="hidden" name="action" value="process-form" />
        <?php wp_nonce_field('update-options'); ?>
        
    	<table class="form-table">
        	<tr>
				<th scope="row"><?php _e('Website Name', 'terms_of_use') ?></th>
				<td>
				    <input name="site_name" id="site_name" type="text" value="<?php echo esc_attr(stripslashes($tou_settings->site_name)); ?>" class="regular-text" />
                    <span class="description"><?php _e('Website Name will replace <b>[website-name]</b> in messages when displayed.', 'terms_of_use') ?></span>
				</td>
         	</tr>
            
            <tr class="form-field">
				<th scope="row"><?php _e('Form Instructions', 'terms_of_use') ?></th>
				<td>
				    <div id="postdiv">
				        <textarea id="member_agreement" name="member_agreement"><?php echo stripslashes($tou_settings->member_agreement) ?></textarea>
            		</div>
                    <span class="description"><?php _e('Instructions displayed above terms.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr class="form-field">
				<th scope="row"><?php _e('Agreement Instructions', 'terms_of_use') ?></th>
				<td>
				    <input name="agreement_text" id="agreement_text" type="text" value="<?php echo esc_attr(stripslashes($tou_settings->agreement_text)); ?>" class="regular-text" />
                    <span class="description"><?php _e('Instructions displayed next to check box for user agreement. Link to the terms page will replace <b>[terms-url]</b> when displayed.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr class="form-field">
				<th scope="row"><?php _e('Click "I Agree"', 'terms_of_use') ?></th>
				<td>
				    <div id="postdiv">
				        <textarea id="agree" name="agree"><?php echo stripslashes($tou_settings->agree) ?></textarea>
            		</div>
                    <span class="description"><?php _e('Instructions displayed directly above the "I Agree" button.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
            <tr>
				<th scope="row"><?php _e('Terms and Conditions', 'terms_of_use') ?></th>
				<td>
				    <div id="poststuff">
				    <div id="<?php echo user_can_richedit() ? 'postdivrich' : 'postdiv'; ?>" class="postarea">
            			<?php the_editor(stripslashes($tou_settings->terms), 'terms', 'title', false); ?>
            		</div>
            		</div>
					<span class="description"><?php _e('Leaving the Terms blank will remove the "Terms and Conditions" box on the agreement page.', 'terms_of_use') ?></span>
				</td>
         	</tr>

            <tr class="form-field">
				<th scope="row"><?php _e('Privacy Policy', 'terms_of_use') ?></th>
				<td>
				    <div id="postdiv">
				        <textarea id="privacy_policy" name="privacy_policy" rows="10"><?php echo stripslashes($tou_settings->privacy_policy) ?></textarea>
            		</div>
					<span class="description"><?php _e('Leaving Privacy Policy blank will remove the "Privacy Policy" box on the agreement page', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr class="form-field">
				<th scope="row"><?php _e('Welcome Message', 'terms_of_use') ?></th>
				<td>
				    <div id="postdiv">
				        <textarea id="welcome" name="welcome" rows="10"><?php echo stripslashes($tou_settings->welcome) ?></textarea>
            		</div>
                    <span class="description"><?php _e('This message is displayed after the user agrees to the terms and conditions.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	<tr class="form-field">
				<th scope="row"><?php _e('Error Messages', 'terms_of_use') ?></th>
				<td>
				    <input name="terms_error" id="terms_error" type="text" value="<?php echo esc_attr(stripslashes($tou_settings->terms_error)); ?>" class="regular-text" />

                    <span class="description"><?php _e('Message seen when terms are required but not accepted.', 'terms_of_use') ?></span>
                    
				    <input name="initials_error" id="initials_error" type="text" value="<?php echo esc_attr(stripslashes($tou_settings->initials_error)); ?>" class="regular-text" />
            		</div>
                    <span class="description"><?php _e('Message seen when initials are required but not submitted.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         </table>
         </div>
         </div>
         
         <div class="postbox ">
         <div class="handlediv"><br/></div><h3 class="hndle"><span><?php _e('Other Options', 'terms_of_use') ?></span></h3>
         <div class="inside">	
         <table class="form-table">
         	<tr>
         	    <th scope="row"><?php _e('Show Terms', 'terms_of_use') ?></th>
				<td>
				    <label for="clear_all">
				    <input type="checkbox" name="clear_all" id="clear_all" value="1" />
                    <?php _e('Clear all previous user agreements so users can reaccept terms. Caution: There is no undo.', 'terms_of_use') ?>
                    </label><br/>
                    
                    <label for="show_date">
                    <input type="checkbox" name="show_date" id="show_date" value="1" <?php checked($tou_settings->show_date, '1') ?> />
                    <?php _e('Show date accepted in user profile.', 'terms_of_use') ?>
                    </label><br/>
                    
                    <label for="initials">
                    <input type="checkbox" name="initials" id="initials" value="1" <?php checked($tou_settings->initials, '1') ?> />
                    <?php _e('Show and require user initials on agreement.', 'terms_of_use') ?>
                    </label><br/>
                    
                    <label for="signup_page">
                    <input type="checkbox" name="signup_page" id="signup_page" value="1" <?php checked($tou_settings->signup_page, '1') ?> />
                    <?php _e('Show and require term agreement on signup page. NOTE: Will not show unless the Terms page is specified below.', 'terms_of_use') ?>
                    </label>
                    
                    <?php if (function_exists('add_comment_meta')){ ?>
                    <br/>
                    <label for="comment_form">
                    <input type="checkbox" name="comment_form" id="comment_form" value="1" <?php checked($tou_settings->comment_form, '1') ?> />
                    <?php _e('Show and require term agreement on comment form. NOTE: Will not show unless the Terms page is specified below.', 'terms_of_use') ?>
                    </label>
                    <?php } ?>
				</td>
         	</tr>
         	
            <tr>
				<th scope="row"><?php _e('Terms Page Admin Menu', 'terms_of_use') ?></th>
				<td>
				    <select name="menu_page">
				        <?php foreach ($admin_menu_options as $page => $page_name){ ?>
				            <option value="<?php echo $page ?>" <?php selected($tou_settings->menu_page, $page) ?>><?php echo $page_name ?></option>
				        <?php } ?>
				    </select><br/>
                    <span class="description"><?php _e('The admin menu item to place the terms under. This is what users will see. <br/>IMPORTANT: Make sure to select a menu item your users have access to. Otherwise, they will be blocked by permissions errors.', 'terms_of_use') ?></span>
				</td>
         	</tr>
			
         	<tr>
				<th scope="row"><?php _e('Terms Page', 'terms_of_use') ?></th>
				<td>
				    <select name="terms_url">
				        <option value=""></option>
				        <?php foreach ($pages as $page){ ?>
				            <option value="<?php echo $page->ID ?>"<?php echo ($tou_settings->terms_url == $page->ID or (!is_numeric($tou_settings->terms_url) and $tou_settings->terms_url == get_permalink($page->ID)))?(' selected=selected'):(''); ?>><?php echo $page->post_title ?></option>
				        <?php } ?>
				    </select><br/>
                    <span class="description"><?php _e('Select the page the display your terms. Include the [terms-of-use] shortcode in this page.', 'terms_of_use') ?></span>
				</td>
         	</tr>
         	
         	</table>
            </div>
            </div>

            <div class="postbox ">
            <div class="handlediv" title="Click to toggle"><br/></div><h3 class="hndle"><span><?php _e('Require Term Agreement to Access', 'terms_of_use') ?></span></h3>
            <div class="inside">	
            <table class="form-table">         	
         	<tr>
         	    <th scope="row"><?php _e('Admin Page(s)', 'terms_of_use') ?></th>
				<td>
				    <div class="tabs-panel" style="height:auto;margin-left:0;">
				        <div style="width:50%" class="alignleft">
				        <?php 
				        $i = 0;
				        foreach ($admin_page_list as $page => $page_name){
				            if($i == 3){ ?>
				        </div>
				        <div style="width:50%" class="alignright">
				        <?php    
				            }
				            $i++;
				        ?>
				        <input type="checkbox" name="admin_page[]" value="<?php echo $page ?>" <?php TouAppHelper::checked( (array)$tou_settings->admin_page, $page) ?> /> <?php echo $page_name ?><br/>
				        <?php } ?>
				        </div>
				        <div class="clear"></div>
				    </div>
				</td>
			</tr>
			
			<tr>
			    <th scope="row"><?php _e('Front-end Page(s)', 'terms_of_use') ?></th>
				<td>
				    <div class="tabs-panel" style="height:140px;margin-left:0;">
				        <div style="width:50%" class="alignleft">
				    <?php
				        $i = 0;
				        foreach ($pages as $page){
				            if($tou_settings->terms_url == $page->ID)
				                continue;
				                
				            if($i == $half_pages){ ?>
				        </div>
				        <div style="width:50%" class="alignright">
				        <?php    
				            }
				            $i++;
				            
				        ?>
				            <input type="checkbox" name="frontend_page[]" value="<?php echo $page->ID ?>" <?php TouAppHelper::checked((array)$tou_settings->frontend_page, $page->ID) ?> /> <?php echo substr($page->post_title, 0, 50) ?><br/>
				    <?php } ?>  
				        </div>
				        <div class="clear"></div>
				    </div>
				</td>
        	</tr>
        	
        	<tr>
            	<th scope="row"><?php _e('Require terms in the checked forms', 'terms_of_use') ?></th>
    			<td>
			    <?php if(class_exists('FrmForm')){ ?>
                    <div class="tabs-panel" style="height:140px;margin-left:0;">
                        <div style="width:50%" class="alignleft">
                        <?php TouAppHelper::forms_checkboxes( 'frm_forms', $tou_settings->frm_forms, 2 ) ?>
                        </div>
                    </div>
                    <div class="clear"></div>
                <?php }else{ ?>
                <strong>Install <a href="http://wordpress.org/extend/plugins/formidable/">Formidable</a> to integrate Terms of Use with forms</strong>
                <?php } ?>
                </td>
            </tr>	
       </table>
       
       </div>
       </div>
       
       </div>
       
       <p class="submit">
           <input name="Submit" class="button-primary" value="<?php _e('Save Changes', 'terms_of_use') ?>" type="submit">
       </p>
    </form>
    </div>
</div>
<style type="text/css">
#editorcontainer #terms{width:100%;margin:0;}
</style>