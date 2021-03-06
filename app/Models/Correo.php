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
        $sql .= "id_sede, ";
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
        $sql .= "'". $aParam['sede']."', ";
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
        $sql .= "id_sede, ";
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
        $sql .= "'". $aParam['sede']."', ";
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
        $sql .= "id_sede, ";
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
        $sql .= "'". $aParam['sede']."', ";
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
        $sql .= "id_sede, ";
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
        $sql .= "'". $aParam['sede']."', ";
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
        $sql .= "id_sede, ";
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
        $sql .= "'". $aParam['sede']."', ";
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
        $sql .= "id_sede, ";
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
        $sql .= "'". $aParam['sede']."', ";
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
        $sql .= "id_sede, ";
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
        $sql .= "'". $aParam['sede']."', ";
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
    
    public function select()
    {
        $sql  = "";
        $sql .= "SELECT  * ";
        $sql .= "FROM {$this->table} ";
        $sql .= "WHERE (estado_pyt is null) OR (estado_pyt = 0)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function search($id)
    {
        $query = "SELECT {$this->table}.*, pais.nombre as 'nombre_pais', sede.nombre as 'nombre_sede', AREA.nombre as 'nombre_area', cargo.nombre as 'nombre_cargo' FROM {$this->table} Left Join pais ON pais.id = {$this->table}.id_pais Left Join sede ON sede.id = {$this->table}.id_sede Left Join AREA ON AREA.id = {$this->table}.id_area Left Join cargo ON cargo.id = {$this->table}.id_superior WHERE {$this->table}.id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function aprobar($id)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= "estado_personas   = 1, ";
        $sql .= "id_alterador      = '" . $_SESSION['user']['id']."', ";
        $sql .= "fecha_alt         = NOW() ";
        $sql .= "WHERE id          = '" . $id."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function reprobado($id)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= "estado_personas   = 2, ";
        $sql .= "id_alterador      = '" . $_SESSION['user']['id']."', ";
        $sql .= "fecha_alt         = NOW() ";
        $sql .= "WHERE id          = '" . $id."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function exportar()
    {
        $query = "SELECT nuevo_correo as 'email_address', nombre as 'first_name', apellido as 'last_name', concat('Techo',YEAR(NOW())) as 'password' FROM {$this->table} WHERE estado_personas = 1 AND hacer = 'Crear' AND estado_pyt is null";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function ActualizarCorreo($aParam)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= "contrasena_temporal = '" . $aParam['contrasena']."', ";
        $sql .= "estado_personas     = '" . $aParam['estadoPersonas']."', ";
        $sql .= "estado_pyt          = '" . $aParam['estadoPyt']."', ";
        $sql .= "comentario          = '" . $aParam['comentario']."', ";
        $sql .= "id_alterador      = '" . $_SESSION['user']['id']."', ";
        $sql .= "fecha_alt         = NOW() ";
        $sql .= "WHERE id          = '" . $aParam['id']."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function searchPais($id)
    {
        $query = "SELECT * FROM pais WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function searchArea($id)
    {
        $query = "SELECT * FROM AREA WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function searchRol($id)
    {
        $query = "SELECT * FROM cargo WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function CheckCorreo($correo)
    {
        $query = "SELECT * FROM usuario WHERE email = '" . $correo . "'";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        
        if($result)
        {
            $return = true;
        }
        else
        {
            $return = false;
        }
        
        return $return;
    }
    
    public function SearchSede($id)
    {
        $query = "SELECT * FROM sede WHERE id_pais=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function SearchUser($email)
    {
        $query = "SELECT * FROM usuario WHERE email=:email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        if($result == 1)
        {
            $ret = true;
        }
        else
        {
            $ret = false;
        }
        return $ret;
    }
    
    public function InsertUser($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO usuario (";
        $sql .= "id, ";
        $sql .= "id_sede, ";
        $sql .= "id_area, ";
        $sql .= "id_cargo, ";
        $sql .= "nombre, ";
        $sql .= "email, ";
        $sql .= "picture, ";
        $sql .= "status, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $aParam['id_sede']."', ";
        $sql .= "'". $aParam['id_area']."', ";
        $sql .= "'". $aParam['id_superior']."', ";
        $sql .= "'". $aParam['nombre']."', ";
        $sql .= "'". $aParam['nuevo_correo']."', ";
        $sql .= "'/sin_imagen.jpg',";
        $sql .= " 1, ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function selectAll()
    {
        $query = "SELECT * FROM correo Order By fecha_solicitud DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
}
