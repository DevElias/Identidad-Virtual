<?php 
namespace App\Controllers;

use Core\BaseController;

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
            $this->setPageTitle('Home');
            $this->renderView('home/dashboard', 'layout');
        }
        
      
    }
}