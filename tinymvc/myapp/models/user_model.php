<?php
class User_Model extends TinyMVC_Model
{
    function esValido($login,$password)
    {
        $pass=sha1($password);
        $this->loadDB();
        $result=$this->db->query_one("SELECT id, type, enabled FROM users WHERE user=? AND password=?",array($login,$pass));
        if($result && intval($result['enabled']) == 1)
        {	

        	$this->sesion->guardar('id', $result['id']);
        	$this->sesion->guardar('userType', $result['type']);
        	return true;
        }
        else
        	return false;
    }

    function alreadyExist($login)
    {
        // $pass=sha1($password);
        $this->loadDB();
        $result=$this->db->query_one("SELECT id FROM users WHERE user=? ",array($login));
        if($result)
            return true;
        else
            return false;
    }

    function getUserID($login,$password)
    {
        $pass=sha1($password);
        $this->loadDB();
        $result=$this->db->query_one("SELECT id FROM users WHERE user=? AND password=?",array($login,$pass));
        return $result['id'];
    }

    function getData()
    {
    	$userID=$this->sesion->obtener('id');
        $this->loadDB();
        $result=$this->db->query_one("SELECT * FROM users WHERE id=?",array($userID));
        return $result;
    }

    function addUser($login, $password, $name, $lastname, $email)
    {
        $pass=sha1($password);
        $this->loadDB();
        $this->db->insert('users',array('user'=> $login,'password'=>$pass,'name'=>$name,
                          'lastname'=>$lastname,'email'=>$email));
    }

    //sin terminar
    function dataUpdate($newData)
    {
        $userID=$this->sesion->obtener('id');
        $this->loadDB();
        $this->db->where('id', $userID);         // Setup query conditions
        $this->db->update('users',array('user'=>$newData['user'], 
                                        'name'=>$newData['name'], 
                                        'lastname'=>$newData['lastname'], 
                                        'email'=>$newData['email']
                                        ));
    }

    function passwordUpdate($newData)
    {
        if ($newData['pass'] == $newData['repass'])
        {
            $newPassword = sha1($newData['pass']);
            $userID=$this->sesion->obtener('id');
            $this->loadDB();
            $this->db->where('id', $userID);         // Setup query conditions
            $this->db->update('users',array('password'=>$newPassword));
        }
    }

    function ImageUpdate($data)
    {
        $msgerror=" ";
        $userID=$this->sesion->obtener('id');
        $user=$this->getData($userID);
        $data['user'] = $user['user'];
        $check = getimagesize($data['image']["tmp_name"]);
        $target_dir = FULL_PATH_IMG;
        $imageFileType = pathinfo($data['image']['name'],PATHINFO_EXTENSION);
        $target_file = $target_dir . basename($data['user'].'.'.$imageFileType);
        $check = getimagesize($data['image']["tmp_name"]);
        if($check !== false) 
        {
            if ($data['image']["size"] <= 40000) 
            {
                if($imageFileType == "png") 
                //|| $imageFileType == "jpg" || $imageFileType == "jpeg"
                //|| $imageFileType == "gif"  
                {  if (move_uploaded_file($data['image']["tmp_name"], $target_file)) 
                    {
                        $msgerror= "The file ". basename( $data['image']["name"]). " has been uploaded in .".$target_file.".";
                    } 
                    else 
                        $msgerror = "Sorry, there was an error uploading your file.";
                }
                else
                    $msgerror = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            }
            else 
                $msgerror = "Sorry, your file is too large.";
        } 
        else 
            $msgerror = "File is not an image.";

        return $msgerror;
    }

    function finished($userID)
    {
        $this->loadDB();
        $result=$this->db->query("UPDATE users SET finished=finished+1 WHERE id=? ",array($userID));
    }

    function avgMoves($userID, $moves){
        $this->loadDB();
        $result=$this->db->query_one("SELECT avg_moves FROM users WHERE id=? ",array($userID));
        $newAvg=intval(($moves + $result['avg_moves'])/2);
        $this->db->query("UPDATE users SET avg_moves=? WHERE id=? ",array($newAvg,$userID));
    }

    function won($userID)
    {
        $this->loadDB();
        $result=$this->db->query("UPDATE users SET won=won+1 WHERE id=? ",array($userID));
    }

    function lost($userID)
    {
        $this->loadDB();
        $result=$this->db->query("UPDATE users SET lost=lost+1 WHERE id=? ",array($userID));
    }

    function setRanking($userID)
    {   
        $this->loadDB();
        $data=$this->getData($userID);
        $ranking = 100*$data['won']*(1+1/$data['finished']); //1000*(1-($data['won']/$data['finished']))+pow(2,$data['avg_moves']);
        $this->db->where('id', $userID);         // Setup query conditions
        $result = $this->db->update('users',array('ranking'=>$ranking));
        if($result)
            return true;
        else
            return false;
    }

    function getRankingTable()
    {
        $this->loadDB();
        $result=$this->db->query_all("SELECT user FROM users ORDER BY ranking DESC");
        return $result;

    }

    function registerUser($data)
    {
        $msgerror = 'ok';

        $data['user']=$data['user'];
        $data['pass']=$data['pass'];
        $data['repass']=$data['repass'];
        $data['name'] = $data['name'];
        $data['lastname'] = $data['lastname'];
        $data['email'] = $data['email'];
        $data['image']=$data['image'];

        $target_dir = FULL_PATH_IMG;
        $imageFileType = pathinfo($data['image']['name'],PATHINFO_EXTENSION);
        $target_file = $target_dir . basename($data['user'].'.'.$imageFileType);
        
        if ($data['pass'] === $data['repass'])
        {
            if(!$this->alreadyExist($data['user']))
            {
                $check = getimagesize($data['image']["tmp_name"]);
                if($check !== false) 
                {
                    if ($data['image']["size"] <= 40000) 
                    {
                        if($imageFileType == "png" ) 
                        // || $imageFileType == "jpg" || $imageFileType == "jpeg"
                        // || $imageFileType == "gif" ) 
                        {  if (move_uploaded_file($data['image']["tmp_name"], $target_file)) 
                            {
                                $msgerror = "The file ". basename( $data['image']["name"]). " has been uploaded in .".$target_file.".";
                                // Here we add all data related with user
                                $this->addUser($data['user'], $data['pass'], $data['name'], $data['lastname'], $data['email']);
                                $registration = 1;
                                // ***********************************
                            } 
                            else 
                                $msgerror = "Sorry, there was an error uploading your file.";
                        }
                        else
                            $msgerror = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    }
                    else 
                        $msgerror = "Sorry, your file is too large.";
                } 
                else 
                    $msgerror = "File is not an image.";
            }
            else 
                $msgerror = "User already exist";
        }
        else 
            $msgerror = "Passwords are different";

        return $msgerror;
    }



}
