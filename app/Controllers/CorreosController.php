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
    
    public function concluir()
    {
        /* Render View Correos */
        $this->renderView('correo/final');
    }
    
    public function listado()
    {
        $model = Container::getModel("Correo");
        $this->view->correo = $model->select();
        
        /* Render View Listado de Correos */
        $this->renderView('correo/listado','layout');
    }
    
    public function show($id)
    {
        $model = Container::getModel("Correo");
        $this->view->correo = $model->search($id);
        
        //If Create or Reset password
        if($this->view->correo->hacer == 'Crear' || $this->view->correo->hacer == 'Recuperar contraseÃ±a' || $this->view->correo->hacer == 'Recuperar contraseña')
        {
            $this->view->correo->contrasena_temporal = 'Techo'.date ("Y");
        }
        
        /* Render View Editar Correos */
        $this->renderView('correo/edit', 'layout');
    }
    
    public function aprobar($id)
    {
        $model = Container::getModel("Correo");
        $result = $model->aprobar($id);
        
        if($result)
        {
            header('Location: /correo/listado');
        }
        
    }
    
    public function reprobado($id)
    {
        $model = Container::getModel("Correo");
        $result = $model->reprobado($id);
        
        if($result)
        {
            header('Location: /correo/listado');
        }
        
    }
    
    public function exportar()
    {
        $model = Container::getModel("Correo");
        $result = $model->exportar();
        $x = 1;
        
        ob_start();
        $df = fopen("php://output", 'w');
        
        if($x == 1)
        {
            $aDados[0]['email address'] = 'email address';
            $aDados[0]['first name']    = 'first name';
            $aDados[0]['last name']     = 'last name';
            $aDados[0]['password']      = 'password';
            
            fputcsv($df, array_keys(reset($aDados)));
            fputcsv($df, $linha);
            $x++;
        }
        
        if (count($result) == 0) 
        {
            return null;
        }
        
        fputcsv($df, array_keys(reset($result)));
        
        foreach ($result as $row) 
        {
            $row = (array) $row;
            fputcsv($df, $row);
        }
        
        $filename = "data_export_" . date("Y-m-d") . ".csv";
        $now = gmdate("D, d M Y H:i:s");
        header("Expires: Tue, 29 Jan 2019 06:00:00 GMT");
        header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
        header("Last-Modified: {$now} GMT");
        
        // force download
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        
        // disposition / encoding on response body
        header("Content-Disposition: attachment;filename={$filename}");
        header("Content-Transfer-Encoding: binary");
        
        fclose($df);
    }
    
    public function edit($aParam)
    {
        $aParam = (array) $aParam;
        
        $aParam['id']             = filter_var($aParam['id'], FILTER_SANITIZE_STRING);
        $aParam['contrasena']     = filter_var($aParam['contrasena'], FILTER_SANITIZE_STRING);
        $aParam['estadoPersonas'] = filter_var($aParam['estadoPersonas'], FILTER_SANITIZE_STRING);
        $aParam['estadoPyt']      = filter_var($aParam['estadoPyt'], FILTER_SANITIZE_STRING);
        $aParam['comentario']     = filter_var($aParam['comentario'], FILTER_SANITIZE_STRING);
        
        
        $model  = Container::getModel("Correo");
        $result = $model->ActualizarCorreo($aParam);
        
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