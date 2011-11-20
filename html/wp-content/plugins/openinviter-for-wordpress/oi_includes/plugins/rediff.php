<?php
$_pluginInfo=array(
	'name'=>'Rediff',
	'version'=>'1.1.3',
	'description'=>"Get the contacts from a Rediff account",
	'base_version'=>'1.6.0',
	'type'=>'email',
	'check_url'=>'http://mail.rediff.com'
	);
/**
 * Rediff Plugin
 * 
 * Import user's contacts from Rediff's AddressBook
 * 
 * @author OpenInviter
 * @version 1.1.3
 */
class rediff extends OpenInviter_Base
{
	private $login_ok=false;
	public $showContacts=true;
	public $requirement='user';
	public $allowed_domains=false;
	private $session_id, $username, $siteAddr;
	public $debug_array=array(
			  'login_post'=>'If you are seeing this page, your browser settings prevent you from automatically redirecting to a new URL',
			  'go_to_inbox'=>'Write Mail',
			  'compose_mail'=>'Group Contacts'
	);
	
	/**
	 * Login function
	 * 
	 * Makes all the necessary requests to authenticate
	 * the current user to the server.
	 * 
	 * @param string $user The current user.
	 * @param string $pass The password for the current user.
	 * @return bool TRUE if the current user was authenticated successfully, FALSE otherwise.
	 */
	public function login($user,$pass)
		{
		$this->resetDebugger();
		$this->service='rediff';
		$this->service_user=$user;
		$this->service_password=$pass;
		$this->init();
		//this array contains the post variables for the login sequence
		$post_elements=array("login"=>"{$user}",
							"passwd"=>"{$pass}",
							"FormName"=>"existing");
		//try to login:
		$res=htmlentities($this->post("http://mail.rediff.com/cgi-bin/login.cgi",$post_elements,true));
		//check for the correct response
		if ($this->checkResponse("login_post",$res))
			{
				$this->updateDebugBuffer('login_post',"http://mail.rediff.com/cgi-bin/login.cgi",'POST',true,$post_elements);
				//if we recived the correct response we must find some vars for the next step.
				//link_to_extract is the string which will provide these vars.
				$link_to_extract = $this->getElementString($res, 'window.location.replace(&quot;', '&quot;);');
				//siteAddr is the subdomain which handles our user's mail.
				$this->siteAddr = $this->getElementString($link_to_extract,'http://','/');
				//username is the user name provided.
				$this->username = $user;
				//session_id is provided after login
				$this->session_id = $this->getElementString($link_to_extract,'&amp;session_id=','&amp;');					
				$url_redirect = "http://{$this->siteAddr}/bn/toggle.cgi?flipval=1&login={$this->username}&session_id={$this->session_id}&folder=Inbox&formname=sh_folder&user_size=1";
			}
		else
		{
			$this->updateDebugBuffer('login_post',"http://mail.rediff.com/cgi-bin/login.cgi",'POST',false,$post_elements);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
		}
		//go the the next page
		$res = ($this->get($url_redirect, true, true));
		$url_redirect = ($this->getElementString($res,'click <a href=','>'));
		if (!$url_redirect)
			{
				$this->updateDebugBuffer('login_post->go_to_inbox',"http://mail.rediff.com/cgi-bin/login.cgi",'GET',false,$post_elements);
				$this->debugRequest();
				$this->stopPlugin();
				return false;			
			}
		$url_redirect = "http://".$this->siteAddr.$url_redirect;
		//go to inbox
		$res = ($this->get($url_redirect, true, true));
		if ($this->checkResponse("go_to_inbox",$res))
			$this->updateDebugBuffer('go_to_inbox',$url_redirect,'GET');		
		else
			{
			$this->updateDebugBuffer('go_to_inbox',$url_redirect,'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		$url_contact = "http://{$this->siteAddr}/bn/address.cgi?login={$this->username}&session_id={$this->session_id}&FormName=popup_list&field=to";
		$last = $url_contact;
		//go to the contacts list
		$res = $this->get($url_contact,true,true);
		if ($this->checkResponse("compose_mail",$res))
			{
			$this->login_ok = $url_contact;
			$this->updateDebugBuffer('compose_mail',$last,'GET');
			return true;
			}
		else 
			{
			$this->updateDebugBuffer('compose_mail',$last,'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		}
	
	/**
	 * Get the current user's contacts
	 * 
	 * Makes all the necesarry requests to import
	 * the current user's contacts
	 * 
	 * @return mixed The array if contacts if importing was successful, FALSE otherwise.
	 */	
	public function getMyContacts()
		{
			//parse the contacts list
			if ($this->login_ok)
				{
				$contactsarr = array();
				$res = $this->get($this->login_ok,true,true);
				$res .= "||exit||";
				while(strstr($res, '<input type="checkbox"'))
				{	
					$res = $this->getElementString($res, '<input type="checkbox" name="to" value=','||exit||');
					$res .= "||exit||";
					$contact_mail = $this->getElementString($res, '"','"');
					$res = $this->getElementString($res, '" ','||exit||');
					$res .= "||exit||";
					$contact_nick = $this->getElementString($res,'>','<br>');
					if (strpos($contact_mail, ",") === false)
					{
						$contactsarr[$contact_mail] = $contact_nick;
					}			
				}
				return $contactsarr;
				}
			else
				{
				$this->debugRequest();
				$this->stopPlugin();
				return false;
				}
		}

	/**
	 * Terminate session
	 * 
	 * Terminates the current user's session,
	 * debugs the request and reset's the internal 
	 * debudder.
	 * 
	 * @return bool TRUE if the session was terminated successfully, FALSE otherwise.
	 */	
	public function logout()
		{
			//go to logout link
			if ($this->login_ok)
			{
				$logout_url = "http://login.rediff.com/bn/logout.cgi?formname=general&login={$this->username}&session_id={$this->session_id}&function_name=logout";
				$res = $this->get($logout_url,true,true);
				
				$this->debugRequest();
				$this->resetDebugger();
				$this->stopPlugin();
				
				return true;
			}
			else return false;
		}
}
?>