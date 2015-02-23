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

use Users\Model\Grid;
use Users\Model\GoGrid;

use Users\Model\User;
use Users\Model\UserTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Sql;

class UserManagerController extends AbstractActionController
{
   
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
                
     
        $gridTable = $this->getServiceLocator()->get('EducTable');
        $gridTable -> editEduc($id);
     
       
    }

    public function gridAction()
    {   
        
        $user = array();
        $educ = array();
        $city = array();
        $stack = array();
        $ss = array();
         
        $gridTable = $this->getServiceLocator()->get('Grid');
    	
               	
		$id = $this->request->getPost();		
		
		foreach ($id as $key => $val) {
			
                if(strpos($key,"user")!==FALSE){ array_push($user,$val);} else {}
                if(strpos($key,"educ")!==FALSE){ array_push($educ,$val);} else {}
                if(strpos($key,"city")!==FALSE){ array_push($city,$val);} else {}
          		}
         
        $data= $gridTable -> checkAll($user,$educ,$city);  
          $stack = array(); $ss = array();
                           foreach($data as $item){   array_push($stack,$item['id'],$item['name'],$item['education'],$item['city'] );
                                                         array_push($ss, $stack);
                                                         $stack = array();  
                                                                    }          
                  $viewModel  = new JsonModel( array("success" => true, "users"  => $ss) ); 
	              return $viewModel;                     
                
                  	 
    }
  
}
