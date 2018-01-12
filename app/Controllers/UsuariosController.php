<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class UsuariosController extends BaseController
{
    public function index($request)
    {
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
        $this->renderView('usuario/index', 'layout');
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
}