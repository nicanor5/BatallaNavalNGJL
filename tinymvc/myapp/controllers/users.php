<?php

/**
 * usuarios.php
 *
 * Users controller
 *
 * @package		TinyMVC
 * @author		Monte Ohrt
 */

class Users_Controller extends TinyMVC_Controller
{
	function validar()
	{
		
		if ($this->getParam('Login')  == true)
		{
			Sesion::obtenerInstancia()->crearSesion();
			$user=$this->getParam('user');
			$password=$this->getParam('pass');
			$usuario=new User_Model();
			if($usuario->esValido($user,$password))
			{
				//Aqui va la pr<<óxima vista
				$userID = $usuario->getUserID($user,$password);
				// $usuario->won($userID);
				$dataU = $usuario->getData($user,$password); 
				$content_view = $this->view->fetch('menu_view', array('data'=>$dataU,'msgerror'=>''));
				
			}
			else
				$content_view = $this->view->fetch('user_view', array('msgerror'=>'Invalid User'));
		}
		else if ($this->getParam('Register')  == true)
		{
			$this->view->assign('type',"user");
			$content_view = $this->view->fetch('register_view', array('msgerror'=>''));
		}
		$this->view->display('layout_view',array('content' => $content_view));
	}

	function userRegistration()
	{	
		$userData['image']=$this->getFile('fileToUpload');
        $userData['user']=$this->getParam('user');
        $userData['pass']=$this->getParam('pass');
        $userData['repass']=$this->getParam('repass');
        $userData['name'] = $this->getParam('username');
        $userData['lastname'] = $this->getParam('userlastname');
        $userData['email'] = $this->getParam('email');
        $type = $this->getParam('type');

        $reg= new User_Model();
        $msgerror = $reg->registerUser($userData);
        if ($msgerror == 'ok')
            $content_view = $this->view->fetch($type . '_view',array('msgerror'=>$msgerror));
        else
            $content_view = $this->view->fetch('register_view',array('msgerror'=>$msgerror));

        $this->view->display('layout_view',array('content' => $content_view));
	}

	function modifyUserData()
	{
		Sesion::obtenerInstancia()->validarSesion();    
		$user = new User_model();
		$dataU=$user->getData();
		$content_view = $this->view->fetch('update_view', array('data'=>$dataU));
        $this->view->display('layout_view',array('content' => $content_view));
	}

	function userUpdate()
	{
		Sesion::obtenerInstancia()->validarSesion();    
        $userData['user']=$this->getParam('user');
        $userData['name'] = $this->getParam('username');
        $userData['lastname'] = $this->getParam('userlastname');
        $userData['email'] = $this->getParam('email');

		$user = new User_model();
		$user->dataUpdate($userData);

        $dataU=$user->getData();
    	$content_view = $this->view->fetch('menu_view',array('data'=>$dataU));
        $this->view->display('layout_view',array('content' => $content_view));
	}

	function passwordUpdate()
	{
		Sesion::obtenerInstancia()->validarSesion();    
        $userData['pass']=$this->getParam('pass');
        $userData['repass']=$this->getParam('repass');
		
		$user = new User_model();
		$user->passwordUpdate($userData);
        $dataU=$user->getData();
    	$content_view = $this->view->fetch('menu_view',array('data'=>$dataU));
        $this->view->display('layout_view',array('content' => $content_view));
	}

	function imageUpdate()
	{
		Sesion::obtenerInstancia()->validarSesion();    
		$userData['image']=$this->getFile('fileToUpload');
		$user = new User_model();
		$toView["mensaje"]=$user->imageUpdate($userData);
        $dataU=$user->getData();
    	$content_view = $this->view->fetch('menu_view',array('data'=>$dataU,'toView'=>$toView));
        $this->view->display('layout_view',array('content' => $content_view));
	}
     
    function statistics()
    {
    	Sesion::obtenerInstancia()->validarSesion();    
        $user = new User_model();
        $dataU=$user->getData();
        $content_view = $this->view->fetch('stats_view',array('toView' => $dataU));
        $this->view->display('layout_view',array('content' => $content_view));
    }
 
    function ranking()
    {
    	Sesion::obtenerInstancia()->validarSesion();    
        $user = new User_model();
        $dataU=$user->getRankingTable();
        $content_view = $this->view->fetch('ranking_view',array('data' => $dataU));
        $this->view->display('layout_view',array('content' => $content_view));
    }

    function menu()
    {
    	Sesion::obtenerInstancia()->validarSesion();
    	$user = new User_model();
        $dataU=$user->getData();
    	$content_view = $this->view->fetch('menu_view',array('data'=>$dataU)); 
		$this->view->display('layout_view',array('content' => $content_view));
    }

    function logOut(){
    	Sesion::obtenerInstancia()->validarSesion();    
    	Sesion::obtenerInstancia()->destruirSesion();
    	$content_view = $this->view->fetch('user_view'); 
		$this->view->display('layout_view',array('content' => $content_view));
    }
}
