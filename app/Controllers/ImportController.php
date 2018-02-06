<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class ImportController extends BaseController
{
    public function index($request)
    {
        session_start();
        if(!isset($_SESSION['access_token']))
        {
            header('Location: /');
        }
        
        $model = Container::getModel("Usuario");
        $this->setPageTitle('Import');
        
        $content = file_get_contents('http://id.techo.org/OrgData.csv');
        $lines = array_map("rtrim", explode("\n", $content));
        
        for($i=0; $i < count($lines); $i++)
        {
            if($i != 0)
            {
                $dados = explode(";",$lines[$i]);
                
                $correo   = utf8_encode($dados[0]);
                $nombre   = $dados[1] . " " . $dados[2];
                
                $aReturn = $model->ImportUser($correo, $nombre);
            }
        }
        
        if($aReturn)
        {
            die(print_r('Deu certo a Importacao vei'));
        }
        else
        {
            die(print_r('Deu algua cagada vei'));
        }
        
//         $this->renderView('import/index');
    }
}