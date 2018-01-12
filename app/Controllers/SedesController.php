<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class SedesController extends BaseController
{
    public function index($request)
    {
        $this->setPageTitle('Sede');
        $model = Container::getModel("Sede");
        $this->view->sede = $model->select();
        
        /* Api Sedes */
        /* URL de Cosumo:  http://localhost:8080/sede?api=true */
        
        $aRequest = (array) $request;
        if($aRequest['api'] === 'true'&& $aRequest['method'] == 'GET')
        {
            die(print_r(json_encode($this->view->sede), true));
        }
        
        /* Render View Paises */
        $this->renderView('sede/index', 'layout');
    }
    
    public function add()
    {
        $this->setPageTitle('Sede');
        $model = Container::getModel("Pais");
        $this->view->paises = $model->select();
        $this->renderView('sede/add', 'layout');
    }
    
    public function save($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['pais']   = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Sede");
        $result = $model->GuardarSede($aParam);
        
        if($result)
        {
            echo json_encode(array("results" => true));
        }
        else
        {
            echo json_encode(array("results" => false));
        }
    }
    
    public function delete($id)
    {
        $model  = Container::getModel("Sede");
        $result = $model->delete($id);
        
        if($result)
        {
            header('Location: /sede');
        }
    }
    
    public function show($id)
    {
        $model = Container::getModel("Sede");
        $this->view->sede = $model->search($id);
        $this->view->pais = $model->selectPaises();
        
        /* Render View Paises */
        $this->renderView('sede/edit', 'layout');
    }
    
    public function edit($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['id']     = filter_var($aParam['id'], FILTER_SANITIZE_STRING);
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['pais']   = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Sede");
        $result = $model->ActualizarSede($aParam);
        
        if($result)
        {
            echo json_encode(array("results" => true));
        }
        else
        {
            echo json_encode(array("results" => false));
        }
    }
}