<?php

/**
 * default.php
 *
 * default application controller
 *
 * @package		TinyMVC
 * @author		Monte Ohrt
 */

class Default_Controller extends TinyMVC_Controller
{
	function index()
	{

		$content_view = $this->view->fetch('user_view', array('msgerror'=>'It works!!'));
		$this->view->assign('content',$content_view);		
	    $this->view->display('layout_view'); 
	}

}

?>
