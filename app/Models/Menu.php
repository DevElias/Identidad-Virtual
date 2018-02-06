<?php 
namespace App\Models;

use Core\BaseModel;
use PDO;


class Menu extends BaseModel
{
    protected $table = "menu";
    private $pdo;
    
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }
    
    public function BuscaStatus()
    {
        $sql  = "";
        $sql .= "SELECT * FROM {$this->table}";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $stmt->closeCursor();
        return $result;
    }
    
    public function Open()
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= " status_menu = 'skin-blue sidebar-mini' ";
        $sql .= " WHERE id_usuario = " . $_SESSION['user']['id'];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
    
    public function close()
    {
        $sql  = "";
        $sql .= "UPDATE {$this->table} SET ";
        $sql .= " status_menu = 'skin-blue sidebar-mini sidebar-collapse' ";
        $sql .= " WHERE id_usuario = " . $_SESSION['user']['id'];
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->rowCount();
        $stmt->closeCursor();
        
        return $result;
    }
}
