<?php 
namespace App\Controllers;

use Core\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        session_start();
        
        $this->setPageTitle('Login');
        $this->renderView('login/index');
    }
    
    public function logout()
    {
        $this->renderView('logout/index');
    }
    
}