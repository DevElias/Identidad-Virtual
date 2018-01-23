<?php 
namespace App\Models;

use Core\BaseModel;
use PDO;


class Correo extends BaseModel
{
    protected $table = "correo";
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function CrearCorreo($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "fecha_solicitud, ";
        $sql .= "email_address, ";
        $sql .= "hacer, ";
        $sql .= "id_pais, ";
        $sql .= "apellido, ";
        $sql .= "nombre, ";
        $sql .= "nuevo_correo, ";
        $sql .= "id_area, ";
        $sql .= "id_superior, ";
        $sql .= "cuenta_real, ";
        $sql .= "alias, ";
        $sql .= "modificar, ";
        $sql .= "correo_recuperar_contrasena, ";
        $sql .= "correo_suspender, ";
        $sql .= "correo_eliminar, ";
        $sql .= "transferir_documentos, ";
        $sql .= "cuenta_origen, ";
        $sql .= "cuenta_destino, ";
        $sql .= "motivo, ";
        $sql .= "contrasena_temporal, ";
        $sql .= "estado_personas, ";
        $sql .= "estado_pyt, ";
        $sql .= "comentario, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= " NOW(), ";
        $sql .= "'". $_SESSION['user']['email']."', ";
        $sql .= "'". $aParam['hacer']."', ";
        $sql .= "'". $aParam['pais']."', ";
        $sql .= "'". $aParam['appelido']."', ";
        $sql .= "'". $aParam['nombre']."', ";
        $sql .= "'". $aParam['correo']."', ";
        $sql .= "'". $aParam['area']."', ";
        $sql .= "'". $aParam['rol']."', ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= "'". $aParam['motivo']."', ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= "'". $_SESSION['user']['id']."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function nickname($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "fecha_solicitud, ";
        $sql .= "email_address, ";
        $sql .= "hacer, ";
        $sql .= "id_pais, ";
        $sql .= "apellido, ";
        $sql .= "nombre, ";
        $sql .= "nuevo_correo, ";
        $sql .= "id_area, ";
        $sql .= "id_superior, ";
        $sql .= "cuenta_real, ";
        $sql .= "alias, ";
        $sql .= "modificar, ";
        $sql .= "correo_recuperar_contrasena, ";
        $sql .= "correo_suspender, ";
        $sql .= "correo_eliminar, ";
        $sql .= "transferir_documentos, ";
        $sql .= "cuenta_origen, ";
        $sql .= "cuenta_destino, ";
        $sql .= "motivo, ";
        $sql .= "contrasena_temporal, ";
        $sql .= "estado_personas, ";
        $sql .= "estado_pyt, ";
        $sql .= "comentario, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= " NOW(), ";
        $sql .= "'". $_SESSION['user']['email']."', ";
        $sql .= "'". $aParam['hacer']."', ";
        $sql .= "'". $aParam['pais']."', ";
        $sql .= " NULL, "; //apellido
        $sql .= " NULL, "; //nombre
        $sql .= " NULL, "; //nuevo correo
        $sql .= " NULL, "; //id area
        $sql .= " NULL, "; // id superior
        $sql .= " NULL, "; // cuenta_origen
        $sql .= "'". $aParam['cuentareal']."', ";
        $sql .= "'". $aParam['alias']."', ";
        $sql .= " NULL, ";// modificar
        $sql .= " NULL, ";//correo_recuperar_contrasena
        $sql .= " NULL, ";//correo_suspender
        $sql .= " NULL, ";//correo_eliminar
        $sql .= " NULL, ";//transferir_documentos
        $sql .= " NULL, ";//cuenta_origen
        $sql .= "'". $aParam['motivo']."', ";
        $sql .= " NULL, "; //contrasena_temporal
        $sql .= " NULL, ";//estado_personas
        $sql .= " NULL, ";//estado_pyt
        $sql .= " NULL, ";//comentario
        $sql .= "'". $_SESSION['user']['id']."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function modificar($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "fecha_solicitud, ";
        $sql .= "email_address, ";
        $sql .= "hacer, ";
        $sql .= "id_pais, ";
        $sql .= "apellido, ";
        $sql .= "nombre, ";
        $sql .= "nuevo_correo, ";
        $sql .= "id_area, ";
        $sql .= "id_superior, ";
        $sql .= "cuenta_real, ";
        $sql .= "alias, ";
        $sql .= "modificar, ";
        $sql .= "correo_recuperar_contrasena, ";
        $sql .= "correo_suspender, ";
        $sql .= "correo_eliminar, ";
        $sql .= "transferir_documentos, ";
        $sql .= "cuenta_origen, ";
        $sql .= "cuenta_destino, ";
        $sql .= "motivo, ";
        $sql .= "contrasena_temporal, ";
        $sql .= "estado_personas, ";
        $sql .= "estado_pyt, ";
        $sql .= "comentario, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, "; //id
        $sql .= " NOW(), "; //fecha_solicitud
        $sql .= "'". $_SESSION['user']['email']."', "; //email_address
        $sql .= "'". $aParam['hacer']."', "; //hacer
        $sql .= "'". $aParam['pais']."', "; //id_pais
        $sql .= " NULL, "; //apellido
        $sql .= " NULL, "; //nombre
        $sql .= " NULL, "; //nuevo correo
        $sql .= " NULL, "; //id area
        $sql .= " NULL, "; // id superior
        $sql .= " NULL, "; // cuenta_real
        $sql .= " NULL, ";// alias
        $sql .= "'". $aParam['modify']."', ";// modificar
        $sql .= " NULL, ";// correo_recuperar_contrasena
        $sql .= " NULL, ";//correo_suspender
        $sql .= " NULL, ";//correo_eliminar
        $sql .= " NULL, ";//transferir_documentos
        $sql .= " NULL, ";//cuenta_origen
        $sql .= " NULL, ";//cuenta_destino
        $sql .= "'". $aParam['motivo']."', "; //motivo
        $sql .= " NULL, "; //contrasena_temporal
        $sql .= " NULL, ";//estado_personas
        $sql .= " NULL, ";//estado_pyt
        $sql .= " NULL, ";//comentario
        $sql .= "'". $_SESSION['user']['id']."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function recuperar($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "fecha_solicitud, ";
        $sql .= "email_address, ";
        $sql .= "hacer, ";
        $sql .= "id_pais, ";
        $sql .= "apellido, ";
        $sql .= "nombre, ";
        $sql .= "nuevo_correo, ";
        $sql .= "id_area, ";
        $sql .= "id_superior, ";
        $sql .= "cuenta_real, ";
        $sql .= "alias, ";
        $sql .= "modificar, ";
        $sql .= "correo_recuperar_contrasena, ";
        $sql .= "correo_suspender, ";
        $sql .= "correo_eliminar, ";
        $sql .= "transferir_documentos, ";
        $sql .= "cuenta_origen, ";
        $sql .= "cuenta_destino, ";
        $sql .= "motivo, ";
        $sql .= "contrasena_temporal, ";
        $sql .= "estado_personas, ";
        $sql .= "estado_pyt, ";
        $sql .= "comentario, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, "; //id
        $sql .= " NOW(), "; //fecha_solicitud
        $sql .= "'". $_SESSION['user']['email']."', "; //email_address
        $sql .= "'". $aParam['hacer']."', "; //hacer
        $sql .= "'". $aParam['pais']."', "; //id_pais
        $sql .= " NULL, "; //apellido
        $sql .= " NULL, "; //nombre
        $sql .= " NULL, "; //nuevo correo
        $sql .= " NULL, "; //id area
        $sql .= " NULL, "; // id superior
        $sql .= " NULL, "; // cuenta_real
        $sql .= " NULL, ";// alias
        $sql .= " NULL, ";// modificar
        $sql .= "'". $aParam['correo_recuperar']."', ";// correo_recuperar_contrasena
        $sql .= " NULL, ";//correo_suspender
        $sql .= " NULL, ";//correo_eliminar
        $sql .= " NULL, ";//transferir_documentos
        $sql .= " NULL, ";//cuenta_origen
        $sql .= " NULL, ";//cuenta_destino
        $sql .= "'". $aParam['motivo']."', "; //motivo
        $sql .= " NULL, "; //contrasena_temporal
        $sql .= " NULL, ";//estado_personas
        $sql .= " NULL, ";//estado_pyt
        $sql .= " NULL, ";//comentario
        $sql .= "'". $_SESSION['user']['id']."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function suspender($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "fecha_solicitud, ";
        $sql .= "email_address, ";
        $sql .= "hacer, ";
        $sql .= "id_pais, ";
        $sql .= "apellido, ";
        $sql .= "nombre, ";
        $sql .= "nuevo_correo, ";
        $sql .= "id_area, ";
        $sql .= "id_superior, ";
        $sql .= "cuenta_real, ";
        $sql .= "alias, ";
        $sql .= "modificar, ";
        $sql .= "correo_recuperar_contrasena, ";
        $sql .= "correo_suspender, ";
        $sql .= "correo_eliminar, ";
        $sql .= "transferir_documentos, ";
        $sql .= "cuenta_origen, ";
        $sql .= "cuenta_destino, ";
        $sql .= "motivo, ";
        $sql .= "contrasena_temporal, ";
        $sql .= "estado_personas, ";
        $sql .= "estado_pyt, ";
        $sql .= "comentario, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, "; //id
        $sql .= " NOW(), "; //fecha_solicitud
        $sql .= "'". $_SESSION['user']['email']."', "; //email_address
        $sql .= "'". $aParam['hacer']."', "; //hacer
        $sql .= "'". $aParam['pais']."', "; //id_pais
        $sql .= " NULL, "; //apellido
        $sql .= " NULL, "; //nombre
        $sql .= " NULL, "; //nuevo correo
        $sql .= " NULL, "; //id area
        $sql .= " NULL, "; // id superior
        $sql .= " NULL, "; // cuenta_real
        $sql .= " NULL, ";// alias
        $sql .= " NULL, ";// modificar
        $sql .= " NULL, ";// correo_recuperar_contrasena
        $sql .= "'". $aParam['correo_suspender']."', ";//correo_suspender
        $sql .= " NULL, ";//correo_eliminar
        $sql .= " NULL, ";//transferir_documentos
        $sql .= " NULL, ";//cuenta_origen
        $sql .= " NULL, ";//cuenta_destino
        $sql .= "'". $aParam['motivo']."', "; //motivo
        $sql .= " NULL, "; //contrasena_temporal
        $sql .= " NULL, ";//estado_personas
        $sql .= " NULL, ";//estado_pyt
        $sql .= " NULL, ";//comentario
        $sql .= "'". $_SESSION['user']['id']."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function eliminar($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "fecha_solicitud, ";
        $sql .= "email_address, ";
        $sql .= "hacer, ";
        $sql .= "id_pais, ";
        $sql .= "apellido, ";
        $sql .= "nombre, ";
        $sql .= "nuevo_correo, ";
        $sql .= "id_area, ";
        $sql .= "id_superior, ";
        $sql .= "cuenta_real, ";
        $sql .= "alias, ";
        $sql .= "modificar, ";
        $sql .= "correo_recuperar_contrasena, ";
        $sql .= "correo_suspender, ";
        $sql .= "correo_eliminar, ";
        $sql .= "transferir_documentos, ";
        $sql .= "cuenta_origen, ";
        $sql .= "cuenta_destino, ";
        $sql .= "motivo, ";
        $sql .= "contrasena_temporal, ";
        $sql .= "estado_personas, ";
        $sql .= "estado_pyt, ";
        $sql .= "comentario, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, "; //id
        $sql .= " NOW(), "; //fecha_solicitud
        $sql .= "'". $_SESSION['user']['email']."', "; //email_address
        $sql .= "'". $aParam['hacer']."', "; //hacer
        $sql .= "'". $aParam['pais']."', "; //id_pais
        $sql .= " NULL, "; //apellido
        $sql .= " NULL, "; //nombre
        $sql .= " NULL, "; //nuevo correo
        $sql .= " NULL, "; //id area
        $sql .= " NULL, "; // id superior
        $sql .= " NULL, "; // cuenta_real
        $sql .= " NULL, ";// alias
        $sql .= " NULL, ";// modificar
        $sql .= " NULL, ";// correo_recuperar_contrasena
        $sql .= " NULL, ";//correo_suspender
        $sql .= "'". $aParam['correo_eliminar']."', ";//correo_eliminar
        $sql .= "'". $aParam['transferDoc']."', ";//transferir_documentos
        $sql .= "'". $aParam['correo_origen']."', ";//cuenta_origen
        $sql .= "'". $aParam['correo_destino']."', ";//cuenta_destino
        $sql .= "'". $aParam['motivo']."', "; //motivo
        $sql .= " NULL, "; //contrasena_temporal
        $sql .= " NULL, ";//estado_personas
        $sql .= " NULL, ";//estado_pyt
        $sql .= " NULL, ";//comentario
        $sql .= "'". $_SESSION['user']['id']."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function transferir($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "fecha_solicitud, ";
        $sql .= "email_address, ";
        $sql .= "hacer, ";
        $sql .= "id_pais, ";
        $sql .= "apellido, ";
        $sql .= "nombre, ";
        $sql .= "nuevo_correo, ";
        $sql .= "id_area, ";
        $sql .= "id_superior, ";
        $sql .= "cuenta_real, ";
        $sql .= "alias, ";
        $sql .= "modificar, ";
        $sql .= "correo_recuperar_contrasena, ";
        $sql .= "correo_suspender, ";
        $sql .= "correo_eliminar, ";
        $sql .= "transferir_documentos, ";
        $sql .= "cuenta_origen, ";
        $sql .= "cuenta_destino, ";
        $sql .= "motivo, ";
        $sql .= "contrasena_temporal, ";
        $sql .= "estado_personas, ";
        $sql .= "estado_pyt, ";
        $sql .= "comentario, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, "; //id
        $sql .= " NOW(), "; //fecha_solicitud
        $sql .= "'". $_SESSION['user']['email']."', "; //email_address
        $sql .= "'". $aParam['hacer']."', "; //hacer
        $sql .= "'". $aParam['pais']."', "; //id_pais
        $sql .= " NULL, "; //apellido
        $sql .= " NULL, "; //nombre
        $sql .= " NULL, "; //nuevo correo
        $sql .= " NULL, "; //id area
        $sql .= " NULL, "; // id superior
        $sql .= " NULL, "; // cuenta_real
        $sql .= " NULL, ";// alias
        $sql .= " NULL, ";// modificar
        $sql .= " NULL, ";// correo_recuperar_contrasena
        $sql .= " NULL, ";//correo_suspender
        $sql .= " NULL, ";//correo_eliminar
        $sql .= " NULL, ";//transferir_documentos
        $sql .= "'". $aParam['correo_origen']."', ";//cuenta_origen
        $sql .= "'". $aParam['correo_destino']."', ";//cuenta_destino
        $sql .= "'". $aParam['motivo']."', "; //motivo
        $sql .= " NULL, "; //contrasena_temporal
        $sql .= " NULL, ";//estado_personas
        $sql .= " NULL, ";//estado_pyt
        $sql .= " NULL, ";//comentario
        $sql .= "'". $_SESSION['user']['id']."', ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
}
