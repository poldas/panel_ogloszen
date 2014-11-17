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
