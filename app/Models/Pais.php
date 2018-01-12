<?php 
namespace App\Models;

use Core\BaseModel;
use PDO;


class Pais extends BaseModel
{
    protected $table = "pais";
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function select()
    {
        $sql  = "";
        $sql .= "SELECT ";
        $sql .= "id     as 'ID_Pais', ";
        $sql .= "nombre as 'Nombre_Pais', ";
        $sql .= "codigo as 'Codigo_Pais', ";
        $sql .= "status as 'Status_Pais', ";
        $sql .= "fecha_inc as 'Fecha de Inclusion', ";
        $sql .= "fecha_alt as 'Fecha de Cambio' ";
        $sql .= "FROM {$this->table} ";
        $sql .= "WHERE borrado = 0 ";
        $stmt = $this->pdo->prepare($sql);
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
    
    public function GuardarPais($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "status, ";
        $sql .= "borrado, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $aParam['nombre']."', ";
        $sql .= "'". $aParam['codigo']."', ";
        $sql .= "'". $aParam['status']."', ";
        $sql .= " 0, ";
        $sql .= " 0, ";
        $sql .= " 0, ";
        $sql .= " NOW(), ";
        $sql .= " '0000-00-00 00:00:00')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function ActualizarPais($aParam)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= "nombre            = '" . $aParam['nombre']."', ";
        $sql .= "codigo            = '" . $aParam['codigo']."', ";
        $sql .= "status            = '" . $aParam['status']."', ";
        $sql .= "borrado           = 0, ";
        $sql .= "id_alterador      = 0, ";
        $sql .= "fecha_alt         = NOW() ";
        $sql .= "WHERE id          = '" . $aParam['id']."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
}
