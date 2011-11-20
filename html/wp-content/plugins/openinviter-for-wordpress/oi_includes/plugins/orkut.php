<?php
$_pluginInfo=array(
	'name'=>'Orkut',
	'version'=>'1.0.4',
	'description'=>"Get the contacts from an Orkut account",
	'base_version'=>'1.6.0',
	'type'=>'social',
	'check_url'=>'http://mail.yahoo.com'
	); 
/**
 * Orkut Plugin
 * 
 * Import user's contacts from Orkut.
 * 
 * @author OpenInviter
 * @version 1.0.4
 */
class orkut extends OpenInviter_base
{
	private $login_ok=false;
	public $showContacts=true;
	public $requirement='email';
	public $allowed_domains=false;
	public $debug_array=array(
				'secondary_get'=>'Email:',
				'the_redirect2'=>'&lt;title&gt;Redirecting&lt;/title&gt;'
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
		$this->service='orkut';
		$this->service_user=$user;
		$this->service_password=$pass;
		$this->curl=$this->init();
		//initial get for the basic cookie
		$res=$this->get("http://www.orkut.com/",true,true);
		//checking response
		if ($this->checkResponse("secondary_get",$res))
			$this->updateDebugBuffer('secondary_get',"http://www.orkut.com/",'GET');
		else
			{
			$this->updateDebugBuffer('secondary_get',"http://www.orkut.com/",'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		//this is the url from the 'action' atribute of the <form> tag from the login form.
		$postAction = "https://www.google.com/accounts/ServiceLoginAuth?service=orkut";
		//this is the array with post variables mandatory for the login operation
		$postElem = $this->getHiddenElements($res, "Email", $user, "Passwd", $pass);
		//loging in
		$res=$this->post($postAction,$postElem,true);
		//check for the correct response from orkut
		$res = htmlentities ($res);
		if ($this->checkResponse("the_redirect2",$res))
			$this->updateDebugBuffer('the_redirect2',$postAction,'GET');
		else
			{
			$this->updateDebugBuffer('the_redirect2',$postAction,'GET',false);
			$this->debugRequest();
			$this->stopPlugin();
			return false;
			}
		//if the response is correct, login_ok property equals with the contacts link.
		$this->login_ok = "http://m.orkut.com/Friends";
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
			else $url = $this->login_ok;
			//this is an array with url-s where you can find ALL the contacts.
			$originalLink = array(
			"a"=>"http://m.orkut.com/Friends?small=a&caps=A&pgsize=10000",			
			"b"=>"http://m.orkut.com/Friends?small=b&caps=B&pgsize=10000",
			"c"=>"http://m.orkut.com/Friends?small=c&caps=C&pgsize=10000",
			"d"=>"http://m.orkut.com/Friends?small=d&caps=D&pgsize=10000",
			"e"=>"http://m.orkut.com/Friends?small=e&caps=E&pgsize=10000",
			"f"=>"http://m.orkut.com/Friends?small=f&caps=F&pgsize=10000",
			"g"=>"http://m.orkut.com/Friends?small=g&caps=G&pgsize=10000",
			"h"=>"http://m.orkut.com/Friends?small=h&caps=H&pgsize=10000",
			"i"=>"http://m.orkut.com/Friends?small=i&caps=I&pgsize=10000",
			"j"=>"http://m.orkut.com/Friends?small=j&caps=J&pgsize=10000",
			"k"=>"http://m.orkut.com/Friends?small=k&caps=K&pgsize=10000",
			"l"=>"http://m.orkut.com/Friends?small=l&caps=L&pgsize=10000",
			"m"=>"http://m.orkut.com/Friends?small=m&caps=M&pgsize=10000",
			"n"=>"http://m.orkut.com/Friends?small=n&caps=N&pgsize=10000",
			"o"=>"http://m.orkut.com/Friends?small=o&caps=O&pgsize=10000",
			"p"=>"http://m.orkut.com/Friends?small=p&caps=P&pgsize=10000",
			"q"=>"http://m.orkut.com/Friends?small=q&caps=Q&pgsize=10000",
			"r"=>"http://m.orkut.com/Friends?small=r&caps=R&pgsize=10000",
			"s"=>"http://m.orkut.com/Friends?small=s&caps=S&pgsize=10000",
			"t"=>"http://m.orkut.com/Friends?small=t&caps=T&pgsize=10000",
			"u"=>"http://m.orkut.com/Friends?small=u&caps=U&pgsize=10000",
			"v"=>"http://m.orkut.com/Friends?small=v&caps=V&pgsize=10000",
			"w"=>"http://m.orkut.com/Friends?small=w&caps=W&pgsize=10000",
			"x"=>"http://m.orkut.com/Friends?small=x&caps=X&pgsize=10000",
			"y"=>"http://m.orkut.com/Friends?small=y&caps=Y&pgsize=10000",
			"z"=>"http://m.orkut.com/Friends?small=z&caps=Z&pgsize=10000",
			"*"=>"http://m.orkut.com/Friends?small=*&caps=*&pgsize=10000"
			); 
			$alphaLink = $originalLink;
			$contacts = array();
			$res = $this->get($url,true);
			$urlRedirect = $this->getElementString($res,'location.replace("','"');
			$urlRedirect = urldecode(str_replace('\x','%',$urlRedirect));
			$res = $this->get($urlRedirect,true);
			$flag = true;
			$pno = 1;
			//the next structure works this way:
			//goes to the current letter's address and parses all the contacts.
			//if the NEXT button is found, then goes to the next page and does that all again.
			//else goes to the next alphabetical letter's address and does that all again
			//until the $originalLink array is complete.
			while ($flag)
			{
				$nexts =array();
				foreach ($alphaLink as $letter=>$link)
					{
					$res = $this->get($link,true);
					$res.="||exit||";
					if (stripos($res, "next &gt;</a>") !== false) $nexts[$letter] = true;
					else $nexts[$letter] = false;
					while(strstr($res, '<div class="mblock">'))
					{
						$t1 = $this->getElementString($res, '<div class="mblock">','</div>');
						$res = $this->getElementString($res, '</div>','||exit||');
						$res .= "||exit||";
						if (stripos($t1, "Email&nbsp;:&nbsp;") !== false) 
							{
							$name = $this->getElementString($t1, '">','</a>');
							$email = trim($this->getElementString($t1, 'Email&nbsp;:&nbsp;', "<h"));
							$contacts[$email] = $name;
							}					
					}
				}
				$pno++;
				$count = 0;
				foreach ($nexts as $value) if ($value) $count++;
				if ($count == 0) $flag = false;
				else 
					{
					foreach ($nexts as $key=>$value) 
						{
						if ($value) $alphaLink[$key] = $originalLink[$key]."&pno={$pno}";
						else if (isset($alphaLink[$key])) unset($alphaLink[$key]);
						}	
					}
			}
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
				$logout_url = "http://www.orkut.com/GLogin.aspx?cmd=logout";
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