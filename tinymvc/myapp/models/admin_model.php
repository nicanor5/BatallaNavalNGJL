<?php
class Admin_Model extends TinyMVC_Model
{
	function __construct()
	{
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
			$toView=$this->adminMenu();
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
			$toView=$this->adminMenu();
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
		return $toView['view'];
	}
	
	function validarAdmin()
	{
		$userType=$this->session->obtener('userType');
		
		if ($userType == ADMIN)
		{
			return true;
		}
		else
		{
			return false;
		}
		
	}


}
