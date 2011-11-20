=== Terms of Use ===
Contributors: sswells
Donate link: http://strategy11.com/donate
Tags: Terms, admin, Use, agreement, Privacy, Policy, WPMU, Conditions, WordPress, plugin, template, comment, registration, signup, reset, cookie, Formidable, protect
Requires at least: 2.8
Tested up to: 3.2
Stable tag: 2.0

Forces all users (except admins) to agree to your Terms and Conditions on first login and anytime you choose to make them accept new terms. Alternatively require terms agreement when commenting, or before accessing specified front-end pages. 

== Description ==
= Require users to accept your Terms and Conditions in several different ways: =
* On signup page
* When submitting a comment
* When submitting any [Formidable](http://wordpress.org/extend/plugins/formidable/ "Formidable") form
* Before accessing specified pages in the back- or front-end

In the back-end, this plugin presents all users except admins with your terms and conditions the first time they login. The Admin menu is hidden until they accept your terms if the option to require agreement on 'All Admin pages' is selected. Existing users and those added in the admin will also need to agree to the Terms and Conditions on their next log in. After the terms are accepted, users are presented with a fully customizable welcome message to help them get started using WordPress.

In the front-end, whether users are logged in or not, they must agree before gaining permission to view the specified page(s). If not logged in, the agreement date and initials are saved to a cookie.

= Features =
* Fully customizable Terms and Conditions, Privacy Policy and welcome message.
* No changes need to be made to the Sign up process.
* Existing users can agree to terms.
* Users can view the terms at any time.
* The date the user agreed is displayed on the profile page with a link to the terms.
* Option to require user initials on agreement.
* Option to require terms agreement on comment form in WordPress version 2.9 and above.
* Option to clear all agreement dates when the terms are changed so users will need to reaccept terms.
* Option to show agreement date on profile.
* Shortcode `[terms-of-use]` for use in pages or posts
* Select a front-end page to protect. If user is not logged in, a cookie will be set when terms are accepted.

http://strategy11.com/terms-of-use-2-wordpress-plugin/

= Translations =
* Japanese ([BNG NET](http://staff.blog.bng.net/ "BNG NET"))

== Installation ==
1. Upload `terms-of-use-2` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu
3. Go to the 'Settings' menu and select 'Terms of Use' to customize settings.
4. Users can view the terms under the 'Dashboard' menu.
5. Use shortcode [terms-of-use] in pages or posts to avoid duplication of content.
6. WPMU: Same as above except go to the 'Site Admin' menu and select 'Terms of Use' to customize settings. 

== Screenshots ==
1. The settings page.
2. The agreement page in the admin. Privacy Policy has been left blank in the example.
3. The welcome page seen after term acceptance in the admin.

== Changelog ==
= 2.0 =
* Added error messages to the settings page
* Updated language files

= 2.0rc2 =
* Don't automatically set users as accepting terms on registration

= 2.0rc1 =
* Don't return error if editing Formidable entry
* Show error messages consistently when inserting in a Formidable form
* Strip slashes from agreement link so the link will work correctly

= 2.0beta2 =
* Added [privacy-policy] shortcode to insert only the privacy policy on a page
* Fixed default link from [terms_url] to [terms-url]
* Corrected language naming conventions to load language files
* Added Japanese translation ([BNG NET](http://staff.blog.bng.net/ "BNG NET"))

= 2.0beta =
* Rewrote plugin code
* Added [Formidable](http://wordpress.org/extend/plugins/formidable/ "Formidable") integration
* Added option to require terms for multiple pages
* Added a PO file for translating. Please send translations to support at strategy11.com
* Added agreement date to the user listing table
* Save terms agreement to database if user is logged in when commenting

= 1.11.3 =
* Replaced all instances of `<?` with `<?php`
* Fixed bug keeping boxes checked on settings page

= 1.11.2 =
* Hopefully fixed parse error some users are getting

= 1.11.1 =
* Changed front-end functionality from a redirect to render terms content on same page. Requires admins to update the Terms of Use settings.
* Added functionality to the "Clear previous agreement" option, to also require users to agree again if they were not logged in when agreed (agreement saved to a cookie)

= 1.11.0 =
* Fixed front-end redirect to work with default permalinks
* Removed unnecessary javascript from admin
* Simplified front-end terms requirements with a page drop-down in the admin settings, and auto content if the page is blank.
* Added option to require terms on comment form

= 1.10.5 =
* Updated instructions for admin menu selected
* Added profile to the options of where to place the Terms of Use admin menu

= 1.10.4 =
* Fixed registration page error... again

= 1.10.3 =
* Fixed bug preventing terms agreement checkbox to show on WP registration page

= 1.10.2 =
* Removed code causing signup issue in WPMU

= 1.10.1 =
* Added Profile page as an option on admin pages to protect

= 1.10 =
* Fixed admin redirect bug

= 1.9 =
* Fixed redirect after terms accepted on WPMU front-end

= 1.8 =
* Bug fix for 'header information already sent' bug some users reported

= 1.7 =
* Fixed bug that overwrote custom options on plugin update.
* Added shortcode for use of terms in pages or posts.
* Fixed bug that showed Privacy Policy and Terms boxes when empty.
* Added option to allow users to accept terms during signup. Known to not save correctly in WPMU.
* Changed date format for profile page to the format selected on Settings > General
* Fixed javascript bug that prevented collapse of windows on new/edit posts page
* Added option to select which admin page to protect
* Added option to select which front-end page to protect
* Added option to select where users see the Terms of Use in the admin menu

= 1.6 =
* Added 'Settings' link on the plugins page
* Added option to require initials on agreement page
* Moved 'Welcome' heading from code to database

= 1.5 =
* Fixed plugin subnav links
 
= 1.4 = 
* Fixed WPMU bugs with link urls. 
* Moved Terms of use to dashboard menu for users to view and accept.

= 1.3 = 
* Fixed folder name in config file.