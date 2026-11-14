<?php

// The manager needs a database connection and the Contact class
require 'DBConnect.php';
require 'Contact.php';

/**
 * Handles every SQL query related to contacts (read, add, delete).
 * It is the only class that talks to the "contact" table.
 */
class ContactManager
{
    // The database connection used by all the methods below
    private ?PDO $db = null;

    // Get the PDO connection as soon as the manager is created
    public function __construct()
    {
        $dbConnect = new DBConnect();
        $this->db = $dbConnect->getPDO();
    }

    /**
     * Gets all the contacts from the database.
     *
     * @return Contact[] A list of Contact objects (empty if the table is empty)
     */
    public function findAll()
    {
        $contacts = [];
        $sqlQuery = 'SELECT * FROM contact';
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute();
        $data = $statement->fetchAll();
        // Turn each database row into a Contact object
        foreach ($data as $d) {
            $contact = new Contact($d['name'], $d['email'], $d['phone_number'], $d['id']);
            $contacts[] = $contact;
        }
        return $contacts;
    }

    /**
     * Gets one contact by its id.
     *
     * @param int $id The id of the contact
     * @return Contact|null The contact, or null if the id does not exist
     */
    public function findById(int $id)
    {
        // ":id" is a placeholder: the value is sent separately, which protects against SQL injection
        $sqlQuery = "SELECT * FROM contact WHERE id = :id";
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute([
            'id' => $id
        ]);
        $data = $statement->fetch();

        // fetch() returns false when no row matches
        if ($data === false) {
            return null;
        }

        $contact = new Contact($data['name'], $data['email'], $data['phone_number'], $data['id']);

        return $contact;
    }

    /**
     * Adds a new contact in the database.
     * The id is not given: the database creates it automatically.
     *
     * @param string $name The name of the contact
     * @param string $email The email of the contact
     * @param string $phone_number The phone number of the contact
     */
    public function addContact($name, $email, $phone_number)
    {
        $sqlQuery = "INSERT INTO contact(name, email, phone_number) VALUES (:name, :email, :phone_number)";
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute([
            'name' => $name,
            'email' => $email,
            'phone_number' => $phone_number
        ]);
    }

    /**
     * Deletes a contact from the database.
     * Nothing happens if the id does not exist.
     *
     * @param int $id The id of the contact to delete
     */
    public function deleteContact(int $id)
    {
        $sqlQuery = "DELETE FROM contact WHERE id = :id";
        $statement = $this->db->prepare($sqlQuery);
        $statement->execute([
            'id' => $id
        ]);
    }
}
