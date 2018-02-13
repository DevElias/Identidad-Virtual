<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class AreasController extends BaseController
{
    public function index($request)
    {
        session_start();
        
        $aRequest = (array) $request;
        $this->setPageTitle('Area');
        $model = Container::getModel("Area");
        
        /* Api Areas */
        /* URL de Cosumo:
         * http://localhost:8080/area?api=true
         * http://localhost:8080/area?api=true&id=1&nombre=Procesos y Tecnologia
         * */
        
        if($aRequest['api'] === 'true' && $aRequest['method'] == 'GET')
        {
            if($aRequest['token'])
            {
                //Verifica se a aplicacao esta registrada
                $app  = $model->CheckToken($aRequest['token']);
                
                if($app)
                {
                    $this->view->area = $model->select();
                    
                    if(count($aRequest) > 3)
                    {
                        $i = 0;
                        foreach ($aRequest as $key => $value)
                        {
                            if($key == 'api' || $key == 'method' || $key == 'token')
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
                    die(print_r(json_encode($this->view->area), true));
                }
            }
        }
        
        if(!isset($_SESSION['access_token']))
        {
            header('Location: /');
        }
        
        $this->view->area = $model->select();
        
        /* Render View Paises */
        $this->renderView('area/index', 'layout_idvirtual');
    }
    
    public function add()
    {
        $this->setPageTitle('Area');
        $this->renderView('area/add', 'layout_idvirtual');
    }
    
    public function save($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['nombre']  = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['codigo']  = filter_var($aParam['codigo'], FILTER_SANITIZE_STRING);
        $aParam['status']  = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        $aParam['detalle'] = filter_var($aParam['detalle'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Area");
        $result = $model->GuardarArea($aParam);
        
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
        $model  = Container::getModel("Area");
        $result = $model->delete($id);
        
        if($result)
        {
            header('Location: /area');
        }
    }
    
    public function show($id)
    {
        $model = Container::getModel("Area");
        $this->view->area = $model->search($id);
        
        /* Render View Paises */
        $this->renderView('area/edit', 'layout_idvirtual');
    }
    
    public function edit($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['id']     = filter_var($aParam['id'], FILTER_SANITIZE_STRING);
        $aParam['nombre'] = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['codigo'] = filter_var($aParam['codigo'], FILTER_SANITIZE_STRING);
        $aParam['status'] = filter_var($aParam['status'], FILTER_SANITIZE_STRING);
        $aParam['detalle'] = filter_var($aParam['detalle'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Area");
        $result = $model->ActualizarArea($aParam);
        
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