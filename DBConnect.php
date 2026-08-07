<?php
class DBConnect{

    private ?PDO $db = null;

    public function getPDO() : ?PDO{
        
        if($this->db === null){
            try{
                $this->db = new PDO('mysql:host=localhost;dbname=gestionnaire;charset=utf8', 'root', '');
            }catch(PDOException $e){
                die('Erreur : ' . $e->getMessage());
            }
        }

        return $this->db;
    }        
}