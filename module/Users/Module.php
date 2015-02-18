<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Users;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Users\Model\User;
use Users\Model\City;
use Users\Model\Educ;
use Users\Model\UserTable;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class Module
{
    
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
        return array(
            'abstract_factories' => array(), 
            'aliases' => array(),
            'factories' => array(
                 // çàïğîñû 
                 
                               
                 
                 //áàçà äàííûõ
                 'UserTable' => function($sm){
                    $tableGateway = $sm->get('UserTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                 } ,
                 
                 'UserTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('user', $dbAdapter, null,$resultSetPrototype);
                 }, 
                 
                 'EducTable' => function($sm){
                    $tableGateway = $sm->get('EducTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                 } ,
                 
                 'EducTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('education', $dbAdapter, null,$resultSetPrototype);
                 },
                 
                 'CityTable' => function($sm){
                    $tableGateway = $sm->get('CityTableGateway');
                    $table = new UserTable($tableGateway);
                    return $table;
                 } ,
                 
                 'CityTableGateway' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new User());
                    return new TableGateway('city', $dbAdapter, null,$resultSetPrototype);
                 },
                 
                 // ÔÎĞÌÛ
                 'LoginForm' => function ($sm) {
                    $form = new \Users\Form\RegisterForm();
                    $form->setInputFilter($sm->get('RegisterFilter'));
                    return $form;
                 },
                 'RegisterForm' => function ($sm) {
                    $form = new \Users\Form\RegisterForm();
                    $form->setInputFilter($sm->get('RegisterFilter'));
                    return $form;
                 },
                 //ÔÈËÜÒĞÛ
                 'LoginFilter' => function ($sm) {
                        return new \Users\Form\LoginFilter();
                  },
                  'RegisterFilter' => function ($sm) {
                        return new \Users\Form\RegisterFilter();
                  },
                   
            ),
            'invokables' => array(),
            'services' => array(),
            'shared' => array(),
            );
    }
}
