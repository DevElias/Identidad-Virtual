<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class PaisesController extends BaseController
{
    public function index($request)
    {
        session_start();
        if(!isset($_SESSION['access_token']))
        {
            header('Location: /');
        }
        
        $this->setPageTitle('Pais');
        $model = Container::getModel("Pais");
        $this->view->pais = $model->select();
        
        /* Api Paises */
        /* URL de Cosumo:  
         * http://localhost:8080/pais?api=true 
         * http://localhost:8080/pais?api=true&id=2&nombre=Brasil
         */
        
        $aRequest = (array) $request;
        if($aRequest['api'] === 'true'&& $aRequest['method'] == 'GET')
        {
            if(count($aRequest) > 2)
            {
                $i = 0;
                foreach ($aRequest as $key => $value)
                {
                    if($key == 'api' || $key == 'method')
                    {
                        continue;
                    }
                    else 
                    {
                        $aDados[$i]['field'] = $key;
                        $aDados[$i]['value'] = $value;
                    }
                    $i ++;
                }
                
                $return = $model->SearchAPI($aDados);
                die(print_r(json_encode($return), true));
            }
            die(print_r(json_encode($this->view->pais), true));
        }
        
        /* Render View Paises */
        $this->renderView('pais/index', 'layout_idvirtual');
    }
    
    public function add()
    {
        $this->setPageTitle('Pais');
        $model = Container::getModel("Pais");
        $this->view->region = $model->selectRegion();
        $this->renderView('pais/add', 'layout_idvirtual');
    }
    
    public function save($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['codigo'] = filter_var($aParam['codigo'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        $aParam['region'] = filter_var($aParam['region'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Pais");
        $result = $model->GuardarPais($aParam);
        
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
        $model  = Container::getModel("Pais");
        $result = $model->delete($id);
        
        if($result)
        {
            header('Location: /pais');
        }
    }
    
    public function show($id)
    {
        $model = Container::getModel("Pais");
        $this->view->pais   = $model->search($id);
        $this->view->region = $model->selectRegion();
        
        
        /* Render View Paises */
        $this->renderView('pais/edit', 'layout_idvirtual');
    }
    
    public function edit($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['id']     = filter_var($aParam['id'], FILTER_SANITIZE_STRING);
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['codigo'] = filter_var($aParam['codigo'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        $aParam['region'] = filter_var($aParam['region'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Pais");
        $result = $model->ActualizarPais($aParam);
        
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