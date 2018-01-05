<?php 
namespace App\Controllers;

use Core\BaseController;

class LoginController extends BaseController
{
    public function index()
    {
        $this->setPageTitle('Login');
        $this->renderView('login/index');
    }
    
    
}