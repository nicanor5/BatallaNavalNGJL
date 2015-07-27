<?php

/**
 * usuarios.php
 *
 * Users controller
 *
 * @package		TinyMVC
 * @author		Monte Ohrt
 */

class Admin_Controller extends TinyMVC_Controller
{
	function __construct()
	{
		error_reporting(E_ALL);
	    ini_set('display_errors', 'On');
		parent::__construct();
		define('LAYOUT','layout_view');
		Sesion::obtenerInstancia()->validarSesion();
	}
	
	function adminMenu()
	{
		$admin=new Admin_Model();
		$toView = $admin->adminMenu();
		$this->view->assign('toView',$toView);
		$content_view = $this->view->fetch($toView["view"], array('msgerror'=>' '));
		$this->view->assign('content',$content_view);		
	    $this->view->display(LAYOUT); 
	}
	
	function habilitar()
	{
		$userID=$this->getParam('id');
		$admin=new Admin_Model();
		$toView=$admin->habilitar($userID);
		print json_encode($toView);
		//$this->view->assign('toView',$toView);
		//$content_view = $this->view->fetch($toView["view"], array('msgerror'=>' '));
		//$this->view->assign('content',$content_view);		
	    //$this->view->display(LAYOUT); 
		
	}
	
	function desactivar()
	{
		$userID=$this->getParam('id');
		$admin=new Admin_Model();
		$toView=$admin->desactivar($userID);
		print "1";
		//$this->view->assign('toView',$toView);
		//$content_view = $this->view->fetch($toView["view"], array('msgerror'=>' '));
		//$this->view->assign('content',$content_view);		
	    //$this->view->display(LAYOUT); 
	}
	function adicionar_menu()
	{
		$this->view->assign('type',"admin");
		$content_view = $this->view->fetch('register_view', array('msgerror'=>''));
		$this->view->display('layout_view',array('content' => $content_view));
	}
	function adicionar()
	{
		$userData['image']=$this->getFile('fileToUpload');
        $userData['user']=$this->getParam('user');
        $userData['pass']=$this->getParam('pass');
        $userData['repass']=$this->getParam('repass');
        $userData['name'] = $this->getParam('username');
        $userData['lastname'] = $this->getParam('userlastname');
        $userData['email'] = $this->getParam('email');
        
        $msgerror = $reg->registerUser($userData);
		$admin=new Admin_Model();
		$toView=$admin->adicionar($userData);
		$this->view->assign('toView',$toView);
		$content_view = $this->view->fetch($toView["view"], array('msgerror'=>' '));
		$this->view->assign('content',$content_view);		
	    $this->view->display(LAYOUT); 
	}
	
	function eliminar()
	{
		$userID=$this->getParam('id');
		$admin=new Admin_Model();
		$toView=$admin->eliminar($userID);
		print "1";
		//$this->view->assign('toView',$toView);
		//$content_view = $this->view->fetch($toView["view"], array('msgerror'=>' '));
		//$this->view->assign('content',$content_view);		
	    //$this->view->display(LAYOUT); 
	}
	
	function volver_menu()
	{
		$user = new User_model();
        $dataU=$user->getData();
    	$content_view = $this->view->fetch('menu_view',array('data'=>$dataU));

	    $this->view->display(LAYOUT,array('content' => $content_view)); 
	}
}
