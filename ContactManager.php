<?php
require 'DBConnect.php';
require 'Contact.php';

class ContactManager{
    
    private ?PDO $db = null;

    public function __construct(){
        $dbConnect = new DBConnect();
        $this->db = $dbConnect->getPDO();
    }

    public function findAll(){
        $contacts = [];
        $sqlQuery = 'SELECT * FROM contact';
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute();
        $data = $statement->fetchAll();
        foreach($data as $d){
            $contact = new Contact($d['name'], $d['email'], $d['phone_number'], $d['id']);
            $contacts[] = $contact;
        }
        return $contacts;
    }

    public function findById(int $id) {
        $sqlQuery = "SELECT * FROM contact WHERE id = :id";
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute([
            'id' => $id
        ]);
        $data = $statement->fetch();

        if($data === false){
            return null;
        }

        $contact = new Contact($data['name'], $data['email'], $data['phone_number'], $data['id']);

        return $contact;
    }

    public function addContact($name, $email, $phone_number){
        $sqlQuery = "INSERT INTO contact(name, email, phone_number) VALUES (:name, :email, :phone_number)";
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number
        ]);
    }

    public function deleteContact(int $id){
        $sqlQuery = "DELETE FROM contact WHERE id = :id";
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute([
            'id' => $id
        ]);
    }
}