<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class UsuariosController extends BaseController
{
    public function index($request)
    {
        session_start();
        $this->setPageTitle('Usuario');
        $model = Container::getModel("Usuario");
        
        /* Api Usuarios */
        /* URL de Cosumo:  http://localhost:8080/usuario?api=true */
        
        $aRequest = (array) $request;
        if($aRequest['api'] === 'true'&& $aRequest['method'] == 'GET')
        {
            if($aRequest['token'])
            {
                //Verifica se a aplicacao esta registrada
                $app  = $model->CheckToken($aRequest['token']);
                
                if($app)
                {
                    $this->view->usuario = $model->select();
                    
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
                    die(print_r(json_encode($this->view->usuario), true));
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
        
        $this->view->usuario = $model->select();
        
        $this->renderView('usuario/index', 'layout_idvirtual');
    }
    
    public function delete($id)
    {
        $model  = Container::getModel("Usuario");
        $result = $model->delete($id);
        
        if($result)
        {
            header('Location: /usuario');
        }
    }
    
    public function show($id)
    {
        /*Model Usuario */
        $model = Container::getModel("Usuario");
        $this->view->usuario = $model->search($id);
        $this->view->areas = $model->selectAreas();
        $this->view->sedes = $model->selectSedes();
        $this->view->cargos = $model->selectCargos();
        
        /* Render View Paises */
        $this->renderView('usuario/edit', 'layout_idvirtual');
    }
    
    public function edit($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['id']    = filter_var($aParam['id'], FILTER_SANITIZE_STRING);
        $aParam['sede']  = filter_var($aParam['sede'], FILTER_SANITIZE_STRING);
        $aParam['area']  = filter_var($aParam['area'], FILTER_SANITIZE_STRING);
        $aParam['cargo'] = filter_var($aParam['cargo'], FILTER_SANITIZE_STRING);
        
        $model  = Container::getModel("Usuario");
        $result = $model->ActualizarUsuario($aParam);
        
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