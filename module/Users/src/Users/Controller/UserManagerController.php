<?php
namespace Users\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

use Users\Form\RegisterForm;
use Users\Form\RegisterFilter;

use Users\Form\UserEditFormForm;
use Users\Form\UserEditFilter;

use Users\Model\User;
use Users\Model\UserTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;

class UserManagerController extends AbstractActionController
{
    public function indexAction()
    {
    	            	 
		$userTable = $this->getServiceLocator()->get('UserTable');
        $educTable = $this->getServiceLocator()->get('EducTable');
        $cityTable = $this->getServiceLocator()->get('cityTable');
        $user= $userTable -> fetchAll()->toArray();
     	    
        $jsonModel  = new JsonModel(array('users' => '2', 'educs' => '3', 'citys' => '4')); 
	    //var_dump($jsonModel);
       
        return $viewModel; 
        
    }
    public function index1Action()
    {
    	 $userTable = $this->getServiceLocator()->get('UserTable');
         $viewModel  = new JsonModel( $userTable->fetchAll()->toArray()); 
	        
        return $viewModel; 
        
    }
    
    public function index2Action()
    {
    	$educTable = $this->getServiceLocator()->get('EducTable');
        $viewModel  = new JsonModel( $educTable->fetchAll()->toArray()); 
        return $viewModel; 
    }
    public function index3Action()
    {
        $cityTable = $this->getServiceLocator()->get('cityTable');
        $viewModel  = new JsonModel( $cityTable->fetchAll()->toArray()); 
	    return $viewModel; 
    }
    
    public function editAction()
    {
        $id = $this->request->getPost();
        $par = $id->toArray();
        $educ_p =$id['education']; 
        $id_p = $id['id'];
        $adapter = new \Zend\Db\Adapter\Adapter(array(
            'driver' => 'Pdo_Mysql',
            'database' => 'zf',
            'username' => 'root',
            'password' => '',
            'driver_options' => array(
                1002 => 'SET NAMES \'utf8\''
            )
        ));
        $educTable = new TableGateway('education', $adapter);
        $educTable -> update(array('education' => $id['education']), array('id_user' => $id['id']) );
       // $viewModel  = new JsonModel( array("sql" => $id["education"])); 
	    //return $viewModel; 
    }

