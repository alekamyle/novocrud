<?php
include_once('conexao/conexao.php'); 

$db = new Database();

class Crud{
    private $conn;
    private $table_name = "tenis";

    public function __construct($db){
        $this->conn = $db;
    }

    public function create($postValues){
        
        $marca = $postValues['marca'];
        $cor = $postValues['cor'];
        $tamanho = $postValues['tamanho'];
       
       

        $query = "INSERT INTO ". $this->table_name . " ( marca, cor,tamanho) VALUES (?,?,?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$marca);
        $stmt->bindParam(2,$cor);
        $stmt->bindParam(3,$tamanho);

        $rows = $this->read();
        if($stmt->execute()){
            print "<script>alert('Cadastro Ok!')</script>";
            print "<script> location.href='?action=read'; </script>";
            return true;
        }else{
            return false;
        }
    }

    public function read(){
        $query = "SELECT * FROM ". $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function update($postValues){
        
        $id = $postValues['id'];
        $marca = $postValues['marca'];
        $cor = $postValues['cor'];
        $tamanho = $postValues['tamanho'];

        if(empty($id) || empty($marca) ||  empty($cor) || empty($tamanho)){
            return false;
        }
        
        $query = "UPDATE ". $this->table_name . " SET  marca = ?,cor = ?, tamanho = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1,$marca);
        $stmt->bindParam(2,$cor);
        $stmt->bindParam(3,$tamanho);
        $stmt->bindParam(4,$id);
        if($stmt->execute()){
            return true;
        }else{
            return false;
        }

    }
        public function readOne($id){
            $query = "SELECT * FROM ". $this->table_name . " WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

        }

        public function delete($id){
            $query = "DELETE FROM  ". $this->table_name . " WHERE id = ?";
            $stmt =$this->conn->prepare($query);
            $stmt->bindParam(1,$id);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
            }
    }

    
    
?>