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
                    $user = $model->InsertUser($_SESSION['user']);
                }
                else
                {
                    //if exist update photo
                    $photo = $model->UpdateUsers($_SESSION['user']);
                }
                
                //Info del usuario
                $result  = $model->DataUser($_SESSION['user']['email']);
                $aUser   = (array) $result[0];
                
                $_SESSION['user']['id']   = $aUser['id'];
                $_SESSION['user']['area'] = $aUser['id_area'];
                $_SESSION['user']['pais'] = $aUser['id_pais'];
                
                //Verify menu in database
                $aMenu = $model->BuscaMenu();
                
                if(count($aMenu) == 0)
                {
                    $aDados['id']   = $_SESSION['user']['id'];
                    $aDados['menu'] = 'skin-blue sidebar-mini sidebar-collapse';
                    
                    $aReturn = $model->GravaMenu($aDados);
                    $_SESSION['user']['menu'] = $aDados['menu'];
                }
                else
                {
                    $aMenu = (array) $aMenu[0];
                    $_SESSION['user']['menu'] = $aMenu['status_menu'];
                }
                
                //redirect and register token
                if(isset($_SESSION['appid']) && isset($_SESSION['redirect']))
                {
                    //Verifica se a aplicacao esta registrada
                    $app  = $model->CheckApp($_SESSION['appid']);
                    
                    if($app)
                    {
                        //Verifica ja existe um token na base para o usuario logado
                        $Check  = $model->CheckExist($_SESSION['user']['id']);
                        
                        //Generate a random string.
                        $token = openssl_random_pseudo_bytes(16);
                        
                        //Convert the binary data into hexadecimal representation.
                        $token = bin2hex($token);
                        
                        $aParam['appid']    = $_SESSION['appid'];
                        $aParam['redirect'] = $_SESSION['redirect'];
                        $aParam['idUser']   = $_SESSION['user']['id'];
                        $aParam['token']    = $token;
                        $aParam['ip']       = $_SERVER["REMOTE_ADDR"];
                        $aParam['start']    = date('Y-m-d H:i');
                        $aParam['end']      = date('Y-m-d H:i', strtotime('+1 year'));
                        
                        
                        if($Check)
                        {
                            $aToken = $model->infoToken($_SESSION['user']['id']);
                            $aToken = (array) $aToken[0];
                            
                            unset($_SESSION['appid']);
                            unset($_SESSION['redirect']);
                            header('Location: ' . $aParam['redirect'] . "?token=" . $aToken['access_token']);
                            return;
                        }
                        else
                        {
                            $return  = $model->GeraToken($aParam);
                            
                            if($return)
                            {
                                unset($_SESSION['appid']);
                                unset($_SESSION['redirect']);
                                header('Location: ' . $aParam['redirect'] . "?token=" . $aParam['token']);
                                return;
                            }
                        }
                    }
                    else 
                    {
                        unset($_SESSION['access_token']);
                        unset($_SESSION['appid']);
                        unset($_SESSION['redirect']);
                        die(print_r('Your Application does not have permission', true));
                    }
                }
                
                $this->setPageTitle('Home');
                $this->renderView('home/dashboard', 'layout');
            }
        }
    }
    
    public function save($aParam)
    {
        $aParam = (array) $aParam;
        
        $_SESSION['appid']    =  $aParam['id'];
        $_SESSION['redirect'] =  $aParam['redirect'];
    }
}