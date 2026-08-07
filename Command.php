<?php
require 'ContactManager.php';

class Command{

    private $contactManager;

    public function __construct(){
        $this->contactManager = new ContactManager();
    }

    public function list(){
        $contacts = $this->contactManager->findAll();
        foreach($contacts as $contact){
            echo $contact->toString() . PHP_EOL;
        }
    }

    public function detail(int $id){
        $contact = $this->contactManager->findById($id);
        if($contact === null){
            echo "Aucun contact trouvé avec l'id $id" . PHP_EOL;
            return;
        }
        echo $contact->toString() . PHP_EOL;
    }

    public function create($name, $email, $phone_number){
        return $this->contactManager->addContact($name, $email, $phone_number);
    }

    public function delete(int $id){
        return $this->contactManager->deleteContact($id);
    }
}