<?php
class Usuario_Model extends TinyMVC_Model
{
    function esValido($login,$password)
    {
        $pass=sha1($password);
        $this->loadDB();
        $result=$this->db->query_one("SELECT id FROM usuarios WHERE login=? AND password=?",array($login,$pass));
        getRankingTable();
        
        if($result){
        	return true;
        }
        else{
        	return false;
        }
    }

    
}