<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class CorreosController extends BaseController
{
    public function index($request)
    {
        $model = Container::getModel("Usuario");
        $this->view->paises = $model->selectPaises();
        $this->view->areas  = $model->selectAreas();
        $this->view->sedes  = $model->selectSedes();
        $this->view->cargos = $model->selectCargos();

        /* Render View Correos */
        $this->renderView('correo/index');
    }
}