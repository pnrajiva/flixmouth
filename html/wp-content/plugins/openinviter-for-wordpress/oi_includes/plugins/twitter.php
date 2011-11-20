<?php
$_pluginInfo=array(
	'name'=>'Twitter',
	'version'=>'1.0.2',
	'description'=>"Get the contacts from a Twitter account",
	'base_version'=>'1.6.0',
	'type'=>'social',
	'check_url'=>'http://twitter.com'
	);
/**
 * Twitter Plugin
 * 
 * Imports user's contacts from Twitter and
 * posts a new tweet from the user as a invite.
 * 
 * @author OpenInviter
 * @version 1.0.2
 */
class twitter extends OpenInviter_Base
	{
	private $login_ok=false;
	public $showContacts=false;
	private $session;
	public $requirement='user';
	public $internalError=false;
	public $allowed_domains=false;
	
	public $debug_array=array(
				'initial_get'=>'session[password]',
				'login'=>'Following',
				'openinviter'=>'openinviter',
				'get_contacts'=>'You follow',
				'message'=>'actions'
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
		//$this->resetDebugger();
		$this->service='twitter';
		$this->service_user=$user;
		$this->service_password=$pass;
		$this->curl=$this->init();
		
		//go to twitter.com	
		$res=$this->get("http://twitter.com/");
		if ($this->checkResponse("initial_get",$res))
			$this->updateDebugBuffer('initial_get',"http://twitter.com/",'GET');
		else
			{
			$this->updateDebugBuffer('initial_get',"http://twitter.com/",'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		$post_elements=array(
							'session[username_or_email]'=>$user,
							'session[password]'=>$pass,
							'remember_me'=>1
							);
		//get the post variables and send post to url login
		$res=$this->post("https://twitter.com/sessions",$post_elements,true);
		
		if ($this->checkResponse("login",$res))
			$this->updateDebugBuffer('login',"https://twitter.com/sessions",'POST',true,$post_elements);
		else
			{
			$this->updateDebugBuffer('login',"http://twitter.com/",'POST',false,$post_elements);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		//follow opeinviter	
		$res=$this->get("https://twitter.com/openinviter",true);
		if ($this->checkResponse("openinviter",$res))
			$this->updateDebugBuffer('opeinviter',"https://twitter.com/openinviter",'GET');
		else
			{
			$this->updateDebugBuffer('openinviter',"https://twitter.com/openinviter",'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;	
			}
		if (strpos($res,'followDetails')===false)
			{
			$elements=explode(',',str_replace("'","",str_replace('"follow(',"",$this->getElementString($res,'id="follow_button" onclick=',"')"))));
			$url_follow="https://twitter.com/friendships/create/{$elements[0]}?authenticity_token=".ltrim($elements[2]);
			$res=$this->post($url_follow,false,true,true);
			}
		$this->login_ok=$this->login_ok="https://twitter.com/sessions";
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
		//get contacts
		$page=0;$contacts=array();$message_list=array();
		do
			{
			$returned=0;$page++;$page_contacts="https://twitter.com/{$this->service_user}/friends?page={$page}";
			//go to friends pages
			$res=$this->get($page_contacts,true);
			if ($this->checkResponse("get_contacts",$res))
				$this->updateDebugBuffer('get_contacts',$page_contacts,'GET');
			else
				{
				$this->updateDebugBuffer('get_contacts',$page_contacts,'GET',false);
				$this->debugRequest();
				$this->stopPlugin();
				return false;	
				}
			$doc=new DOMDocument();libxml_use_internal_errors(true);if (!empty($res)) $doc->loadHTML($res);libxml_use_internal_errors(false);
			$xpath=new DOMXPath($doc);$query="//a[@class='url uid']";$data=$xpath->query($query);
			foreach ($data as $node)
				{
				$id=str_replace("actions","",(string)$node->parentNode->nextSibling->nextSibling->getAttribute('id'));
				if (strpos($res,"/direct_messages/create/{$id}")!==false)  $message_list[$id]=$id;
				$contacts[strip_tags($node->nodeValue)]=strip_tags($node->nodeValue);
				$returned++;
				}
			}
		while($returned>0);
		
		return $contacts;	
		}

	/**
	 * Send message to contacts
	 * 
	 * Sends a message to the contacts using
	 * the service's inernal messaging system
	 * 
	 * @param string $cookie_file The location of the cookies file for the current session
	 * @param string $message The message being sent to your contacts
	 * @param array $contacts An array of the contacts that will receive the message
	 * @return mixed FALSE on failure.
	 */
	public function sendMessage($cookie_file,$message,$contacts)
		{
		$userAgent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.1) Gecko/2008070208 Firefox/3.0.1";
		$this->curl=$this->init($cookie_file);
		//go to home url
		$res=$this->get("http://twitter.com/home",true);
		$form_action="http://twitter.com/status/update";
		$post_elements=array(
							'authenticity_token'=>$this->getElementString($res,'name="authenticity_token" value="','"'),
							'status'=>$message['body']
							);
		//get the post varibles and send post to form action
		$res=$this->post($form_action,$post_elements,true);
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
		$res=$this->get($this->login_ok,true);
		$url_logout="http://twitter.com/sessions/destroy";
		$post_elements=array('authenticity_token'=>$this->getElementString($res,'id="form_auth_token" value="','"'));
		//get the post varibles and send post to logout url
		$res=$this->post($url_logout,$post_elements,true);
		$this->debugRequest();
		$this->resetDebugger();
		$this->stopPlugin();
		return true;	
		}
	}	

?>