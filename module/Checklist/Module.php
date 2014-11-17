<?php
namespace Checklist;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Checklist\Model\TaskMapper;
use Checklist\Model\OfertaMapper;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
            $eventManager = $e->getApplication()->getEventManager();
            $moduleRouteListener = new ModuleRouteListener();
            $moduleRouteListener->attach($eventManager);
            
            /**
     * Log any Uncaught Exceptions, including all Exceptions in the stack
     */
    $sharedManager = $e->getApplication()->getEventManager()->getSharedManager();
    $sm = $e->getApplication()->getServiceManager();
    $sharedManager->attach('Zend\Mvc\Application', 'dispatch.error',
         function($e) use ($sm) {
            if ($e->getParam('exception')){
                $ex = $e->getParam('exception');
                do {
                    $sm->get('Logger')->crit(
                        sprintf(
                           "%s:%d %s (%d) [%s]\n", 
                            $ex->getFile(), 
                            $ex->getLine(), 
                            $ex->getMessage(), 
                            $ex->getCode(), 
                            get_class($ex)
                        )
                    );
                }
                while($ex = $ex->getPrevious());
            }
         }
    );
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig() {
    	return array(
            'factories' => array(
                'TaskMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $mapper = new TaskMapper($dbAdapter);
                    return $mapper;
                },
                'OfertaMapper' => function ($sm) {
                    $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                    $mapper = new OfertaMapper($dbAdapter);
                    return $mapper;
                }
            ),
    	);
    }
}
