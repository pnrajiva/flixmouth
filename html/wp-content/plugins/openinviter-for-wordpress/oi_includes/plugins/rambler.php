<?php
$_pluginInfo=array(
	'name'=>'Rambler',
	'version'=>'1.0.7',
	'description'=>"Get the contacts from a Rambler account",
	'base_version'=>'1.6.0',
	'type'=>'email',
	'check_url'=>'http://www.rambler.ru'
	);
/**
 * Rambler Plugin
 * 
 * Import user's contacts from Rambler AddressBook
 * 
 * @author OpenInviter
 * @version 1.0.7
 */
class rambler extends OpenInviter_Base
	{
	private $login_ok=false;
	public $showContacts=true;
	public $requirement='email';
	public $internalError=false;
	public $allowed_domains=array('rambler.ru');
	
	public $debug_array=array(
				'initial_get'=>'login',
				'login_post'=>'ramac_add_handler',
				'pop_up_contacts'=>'evt_cancel(event)'
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
		$this->service='rambler';
		$this->service_user=$user;
		$this->service_password=$pass;
		$this->curl=$this->init();
		
		//go to rambler.ru
		$res=$this->get("http://www.rambler.ru/",true);
		
		if ($this->checkResponse("initial_get",$res))
			$this->updateDebugBuffer('initial_get',"http://www.rambler.ru/",'GET');
		else
			{
			$this->updateDebugBuffer('initial_get',"http://www.rambler.ru/",'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		$post_elements=$this->getHiddenElements($res,"login",$user,"passw",$pass);
		//first key template val 
		unset($post_elements[0]);
		//get the post varibles and send post to login url 
		$res=$this->post("http://id.rambler.ru/script/auth.cgi",$post_elements,true);
		
		//get the contact url
		if ($this->checkResponse("login_post",$res))
			$this->updateDebugBuffer('login_post',"http://id.rambler.ru/script/auth.cgi",'POST',true,$post_elements);
		else
			{
			$this->updateDebugBuffer('login_post',"http://id.rambler.ru/script/auth.cgi",'POST',false,$post_elements);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		
		$url_contact_array=$this->getElementDOM($res,"//a[@id='addressbook-link']",'attribute','href');
		$value=substr($url_contact_array[0],strpos($url_contact_array[0],"r=")+2,strlen($url_contact_array[0])-strpos($url_contact_array[0],"r=")-2);
		//get the contacts url
		$url_contact="http://mail.rambler.ru/mail/contacts.cgi?mode=popup;{$value}";
		$this->login_ok=$url_contact;
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
		if (!$this->login_ok)
			{
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		else $url=$this->login_ok;
		//go to url contcts
		$res=$this->get($url,true);
		if ($this->checkResponse("pop_up_contacts",$res))
			$this->updateDebugBuffer('pop_up_contacts',$url,'GET');
		else
			{
			$this->updateDebugBuffer('pop_up_contacts',$url,'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		//get the contacts		
		$contacts=array();
		$array_result=explode(PHP_EOL,$res);
		foreach($array_result as $key=>$val)
			if (strpos($val,'evt_cancel(event);">')!==false)
				if (!empty($array_result[$key+1]))
					$contacts[$this->getElementString($val,'evt_cancel(event);">',"<")]=strip_tags($array_result[$key+1]);
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
		//go to url contacts and get the logout url
		$url=$this->login_ok;
		$url_logout=str_replace("http://","http://id.",str_replace("contacts.cgi?mode=popup;","auth.cgi?back=;mode=logout;r=",$url));
		//go to url logout
		$res=$this->get($url_logout,true);
		$this->debugRequest();
		$this->resetDebugger();
		$this->stopPlugin();
		return true;
		}
	
	}	
?>