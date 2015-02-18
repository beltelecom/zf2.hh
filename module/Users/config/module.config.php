<?php

return array(
    'controllers' => array(
    'invokables' => array(
        'Users\Controller\Index' => 'Users\Controller\IndexController',
        'Users\Controller\Register' => 'Users\Controller\RegisterController',
        'Users\Controller\Login' => 'Users\Controller\LoginController',
        'Users\Controller\UserManager' => 'Users\Controller\UserManagerController',
        
      ),
    ),
    'router' => array(
        'routes' => array(
            'users' => array(
                'type' => 'Literal',
                'options' => array(
                      'route' => '/users',
                      'defaults' => array(
                            '__NAMESPACE__' => 'Users\Controller',
                            'controller' => 'Index',
                            'action' => 'index',
                       ),
                  ),
                'may_terminate' => true,
                'child_routes' => array(
                  
                    
                    'users' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/users[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        	'defaults' => array(
                        		'controller' => 'Users\Controller\Index',
                        		'action'     => 'index',
                        	),                        		
                        ),
                    ),
                    'login' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/login[/:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                        	'defaults' => array(
                        		'controller' => 'Users\Controller\Login',
                        		'action'     => 'index',
                        	),                        		
                        ),
                    ),
                	'register' => array(
               			'type'    => 'Segment',
               			'options' => array(
               				'route'    => '/register[/:action]',
               				'constraints' => array(
               					'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
               				),
               				'defaults' => array(
               					'controller' => 'Users\Controller\Register',
               					'action'     => 'index',
               				),
               			),
                	), 
                	'user-manager' => array(
                		'type'    => 'Segment',
                		'options' => array(
                			'route'    => '/user-manager[/:action[/:id]]',
                			'constraints' => array(
                				'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                				'id'     => '[a-zA-Z0-9_-]*',
                			),
                			'defaults' => array(
                				'controller' => 'Users\Controller\UserManager',
                				'action'     => 'index',
                			),
                		),
                	),
                    'upload-manager' => array(
                		'type'    => 'Segment',
                		'options' => array(
                			'route'    => '/upload-manager[/:action[/:id]]',
                			'constraints' => array(
                				'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                				'id'     => '[a-zA-Z0-9_-]*',                				
                			),
                			'defaults' => array(
                				'controller' => 'Users\Controller\UploadManager',
                				'action'     => 'index',
                			),
                		),
                	),
                    
                  ),
                ),
              ),
            ),
         //),
     'view_manager' => array(
        'template_path_stack' => array(
            'users' => __DIR__ . '/../view',
         ),
         'strategies' => array(
            'ViewJsonStrategy',
        ),
      ),
);
