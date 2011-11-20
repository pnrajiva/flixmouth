<?php

/*
Plugin Name: OpenInviter
Version: 1.7.0
Plugin URI: http://openinviter.com
Description: Allow your visitors to invite their contacts from their AddressBook in GMail, Yahoo!, AOL, Live.com and many other networks to your blog.
Author: OpenInviter
Author URI: http://openinviter.com
*/


if (!defined('WP_CONTENT_DIR')) {
	define( 'WP_CONTENT_DIR', ABSPATH.'wp-content');
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', get_option('siteurl').'/wp-content');
}
if (!defined('WP_PLUGIN_DIR')) {
	define('WP_PLUGIN_DIR', WP_CONTENT_DIR.'/plugins');
}
if (!defined('WP_PLUGIN_URL')) {
	define('WP_PLUGIN_URL', WP_CONTENT_URL.'/plugins');
}

if (!class_exists('OpenInviter'))
	include("oi_includes/openinviter.php");
$inviter=new OpenInviter();
if (isset($inviter))
	{
	$services=$inviter->getPlugins();
	unset($inviter);
	}
else $services=array();

$openinviter_options['settings']['message_body']=array('label'=>'Message body:','default'=>"Hey!\r\n\r\nI have just found a really nice blog - ".get_option('blogname')." - ".get_option('siteurl')." and I think you would like it!");
$openinviter_options['settings']['message_subject']=array('label'=>'Message subject:','default'=>"%s is inviting you to ".get_option('blogname'));
$openinviter_options['title'] = 'Invite your friends';
$openinviter_options['settings']['username'] = array('label'=>'Username:', 'default'=>'tataencu');
$openinviter_options['settings']['private_key'] = array('label'=>'Private key:', 'default'=>'754f89f39acad59e53b22c5a9f9b46a7');
$openinviter_options['settings']['transport'] = array('label'=>'Transport:', 'default'=>'curl');
$openinviter_options['settings']['cookie_path']=array('label'=>'Cookie files path:','default'=>'.');
$openinviter_options['settings']['filter_emails'] = array('label'=>'Filter emails:', 'default'=>true);
$openinviter_options['settings']['local_debug'] = array('label'=>'Local debug:', 'default'=>false);
$openinviter_options['settings']['remote_debug'] = array('label'=>'Remote debug:', 'default'=>true);

function oks($oks)
	{
	if (count($oks)==0)
		return;
	$result="<span style='color:blue;font-weight:bold;'>";
	foreach ($oks as $ok)
		$result.="<br />".$ok;
	$result.="</span>";
	return $result;
	}

function ers($ers)
	{
	if (count($ers)==0)
		return;
	$result="<span style='color:red;font-weight:bold;'>";
	foreach ($ers as $er)
		$result.="<br />".$er;
	$result.="</span>";
	return $result;
	}

function is_base36($string)
	{
	$allowed_chars="0123456789abcdefghijklmnopqrstuvwxyz";
	$length=strlen($string);
	$result=true;
	for ($i=0;$i<$length;$i++)
		if (strpos($allowed_chars,$string[$i])===false)
			$result=false;
	return $result;
	}

function is_md5($string)
	{
	$valid_chars=array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
	$string=strtolower($string);
	if (strlen($string)!=32)
		return false;
	for($i=0;$i<32;$i++)
		if (!in_array($string{$i},$valid_chars))
			return false;
	return true;
	}

function row2text($row)
	{
	$text='';
	reset($row);
	$flag=0;
	$i=0;
	while(list($var,$val)=each($row))
		{
		if($flag==1)
			$text.=", ";
		elseif($flag==2)
			$text.=",\n";
		$flag=1;
		//Variable
		if(is_numeric($var))
			if($var{0}=='0')
				$text.="'$var'=>";
			else
				{
				if($var!==$i)
					$text.="$var=>";
				$i=$var;
				}
		else
			$text.="'$var'=>";
		$i++;
		//letter
		if(is_array($val))
			{
			$text.="array(".row2text($val).")";
			$flag=2;
			}
		else
			$text.="'$val'";
		}
	return($text);
	}

function openinviter_init()
	{
	add_action('admin_menu', 'openinviter_config_page');
	}
add_action('init','openinviter_init');

