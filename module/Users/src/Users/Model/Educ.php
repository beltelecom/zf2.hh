<?php
namespace Users\Model;

class Educ
{
    public $id;
    public $id_user;
    public $name;
    public $email;
    public $password;
    public $education;
    public $city;
    

    public function setPassword($clear_password)
    {
        $this->password = md5($clear_password);
    }

	function exchangeArray($data)
	{
		$this->id		= (isset($data['id'])) ? $data['id'] : null;
        $this->id_user		= (isset($data['id_user'])) ? $data['id_user'] : null;
	//	$this->name		= (isset($data['name'])) ? $data['name'] : null;
	//	$this->email	= (isset($data['email'])) ? $data['email'] : null;
		//$this->password	= (isset($data['password'])) ? $data['password'] : null;
        $this->education	= (isset($data['education'])) ? $data['education'] : null;	
        //$this->city	= (isset($data['city'])) ? $data['city'] : null;	
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}	
}
