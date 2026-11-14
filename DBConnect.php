<?php

// Load the database settings (DB_HOST, DB_NAME, DB_USER, DB_PASS)
require_once 'config.php';

/**
 * Handles the connection to the database.
 */
class DBConnect
{
    // The PDO connection. It stays null until the first call to getPDO().
    private ?PDO $db = null;

    /**
     * Returns the PDO connection, and creates it the first time it is needed.
     * Later calls reuse the same connection instead of opening a new one.
     *
     * @return PDO|null The database connection
     */
    public function getPDO(): ?PDO
    {

        // Only connect if there is no connection yet
        if ($this->db === null) {
            try {
                // Build the connection from the constants defined in config.php
                $this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS);
            } catch (PDOException $e) {
                // The connection failed: show the error and stop the program
                die('Erreur : ' . $e->getMessage());
            }
        }

        return $this->db;
    }
}