function openinviter_config_page()
	{
	if (function_exists('add_submenu_page'))
		add_submenu_page('plugins.php', __('OpenInviter Configuration'), __('OpenInviter Configuration'), 'manage_options', 'openinviter-config', 'openinviter_conf');
	}

function openinviter_conf()
	{
	if ($_SERVER['REQUEST_METHOD']=='POST')
		{
		$options=array();
		$ers=array();
		if (empty($_POST['message_body_box']))
			$ers['message']=__("Message missing");
		elseif (strlen($_POST['message_body_box'])<15)
			$ers['message']=__("Message body too short. Minimum length: 15 chars");
		else $options['message_body']=$_POST['message_body_box'];
		if (empty($_POST['message_subject_box']))
			$ers['message_subject']=__("Message subject missing");
		elseif (strlen($_POST['message_subject_box'])<5)
			$ers['message_subject']=__("Message subject too short. Minimum length: 5 chars");
		else $options['message_subject']=$_POST['message_subject_box'];
		if (empty($_POST['username_box']))
			$ers['username']=__("OpenInviter.com Username missing");
		else $options['username']=$_POST['username_box'];
		if (empty($_POST['private_key_box']))
			$ers['private_key']=__("OpenInviter.com Private Key missing");
		elseif (!is_md5($_POST['private_key_box']))
			$ers['private_key']=__("Invalid OpenInviter.com Private Key");
		else $options['private_key']=$_POST['private_key_box'];
		if (empty($_POST['transport_box']))
			$ers['transport']=__("Transport missing");
		else $options['transport']=$_POST['transport_box'];
		if (empty($_POST['cookie_path_box']))
			$ers['cookie']=__("Cookie path missing");
		else $options['cookie_path']=$_POST['cookie_path_box'];
		if (empty($_POST['local_debug_box']))
			$ers['local_debug']=__("Local debugger setting missing");
		else $options['local_debug']=($_POST['local_debug_box']=='off'?false:$_POST['local_debug_box']);
		if (empty($_POST['remote_debug_box']))
			$ers['remote_debug']=__("Remote debugger setting missing");
		else $options['remote_debug']=($_POST['remote_debug_box']=='on'?true:false);
		if (!isset($_POST['filter_emails_box']))
			$options['filter_emails']=false;
		else
			$options['filter_emails']=true;
		if (count($ers)==0)
			{
			if (!get_option('openinviter_settings'))
				add_option('openinviter_settings',$options);
			else
				update_option('openinviter_settings',$options);
			$path=WP_PLUGIN_DIR."/openinviter-for-wordpress/oi_includes/config.php";
			$file_contents="<?php\n";
			$file_contents.="\$openinviter_settings=array(\n".row2text($options)."\n);\n";
			$file_contents.="?>";
			file_put_contents($path,$file_contents);
			echo "<div id='message' class='updated fade'><p><strong>".__('Options saved.')."</strong></p></div>";
			}
		else
			{
			echo "<div id='message' class='error'><p><strong>".__('Errors encountered:')."</strong>";
			foreach ($ers as $er)
				echo "<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$er}";
			echo "</p></div>";
			}
		}
	else
		{
		$options=get_option('openinviter_settings');
		global $openinviter_options;
		foreach ($openinviter_options['settings'] as $key=>$val)
			if (!isset($options[$key]))
				$options[$key]=$val['default'];
		}
	$transports=array('curl'=>__('cURL'),'wget'=>__('WGET'));
	$local_debugs=array('off'=>__('None'),'on_error'=>__('Errors only'),'always'=>__('Always'));
	$remote_debugs=array('off'=>__('Off'),'on'=>__('On'));
	$contents="<div class='wrap'><h2>".__('OpenInviter Configuration')."</h2>
			<div class='narrow'><form action='' method='POST' style='margin: auto; width: 600px;'><p>
			".sprintf(__('<strong>Tip</strong>: You can get your API details (username and private key) from <a href="%1$s">OpenInviter.com</a>. If you don\'t have an OpenInviter.com account you can sign up at <a href="%2$s">OpenInviter.com</a>.'), 'http://openinviter.com/get_key.php', 'http://openinviter.com/register.php')
			."</p>
				<table>
				<tr><td valign='top'><strong><label for='message_body_box'>".__("Invite message body")."</label></strong></td><td><textarea rows='5' cols='47' id='message_body_box' name='message_body_box'>{$options['message_body']}</textarea></td></tr>
				<tr><td valign='top'><strong><label for='message_subject_box'>".__("Invite message subject")."</label></strong></td><td><input type='text' id='message_subject_box' name='message_subject_box' value='{$options['message_subject']}' style='font-family: 'Courier New', Courier, mono; font-size: 1.5em;' size='50' /></td></tr>
				<tr><td colspan='2' align='right'>The <strong>%s</strong> in the message subject will be replaced with the sender</td></tr>
				<tr><td colspan='2'>&nbsp;</td></tr>
				<tr><td><strong><label for='username_box'>".__('OpenInviter.com Username')."</label></strong></td><td><input id='username_box' name='username_box' type='text' value='{$options['username']}' style='font-family: 'Courier New', Courier, mono; font-size: 1.5em;' size='50' /></td></tr>
				<tr><td><strong><label for='private_key_box'>".__('OpenInviter.com Private Key')."</label></strong></td><td><input id='private_key_box' name='private_key_box' type='text' value='{$options['private_key']}' style='font-family: 'Courier New', Courier, mono; font-size: 1.5em;' size='50' /></td></tr>
				<tr><td><strong><label for='transport_box'>".__("Transport")."</label></strong></td><td><select id='transport_box' name='transport_box'><option value=''></option>";
	foreach ($transports as $value=>$name)
		$contents.="<option value='{$value}'".($options['transport']==$value?' selected':'').">{$name}</option>";
	$contents.="</select></td></tr>
				<tr><td><strong><label for='cookie_path_box'>".__("Cookie path")."</label></strong></td><td><input type='text' id='cookie_path_box' name='cookie_path_box' value='{$options['cookie_path']}' style='font-family: 'Courier New', Courier, mono; font-size: 1.5em;' size='50' /></td></tr>
				<tr><td><strong><label for='local_debug_box'>".__('Local debugger')."</label></strong></td><td><select id='local_debug_box' name='local_debug_box'><option value=''></option>";
	if ($options['local_debug']===false) $options['local_debug']='off';
	if ($options['remote_debug']===false) $options['remote_debug']='off';
	else $options['remote_debug']='on';
	foreach($local_debugs as $value=>$name)
		$contents.="<option value='{$value}'".($options['local_debug']==$value?' selected':'').">{$name}</option>";
	$contents.="</select></td></tr>
				<tr><td><strong><label for='remote_debug_box'>".__('Remote debugger')."</label></strong></td><td><select id='remote_debug_box' name='remote_debug_box'><option value=''></option>";
	foreach ($remote_debugs as $value=>$name)
		$contents.="<option value='{$value}'".($options['remote_debug']==$value?' selected':'').">{$name}</option>";
	$contents.="</select></td></tr>
				<tr><td><strong><label for='filter_emails_box'>".__('Filter emails')."</label></strong></td><td><input id='filter_emails_box' name='filter_emails_box' type='checkbox' value='Y'".($options['filter_emails']?' checked':'')."></td></tr>
				<tr><td colspan='2' align='center'><p class='submit'><input type='submit' id='submit' name='save' value='".__("Save options")."' /></p></td></tr>
				</table>
			</form>
			</div>
		</div>";
	echo $contents;
	}

