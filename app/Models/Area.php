<?php 
namespace App\Models;

use Core\BaseModel;
use PDO;


class Area extends BaseModel
{
    protected $table = "AREA";
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function select()
    {
        $sql  = "";
        $sql .= "SELECT ";
        $sql .= "id     as 'ID_Area', ";
        $sql .= "nombre as 'Nombre_Area', ";
        $sql .= "codigo as 'Codigo_Area', ";
        $sql .= "detalle as 'Detalle_Area', ";
        $sql .= "status as 'Status_Area', ";
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
    
    public function GuardarArea($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "codigo, ";
        $sql .= "detalle, ";
        $sql .= "status, ";
        $sql .= "borrado, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $aParam['nombre']."', ";
        $sql .= "'". $aParam['codigo']."', ";
        $sql .= "'". $aParam['detalle']."', ";
        $sql .= "'". $aParam['status']."', ";
        $sql .= " 0, ";
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
    
    public function SearchAPI($aParam)
    {
        $query .= "SELECT * FROM {$this->table} WHERE ";
        for($i=0; $i < count($aParam); $i++)
        {
            if($i == 0)
            {
                $query .= $aParam[$i]['field'] . " = '" . $aParam[$i]['value'] . "' ";
            }
            else
            {
                $query .= "AND " .$aParam[$i]['field'] . " = '" . $aParam[$i]['value'] . "'";
            }
            
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function ActualizarArea($aParam)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= "nombre            = '" . $aParam['nombre']."', ";
        $sql .= "codigo            = '" . $aParam['codigo']."', ";
        $sql .= "detalle           = '" . $aParam['detalle']."', ";
        $sql .= "status            = '" . $aParam['status']."', ";
        $sql .= "borrado           = 0, ";
        $sql .= "id_alterador      = '" . $_SESSION['user']['id']."', ";
        $sql .= "fecha_alt         = NOW() ";
        $sql .= "WHERE id          = '" . $aParam['id']."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function CheckToken($token)
    {
        $sql  = "";
        $sql .= "SELECT * FROM token WHERE access_token = '" . $token. "'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        return $result;
    }
}
