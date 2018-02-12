<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class UsuariosController extends BaseController
{
    public function index($request)
    {
        session_start();
        if(!isset($_SESSION['access_token']))
        {
            header('Location: /');
        }
        
        $this->setPageTitle('Usuario');
        $model = Container::getModel("Usuario");
        $this->view->usuario = $model->select();
        
        /* Api Usuarios */
        /* URL de Cosumo:  http://localhost:8080/usuario?api=true */
        
        $aRequest = (array) $request;
        if($aRequest['api'] === 'true'&& $aRequest['method'] == 'GET')
        {
            die(print_r(json_encode($this->view->usuario), true));
        }
        
        /* Render View Paises */
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