function widget_openinviter_init() {

	if (!function_exists('register_sidebar_widget'))
		return;

	function widget_openinviter($args)
		{
		global $openinviter_options,$services;
		$inviter=new OpenInviter();
		if ((empty($inviter->settings['username'])) OR (empty($inviter->settings['private_key'])))
			return;
		extract($args);
		$title=get_option('openinviter_title');
		if (!$title)
			$title=$openinviter_options['title'];
		$contents=$before_widget . $before_title . $title . $after_title . "<center>";
		$_POST['inviter_email_box']='';
		$_POST['inviter_password_box']='';
		$_POST['inviter_service_box']='';
		$contents.="<form action='?' method='POST'>
			<label for='inviter_email_box'>Email address</label><br /><input type='text' name='inviter_email_box' id='inviter_email_box' value='{$_POST['inviter_email_box']}' /><br>
			<label for='inviter_password_box'>Password</label><br /><input type='password' name='inviter_password_box' id='inviter_password_box' value='{$_POST['inviter_password_box']}' /><br>
			<label for='inviter_service_box'>Email provider</label><br /><select name='inviter_service_box' id='inviter_service_box'><option value=''></option>";
		foreach ($services as $type=>$providers)
			{
			$contents.="<option disabled>".$inviter->pluginTypes[$type]."</option>";
			foreach ($providers as $service=>$details)
				$contents.="<option value='{$service}'".($service==$_POST['inviter_service_box']?' selected':'').">{$details['name']}</option>";
			}
		$contents.="</select><br>
			<input type='submit' name='inviter_submit' value='Invite friends!'></form>";
		$contents.="<br /><a href='http://openinviter.com/'><img src='http://openinviter.com/images/banners/banner_blue_1.gif' border='0' alt='Powered by OpenInviter.com' title='Powered by OpenInviter.com'></a></center>" . $after_widget;
		echo $contents;
		}

	function widget_openinviter_control()
		{
		global $openinviter_options;
		if (isset($_POST['inviter-submit']))
			if (!empty($_POST['title_box']))
				if (!get_option('openinviter_title'))
					add_option('openinviter_title', $_POST['title_box']);
				else
					update_option('openinviter_title', $_POST['title_box']);
		$title = get_option('openinviter_title');
		if (!$title)
			$title=$openinviter_options['title'];
		echo "<p style='text-align:right;' class='openinviter_field'><label for='title_box'>Title <input id='title_box' name='title_box' type='text' value='{$title}' class='openinviter_text' /></label></p>";
		echo '<input type="hidden" id="inviter-submit" name="inviter-submit" value="1" />';
		}
	
	function widget_openinviter_register()
		{		
		$options = get_option('widget_inviter');
		$dims = array('width' => 300, 'height' => 300);
		$class = array('classname' => 'widget_openinviter');

		wp_register_sidebar_widget('openinviter', __("OpenInviter"),'widget_openinviter', $class);
		wp_register_widget_control('openinviter', __("OpenInviter"),'widget_openinviter_control', $dims);
		
		}
	widget_openinviter_register();
	}

