<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;

class HomeController extends BaseController
{
    public function index()
    {
        session_start();
        if(!isset($_SESSION['access_token']))
        {
            header('Location: /');
        }
        else
        {
            
            $model = Container::getModel("Usuario");
            $result  = $model->SearchUser($_SESSION['user']['email']);
            
            if(!$result)
            {
                $user  = $model->InsertUser($_SESSION['user']);
            }
            
            $this->setPageTitle('Home');
            $this->renderView('home/dashboard', 'layout');
        }
        
      
    }
}