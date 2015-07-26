<?php
class Register_Model extends TinyMVC_Model
{

    


    function changeUserData($data)
    { 
        $data['user']=$data['user'];
        $data['name'] = $data['name'];
        $data['lastname'] = $data['lastname'];
        $data['email'] = $data['email'];
        
        $usuario=new User_Model();
        if(!$usuario->alreadyExist($data['user']))
        {
            $usuario->update($userID, $data);
            $registration = 1;
        }
        else 
            $msgerror = "User already exist";

        return $msgerror;
    }
}
