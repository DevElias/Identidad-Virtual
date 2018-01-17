<?php 
namespace App\Models;

use Core\BaseModel;
use PDO;


class Usuario extends BaseModel
{
    protected $table = "usuario";
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function select()
    {
        $sql  = "";
        $sql .= "SELECT ";
        $sql .= "usuario.id     as 'ID_Usuario', ";
        $sql .= "usuario.nombre as 'Nombre_Usuario', ";
        $sql .= "usuario.email  as 'Email_Usuario', ";
        $sql .= "usuario.status as 'Status_Usuario', ";
        $sql .= "usuario.picture as 'Picture_Usuario', ";
        $sql .= "AREA.nombre as 'Area_Usuario', ";
        $sql .= "cargo.nombre as 'Cargo_Usuario', ";
        $sql .= "usuario.fecha_inc as 'Fecha de Inclusion', ";
        $sql .= "usuario.fecha_alt as 'Fecha de Cambio' ";
        $sql .= "FROM {$this->table} ";
        $sql .= "Left Join AREA on AREA.id = {$this->table}.id_area ";
        $sql .= "Left Join cargo on cargo.id = {$this->table}.id_cargo ";
        $sql .= "WHERE {$this->table}.borrado = 0 ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function InsertUser($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
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
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= "'". $aParam['name']."', ";
        $sql .= "'". $aParam['email']."', ";
        $sql .= "'". $aParam['picture']."', ";
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
    
    public function SearchUser($email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email=:email";
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
    
    public function DataUser($email)
    {
        $query = "SELECT * FROM {$this->table} WHERE email=:email";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
     
        return $result;
    }
    
    public function delete($id)
    {
        $query .= "UPDATE {$this->table} SET ";
        $query .= "borrado = 1 ";
        $query .= "WHERE id=:id ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
    
    public function search($id)
    {
        $query = "SELECT * FROM {$this->table} WHERE id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectAreas()
    {
        $query = "SELECT * FROM area WHERE borrado = 0";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectSedes()
    {
        $query = "SELECT * FROM sede WHERE borrado = 0";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectCargos()
    {
        $query = "SELECT * FROM cargo WHERE borrado = 0";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function ActualizarUsuario($aParam)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= "id_sede           = '" . $aParam['sede']."', ";
        $sql .= "id_area           = '" . $aParam['area']."', ";
        $sql .= "id_cargo          = '" . $aParam['cargo']."', ";
        $sql .= "id_alterador      = '" . $_SESSION['user']['id']."', ";
        $sql .= "fecha_alt         = NOW() ";
        $sql .= "WHERE id          = '" . $aParam['id']."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    
}
