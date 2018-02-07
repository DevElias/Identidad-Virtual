<?php 
namespace App\Models;

use Core\BaseModel;
use PDO;


class Cargo extends BaseModel
{
    protected $table = "cargo";
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function select()
    {
        $sql  = "";
        $sql .= "SELECT ";
        $sql .= "cargo.id     as 'ID_Cargo', ";
        $sql .= "cargo.nombre as 'Nombre_Cargo', ";
        $sql .= "cargo.status as 'Status_Cargo', ";
        $sql .= "sup.nombre as 'Superior_Cargo', ";
        $sql .= "cargo.fecha_inc as 'Fecha de Inclusion', ";
        $sql .= "cargo.fecha_alt as 'Fecha de Cambio' ";
        $sql .= "FROM {$this->table} ";
        $sql .= "Left Join cargo sup ON sup.id = cargo.id_superior ";
        $sql .= "WHERE cargo.borrado = 0 Order By cargo.nombre ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function GuardarCargo($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "detalle, ";
        $sql .= "status, ";
        $sql .= "id_superior, ";
        $sql .= "borrado, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $aParam['nombre']."', ";
        $sql .= "'". $aParam['detalle']."', ";
        $sql .= "'". $aParam['status']."', ";
        $sql .= "'". $aParam['superior']."', ";
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
        $sql  = "";
        $sql .= "SELECT ";
        $sql .= "cargo.id     as 'ID_Cargo', ";
        $sql .= "cargo.nombre as 'Nombre_Cargo', ";
        $sql .= "cargo.detalle as 'Detalle_Cargo', ";
        $sql .= "cargo.status as 'Status_Cargo', ";
        $sql .= "cargo.id_superior as 'ID_Superior', ";
        $sql .= "sup.nombre as 'Superior_Cargo', ";
        $sql .= "cargo.fecha_inc as 'Fecha de Inclusion', ";
        $sql .= "cargo.fecha_alt as 'Fecha de Cambio' ";
        $sql .= "FROM {$this->table} ";
        $sql .= "Left Join cargo sup ON sup.id = cargo.id_superior ";
        $sql .= "WHERE cargo.id = " . $id;
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectCargos()
    {
        $query = "SELECT * FROM cargo Order By cargo.nombre ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
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
    
    public function ActualizarCargo($aParam)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= "nombre            = '" . $aParam['nombre']."', ";
        $sql .= "detalle           = '" . $aParam['detalle']."', ";
        $sql .= "status            = '" . $aParam['status']."', ";
        $sql .= "id_superior       = '" . $aParam['superior']."', ";
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
}
