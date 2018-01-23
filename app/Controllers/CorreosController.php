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
    
    public function crear($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['pais']     = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['appelido'] = filter_var($aParam['appelido'], FILTER_SANITIZE_STRING);
        $aParam['nombre']   = filter_var($aParam['nombre'], FILTER_SANITIZE_STRING);
        $aParam['correo']   = filter_var($aParam['correo'], FILTER_SANITIZE_STRING);
        $aParam['area']     = filter_var($aParam['area'], FILTER_SANITIZE_STRING);
        $aParam['rol']      = filter_var($aParam['rol'], FILTER_SANITIZE_STRING);
        $aParam['copia']    = filter_var($aParam['copia'], FILTER_SANITIZE_STRING);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            //Implamentar...
        }
        
        $model  = Container::getModel("Correo");
        $result = $model->CrearCorreo($aParam);
        
        if($result)
        {
            echo json_encode(array("results" => true));
        }
        else
        {
            echo json_encode(array("results" => false));
        }
    }
    
    public function nickname($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['pais']      = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['cuentareal'] = filter_var($aParam['cuentareal'], FILTER_SANITIZE_STRING);
        $aParam['alias']     = filter_var($aParam['alias'], FILTER_SANITIZE_STRING);
        $aParam['motivo']    = filter_var($aParam['motivo'], FILTER_SANITIZE_STRING);
        $aParam['copia']     = filter_var($aParam['copia'], FILTER_SANITIZE_STRING);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            //Implamentar...
        }
        
        $model  = Container::getModel("Correo");
        $result = $model->nickname($aParam);
        
        if($result)
        {
            echo json_encode(array("results" => true));
        }
        else
        {
            echo json_encode(array("results" => false));
        }
    }
    
    public function modificar($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['pais']      = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['modify']    = filter_var($aParam['modify'], FILTER_SANITIZE_STRING);
        $aParam['motivo']    = filter_var($aParam['motivo'], FILTER_SANITIZE_STRING);
        $aParam['copia']     = filter_var($aParam['copia'], FILTER_SANITIZE_STRING);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            //Implamentar...
        }
        
        $model  = Container::getModel("Correo");
        $result = $model->modificar($aParam);
        
        if($result)
        {
            echo json_encode(array("results" => true));
        }
        else
        {
            echo json_encode(array("results" => false));
        }
    }
    
    public function recuperar($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['pais']             = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['correo_recuperar'] = filter_var($aParam['correo_recuperar'], FILTER_SANITIZE_STRING);
        $aParam['motivo']    = filter_var($aParam['motivo'], FILTER_SANITIZE_STRING);
        $aParam['copia']     = filter_var($aParam['copia'], FILTER_SANITIZE_STRING);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            //Implamentar...
        }
        
        $model  = Container::getModel("Correo");
        $result = $model->recuperar($aParam);
        
        if($result)
        {
            echo json_encode(array("results" => true));
        }
        else
        {
            echo json_encode(array("results" => false));
        }
    }
    
    public function suspender($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['pais']             = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['correo_suspender'] = filter_var($aParam['correo_suspender'], FILTER_SANITIZE_STRING);
        $aParam['motivo']    = filter_var($aParam['motivo'], FILTER_SANITIZE_STRING);
        $aParam['copia']     = filter_var($aParam['copia'], FILTER_SANITIZE_STRING);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            //Implamentar...
        }
        
        $model  = Container::getModel("Correo");
        $result = $model->suspender($aParam);
        
        if($result)
        {
            echo json_encode(array("results" => true));
        }
        else
        {
            echo json_encode(array("results" => false));
        }
    }
    
    public function eliminar($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['pais']             = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['correo_eliminar']  = filter_var($aParam['correo_eliminar'], FILTER_SANITIZE_STRING);
        $aParam['transferDoc']      = filter_var($aParam['transferDoc'], FILTER_SANITIZE_STRING);
        $aParam['correo_origen']    = filter_var($aParam['correo_origen'], FILTER_SANITIZE_STRING);
        $aParam['correo_destino']   = filter_var($aParam['correo_destino'], FILTER_SANITIZE_STRING);
        $aParam['motivo']           = filter_var($aParam['motivo'], FILTER_SANITIZE_STRING);
        $aParam['copia']            = filter_var($aParam['copia'], FILTER_SANITIZE_STRING);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            //Implamentar...
        }
        
        $model  = Container::getModel("Correo");
        $result = $model->eliminar($aParam);
        
        if($result)
        {
            echo json_encode(array("results" => true));
        }
        else
        {
            echo json_encode(array("results" => false));
        }
    }
    
    public function transferir($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['pais']             = filter_var($aParam['pais'], FILTER_SANITIZE_STRING);
        $aParam['correo_origen']    = filter_var($aParam['correo_origen'], FILTER_SANITIZE_STRING);
        $aParam['correo_destino']   = filter_var($aParam['correo_destino'], FILTER_SANITIZE_STRING);
        $aParam['motivo']           = filter_var($aParam['motivo'], FILTER_SANITIZE_STRING);
        $aParam['copia']            = filter_var($aParam['copia'], FILTER_SANITIZE_STRING);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            //Implamentar...
        }
        
        $model  = Container::getModel("Correo");
        $result = $model->transferir($aParam);
        
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