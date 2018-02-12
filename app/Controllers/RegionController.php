<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class RegionController extends BaseController
{
    public function index($request)
    {
        session_start();
        if(!isset($_SESSION['access_token']))
        {
            header('Location: /');
        }
        
        $this->setPageTitle('Region');
        $model = Container::getModel("Region");
        $this->view->region = $model->select();
        
        /* Api Region */
        /* URL de Cosumo:  
         * http://localhost:8080/region?api=true 
         * http://localhost:8080/region?api=true&nombre=Ejemplo
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
            die(print_r(json_encode($this->view->region), true));
        }
        
        /* Render View Paises */
        $this->renderView('region/index', 'layout_idvirtual');
    }
    
    public function add()
    {
        $this->setPageTitle('Region');
        $this->renderView('region/add', 'layout_idvirtual');
    }
    
    public function save($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['codigo'] = filter_var($aParam['codigo'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Region");
        $result = $model->GuardarRegion($aParam);
        
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
        $model  = Container::getModel("Region");
        $result = $model->delete($id);
        
        if($result)
        {
            header('Location: /region');
        }
    }
    
    public function show($id)
    {
        $model = Container::getModel("Region");
        $this->view->region = $model->search($id);
        
        /* Render View Paises */
        $this->renderView('region/edit', 'layout_idvirtual');
    }
    
    public function edit($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['id']     = filter_var($aParam['id'], FILTER_SANITIZE_STRING);
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['codigo'] = filter_var($aParam['codigo'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Region");
        $result = $model->ActualizarRegion($aParam);
        
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