    public function gridAction()
    {   
        
        $user = array();
        $educ = array();
        $city = array();
        $adapter = new \Zend\Db\Adapter\Adapter(array(
            'driver' => 'Pdo_Mysql',
            'database' => 'zf',
            'username' => 'root',
            'password' => '',
            'driver_options' => array(
                1002 => 'SET NAMES \'utf8\''
            )
        ));
    	       	
		$id = $this->request->getPost();		
		
		foreach ($id as $key => $val) {
			
                if(strpos($key,"user")!==FALSE){ array_push($user,$val);} else {}
                if(strpos($key,"educ")!==FALSE){ array_push($educ,$val);} else {}
                if(strpos($key,"city")!==FALSE){ array_push($city,$val);} else {}
                
                	
			}		
	
                if(empty($user) and empty($educ) and empty($city) ){ 
                                           $sql = "SELECT u.id ,u.name, c.city, e.education FROM user u JOIN city c ON u.id=c.id_user JOIN education e ON u.id=e.id_user";
                                 }
                                 
                if(empty($user) and empty($educ) and !empty($city) ){ 
                      foreach ($city as $key1 => $val1 ){
                        $st=$st.$val1.",";
                      } 
                       $st =  substr($st, 0, -1);
                      $sql = "SELECT u.id ,u.name, c.city, e.education FROM user u JOIN city c ON u.id=c.id_user JOIN education e ON u.id=e.id_user WHERE c.id_user IN ($st)";
                }
                
                if(empty($user) and !empty($educ) and empty($city) ){ 
                      foreach ($educ as $key1 => $val1 ){
                        $st=$st.$val1.",";
                      } 
                       $st =  substr($st, 0, -1);
                      $sql = "SELECT u.id ,u.name, c.city, e.education FROM user u JOIN city c ON u.id=c.id_user JOIN education e ON u.id=e.id_user WHERE e.id_user IN ($st)";
                }
                
                 if(!empty($user) and empty($educ) and empty($city) ){ 
                      foreach ($user as $key1 => $val1 ){
                        $st=$st.$val1.",";
                      } 
                       $st =  substr($st, 0, -1);
                      $sql = "SELECT u.id ,u.name, c.city, e.education FROM user u JOIN city c ON u.id=c.id_user JOIN education e ON u.id=e.id_user WHERE u.id IN ($st)";
                     }
                 
                 if(empty($user) and !empty($educ) and !empty($city) ){ 
                      foreach ($city as $key1 => $val1 ){
                        $st=$st.$val1.",";
                      } 
                      foreach ($educ as $key1 => $val1 ){
                        $st1=$st1.$val1.",";
                      } 
                       $st =  substr($st, 0, -1);
                       $st1 =  substr($st1, 0, -1);
                      $sql = "SELECT u.id ,u.name, c.city, e.education FROM user u JOIN city c ON u.id=c.id_user JOIN education e ON u.id=e.id_user WHERE c.id_user IN ($st) AND e.id_user IN ($st1)";
                     }    
                
                if(!empty($user) and empty($educ) and !empty($city) ){ 
                      foreach ($city as $key1 => $val1 ){
                        $st=$st.$val1.",";
                      } 
                      foreach ($user as $key1 => $val1 ){
                        $st1=$st1.$val1.",";
                      } 
                       $st =  substr($st, 0, -1);
                       $st1 =  substr($st1, 0, -1);
                      $sql = "SELECT u.id ,u.name, c.city, e.education FROM user u JOIN city c ON u.id=c.id_user JOIN education e ON u.id=e.id_user WHERE c.id_user IN ($st) AND u.id IN ($st1)";
                     } 
                        
                  if(!empty($user) and !empty($educ) and empty($city) ){ 
                      foreach ($educ as $key1 => $val1 ){
                        $st=$st.$val1.",";
                      } 
                      foreach ($user as $key1 => $val1 ){
                        $st1=$st1.$val1.",";
                      } 
                       $st =  substr($st, 0, -1);
                       $st1 =  substr($st1, 0, -1);
                      $sql = "SELECT u.id ,u.name, c.city, e.education FROM user u JOIN city c ON u.id=c.id_user JOIN education e ON u.id=e.id_user WHERE e.id_user IN ($st) AND u.id IN ($st1)";
                     }  
                     
                     if(!empty($user) and !empty($educ) and !empty($city) ){ 
                      foreach ($educ as $key1 => $val1 ){
                        $st=$st.$val1.",";
                      } 
                      foreach ($user as $key1 => $val1 ){
                        $st1=$st1.$val1.",";
                      } 
                       foreach ($city as $key1 => $val1 ){
                        $st2=$st2.$val1.",";
                      }
                       $st =  substr($st, 0, -1);
                       $st1 =  substr($st1, 0, -1);
                       $st2 =  substr($st2, 0, -1);
                       
                      $sql = "SELECT  u.id ,u.name, c.city, e.education FROM user u JOIN city c ON u.id=c.id_user JOIN education e ON u.id=e.id_user WHERE e.id_user IN ($st) AND u.id IN ($st1) AND c.id_user IN ($st2)";
                     }                   
                               $statement = $adapter->createStatement($sql);
                               $statement->prepare();
                               $data = $statement->execute();
                              
                               //$viewModel  = new ViewModel( $data ); 
		                      // return $viewModel;
                              //var_dump($data); 
                              $jj = 0; $stack = array(); $ss = array();
                              foreach($data as $item){   array_push($stack,$item['id'],$item['name'],$item['education'],$item['city'] );
                                                         array_push($ss, $stack);
                                                         $stack = array();  
                                                         //echo $item['id']." | ".$item['name']." | ".$item['education']." | ".$item['city']."<br>";
                                                           }          
                  $viewModel  = new JsonModel( array("success" => true, "users"  => $ss) ); 
	              return $viewModel;                     
                //if(!empty($educ)){ var_dump($educ);}
               // if(!empty($city)){ var_dump($city);}
                  	 
    }
    
    public function processAction()
    {
    //	$this->layout('layout/myaccount');
    	 
        if (!$this->request->isPost()) {
            return $this->redirect()->toRoute('users/user-manager', array('action' => 'edit'));
        }

        $post = $this->request->getPost();
        $userTable = $this->getServiceLocator()->get('UserTable');       
        $user = $userTable->getUser($post->id);
        
		$form = $this->getServiceLocator()->get('UserEditForm');
		$form->bind($user);	
        $form->setData($post);
        
        if (!$form->isValid()) {
            $model = new ViewModel(array(
                'error' => true,
                'form'  => $form,
            ));
            $model->setTemplate('users/user-manager/edit');
            return $model;
        }
		
        // Save user
        $this->getServiceLocator()->get('UserTable')->saveUser($user);
        
        return $this->redirect()->toRoute('users/user-manager');
    }
    
    public function deleteAction()
    {
    	//$this->layout('layout/myaccount');
    	$this->getServiceLocator()->get('UserTable')
				    				->deleteUser($this->params()
				    				->fromRoute('id'));
    	return $this->redirect()
    						->toRoute('users/user-manager');
    	 
    }

}
