<?php 
namespace App\Controllers;

use Core\BaseController;
use Core\Container;
use PHPMailer\PHPMailer\PHPMailer;

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
        
        //Search Info
        $model = Container::getModel("Correo");
        $Pais  = (array) $model->searchPais($aParam['pais']);
        $Area  = (array) $model->searchArea($aParam['area']);
        $Rol  = (array) $model->searchRol($aParam['rol']);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            $mail = new PHPMailer(true); 
            
            $cEmail    = $_SESSION['user']['email'];
            
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'no-reply@techo.org';
            $mail->Password = '0CBiyyRg';
            
            $html = '<html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Solicitud de Correo</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicitud de cuentas TECHO/TETO</strong></p><br>
    										<strong>&#161;Hemos registrado tu Solicitud!</strong></p>
    										Una vez que tu solicitud sea atendida, te enviaremos un Correo de confirmaci&oacute;n<br>
    										<p>Crear Correo: <strong> '. $aParam['correo']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Apellido(s): <strong> ' . $aParam['appelido'] .'</strong></p>
    										<p>Nombre(s): <strong> '   . $aParam['nombre']   .'</strong></p>
    										<p>&Aacute;rea: <strong> ' . $Area['nombre']     .'</strong></p>
    										<p>Rol : <strong> '        . $Rol['nombre']      .'</strong></p>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicita&ccedil;&atilde;o de Email TECHO/TETO</strong></p><br>
    										<strong>Registramos sua Solicita&ccedil;&atilde;o!</strong></p>
    										Assim que sua Solicita&ccedil;&atilde;o for atendida, te enviaremos un email de confirma&ccedil;&atilde;o<br>
    										<p>Criar Email: <strong> '. $aParam['correo']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Sobrenome(s): <strong> ' . $aParam['appelido'] .'</strong></p>
    										<p>Nome(s): <strong> '   . $aParam['nombre']   .'</strong></p>
    										<p>&Aacute;rea: <strong> ' . $Area['nombre']     .'</strong></p>
    										<p>Cargo : <strong> '        . $Rol['nombre']      .'</strong></p>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>';
            
            $mail->From = 'no-reply@techo.org';
            $mail->FromName = 'Identidad Virtual - TECHO';
            
            $mail->AddAddress($cEmail);
            
            $mail->IsHTML(true);
            
            
            $mail->Subject  = "TECHO - Solicitud de Correo"; // Assunto da mensagem
            $mail->Body = "". $html . "";
            
            // Define os anexos (opcional)
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            
            // Envia o e-mail
            $enviado = $mail->Send();
            
            // Limpa os destinat�rios e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        }
        
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
        
        //Search Info
        $model = Container::getModel("Correo");
        $Pais  = (array) $model->searchPais($aParam['pais']);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            $mail = new PHPMailer(true);
            
            $cEmail    = $_SESSION['user']['email'];
            
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'no-reply@techo.org';
            $mail->Password = '0CBiyyRg';
            
            $html = '<html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Crear un Alias (Nickname)</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicitud de cuentas TECHO/TETO</strong></p><br>
    										<strong>&#161;Hemos registrado tu Solicitud!</strong></p>
    										Una vez que tu solicitud sea atendida, te enviaremos un Correo de confirmaci&oacute;n<br>
    										<p>Crear un Alias: <strong> '. $aParam['alias']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Correo: <strong> ' . $aParam['cuentareal'] .'</strong></p>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicita&ccedil;&atilde;o de Email TECHO/TETO</strong></p><br>
    										<strong>Registramos sua Solicita&ccedil;&atilde;o!</strong></p>
    										Assim que sua Solicita&ccedil;&atilde;o for atendida, te enviaremos un email de confirma&ccedil;&atilde;o<br>
    										<p>Criar Apelido: <strong> '. $aParam['alias']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Correo: <strong> ' . $aParam['cuentareal'] .'</strong></p>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>';
            
            $mail->From = 'no-reply@techo.org';
            $mail->FromName = 'Identidad Virtual - TECHO';
            
            $mail->AddAddress($cEmail);
            
            $mail->IsHTML(true);
            
            
            $mail->Subject  = "TECHO - Solicitud de Correo"; // Assunto da mensagem
            $mail->Body = "". $html . "";
            
            // Define os anexos (opcional)
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            
            // Envia o e-mail
            $enviado = $mail->Send();
            
            // Limpa os destinat�rios e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        }
        
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
        
        //Search Info
        $model = Container::getModel("Correo");
        $Pais  = (array) $model->searchPais($aParam['pais']);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            $mail = new PHPMailer(true);
            
            $cEmail    = $_SESSION['user']['email'];
            
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'no-reply@techo.org';
            $mail->Password = '0CBiyyRg';
            
            $html = '<html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Solicitud de Correo - Modificar</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicitud de cuentas TECHO/TETO</strong></p><br>
    										<strong>&#161;Hemos registrado tu Solicitud!</strong></p>
    										Una vez que tu solicitud sea atendida, te enviaremos un Correo de confirmaci&oacute;n<br>
    										<p>Modificar: <strong> '. $aParam['modify']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicita&ccedil;&atilde;o de Email TECHO/TETO</strong></p><br>
    										<strong>Registramos sua Solicita&ccedil;&atilde;o!</strong></p>
    										Assim que sua Solicita&ccedil;&atilde;o for atendida, te enviaremos un email de confirma&ccedil;&atilde;o<br>
    										<p>Modificar: <strong> '. $aParam['modify']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>';
            
            $mail->From = 'no-reply@techo.org';
            $mail->FromName = 'Identidad Virtual - TECHO';
            
            $mail->AddAddress($cEmail);
            
            $mail->IsHTML(true);
            
            
            $mail->Subject  = "TECHO - Solicitud de Correo"; // Assunto da mensagem
            $mail->Body = "". $html . "";
            
            // Define os anexos (opcional)
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            
            // Envia o e-mail
            $enviado = $mail->Send();
            
            // Limpa os destinat�rios e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        }
        
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
        
        //Search Info
        $model = Container::getModel("Correo");
        $Pais  = (array) $model->searchPais($aParam['pais']);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            $mail = new PHPMailer(true);
            
            $cEmail    = $_SESSION['user']['email'];
            
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'no-reply@techo.org';
            $mail->Password = '0CBiyyRg';
            
            $html = '<html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Solicitud de Correo - Recuperar contrase&ntilde;a</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicitud de cuentas TECHO/TETO</strong></p><br>
    										<strong>&#161;Hemos registrado tu Solicitud!</strong></p>
    										Una vez que tu solicitud sea atendida, te enviaremos un Correo de confirmaci&oacute;n<br>
    										<p>Recuperar contrase&ntilde;a: del Correo: <strong> '. $aParam['correo_recuperar']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicita&ccedil;&atilde;o de Email TECHO/TETO</strong></p><br>
    										<strong>Registramos sua Solicita&ccedil;&atilde;o!</strong></p>
    										Assim que sua Solicita&ccedil;&atilde;o for atendida, te enviaremos un email de confirma&ccedil;&atilde;o<br>
    										<p>Recuperar Senha do Email: <strong> '. $aParam['correo_recuperar']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>';
            
            $mail->From = 'no-reply@techo.org';
            $mail->FromName = 'Identidad Virtual - TECHO';
            
            $mail->AddAddress($cEmail);
            
            $mail->IsHTML(true);
            
            
            $mail->Subject  = "TECHO - Solicitud de Correo"; // Assunto da mensagem
            $mail->Body = "". $html . "";
            
            // Define os anexos (opcional)
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            
            // Envia o e-mail
            $enviado = $mail->Send();
            
            // Limpa os destinat�rios e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        }
        
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
        
        //Search Info
        $model = Container::getModel("Correo");
        $Pais  = (array) $model->searchPais($aParam['pais']);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            $mail = new PHPMailer(true);
            
            $cEmail    = $_SESSION['user']['email'];
            
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'no-reply@techo.org';
            $mail->Password = '0CBiyyRg';
            
            $html = '<html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Solicitud de Correo - Supender</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicitud de cuentas TECHO/TETO</strong></p><br>
    										<strong>&#161;Hemos registrado tu Solicitud!</strong></p>
    										Una vez que tu solicitud sea atendida, te enviaremos un Correo de confirmaci&oacute;n<br>
    										<p>Suspender Correo: <strong> '. $aParam['correo_suspender']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicita&ccedil;&atilde;o de Email TECHO/TETO</strong></p><br>
    										<strong>Registramos sua Solicita&ccedil;&atilde;o!</strong></p>
    										Assim que sua Solicita&ccedil;&atilde;o for atendida, te enviaremos un email de confirma&ccedil;&atilde;o<br>
    										<p>Suspender Email: <strong> '. $aParam['correo_suspender']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>';
            
            $mail->From = 'no-reply@techo.org';
            $mail->FromName = 'Identidad Virtual - TECHO';
            
            $mail->AddAddress($cEmail);
            
            $mail->IsHTML(true);
            
            
            $mail->Subject  = "TECHO - Solicitud de Correo"; // Assunto da mensagem
            $mail->Body = "". $html . "";
            
            // Define os anexos (opcional)
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            
            // Envia o e-mail
            $enviado = $mail->Send();
            
            // Limpa os destinat�rios e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        }
        
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
        
        //Search Info
        $model = Container::getModel("Correo");
        $Pais  = (array) $model->searchPais($aParam['pais']);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            $mail = new PHPMailer(true);
            
            $cEmail    = $_SESSION['user']['email'];
            
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'no-reply@techo.org';
            $mail->Password = '0CBiyyRg';
            
            $html = '<html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Solicitud de Correo - Eliminar</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicitud de cuentas TECHO/TETO</strong></p><br>
    										<strong>&#161;Hemos registrado tu Solicitud!</strong></p>
    										Una vez que tu solicitud sea atendida, te enviaremos un Correo de confirmaci&oacute;n<br>
    										<p>Eliminar Correo: <strong> '. $aParam['correo_eliminar']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicita&ccedil;&atilde;o de Email TECHO/TETO</strong></p><br>
    										<strong>Registramos sua Solicita&ccedil;&atilde;o!</strong></p>
    										Assim que sua Solicita&ccedil;&atilde;o for atendida, te enviaremos un email de confirma&ccedil;&atilde;o<br>
    										<p>Apagar Email: <strong> '. $aParam['correo_eliminar']   .'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>';
            
            $mail->From = 'no-reply@techo.org';
            $mail->FromName = 'Identidad Virtual - TECHO';
            
            $mail->AddAddress($cEmail);
            
            $mail->IsHTML(true);
            
            
            $mail->Subject  = "TECHO - Solicitud de Correo"; // Assunto da mensagem
            $mail->Body = "". $html . "";
            
            // Define os anexos (opcional)
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            
            // Envia o e-mail
            $enviado = $mail->Send();
            
            // Limpa os destinat�rios e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        }
        
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
        
        //Search Info
        $model = Container::getModel("Correo");
        $Pais  = (array) $model->searchPais($aParam['pais']);
        
        //Enviar Email
        if($aParam['copia'] == 'On')
        {
            $mail = new PHPMailer(true);
            
            $cEmail    = $_SESSION['user']['email'];
            
            $mail->IsSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Port = 587;
            $mail->Username = 'no-reply@techo.org';
            $mail->Password = '0CBiyyRg';
            
            $html = '<html>
                        <head>
                        	<meta charset="utf-8">
                        	<meta http-equiv="X-UA-Compatible" content="IE=edge">
                        	<title>Solicitud de Correo - Transferir</title>
                        </head>
                        <body>
                        <style>
                        	* {
                        		font-size: 14px;
                        		line-height: 1.8em;
                        		font-family: arial;
                        	}
                        </style>
                        	<table style="margin:0 auto; max-width:660px;">
                        		<thead>
                        			<tr>
                        				<th><img src="https://crunchbase-production-res.cloudinary.com/image/upload/c_lpad,h_256,w_256,f_jpg/v1456028699/hmjywirmsbcl3frjdtsn.png" />  </th>
                        			</tr>
                        		</thead>
                        		<tbody>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicitud de cuentas TECHO/TETO</strong></p><br>
    										<strong>&#161;Hemos registrado tu Solicitud!</strong></p>
    										Una vez que tu solicitud sea atendida, te enviaremos un Correo de confirmaci&oacute;n<br>
    										<p><strong>Transferir Documentos: </strong></p>
                                            <p>Correo Origen: <strong> ' . $aParam['correo_origen'].'</strong></p>
                                            <p>Correo Destino: <strong> ' . $aParam['correo_destino'].'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        			<tr>
                        				<td>
                                            <p style="padding-bottom:20px; text-align:center;"><strong>Solicita&ccedil;&atilde;o de Email TECHO/TETO</strong></p><br>
    										<strong>Registramos sua Solicita&ccedil;&atilde;o!</strong></p>
    										Assim que sua Solicita&ccedil;&atilde;o for atendida, te enviaremos un email de confirma&ccedil;&atilde;o<br>
    										<p><strong>Transferir Documentos: </strong></p>
                                            <p>Email de Origem: <strong> ' . $aParam['correo_origen'].'</strong></p>
                                            <p>Email de Destino: <strong> ' . $aParam['correo_destino'].'</strong></p>
    										<p>Pa&iacute;s: <strong> ' . $Pais['nombre']     .'</strong></p>
    										<p>Motivo: <strong> ' . $aParam['motivo'] .'</strong></p>
                        				</td>
                        			</tr>
                        		</tbody>
                        	</table>
                        </body>
                        </html>';
            
            $mail->From = 'no-reply@techo.org';
            $mail->FromName = 'Identidad Virtual - TECHO';
            
            $mail->AddAddress($cEmail);
            
            $mail->IsHTML(true);
            
            
            $mail->Subject  = "TECHO - Solicitud de Correo"; // Assunto da mensagem
            $mail->Body = "". $html . "";
            
            // Define os anexos (opcional)
            //$mail->AddAttachment("c:/temp/documento.pdf", "novo_nome.pdf");  // Insere um anexo
            
            // Envia o e-mail
            $enviado = $mail->Send();
            
            // Limpa os destinat�rios e os anexos
            $mail->ClearAllRecipients();
            $mail->ClearAttachments();
        }
        
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
        if($this->view->correo->hacer == 'Crear' || $this->view->correo->hacer == 'Recuperar contraseña' || $this->view->correo->hacer == 'Recuperar contrase�a')
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