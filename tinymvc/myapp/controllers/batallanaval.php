<?php

/**
 * rompecocos.php
 *
 * Rompecocos controller
 *
 * @package		TinyMVC
 * @author		Monte Ohrt
 */

class BatallaNaval_Controller extends TinyMVC_Controller
{
	function __construct()
	{
		parent::__construct();
		define('LAYOUT','layout_view');
		Sesion::obtenerInstancia()->validarSesion();

	}
	
	function init_field()
	{	
		$batalla=new BatallaNaval_Model();
		$size=$this->getParam('size');
		$toView=$batalla->init_field($size);
		$this->view->assign('toView',$toView);
		$content_view = $this->view->fetch($toView["view"], array('msgerror'=>' '));
		$this->view->assign('content',$content_view);		
	    $this->view->display(LAYOUT); 
	}
	
	function initialize()
	{
		$batalla=new BatallaNaval_Model();
		$box=$this->getParam('box');
		$toView=$batalla->init_game($box);
		$this->view->assign('toView',$toView);
		$content_view = $this->view->fetch($toView["view"], array('msgerror'=>''));
		//$this->view->assign('content',$content_view);		
	    $this->view->display(LAYOUT,array('content' => $content_view)); 
	}

	function play()
	{
		$batalla=new BatallaNaval_Model();
		$shotbox=$this->getParam('shotbox');
		$toView=$batalla->play_game($shotbox);
		$this->view->assign('toView',$toView);
		$content_view = $this->view->fetch($toView["view"], array('msgerror'=>' '));
		//$this->view->assign('content',$content_view);		
	    $this->view->display(LAYOUT,array('content' => $content_view));  
	}
	
	function restart()
	{
		$user = new User_model();
        $dataU=$user->getData();
    	$content_view = $this->view->fetch('menu_view',array('data'=>$dataU));

	    $this->view->display(LAYOUT,array('content' => $content_view)); 
	}

}
