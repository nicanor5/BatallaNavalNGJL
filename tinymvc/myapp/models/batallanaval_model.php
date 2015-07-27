<?php
class BatallaNaval_Model extends TinyMVC_Model
{
	function __construct()
	{
		parent::__construct();
		define('SIZE',6);	
		
	}
	
	function init_field()
	{
		$toView["view"]='fleetsetup_view';
		
		return $toView;	
	}
	
	function init_game($box)
	{
		$cuenta=0;
		for ($i=0; $i<SIZE; $i++)
		{
			if (isset($box[$i]))
			{
		    	$cuenta+=count($box[$i]);
			}
		}
		if ($cuenta !=SIZE)
		{
			$toView["shipsFlag"]=1;
			$toView["view"]='fleetsetup_view';
		    return $toView;
		}
		
		$userFleet=$box; // Ubicacion barcos del usuario
		for ($i=0; $i<SIZE; $i++)
		{
			for ($j=0;$j<SIZE; $j++)
			{
				$fired[$i][$j]=0; // Ubicacion disparos del usuario al enemigo
				if (!isset($userFleet[$i][$j]))
				{
					$userFleet[$i][$j]=0; // Ubicacion
				}
				$enemyShots[$i][$j]=0;
			}
		}
		
		$userHits=0;
		$enemyHits=0;
		$enemyFleet=$this->set_enemy(SIZE);
		$this->sesion->guardar('userFleet',$userFleet);
		$this->sesion->guardar('enemyFleet',$enemyFleet);
		$this->sesion->guardar('fired',$fired);
		$this->sesion->guardar('enemyShots',$enemyShots);
		$this->sesion->guardar('userHits',$userHits);
		$this->sesion->guardar('enemyHits',$enemyHits);
		
		
		
		$toView["userHit"]=0;
		$toView["userFleet"]=$userFleet;
		$toview["enemyHit"]=0;
		$toView["fired"]=$fired;
		$toView["view"]='battlefield_view';
		
		return $toView;
	}
	
	function set_enemy($size)
	{			
		for ($i=0; $i<$size; $i++)
		{
			for ($j=0;$j<$size; $j++)
			{
				$enemyFleet[$i][$j]=0;
			}
		}
		// Set the enemy fleet
		
		$i=0;		
		while($i<$size)
		{
			$rand_fila=mt_rand(0,$size-1);
			$rand_col=mt_rand(0,$size-1);
			if ($enemyFleet[$rand_fila][$rand_col]==0)
			{
				$enemyFleet[$rand_fila][$rand_col]=1;
				$i++;
			}
		}
		
		return $enemyFleet;
	}

	function play_game($shotbox)
	{
		$usuario = new User_Model();
		$toView["view"]='battlefield_view';
		$toView["userHit"]=$this->user_play($shotbox);
		$toView["fired"]=$this->sesion->obtener('fired');
		if($this->check_player()==1)
		{
			$id=$this->sesion->obtener('id');
			$usuario->won($id);
			$usuario->finished($id);
			$usuario->avgMoves($id,$tries);
			$usuario->setRanking($id);
			$toView["enemyFleet"]=$this->sesion->obtener('enemyFleet');
			$toView["winner"]=1;
			$toView["userHits"]=$this->sesion->obtener('userHits');
			$toView["enemyHits"]=$this->sesion->obtener('enemyHits');
			$toView["view"]="results_view";
			return $toView;
		}
		$toView["enemyHit"]=$this->enemy_play();
		$toView["userFleet"]=$this->sesion->obtener('userFleet');
		if($this->check_enemy()==1)
		{
			$id=$this->sesion->obtener('id');
			$usuario->lost($id);
			$usuario->finished($id);
			$usuario->setRanking($id);
			$toView["enemyFleet"]=$this->sesion->obtener('enemyFleet');
			$toView["winner"]=2;
			$toView["userHits"]=$this->sesion->obtener('userHits');
			$toView["enemyHits"]=$this->sesion->obtener('enemyHits');
			$toView["view"]='results_view';
			return $toView;
		}
		return $toView;
	}
	
	function user_play($shotbox)
	{
		// Obtener indices
		$i=$shotbox[0];
		$j=$shotbox[1];
		
		
		// Verificar si se dio a un barco enemigo
		$enemyFleet=$this->sesion->obtener('enemyFleet');
		if ($enemyFleet[$i][$j]==1)
		{
			$userHits=$this->sesion->obtener('userHits');
			$userHits++;
			$this->sesion->guardar('userHits',$userHits);
			$fired[$i][$j]+=1;
			$this->sesion->guardar('fired',$fired);
			return 1;		
		}
		else
		{
			return 0;
		}
	}
	
	function check_player()
	{	
		// Verificar fin de juego para usuario
		$userHits=$this->sesion->obtener('userHits');
		if ($userHits>=SIZE)
		{
			// El usuario gano
			return 1;
		}
		return 0;
	}
	
	function enemy_play()
	{
		// Disparo enemigo
		$enemyShots=$this->sesion->obtener('enemyShots');
		do
		{
			$rand_fila=mt_rand(0,SIZE-1);
			$rand_col=mt_rand(0,SIZE-1);
		} while($enemyShots[$rand_fila][$rand_col]==1);
		$enemyShots[$rand_fila][$rand_col]=1;
		$this->sesion->guardar('enemyShots',$enemyShots);
		
		$userFleet=$this->sesion->obtener('userFleet');
		$userFleet[$rand_fila][$rand_col]+=2;
		$this->sesion->guardar('userFleet',$userFleet);
		if ($userFleet[$rand_fila][$rand_col]==3)
		{
			$enemyHits=$this->sesion->obtener('enemyHits');
			$enemyHits++;
			$this->sesion->guardar('enemyHits',$enemyHits);
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function check_enemy()
	{
		$enemyHits=$this->sesion->obtener('enemyHits');
		if ($enemyHits>=SIZE)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}
