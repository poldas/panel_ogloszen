<?php

namespace Checklist\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Checklist\Form\OfertaForm;
use Checklist\Model\OfertaEntity;
use Checklist\Model\Parser;

class OfertaController extends AbstractActionController {

	public function indexAction() {
            return new ViewModel(array ('klucz' => 'message'));
	}

	public function editAction() {
            $this->layout('layout/oferta');
            $id = (int)$this->params('id');
            if (!$id) {
                return $this->redirect()->toRoute('oferta', array(
                    'action' => 'add'
                ));
            }
            $task = $this->getOfertaMapper()->getOferta($id);

            $form = new OfertaForm();
            $form->bind($task);

            $request = $this->getRequest();
            if ($request->isPost()) {
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $this->getOfertaMapper()->saveOferta($task);
                    return $this->redirect()->toRoute('oferta', array(
                            'action' => 'getlist'
                    ));
                }
            }
            return array (
                'id' => $id,
                'form' => $form
            );
	}

	public function addAction() {
            $this->layout('layout/oferta');
            $form = new OfertaForm();
            $task = new OfertaEntity();
            $form->bind($task);

            $request = $this->getRequest();
            if ($request->isPost()) {
                $form->setData($request->getPost());
                if ($form->isValid()) {
                    $result = $this->getOfertaMapper()->saveOferta($task);
                    // Redirect to list of tasks
                    \Zend\Debug\Debug::dump($result);
                    if (!$result) {
                        $this->flashMessenger()->addErrorMessage("Problem z dodaniem rekordu");
                    } else {
//                        return $this->redirect()->toRoute('oferta', array(
//                            'action' => 'getlist'
//                        ));
                    }
                }
            }
            return array (
                'form' => $form
            );
	}

        public function addurlAction() {
            $this->layout('layout/oferta');
            $request = $this->getRequest();
            if ($request->isPost()) {
                $url = $request->getPost('url');
                $parser = new Parser();
                $form = new OfertaForm();
                $task = new OfertaEntity();
                $form->bind($task);                
                
                $dane = $parser->setUrl($url)->getResult();
                $form->setData($dane);
                if ($form->isValid()) {
                    $result = $this->getOfertaMapper()->saveOferta($task);
                    if (!$result) {
                        $this->flashMessenger()->addMessage("Problem z dodaniem rekordu");
                    } else {
                        return $this->redirect()->toRoute( 'oferta', array(
                            'action' => 'getlist'
                        ));
                    }
                } else {
                    echo "<pre>";
                    print_r($form->getMessages());
                    echo "</pre>";
                }
            }
	}
        
	public function getListAction() {
            $this->layout('layout/oferta');
            $mapper = $this->getOfertaMapper();
            return new ViewModel(array(
                'tasks' => $mapper->fetchAll()
            ));
	}

	public function deleteAction() {
            $this->layout('layout/oferta');
            $id = $this->params('id');
            $task = $this->getOfertaMapper()->getOferta($id);
            if (!$task) {
                return $this->redirect()->toRoute( 'oferta', array(
                    'action' => 'getlist'
                ));
            }

            $request = $this->getRequest();
            if ($request->isPost()) {
                if ($request->getPost()->get('del') == 'Yes') {
                    $this->getOfertaMapper()->deleteOferta($id);
                }

                return $this->redirect()->toRoute('oferta', array (
                    'action' => 'getlist'
                ));
            }

            return array (
                'id' => $id,
                'task' => $task
            );
	}

	public function getOfertaMapper() {
            return $this->getServiceLocator()->get('OfertaMapper');
	}
}
