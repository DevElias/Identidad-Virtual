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
            $techo = strpos($_SESSION['user']['email'], '@techo.org');
            $teto  = strpos($_SESSION['user']['email'], '@teto.org');
            
            if($techo === false && $teto === false) 
            {
                unset($_SESSION['access_token']);
                header('Location: /');
            }
            else 
            {
                $model = Container::getModel("Usuario");
                $result  = $model->SearchUser($_SESSION['user']['email']);
                
                //if not exist, insert
                if(!$result)
                {
                    $user    = $model->InsertUser($_SESSION['user']);
                    
                    if($user)
                    {
                        //Verify email in table correos
                        $exist = $model->SearchCorreo($_SESSION['user']['email']);
                        
                        if($exist)
                        {
                            
                            $exist = (array) $exist;
                           
                            //Verify email in table correos
                            $exist = $model->UpdateUsers($exist);
                        }
                    }
                }
                
                //Info del usuario
                $result  = $model->DataUser($_SESSION['user']['email']);
                $aUser   = (array) $result[0];
                
                $_SESSION['user']['id'] = $aUser['id'];
                
                $this->setPageTitle('Home');
                $this->renderView('home/dashboard', 'layout');
            }
        }
    }
}