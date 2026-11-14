<?php

/**
 * A contact: a person with a name, an email and a phone number.
 * The id is null until the contact is saved in the database.
 */
class Contact
{
    // Constructor promotion: each "private" parameter is also created as a property.
    // The id is optional because a new contact does not have one yet.
    public function __construct(private ?string $name, private ?string $email, private ?string $phone_number, private ?int $id = null)
    {
    }

    // Getters: read the value of each property
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    // Setters: change the value of each property
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(?string $email): void
    {
        $this->email = $email;
    }

    public function setPhoneNumber(?string $phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    /**
     * Returns the contact as one line of text, to display it in the terminal.
     * Format: "id - name - email - phone number"
     */
    public function toString(): ?string
    {
        return "{$this->id} - {$this->name} - {$this->email} - {$this->phone_number}";
    }
}
