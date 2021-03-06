<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class SedesController extends BaseController
{
    public function index($request)
    {
        session_start();
        
        $aRequest = (array) $request;
        $this->setPageTitle('Sede');
        $model = Container::getModel("Sede");
        
        /* Api Sedes */
        /* URL de Cosumo:
         * http://localhost:8080/sede?api=true
         * http://localhost:8080/sede?api=true&id=1&nombre=Teste 01
         * */
        
        if($aRequest['api'] === 'true'&& $aRequest['method'] == 'GET')
        {
            if($aRequest['token'])
            {
                //Verifica se a aplicacao esta registrada
                $app  = $model->CheckToken($aRequest['token']);
                
                if($app)
                {
                    $this->view->sede = $model->select();
                    
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
                    die(print_r(json_encode($this->view->sede), true));
                }
                else
                {
                    die(print_r('Your Application does not have permission', true));
                }
            }
        }
        
        if(!isset($_SESSION['access_token']))
        {
            header('Location: /');
        }
      
        $this->view->sede = $model->select();
        
        /* Render View Paises */
        $this->renderView('sede/index', 'layout_idvirtual');
    }
    
    public function add()
    {
        $this->setPageTitle('Sede');
        $model = Container::getModel("Pais");
        $this->view->paises = $model->select();
        $this->renderView('sede/add', 'layout_idvirtual');
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
        $this->renderView('sede/edit', 'layout_idvirtual');
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