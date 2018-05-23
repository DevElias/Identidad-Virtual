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
                    $app  = $model->CheckApp($_SESSION['appid'], $_SESSION['redirect']);
                    
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
                            
                            $redirect = $_SESSION['redirect'];
                            
                            unset($_SESSION['appid']);
                            unset($_SESSION['redirect']);
                            header('Location: ' . $redirect. "?token=" . $aToken['access_token']);
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
                else 
                {
                    if(!$_SESSION['user']['token'])
                    {
                        //Verifica todos os Token deste usuarios e apaga os velhos
                        $listToken  = $model->AllToken($_SESSION['user']['id']);
                        
                        for($i=0; $i < count($listToken); $i++)
                        {
                            $register = (array) $listToken[$i];
                            
                            if($register['id_app'] == 'Local - Login TECHO')
                            {
                                $aRetorno  = $model->DeleteToken($register['id']);
                            }
                        }
                        
                        //Generate a random string.
                        $token = openssl_random_pseudo_bytes(16);
                        
                        //Convert the binary data into hexadecimal representation.
                        $token = bin2hex($token);
                        
                        $aToken['appid']    = 'Local - Login TECHO';
                        $aToken['idUser']   = $_SESSION['user']['id'];
                        $aToken['token']    = $token;
                        $aToken['ip']       = $_SERVER["REMOTE_ADDR"];
                        $aToken['start']    = date('Y-m-d H:i');
                        $aToken['end']      = date('Y-m-d H:i', strtotime('+1 day'));
                        
                        //Gera um Token Novo, ou seja um NOVO token por usuario sempre
                        $aRet  = $model->GeraToken($aToken);
                        
                        if($aRet)
                        {
                            $aDados = $model->DadosToken($token);
                            $aDados = (array) $aDados;
                            
                            $_SESSION['user']['token'] = $aDados['access_token'];
                        }
                    }
                }
                
                $aApps = $model->SelectApps();
                $this->view->apps = $aApps;
                
                $this->setPageTitle('Home');
                $this->renderView('home/dashboard', 'layout');
            }
        }
    }
    
    //Metodo de Login com Redirect
    public function save($aParam)
    {
        $aParam = (array) $aParam;
        
        $_SESSION['appid']    =  $aParam['id'];
        $_SESSION['redirect'] =  $aParam['redirect'];
    }
    
    //Metodo de Acesso para as Aplicacoes via CURL sem Redirect
    public function access($aParam)
    {
        session_start();
        
        $aParam = (array) $aParam;
        
        if(isset($aParam['token']))
        {
            $model = Container::getModel("Usuario");
            //Verifica se a aplicacao esta registrada
            $app  = $model->CheckToken($aParam['token']);
            
            if($app)
            {
                $aDados   = $model->DadosToken($aParam['token']);
                $aDados   = (array) $aDados;
                
                $aUsuario = $model->search($aDados['id_usuario']);
                
                $aUser   = json_encode($aUsuario);
                
                die(print_r($aUser, true));
            }
            else
            {
                die(print_r('Your Application does not have permission', true));
            }
        }
    }
}