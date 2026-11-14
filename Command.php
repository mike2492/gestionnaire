<?php

require 'ContactManager.php';

/**
 * Links the commands typed by the user to the contact manager.
 * Each public method matches one command of the program (list, detail, create, delete).
 */
class Command
{
    // Used to read and write contacts in the database
    private $contactManager;

    public function __construct()
    {
        $this->contactManager = new ContactManager();
    }

    /**
     * Command "list": displays all the contacts, one per line.
     */
    public function list()
    {
        $contacts = $this->contactManager->findAll();
        foreach ($contacts as $contact) {
            echo $contact->toString() . PHP_EOL;
        }
    }

    /**
     * Command "detail <id>": displays one contact, or a message if it does not exist.
     *
     * @param int $id The id of the contact to display
     */
    public function detail(int $id)
    {
        $contact = $this->contactManager->findById($id);
        // No contact with this id: tell the user and stop here
        if ($contact === null) {
            echo "Aucun contact trouvé avec l'id $id" . PHP_EOL;
            return;
        }
        echo $contact->toString() . PHP_EOL;
    }

    /**
     * Command "create <name>, <email>, <phone>": saves a new contact.
     * The values are already checked in main.php before this method is called.
     */
    public function create($name, $email, $phone_number)
    {
        return $this->contactManager->addContact($name, $email, $phone_number);
    }

    /**
     * Command "delete <id>": removes a contact from the database.
     *
     * @param int $id The id of the contact to delete
     */
    public function delete(int $id)
    {
        return $this->contactManager->deleteContact($id);
    }
}
