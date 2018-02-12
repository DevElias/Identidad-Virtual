<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class MenuController extends BaseController
{
    public function StatusMenu()
    {
        
        $model = Container::getModel("Menu");
        $aReturn = $model->BuscaStatus();
        $aReturn = (array) $aReturn[0];
        
        $_SESSION['user']['menu'] = $aReturn['status_menu'];
    }
    
    public function ChangeStatus()
    {
        $model = Container::getModel("Menu");
        
        //Mini
        if($_SESSION['user']['menu'] == 'skin-blue sidebar-mini sidebar-collapse')
        {
            $aReturn = $model->Open();
            $_SESSION['user']['menu'] = 'skin-blue sidebar-mini';
        }
        else
        {
            $aReturn = $model->Close();
            $_SESSION['user']['menu'] = 'skin-blue sidebar-mini sidebar-collapse';
        }
        
    }
    
    public function home()
    {
        
        session_start();
        if(!isset($_SESSION['access_token']))
        {
            header('Location: /');
        }
        $this->setPageTitle('Home');
        
        /* Render View Paises 
         * layout de la identidad Virtual
         * */
        $this->renderView('home/home_idvirtual', 'layout_idvirtual');
    }
    
}