<?php 
namespace App\Models;

use Core\BaseModel;
use PDO;


class Sede extends BaseModel
{
    protected $table = "sede";
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function select()
    {
        $sql  = "";
        $sql .= "SELECT ";
        $sql .= "{$this->table}.id     as 'ID_Sede', ";
        $sql .= "{$this->table}.nombre as 'Nombre_Sede', ";
        $sql .= "pais.id as 'Pais_ID', ";
        $sql .= "pais.nombre as 'Pais_Nombre', ";
        $sql .= "{$this->table}.status as 'Status_Sede', ";
        $sql .= "{$this->table}.fecha_inc as 'Fecha de Inclusion', ";
        $sql .= "{$this->table}.fecha_alt as 'Fecha de Cambio' ";
        $sql .= "FROM {$this->table} ";
        $sql .= "Inner Join pais on pais.id = {$this->table}.id_pais ";
        $sql .= "WHERE {$this->table}.borrado = 0  ORDER BY {$this->table}.id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function GuardarSede($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO {$this->table} (";
        $sql .= "id, ";
        $sql .= "nombre, ";
        $sql .= "id_pais, ";
        $sql .= "status, ";
        $sql .= "borrado, ";
        $sql .= "id_creador, ";
        $sql .= "id_alterador, ";
        $sql .= "fecha_inc, ";
        $sql .= "fecha_alt) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $aParam['nombre']."', ";
        $sql .= "'". $aParam['pais']."', ";
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
        $sql .= "SELECT ";
        $sql .= "{$this->table}.id     as 'ID_Sede', ";
        $sql .= "{$this->table}.nombre as 'Nombre_Sede', ";
        $sql .= "pais.nombre as 'Pais_Nombre', ";
        $sql .= "pais.id as 'ID_Pais', ";
        $sql .= "{$this->table}.status as 'Status_Sede' ";
        $sql .= "FROM {$this->table} ";
        $sql .= "Inner Join pais on pais.id = {$this->table}.id_pais ";
        $sql .= "WHERE {$this->table}.id = " . $id;
        $stmt = $this->pdo->prepare($sql);
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
        $query .= " ORDER BY {$this->table}.nombre ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectPaises()
    {
        $query = "SELECT * FROM pais ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function ActualizarSede($aParam)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= "nombre            = '" . $aParam['nombre']."', ";
        $sql .= "id_pais           = '" . $aParam['pais']."', ";
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
