<?php
$dbParams = array(
		'database'  => 'oferty',
		'username'  => 'poldas',
		'password'  => 'zaqwsx',
		'hostname'  => 'localhost',
		// buffer_results - only for mysqli buffered queries, skip for others
		'options' => array('buffer_results' => true)
);
return array(
    'router' => array(
       'routes' => array(
            'task' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/task[/:action[/:id]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Checklist\Controller',
                        'controller'    => 'Task',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'action' => 'add|edit|delete|getlist$',
                        'id'     => '[0-9]+',
                    ),
                ),
            ),
            'oferta' => array(
                'type'    => 'Segment',
                'options' => array(
                    'route'    => '/oferta[/:action[/:id]]',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Checklist\Controller',
                        'controller'    => 'Oferta',
                        'action'        => 'index',
                    ),
                    'constraints' => array(
                        'action' => 'add|addurl|edit|delete|getlist$',
                        'id'     => '[0-9]+',
                    ),
                ),
            ),
            'home' => array(
                'type'    => 'literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        '__NAMESPACE__' => 'Checklist\Controller',
                        'controller'    => 'Task',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'Checklist\Controller\Task' => 'Checklist\Controller\TaskController',
        	'Checklist\Controller\Oferta' => 'Checklist\Controller\OfertaController'
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'task' => __DIR__ . '/../view',
        	'oferta' => __DIR__ . '/../view',
        ),
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/oferta'    => __DIR__ . '/../view/layout/layout_oferta.phtml',
            'checklist/oferta/index'  => __DIR__ . '/../view/checklist/oferta/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
    ),
	'service_manager' => array(
         'factories' => array(
         	'Navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
         		/**
         		 * This default Db factory is required so that ZDT
         		 * doesn't throw exceptions, even though we don't use it
         		 */
         		'Zend\Db\Adapter\Adapter' => function ($sm) use ($dbParams) {
                $adapter = new BjyProfiler\Db\Adapter\ProfilingAdapter(array(
                    'driver'    => 'pdo',
                    'dsn'       => 'mysql:dbname='.$dbParams['database'].';host='.$dbParams['hostname'],
                    'database'  => $dbParams['database'],
                    'username'  => $dbParams['username'],
                    'password'  => $dbParams['password'],
                    'hostname'  => $dbParams['hostname'],
                ));

                if (php_sapi_name() == 'cli') {
                    $logger = new Zend\Log\Logger();
                    // write queries profiling info to stdout in CLI mode
                    $writer = new Zend\Log\Writer\Stream('php://output');
                    $logger->addWriter($writer, Zend\Log\Logger::DEBUG);
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\LoggingProfiler($logger));
                } else {
                    $adapter->setProfiler(new BjyProfiler\Db\Profiler\Profiler());
                }
                if (isset($dbParams['options']) && is_array($dbParams['options'])) {
                    $options = $dbParams['options'];
                } else {
                    $options = array();
                }
                $adapter->injectProfilingStatementPrototype($options);
                return $adapter;
            },
         ),
     ),
		'navigation' => array(
			'default' => array(
				array(
				    'label' => 'Home',
					'route' => 'home',
				),
		        array(
		            'label' => 'Todo',
		            'route' => 'task',
		        	'action' => 'getlist',
		            'pages' => array(
		                array(
		                    'label' => 'Add',
		                    'route' => 'task',
		                    'action' => 'add',
		                ),
		                array(
		                    'label' => 'Edit',
		                    'route' => 'task',
		                    'action' => 'edit',
		                ),
		                array(
		                    'label' => 'Delete',
		                    'route' => 'task',
		                    'action' => 'delete',
		                ),
		            ),
		        ),
				array(
					'label' => 'Panel oferta',
					'route' => 'oferta',
					'action' => 'getlist',
				),
			),
		),
);