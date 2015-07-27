<?php
class Admin_Model extends TinyMVC_Model
{
	function __construct()
	{
		parent::__construct();
		define('ENABLED',1);
		define('DISABLED',0);
		define('ADMIN',0);
	}	
	
	function adminMenu()
	{
		if ($this->validarAdmin())
		{
			$this->loadDB();
			$result=$this->db->query_all("SELECT id, user, enabled FROM users ORDER BY id ASC");
			$toView['users'] = $result;
			$toView['view'] = 'admin_view';
		}
		else
		{
			$toView['view']='forbidden_view';
		}
		return $toView;
	}
	
    function habilitar($userID)
	{
		if ($this->validarAdmin())
		{
			$this->loadDB();
			$this->db->where('id', $userID);
			$this->db->update('users',array('enabled'=>ENABLED));
			$toView['retorno']=$this->sendMail($userID,"enabled");
			//$toView=$this->adminMenu();
		}
		else
		{
			$toView['view']='forbidden_view';
		}
		return $toView;
	}
	
    function desactivar($userID)
	{
		if ($this->validarAdmin())
		{
			$this->loadDB();
			$this->db->where('id', $userID);
			$this->db->update('users',array('enabled'=>DISABLED));
			$toView['retorno']=$this->sendMail($userID,"disabled");
			//$toView=$this->adminMenu();
		}
		else
		{
			$toView['view']='forbidden_view';
		}
		return $toView;
	}
	
    function adicionar($login, $password, $name, $lastname, $email)
	{
		if ($this->validarAdmin())
		{
			
		    $pass=sha1($password);
		    $this->loadDB();
		    $this->db->insert('users',array('user'=> $login,'password'=>$pass,'name'=>$name,
		                      'lastname'=>$lastname,'email'=>$email));
		    $toView=$this->adminMenu();
		}
		else
		{
			$toView['view']='forbidden_view';
		}
		return $toView['view'];
	}
	
    function eliminar($userID)
	{
		if ($this->validarAdmin())
		{
			$this->loadDB();
			$result=$this->db->query_one("DELETE FROM users WHERE id=? ",array($userID));			
			$toView=$this->adminMenu();
		}
		else
		{
			$toView['view']='forbidden_view';
		}
		return $toView;
	}
	
	function validarAdmin()
	{
		$userType=$this->sesion->obtener('userType');
		
		if ($userType == ADMIN)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}
	
	function sendMail($userID,$content)
	{
		$userMail=$this->db->query_one("SELECT email FROM users WHERE id=?",array(intval($userID)));
		$mailbody="<html><body>You have been " . $content ." to play Navy Gunship Offensive NG-JL.</body></html>";
	    $retorno="";
	    $subject="Navy Gunship Offensive NG-JL: User ". $content;
		if(mail($userMail['email'],$subject,$mailbody,"Content-Type: text/html"))
			$retorno = "Email successfully sent";
		else
			$retorno = "An error occured";
		return $retorno;
	}


}