function openinviter_validation()
	{
	global $services,$validation_displayed;
	if ($validation_displayed) return;
	$validation_displayed=true;
	$inviter=new OpenInviter();
	if ((empty($inviter->settings['username'])) OR (empty($inviter->settings['private_key'])))
		return;
	$display_openinviter=false;$ers=array();$oks=array();
	$procedure='';
	if ($_SERVER['REQUEST_METHOD']=='POST')
		{
		if (isset($_POST['inviter_submit']))
			{
			$display_openinviter=true;
			$procedure='inviter';
			if (!empty($_POST['send_invites'])) $step='send_invites';
			else $step='get_contacts';
			if ($step=='send_invites')
				{
				if (empty($_POST['inviter_service_box'])) $ers['service']=__("Service missing");
				else
					{
					$inviter->startPlugin($_POST['inviter_service_box']);
					if (empty($_POST['inviter_email_box'])) $ers['inviter']='Inviter information missing';
					if (empty($_POST['cookie_file'])) $ers['cookie']='Could not find cookie file';
					$settings=get_option('openinviter_settings');global $openinviter_options;
					$message=(empty($settings['message_body'])?$openinviter_options['message_body']:$settings['message_body']);
					$subject=(empty($settings['message_subject'])?$openinviter_options['message_subject']:$settings['message_subject']);
					$message=array('subject'=>$subject,'message'=>$message);
					$contacts=array();$selected_contacts=array();
					foreach ($_POST as $key=>$val)
						if(strpos($key,'check_')!==false)
							$selected_contacts[$_POST['email_'.$val]]=$_POST['name_'.$val];
						elseif (strpos($key,'email_')!==false)
							{
							$temp=explode('_',$key);$counter=$temp[1];
							$contacts[$val]=$_POST['name_'.$temp[1]];
							}
					if (count($selected_contacts)==0)
						$ers['no_selected']=__("You have not selected any contacts to invite");
					}
				if (count($ers)==0)
					{
					$sendMessage=$inviter->sendMessage($_POST['cookie_file'],$message,$selected_contacts);
					$inviter->logout();
					if ($sendMessage===-1)
						{
						if (!function_exists("wp-mail"))
							require_once(ABSPATH.'wp-includes/pluggable.php');
						$message_footer="\r\n\r\nThis invite was sent using OpenInviter technology.";
						$message_headers = 'From: "' .get_option('blogname'). '" <wordpress@' .get_option('siteurl'). '>'; 
						$temp=$message.$message_footer;
						foreach($contacts as $email=>$name)
							wp_mail( $email, sprintf($subject,$_POST['inviter_email_box']), $temp, $message_headers);
						$oks['sent']=__("Invites sent successfully");
						}
					elseif ($sendMessage===false)
						$ers['internal']="There were errors while sending your invites.<br>Please try again later!";
					else $oks['internal']="Invites sent successfully!";
					}
				}
			elseif ($step=='get_contacts')
				{
				if (empty($_POST['inviter_email_box']))
					$ers['email']=__("Email missing");
				if (empty($_POST['inviter_password_box']))
					$ers['password']=__("Password missing");
				if (empty($_POST['inviter_service_box']))
					$ers['service']=__("Service missing");
				if (count($ers)==0)
					{
					$inviter->startPlugin($_POST['inviter_service_box']);
					$internal=$inviter->getInternalError();
					if ($internal)
						$ers['inviter']=$internal;
					elseif (!$inviter->login($_POST['inviter_email_box'],$_POST['inviter_password_box']))
						{
						$internal=$inviter->getInternalError();
						$ers['login']=($internal?$internal:"Login failed. Please check the email and password you have provided and try again later");
						}
					elseif (false===$contacts=$inviter->getMyContacts())
						$ers['contacts']=__("Unable to get contacts.");
					else
						{
						$inviter->stopPlugin(true);
						$step='send_invites';
						$_POST['cookie_file']=$inviter->plugin->cookie;
						}
					}
				}
			}
		}
	if ($display_openinviter!==false)
		{
		$title=get_option('openinviter_title');
		if (empty($title))
			{
			global $openinviter_options;
			$title=$openinviter_options['title'];
			}
		$contents="<br /><div style='width:90%;margin:0px auto;border:1px dashed black;background:white;color:black;'><center><h2 style='margin-top:5px;'>{$title}</h2></center>";
		if (count($ers)!=0)
			$contents.="<center>".ers($ers)."</center><br />";
		if (count($oks)!=0)
			$contents.="<center>".oks($oks)."</center><br />";
		elseif ($procedure=='inviter' AND $step='send_invites')
			{
			$contents.="<form action='' method='POST'>
				<input type='hidden' name='inviter_service_box' value='{$_POST['inviter_service_box']}'>
				<input type='hidden' name='inviter_email_box' value='{$_POST['inviter_email_box']}'>
				<input type='hidden' name='cookie_file' value='{$_POST['cookie_file']}'>
				<input type='hidden' name='send_invites' value='send_invites'>
				<table align='center'>
					<tr><td colspan='2'>&nbsp;</td></tr>
					<tr><td colspan='2' align='center'><input type='submit' name='inviter_submit' value='".__("Send Invites")."' /></td></tr>";
			if ($inviter->showContacts())
				{
				if (empty($contacts))
					{
					$ers['contacts']=__("You do not have any contacts that you can invite!");
					$contents.="<center>".ers($ers)."</center><br />";
					}
				else
					{
					$counter=0;
					foreach ($contacts as $email=>$name)
						{
						$counter++;
						$contents.="<tr><td><input type='checkbox' name='check_{$counter}' checked value='{$counter}' /><input type='hidden' name='name_{$counter}' value='{$name}' /><input type='hidden' name='email_{$counter}' value='{$name}' /></td><td>{$email}</td></tr>";
						}
					$contents.="<tr><td colspan='2' align='center'><input type='submit' name='inviter_submit' value='".__("Send Invites")."' /></td></tr>";
					}
				}
			$contents.="</table></form>";
			}
		$contents.="</div>";
		echo $contents;
		}
	}
$validation_displayed=false;
add_action('widgets_init', 'widget_openinviter_init');
add_filter('loop_start', 'openinviter_validation');
?>
