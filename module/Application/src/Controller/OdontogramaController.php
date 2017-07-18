<?php
namespace Application\Controller;

use Application\Model\Entity\Enviroment;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;

class OdontogramaController extends AbstractActionController {

    var $table;

    public function __construct(\Application\Model\OdontogramaTable $table){
        $this->table = $table;
    }

    public function indexAction(){
        return new ViewModel();
    }

    public function getAction(){
        $response = \Application\Model\Entity\Enviroment::AJAX_RESPONSE;
        if($this->getRequest()->isPost() && $this->getRequest()->isXmlHttpRequest()){
            $response = $this->table->get('ID_PACIENTE', $this->getRequest()->getPost('id', 0));
        }
        return new JsonModel($response);
    }

    public function getAllAction(){
        $response = Enviroment::AJAX_TABLE;
        if($this->getRequest()->isPost() && $this->getRequest()->isXmlHttpRequest()){
            $response = [
                'data' => $this->table->fetchAll([
                    'detalle_odontograma.ACTIVE'=>true,
                    'detalle_odontograma.ID_ODONTOGRAMA' => $this->getRequest()->getPost('id', 0)
                ])
            ];
        }
        return new JsonModel($response);
    }
}