<?php get_header() ?>

	<div id="content">
		<div class="padder">

		<?php do_action( 'bp_before_register_page' ) ?>

		<div class="page" id="register-page">

			<form action="" name="signup_form" id="signup_form" class="standard-form" method="post" enctype="multipart/form-data">

			<?php if ( 'request-details' == bp_get_current_signup_step() ) : ?>

				<h2><?php _e( 'Create an Account', 'buddypress' ) ?></h2>

				<?php do_action( 'template_notices' ) ?>

				<p><?php _e( 'Registering for this site is easy, just fill in the fields below and we\'ll get a new account set up for you in no time.', 'buddypress' ) ?></p>

				<?php do_action( 'bp_before_account_details_fields' ) ?>

				<div class="register-section" id="basic-details-section">

					<?php /***** Basic Account Details ******/ ?>

					<h4><?php _e( 'Account Details', 'buddypress' ) ?></h4>

					<label for="signup_username"><?php _e( 'Username', 'buddypress' ) ?> <?php _e( '(required)', 'buddypress' ) ?></label>
					<?php do_action( 'bp_signup_username_errors' ) ?>
					<input type="text" name="signup_username" id="signup_username" value="<?php bp_signup_username_value() ?>" />

					<label for="signup_email"><?php _e( 'Email Address', 'buddypress' ) ?> <?php _e( '(required)', 'buddypress' ) ?></label>
					<?php do_action( 'bp_signup_email_errors' ) ?>
					<input type="text" name="signup_email" id="signup_email" value="<?php bp_signup_email_value() ?>" />

					<label for="signup_password"><?php _e( 'Choose a Password', 'buddypress' ) ?> <?php _e( '(required)', 'buddypress' ) ?></label>
					<?php do_action( 'bp_signup_password_errors' ) ?>
					<input type="password" name="signup_password" id="signup_password" value="" />
					<label for="signup_password_confirm"><?php _e( 'Confirm Password', 'buddypress' ) ?> <?php _e( '(required)', 'buddypress' ) ?></label>
					<?php do_action( 'bp_signup_password_confirm_errors' ) ?>
					<input type="password" name="signup_password_confirm" id="signup_password_confirm" value="" />
				</div><!-- #basic-details-section -->

				<?php do_action( 'bp_after_account_details_fields' ) ?>

				<?php /***** Extra Profile Details ******/ ?>

				<?php if ( bp_is_active( 'xprofile' ) ) : ?>

					<?php do_action( 'bp_before_signup_profile_fields' ) ?>

					<div class="register-section" id="profile-details-section">

						<h4><?php _e( 'Profile Details', 'buddypress' ) ?></h4>

						<?php /* Use the profile field loop to render input fields for the 'base' profile field group */ ?>
						<?php if ( function_exists( 'bp_has_profile' ) ) : if ( bp_has_profile( 'profile_group_id=1' ) ) : while ( bp_profile_groups() ) : bp_the_profile_group(); ?>

						<?php while ( bp_profile_fields() ) : bp_the_profile_field(); ?>

							<div class="editfield">

								<?php if ( 'textbox' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
									<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
									<input type="text" name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>" value="<?php bp_the_profile_field_edit_value() ?>" />

								<?php endif; ?>

								<?php if ( 'textarea' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
									<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
									<textarea rows="5" cols="40" name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_edit_value() ?></textarea>

								<?php endif; ?>

								<?php if ( 'selectbox' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
									<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
									<select name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>">
										<?php bp_the_profile_field_options() ?>
									</select>

								<?php endif; ?>

								<?php if ( 'multiselectbox' == bp_get_the_profile_field_type() ) : ?>

									<label for="<?php bp_the_profile_field_input_name() ?>"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
									<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
									<select name="<?php bp_the_profile_field_input_name() ?>" id="<?php bp_the_profile_field_input_name() ?>" multiple="multiple">
										<?php bp_the_profile_field_options() ?>
									</select>

								<?php endif; ?>

								<?php if ( 'radio' == bp_get_the_profile_field_type() ) : ?>

									<div class="radio">
										<span class="label"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></span>

										<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
										<?php bp_the_profile_field_options() ?>

										<?php if ( !bp_get_the_profile_field_is_required() ) : ?>
											<a class="clear-value" href="javascript:clear( '<?php bp_the_profile_field_input_name() ?>' );"><?php _e( 'Clear', 'buddypress' ) ?></a>
										<?php endif; ?>
									</div>

								<?php endif; ?>

								<?php if ( 'checkbox' == bp_get_the_profile_field_type() ) : ?>

									<div class="checkbox">
										<span class="label"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></span>

										<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>
										<?php bp_the_profile_field_options() ?>
									</div>

								<?php endif; ?>

								<?php if ( 'datebox' == bp_get_the_profile_field_type() ) : ?>

									<div class="datebox">
										<label for="<?php bp_the_profile_field_input_name() ?>_day"><?php bp_the_profile_field_name() ?> <?php if ( bp_get_the_profile_field_is_required() ) : ?><?php _e( '(required)', 'buddypress' ) ?><?php endif; ?></label>
										<?php do_action( 'bp_' . bp_get_the_profile_field_input_name() . '_errors' ) ?>

										<select name="<?php bp_the_profile_field_input_name() ?>_day" id="<?php bp_the_profile_field_input_name() ?>_day">
											<?php bp_the_profile_field_options( 'type=day' ) ?>
										</select>

										<select name="<?php bp_the_profile_field_input_name() ?>_month" id="<?php bp_the_profile_field_input_name() ?>_month">
											<?php bp_the_profile_field_options( 'type=month' ) ?>
										</select>

										<select name="<?php bp_the_profile_field_input_name() ?>_year" id="<?php bp_the_profile_field_input_name() ?>_year">
											<?php bp_the_profile_field_options( 'type=year' ) ?>
										</select>
									</div>

								<?php endif; ?>

								<?php do_action( 'bp_custom_profile_edit_fields' ) ?>

								<p class="description"><?php bp_the_profile_field_description() ?></p>

							</div>

						<?php endwhile; ?>

						<input type="hidden" name="signup_profile_field_ids" id="signup_profile_field_ids" value="<?php bp_the_profile_group_field_ids() ?>" />

						<?php endwhile; endif; endif; ?>

					</div><!-- #profile-details-section -->

					<?php do_action( 'bp_after_signup_profile_fields' ) ?>

				<?php endif; ?>
				
				<?php if ( bp_get_blog_signup_allowed() ) : ?>

					<?php do_action( 'bp_before_blog_details_fields' ) ?>

					<?php /***** Blog Creation Details ******/ ?>

					<div class="register-section" id="blog-details-section">

						<h4><?php _e( 'Blog Details', 'buddypress' ) ?></h4>

						<p><input type="checkbox" name="signup_with_blog" id="signup_with_blog" value="1"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes, I\'d like to create a new blog', 'buddypress' ) ?></p>

						<div id="blog-details"<?php if ( (int) bp_get_signup_with_blog_value() ) : ?>class="show"<?php endif; ?>>

							<label for="signup_blog_url"><?php _e( 'Blog URL', 'buddypress' ) ?> <?php _e( '(required)', 'buddypress' ) ?></label>
							<?php do_action( 'bp_signup_blog_url_errors' ) ?>

							<?php if ( is_subdomain_install() ) : ?>
								http:// <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value() ?>" /> .<?php echo str_replace( 'http://', '', site_url() ) ?>
							<?php else : ?>
								<?php echo site_url() ?>/ <input type="text" name="signup_blog_url" id="signup_blog_url" value="<?php bp_signup_blog_url_value() ?>" />
							<?php endif; ?>

							<label for="signup_blog_title"><?php _e( 'Blog Title', 'buddypress' ) ?> <?php _e( '(required)', 'buddypress' ) ?></label>
							<?php do_action( 'bp_signup_blog_title_errors' ) ?>
							<input type="text" name="signup_blog_title" id="signup_blog_title" value="<?php bp_signup_blog_title_value() ?>" />

							<span class="label"><?php _e( 'I would like my blog to appear in search engines, and in public listings around this site', 'buddypress' ) ?>:</span>
							<?php do_action( 'bp_signup_blog_privacy_errors' ) ?>

							<label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_public" value="public"<?php if ( 'public' == bp_get_signup_blog_privacy_value() || !bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'Yes' ) ?></label>
							<label><input type="radio" name="signup_blog_privacy" id="signup_blog_privacy_private" value="private"<?php if ( 'private' == bp_get_signup_blog_privacy_value() ) : ?> checked="checked"<?php endif; ?> /> <?php _e( 'No' ) ?></label>

						</div>

					</div><!-- #blog-details-section -->

					<?php do_action( 'bp_after_blog_details_fields' ) ?>

				<?php endif; ?>

                                  <!-- CM added for privacy-->
                                   
                                <div style="width:  600px;  height:  200px;  overflow:  scroll;">
                                    <BR>
                                     <div>
                                         <H4>Terms and conditions</H4>
                                     </div>
                                    <BR>
                                    <p class="description">Important Information You should carefully read the following Terms and Conditions (also referred to as the "Terms of Use", "Terms of Service" or "TOS"). Your use of our service(s) implies that you have read and accepted these Terms and Conditions. The Website (all flixmouth websites may hereafter be referred to, both individually and collectively, as "The Website") from which you accessed this agreement is provided to you subject to the conditions listed below. These terms are in addition to any other terms that individual Website owners within the flixmouth may include for governing access to their Websites.
Any Non-Human Visitors to these Websites shall be considered agents of the individual(s) who controls, authors or otherwise makes use of them. Such individual(s) shall be deemed responsible for the actions of their Non-Human Visitor devices in the same manner as if they personally visited the Website.
The access rights granted to you under the Terms Of Use are non-transferable without the express written permission of the owner of flixmouth. You are responsible for the actions of any other person who may utilize your access rights on the flixmouth Website.
Introduction The following terms and conditions govern all use of the flixmouth Website(s) and all content, services and products available at or through the Website. The Website is offered subject to your acceptance without modification of all of the terms and conditions contained herein and all other associated operating rules and policies (including, without limitation, flixmouth Privacy Policy).
Please read this Agreement carefully before accessing or using the flixmouth Website. By accessing or using any part of the Website, you agree to become bound by the terms and conditions of this agreement. If you do not agree to all the terms and conditions of this agreement, then you may not access the Website or use any services. If these terms and conditions are considered an offer by the flixmouth, acceptance is expressly limited to these terms.
The Website is available only to individuals who are at least 13 years old. If you are not yet 13 years old, you must stop using the Website immediately or else provide flixmouth with written parental approval.
Our basic products and services are free to both Website owners & individual users. However we may offer some paid upgrades for advanced features such as domain hosting or extra disk space or bandwidth.
Our products and services are designed to give Website owners as much control and ownership over their site as possible and to encourage users/members to express themselves freely. However, each site owner must be responsible for the content of their site. In particular, as a site owner, you must make certain that none of the prohibited items listed below appear on your site or get linked to from your site (things like spam, viruses, or hate content).
SPECIAL LICENSE RESTRICTIONS FOR NON-HUMAN VISITORS A special restriction on a visitor\'s license to access the Website applies to all Non-Human Visitors. Non-Human Visitors include, but are not limited to, web spiders, bots, indexers, robots, crawlers, harvesters, or any other computer programs designed to access, read, compile or gather content from the Website automatically.Email addresses on the flixmouth are considered proprietary intellectual property. It is recognized that these email addresses are provided for human visitors alone. You acknowledge and agree that each email address the Website contains has a value not less than US $50. You further agree that the compilation, storage, and/or distribution of these addresses substantially diminishes the value of these addresses. Intentional collection, harvesting, gathering, and/or storing the Website\'s email addresses is recognized as a violation of this agreement and expressly prohibited. Ownership You do not claim intellectual property right or exclusive ownership to any of our products or services, whether modified or unmodified. All products and services are the property of flixmouth. Our products and services are provided 'as is' without warranty of any kind, either expressed or implied. In no event shall our organization (or any business or individual associated with flixmouth) be liable for any damages including, but not limited to, direct, indirect, special, punitive, incidental or consequential, or other losses arising out of the use of or inability to use our products or services.
Your flixmouth Account and Site. If you create a site with flixmouth, you are responsible for maintaining the security of your account and site, and you are fully responsible for all activities that occur under the account and any other actions taken in connection with the site. You must not describe or assign keywords to your site in a misleading or unlawful manner, including in a manner intended to trade on the name or reputation of others, and flixmouth may change or remove any description or keyword that it considers inappropriate or unlawful, or otherwise likely to cause flixmouth to be positioned for possible liability. You must immediately notify flixmouth of any unauthorized uses of your site, your account or any other breaches of security. flixmouth will not be liable for any acts or omissions by you, including any damages of any kind incurred as a result of such acts or omissions.
Responsibility of Contributors. If you operate a Website, comment on a Website, post material to the Website, post links on the Website, or otherwise make (or allow any third party to make) material available by means of the Website (any such material, 'Content'), You are entirely responsible for the content of, and any harm resulting from, that Content. That is the case regardless of whether the Content in question constitutes text, graphics, an audio file, computer software or any other type of electronic content. By making Content available, you represent and warrant that:
the downloading, copying and use of the Content will not infringe the proprietary rights, including but not limited to the copyright, patent, trademark or trade secret rights, of any third party;
you have fully complied with any third-party licenses relating to the Content, and have done all things necessary to successfully pass through to end users any required terms;
the Content does not contain or install any viruses, worms, malware, Trojan horses or other harmful or destructive content;
the Content is not spam, is not machine- or randomly-generated, and does not contain unethical or unwanted commercial content designed to drive traffic to third party sites or boost the search engine rankings of third party sites, or to further unlawful acts (such as phishing) or mislead recipients as to the source of the material (such as spoofing);
the Content is not obscene, libellous, defamatory, hateful or racially bigoted, does not violate the privacy or publicity rights of any third party and is not otherwise unlawful;
your site is not named in a manner that misleads your readers into thinking that you are another person or company. For example, your site\'s URL or name is not the name of a person other than yourself or company other than your own; and
you have, in the case of Content that includes computer code, accurately categorized and/or described the type, nature, uses and effects of the materials, whether requested to do so by flixmouth or otherwise.
By submitting Content to flixmouth for inclusion on the Website, you grant flixmouth a world-wide, royalty-free, and non-exclusive license to reproduce, modify, adapt and publish the Content solely for the purpose of displaying, distributing and promoting your site or Content. If you delete Content and advise flixmouth, flixmouth will use reasonable efforts to remove said Content from the Website (generally within two business days), but you acknowledge that caching and/or other references to the Content may not be made immediately unavailable.
Without limiting any of those representations or warranties, flixmouth has the right (though not the obligation) to, in flixmouth\'s sole discretion (i) refuse or remove any content that, in flixmouth\'s reasonable opinion, violates any flixmouth\'s policy or is in any way harmful, unlawful or objectionable, or (ii) terminate or deny access to and use of the Website to any individual or entity for any reason, in flixmouth\'s sole discretion. flixmouth will have no obligation to provide a refund of any amounts previously paid.
Fees and Payment. Optional premium paid services (such as domain purchases, etc.) may be available on the Website. By selecting a premium service you agree to pay flixmouth the monthly or annual subscription fees indicated for that service. Payments will be charged on the day you sign up for a premium service and will cover the use of that service for a monthly or annual period as indicated. Premium service fees are not refundable.
Responsibility of Website Visitors. flixmouth has not reviewed, and cannot review, all of the material, including computer software, posted to the Website, and cannot therefore be responsible for that material\'s content, use or effects. By operating the Website, flixmouth does not represent or imply that it endorses the material there posted, or that it believes such material to be accurate, useful or non-harmful. You are responsible for taking precautions as necessary to protect yourself and your computer systems from viruses, worms, Trojan horses, and other harmful or destructive content. Any user or site owner who finds content that is offensive, indecent, or otherwise objectionable, or content containing technical inaccuracies, typographical mistakes, or other errors has a responsibility to report such Content to flixmouth. In the same way, anyone who discovers Content on the Website that contains material that violates the privacy or publicity rights, or infringes the intellectual property and other proprietary rights, of third parties, or the downloading, copying or use of which is subject to additional terms and conditions, stated or unstated, must report the same to flixmouth. flixmouth disclaims any responsibility for any harm resulting from the use by visitors of the Website, or from any downloading by those visitors of content there posted.
Content Posted on Other Websites. We have not reviewed, and cannot review, all of the material, including computer software, made available through the Websites and WebPages to which flixmouth links, and that link to flixmouth. flixmouth does not have any control over those non-flixmouth Websites and WebPages, and is not responsible for their contents or their use. By linking to a non-flixmouth Website or webpage, flixmouth does not represent or imply that it endorses such Website or webpage. You are responsible for taking precautions as necessary to protect yourself and your computer systems from viruses, worms, Trojan horses, and other harmful or destructive content. flixmouth disclaims any responsibility for any harm resulting from your use of non-flixmouth Websites and WebPages.
Copyright Infringement and DMCA Policy. As flixmouth asks others to respect its intellectual property rights, it respects the intellectual property rights of others. If you believe that material located on or linked to by flixmouth violates your copyright, you are encouraged to notify flixmouth. flixmouth will respond to all such notices, including as required or appropriate by removing the infringing material or disabling all links to the infringing material. In the case of a visitor who may infringe or repeatedly infringes the copyrights or other intellectual property rights of flixmouth or others, flixmouth may, in its discretion, terminate or deny access to and use of the Website. In the case of such termination, flixmouth will have no obligation to provide a refund of any amounts previously paid to flixmouth.
Intellectual Property. This Agreement does not transfer from flixmouth to you any flixmouth or third party intellectual property, and all right, title and interest in and to such property will remain (as between the parties) solely with flixmouth. flixmouth, the flixmouth domain, the flixmouth logo, and all other trademarks, service marks, graphics and logos used in connection with flixmouth, or the Website are trademarks or registered trademarks of flixmouth or flixmouth\'s licensors. Other trademarks, service marks, graphics and logos used in connection with the Website may be the trademarks of other third parties. Your use of the Website grants you no right or license to reproduce or otherwise use any flixmouth or third-party trademarks.
Changes. flixmouth reserves the right, at its sole discretion, to modify or replace any part of this Agreement. It is your responsibility to check this Agreement periodically for changes. Your continued use of or access to the Website following the posting of any changes to this Agreement constitutes acceptance of those changes. flixmouth may also, in the future, offer new services and/or features through the Website (including, the release of new tools, services and resources). Such new features and/or services shall be subject to the terms and conditions of this Agreement.
Termination. flixmouth may terminate your access to all or any part of the Website at any time, with or without cause, with or without notice, effective immediately. If you wish to terminate this Agreement or your flixmouth account (if you have one), you may simply discontinue using the Website. Notwithstanding the foregoing, if you have a VIP, Premium or other Paid Services account, such account can only be terminated by flixmouth if you materially breach this Agreement and fail to cure such breach within thirty (30) days from flixmouth\'s notice to you thereof; provided that, flixmouth can terminate the Website immediately as part of a general shut down of our service or other lawful reason. Additionally, a paid account may be temporarily terminated pending a determination of the facts relating to a possible breach of this Agreement. Upon termination, all provisions of this Agreement which by their nature should survive termination shall survive termination, including, without limitation, ownership provisions, warranty disclaimers, indemnity and limitations of liability.
Disclaimer of Warranties.
The materials on flixmouth\'s Website are provided \'as is\'. flixmouth makes no warranties, expressed or implied, and hereby disclaims and negates all other warranties, including without limitation, implied warranties or conditions of merchantability, fitness for a particular purpose, or non-infringement of intellectual property or other violation of rights. Further, flixmouth does not warrant or make any representations concerning the accuracy, likely results, or reliability of the use of the materials on its Internet Website or otherwise relating to such materials or on any sites linked to this site.
Limitation of Liability. In no event will flixmouth, or its suppliers or licensors, or any individuals associated with those entities, be liable with respect to any subject matter of this agreement under any contract, negligence, strict liability or other legal or equitable theory for: (i) any special, incidental or consequential damages; (ii) the cost of procurement or substitute products or services; (iii) for interruption of use or loss or corruption of data; or (iv) for any amounts that exceed the fees paid by you to flixmouth under this agreement during the twelve (12) month period prior to the cause of action. flixmouth shall have no liability for any failure or delay due to matters beyond their reasonable control. The foregoing shall not apply to the extent prohibited by applicable law.
General Representation and Warranty.
You represent and warrant that (i) your use of the Website will be in strict accordance with the flixmouth  Privacy Policy, with this Agreement and with all applicable laws and regulations (including without limitation any local laws or regulations in your country, state, city, or other governmental area, regarding online conduct and acceptable content, and including all applicable laws regarding the transmission of technical data exported from the country in which you reside) and (ii) your use of the Website will not infringe or misappropriate the intellectual property rights of any third party.
Indemnification. You agree to indemnify and hold harmless flixmouth, its contractors, and its licensors, and their respective directors, officers, employees and agents from and against any and all claims and expenses, including attorneys fees, arising out of your use of the Website, including but not limited to out of your violation of this Agreement.
APPLICABLE LAW AND JURISDICTION
Each party agrees that any suit, action or proceeding brought by such party against the other in connection with or arising from the Terms of Service ("Judicial Action") shall be governed by the law of the state of residence of the registered Administrative Contact (the "Admin State") for the Website as such laws are applied to agreements between Admin State residents entered into and performed entirely within the Admin State. You consent to the jurisdiction of federal and state courts within the Admin State. You consent to the venue in any action brought against him in connection with breaches of these Terms of Service. You consent to electronic service of process regarding actions under the above agreement.
RECORDS OF VISITOR USE AND ABUSE
You consent to having your Internet Protocol address recorded. An email address may appear immediately below (the "Identifier") if we suspect potential abuse. The Identifier is uniquely matched to your Internet Protocol address. Visitors agree not to use this address for any reason.
VISITORS AGREE THAT HARVESTING, GATHERING, STORING, TRANSFERRING TO A THIRD PARTY OR SENDING ANY MESSAGE(S) TO THE IDENTIFIER CONSTITUTES AN ACCEPTANCE AND SUBSEQUENT BREACH OF THESE TERMS OF SERVICE.
Site Terms of Use Modifications flixmouth may revise these Terms of Use for its Website at any time without notice. By using this Website you are agreeing to be bound by the then current version of these Terms and Conditions of Use. </p>

                                </div>

                                 <BR>
                                     <div>
                                         <H4>Accept Terms</H4>
                                     </div>
                                 <BR>

				<?php do_action( 'bp_before_registration_submit_buttons' ) ?>

				<div class="submit">
					<input type="submit" name="signup_submit" id="signup_submit" value="<?php _e( 'Complete Sign Up', 'buddypress' ) ?> &rarr;" />
				</div>

				<?php do_action( 'bp_after_registration_submit_buttons' ) ?>

				<?php wp_nonce_field( 'bp_new_signup' ) ?>

			<?php endif; // request-details signup step ?>

			<?php if ( 'completed-confirmation' == bp_get_current_signup_step() ) : ?>

				<h2><?php _e( 'Sign Up Complete!', 'buddypress' ) ?></h2>

				<?php do_action( 'template_notices' ) ?>

				<?php if ( bp_registration_needs_activation() ) : ?>
					<p><?php _e( 'You have successfully created your account! To begin using this site you will need to activate your account via the email we have just sent to your address.', 'buddypress' ) ?></p>
				<?php else : ?>
					<p><?php _e( 'You have successfully created your account! Please log in using the username and password you have just created.', 'buddypress' ) ?></p>
				<?php endif; ?>

				<?php if ( bp_is_active( 'xprofile' ) && !(int)bp_get_option( 'bp-disable-avatar-uploads' ) ) : ?>

					<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>

						<h4><?php _e( 'Your Current Avatar', 'buddypress' ) ?></h4>
						<p><?php _e( "We've fetched an avatar for your new account. If you'd like to change this, why not upload a new one?", 'buddypress' ) ?></p>

						<div id="signup-avatar">
							<?php bp_signup_avatar() ?>
						</div>

						<p>
							<input type="file" name="file" id="file" />
							<input type="submit" name="upload" id="upload" value="<?php _e( 'Upload Image', 'buddypress' ) ?>" />
							<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
							<input type="hidden" name="signup_email" id="signup_email" value="<?php bp_signup_email_value() ?>" />
							<input type="hidden" name="signup_username" id="signup_username" value="<?php bp_signup_username_value() ?>" />
						</p>

						<?php wp_nonce_field( 'bp_avatar_upload' ) ?>

					<?php endif; ?>

					<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>

						<h3><?php _e( 'Crop Your New Avatar', 'buddypress' ) ?></h3>

						<img src="<?php bp_avatar_to_crop() ?>" id="avatar-to-crop" class="avatar" alt="<?php _e( 'Avatar to crop', 'buddypress' ) ?>" />

						<div id="avatar-crop-pane">
							<img src="<?php bp_avatar_to_crop() ?>" id="avatar-crop-preview" class="avatar" alt="<?php _e( 'Avatar preview', 'buddypress' ) ?>" />
						</div>

						<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php _e( 'Crop Image', 'buddypress' ) ?>" />

						<input type="hidden" name="signup_email" id="signup_email" value="<?php bp_signup_email_value() ?>" />
						<input type="hidden" name="signup_username" id="signup_username" value="<?php bp_signup_username_value() ?>" />
						<input type="hidden" name="signup_avatar_dir" id="signup_avatar_dir" value="<?php bp_signup_avatar_dir_value() ?>" />

						<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src() ?>" />
						<input type="hidden" id="x" name="x" />
						<input type="hidden" id="y" name="y" />
						<input type="hidden" id="w" name="w" />
						<input type="hidden" id="h" name="h" />

						<?php wp_nonce_field( 'bp_avatar_cropstore' ) ?>

					<?php endif; ?>

				<?php endif; ?>

			<?php endif; // completed-confirmation signup step ?>
			<?php do_action( 'bp_custom_signup_steps' ) ?>

			</form>

		</div>

		<?php do_action( 'bp_after_register_page' ) ?>

		</div><!-- .padder -->
	</div><!-- #content -->

	<?php locate_template( array( 'sidebar.php' ), true ) ?>

	<?php do_action( 'bp_after_directory_activity_content' ) ?>

	<script type="text/javascript">
		jQuery(document).ready( function() {
			if ( jQuery('div#blog-details').length && !jQuery('div#blog-details').hasClass('show') )
				jQuery('div#blog-details').toggle();

			jQuery( 'input#signup_with_blog' ).click( function() {
				jQuery('div#blog-details').fadeOut().toggle();
			});
		});
	</script>

<?php get_footer() ?>
