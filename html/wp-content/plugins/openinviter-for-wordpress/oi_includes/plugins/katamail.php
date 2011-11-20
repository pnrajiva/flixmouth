<?php
$_pluginInfo=array(
	'name'=>'KataMail',
	'version'=>'1.0.3',
	'description'=>"Get the contacts from a KataMail account",
	'base_version'=>'1.6.0',
	'type'=>'email',
	'check_url'=>'http://webmail.katamail.com'
	);
/**
 * KataMail Plugin
 * 
 * Imports user's contacts from KataMail's AddressBook
 * 
 * @author OpenInviter
 * @version 1.0.3
 */
class katamail extends OpenInviter_base
{
	private $login_ok=false;
	public $showContacts=false;
	public $requirement=false;
	public $allowed_domains=array('katamail');
	private $server,$id = "";
	public $debug_array=array(
			  'main_redirect'=>'location.href'
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
	public function login($user, $pass)
	{
		$this->resetDebugger();
		$this->service='katamail';
		$this->service_user=$user;
		$this->service_password=$pass;
		$this->curl=$this->init();
		//these are the variables sent by POST method
		$postvars = array(
			"Language"=>"italiano",
			"pop3host"=>"katamail.com",
			"username"=>$user,
			"LoginType"=>"xp",
			"language"=>"italiano",
			"MailType"=>"imap",
			"email"=>$user."@katamail.com",
			"password"=>$pass		);
		//Making a request to get initial cookie
		$res = $this->get("http://webmail.katamail.com", true);
		//Loging in with the post vars defined earlier
		$res = $this->post("http://webmail.katamail.com/atmail.php", $postvars, true);
		$res = htmlentities($res);
		//checking the first step
		if ($this->checkResponse("main_redirect",$res))
			$this->updateDebugBuffer('main_redirect',"http://webmail.katamail.com/atmail.php",'POST');
		else
			{
			$this->updateDebugBuffer('main_redirect',"http://webmail.katamail.com/atmail.php",'POST',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		$this->login_ok = "http://webmail.katamail.com/abook.php?func=export&abookview=personal";
		return true;
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
		//if loged in succes process contacts list... else stop pluging and display error message
		if (!$this->login_ok)
			{
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		else
			{
			$contacts = array();
			$res = $this->get($this->login_ok);
			$temp=$this->parseCSV($res);
			foreach ($temp as $values)
				{
				$name=$values['6'].(empty($values['17'])?'':(empty($values['6'])?'':'-')."{$values['17']}").(empty($values['18'])?'':' '.$values['18']);
				if (!empty($values['1']))
					$contacts[$values['1']]=(empty($name)?$values['1']:$name);
				if (!empty($values['2']))
					$contacts[$values['2']]=(empty($name)?$values['2']:$name);
				if (!empty($values['3']))
					$contacts[$values['3']]=(empty($name)?$values['3']:$name);
				if (!empty($values['4']))
					$contacts[$values['4']]=(empty($name)?$values['4']:$name);
				if (!empty($values['5']))
					$contacts[$values['5']]=(empty($name)?$values['5']:$name);
				}
			}
		$this->showContacts = true;
		return $contacts;
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
		//go to logout url
		if ($this->login_ok)
		{
			$logout_url = "http://webmail.katamail.com/util.php?func=logout";
			$res = $this->get($logout_url, true);
			$this->debugRequest();
			$this->resetDebugger();
			$this->stopPlugin();
			return true;
		}
		else return false;
	}
}
?>