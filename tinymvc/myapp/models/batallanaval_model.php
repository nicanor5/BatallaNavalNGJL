<?php
class BatallaNaval_Model extends TinyMVC_Model
{
	function init_field($size)
	{
		$this->session->guardar('size',$size);
		
		$toView["size"]=$size;
		$toView["view"]='fleetsetup_view';
		
		return $toView;	
	}
	
	function init_game($box)
	{
		$size=$this->session->obtener('size');
		$cuenta=0;
		for ($i=0; $i<$size; $i++)
		{
			if (isset($box[$i]))
			{
		    	$cuenta+=count($box[$i]);
			}
		}
		if ($cuenta !=$size)
		{
			$toView["size"]=$size;
			$toView["shipsFlag"]=1;
			$toView["view"]='fleetsetup_view';
		    return $toView;
		}
		
		$userFleet=$box; // Ubicacion barcos del usuario
		for ($i=0; $i<$size; $i++)
		{
			for ($j=0;$j<$size; $j++)
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
		$userTries=0;
		$enemyFleet=$this->set_enemy($size);
		$this->session->guardar('userFleet',$userFleet);
		$this->session->guardar('enemyFleet',$enemyFleet);
		$this->session->guardar('fired',$fired);
		$this->session->guardar('enemyShots',$enemyShots);
		$this->session->guardar('userHits',$userHits);
		$this->session->guardar('enemyHits',$enemyHits);
		$this->session->guardar('userTries',$userTries);
		
		
		
		$toView["size"]=$size;
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
		$toView["size"]=$this->session->obtener('size');
		$toView["userHit"]=$this->user_play($shotbox);
		$toView["fired"]=$this->session->obtener('fired');
		if($this->check_player()==1)
		{
			$tries=$this->session->obtener('userTries');
			$id=$this->session->obtener('id');
			$usuario->won($id);
			$usuario->finished($id);
			$usuario->avgMoves($id,$tries);
			$usuario->setRanking($id);
			$toView["enemyFleet"]=$this->session->obtener('enemyFleet');
			$toView["winner"]=1;
			$toView["userHits"]=$this->session->obtener('userHits');
			$toView["enemyHits"]=$this->session->obtener('enemyHits');
			$toView["view"]="results_view";
			return $toView;
		}
		$toView["enemyHit"]=$this->enemy_play();
		$toView["userFleet"]=$this->session->obtener('userFleet');
		if($this->check_enemy()==1)
		{
			$id=$this->session->obtener('id');
			$usuario->lost($id);
			$usuario->finished($id);
			$usuario->setRanking($id);
			$toView["enemyFleet"]=$this->session->obtener('enemyFleet');
			$toView["winner"]=2;
			$toView["userHits"]=$this->session->obtener('userHits');
			$toView["enemyHits"]=$this->session->obtener('enemyHits');
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
		
		// Indicar disparo
		$userTries=$this->session->obtener('userTries');
		$userTries++;
		$this->session->guardar('userTries',$userTries);
		$fired=$this->session->obtener('fired');
		$fired[$i][$j]+=2;
		$this->session->guardar('fired',$fired);
		
		// Verificar si se dio a un barco enemigo
		$enemyFleet=$this->session->obtener('enemyFleet');
		if ($enemyFleet[$i][$j]==1)
		{
			$userHits=$this->session->obtener('userHits');
			$userHits++;
			$this->session->guardar('userHits',$userHits);
			$fired[$i][$j]+=1;
			$this->session->guardar('fired',$fired);
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
		$userHits=$this->session->obtener('userHits');
		$size=$this->session->obtener('size');
		if ($userHits>=$size)
		{
			// El usuario gano
			return 1;
		}
		return 0;
	}
	
	function enemy_play()
	{
		// Disparo enemigo
		$enemyShots=$this->session->obtener('enemyShots');
		$size=$this->session->obtener('size');
		do
		{
			$rand_fila=mt_rand(0,$size-1);
			$rand_col=mt_rand(0,$size-1);
		} while($enemyShots[$rand_fila][$rand_col]==1);
		$enemyShots[$rand_fila][$rand_col]=1;
		$this->session->guardar('enemyShots',$enemyShots);
		
		$userFleet=$this->session->obtener('userFleet');
		$userFleet[$rand_fila][$rand_col]+=2;
		$this->session->guardar('userFleet',$userFleet);
		if ($userFleet[$rand_fila][$rand_col]==3)
		{
			$enemyHits=$this->session->obtener('enemyHits');
			$enemyHits++;
			$this->session->guardar('enemyHits',$enemyHits);
			return 1;
		}
		else
		{
			return 0;
		}
	}
	function check_enemy()
	{
		$enemyHits=$this->session->obtener('enemyHits');
		$size=$this->session->obtener('size');
		if ($enemyHits>=$size)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}
}