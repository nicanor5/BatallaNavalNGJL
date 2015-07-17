<?php

class Sesion
{
	static $instancia=null;

	private function __construct()
	{
		session_start();
		
	}

	
	public static function obtenerInstancia()
	{
		if(self::$instancia==null){
			self::$instancia=new Sesion();	
		}
		return self::$instancia;
	}

	public function guardar($clave,$valor)
	{
		$_SESSION[$clave]=$valor;
	}

	public function guardarElementoArreglo($arreglo,$clave,$valor)
	{
		$_SESSION[$arreglo][$clave]=$valor;
	}

	public function obtener($clave)
	{
		return $_SESSION[$clave];
	}

	public function crearSesion()
	{
		$this->guardar('sesion',true);
	}

	public function validarSesion()
	{
		if(isset($_SESSION['sesion'])){
			return true;
		}
		else{
			header("location:".TMVC_BASEURL);
			exit;
		}
	}

	public function destruirSesion()
	{
		$_SESSION=array();
		session_destroy();
	}
}