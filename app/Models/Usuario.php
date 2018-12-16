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
        $sql .= "pais.nombre as 'Pais_Usuario', ";
        $sql .= "usuario.fecha_inc as 'Fecha de Inclusion', ";
        $sql .= "usuario.fecha_alt as 'Fecha de Cambio' ";
        $sql .= "FROM {$this->table} ";
        $sql .= "Left Join AREA on AREA.id = {$this->table}.id_area ";
        $sql .= "Left Join cargo on cargo.id = {$this->table}.id_cargo ";
        $sql .= "Left Join sede on sede.id = {$this->table}.id_sede ";
        $sql .= "Left Join pais on pais.id = sede.id_pais ";
        $sql .= "WHERE {$this->table}.borrado = 0 ";
        
        if($_SESSION['user']['pais'] != 5)
        {
            $sql .= ' AND pais.id = '. $_SESSION['user']['pais'] . ' OR usuario.id_sede is null ';
        }
        
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
        $query = "SELECT {$this->table}.*, pais.id as 'id_pais' FROM {$this->table} Left Join sede on sede.id = {$this->table}.id_sede Left Join pais on pais.id = sede.id_pais WHERE {$this->table}.email=:email";
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
        $query = "SELECT {$this->table}.*, pais.id as 'id_pais' FROM {$this->table} LEFT JOIN sede ON sede.id = {$this->table}.id_sede LEFT JOIN pais ON pais.id = sede.id_pais WHERE {$this->table}.id=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectAreas()
    {
        $query = "SELECT * FROM AREA WHERE borrado = 0 ORDER BY nombre asc";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectSedes()
    {
        $sql   = "SELECT ";
        $sql  .= "sede.*, ";
        $sql  .= "CONCAT(sede.nombre , ' - ' , pais.nombre) AS sede_completo ";
        $sql  .= "FROM sede ";
        $sql  .= "INNER JOIN pais ON pais.id = sede.id_pais ";
        $sql  .= "WHERE sede.borrado = 0 ";
        
        //Oficina Internacional
        if($_SESSION['user']['pais'] != 5)
        {
            $sql .= " AND sede.id_pais = " . $_SESSION['user']['pais'];
        }
        $sql  .= " ORDER BY sede.nombre ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectCargos()
    {
        $query = "SELECT * FROM cargo WHERE borrado = 0 ORDER BY nombre ASC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function selectPaises()
    {
        $query = "SELECT * FROM pais WHERE borrado = 0 ORDER BY nombre ASC";
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
        $sql .= "id_sede           = " . ($aParam['sede'] == '0' ? 'NULL' : $aParam['sede'])  .", ";
        $sql .= "id_area           = " . ($aParam['area'] == '0' ? 'NULL' : $aParam['area'])  .", ";
        $sql .= "id_cargo          = " . ($aParam['cargo'] == '0' ? 'NULL' : $aParam['cargo']).", ";
        $sql .= "id_alterador      = '" . $_SESSION['user']['id']."', ";
        $sql .= "fecha_alt         = NOW() ";
        $sql .= "WHERE id          = '" . $aParam['id']."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    /* Nao esta em uso, aqui lista toda informacao do usuario como Chefe, Cargo do Chefe, etc*/
    public function AllInfoUser($aParam)
    {
        $sql   = "SELECT ";
        $sql  .= "usuario.nombre AS 'Usuario', ";
        $sql  .= "cargo.nombre AS 'Cargo', ";
        $sql  .= "sup.nombre AS 'Superior', ";
        $sql  .= "jefe.nombre AS 'Jefe' ";
        $sql  .= "FROM {$this->table} ";
        $sql  .= "LEFT JOIN cargo ON cargo.id = usuario.id_cargo ";
        $sql  .= "LEFT JOIN usuario jefe ON jefe.id_cargo = cargo.id_superior ";
        $sql  .= "LEFT JOIN cargo sup ON sup.id = cargo.id_superior ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function SearchCorreo($correo)
    {
        $query = "SELECT * FROM correo WHERE nuevo_correo  = '" . $correo . "' AND estado_pyt = 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function UpdateUsers($aParam)
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= " picture       = '" . $aParam['picture'] ."' ";
        $sql .= " WHERE email  = '" . $aParam['email']."'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function ImportUser($correo, $nombre)
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
        $sql .= " 6, ";
        $sql .= " NULL, ";
        $sql .= " NULL, ";
        $sql .= "'". $nombre."', ";
        $sql .= "'". $correo."', ";
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
    
    public function GravaMenu($aDados)
    {
        $sql  = "";
        $sql .= "INSERT INTO menu (";
        $sql .= "status_menu, ";
        $sql .= "id_usuario) VALUES (";
        $sql .= "'". $aDados['menu']."', ";
        $sql .=      $aDados['id']. ")";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function BuscaMenu()
    {
        $sql  = "";
        $sql .= "SELECT * FROM menu WHERE id_usuario = " . $_SESSION['user']['id'];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function GeraToken($aParam)
    {
        $sql  = "";
        $sql .= "INSERT INTO token (";
        $sql .= "id, ";
        $sql .= "id_app, ";
        $sql .= "id_usuario, ";
        $sql .= "access_token, ";
        $sql .= "ip_request, ";
        $sql .= "start_session, ";
        $sql .= "timeout_session) VALUES (";
        $sql .= " NULL, ";
        $sql .= "'". $aParam['appid']."', ";
        $sql .= "'". $aParam['idUser']."', ";
        $sql .= "'". $aParam['token']."', ";
        $sql .= "'". $aParam['ip']."', ";
        $sql .= "'". $aParam['start']."', ";
        $sql .= "'". $aParam['end']."') ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function CheckApp($appID, $redirect)
    {
        $sql  = "";
        $sql .= "SELECT * FROM apps WHERE id_app = '" . $appID . "' AND redirect = '" . $redirect . "'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        return $result;
    }
    
    public function CheckExist($idUser)
    {
        $sql  = "";
        $sql .= "SELECT * FROM token WHERE id_usuario = '" . $idUser. "' AND id_app != 'Local - Login TECHO'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        return $result;
    }
    
    public function InfoToken($idUser)
    {
        $sql  = "";
        $sql .= "SELECT * FROM token WHERE id_usuario = '" . $idUser. "'";
        $stmt = $this->pdo->prepare($sql);
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
    
    public function DadosToken($token)
    {
        $sql  = "";
        $sql .= "SELECT * FROM token WHERE access_token = '" . $token. "'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $stmt->closeCursor();
        return $result;
    }
    
    public function AllToken($idUser)
    {
        $sql  = "";
        $sql .= "SELECT * FROM token WHERE id_usuario = '" . $idUser. "'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function DeleteToken($id)
    {
        $query .= "DELETE FROM token ";
        $query .= "WHERE id=:id ";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $result = $stmt->execute();
        $stmt->closeCursor();
        return $result;
    }
    
    public function SelectApps()
    {
        $sql  = "";
        $sql .= "SELECT * FROM apps";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function checkInfo($id)
    {
        $query = "SELECT * FROM usuario WHERE id = " . $id;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
}
