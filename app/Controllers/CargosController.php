<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class CargosController extends BaseController
{
    public function index($request)
    {
        $this->setPageTitle('Cargo');
        $model = Container::getModel("Cargo");
        $this->view->cargo = $model->select();
        
        /* Api Cargos */
        /* URL de Cosumo:  
         * http://localhost:8080/cargo?api=true 
         * http://localhost:8080/cargo?api=true&nombre=Coord. de Finanzas
         * */
        
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
            die(print_r(json_encode($this->view->cargo), true));
        }
        
        /* Render View Paises */
        $this->renderView('cargo/index', 'layout');
    }
    
    public function add()
    {
        $this->setPageTitle('Cargo');
        $this->renderView('cargo/add', 'layout');
    }
    
    public function save($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['codigo'] = filter_var($aParam['codigo'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Cargo");
        $result = $model->GuardarCargo($aParam);
        
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
        $model  = Container::getModel("Cargo");
        $result = $model->delete($id);
        
        if($result)
        {
            header('Location: /cargo');
        }
    }
    
    public function show($id)
    {
        $model = Container::getModel("Cargo");
        $this->view->cargo = $model->search($id);
        
        /* Render View Paises */
        $this->renderView('cargo/edit', 'layout');
    }
    
    public function edit($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['id']     = filter_var($aParam['id'], FILTER_SANITIZE_STRING);
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Cargo");
        $result = $model->ActualizarCargo($aParam);
        
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