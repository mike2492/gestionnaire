<?php 
class Contact{

    public function __construct(private ?string $name, private ?string $email, private ?string $phone_number, private ?int $id = null)
    {}
    
    public function getId() : ?int{
        return $this->id;
    }

    public function getName() : ?string{
        return $this->name;
    }

    public function getEmail() : ?string{
        return $this->email;
    }   

    public function getPhoneNumber() : ?string{
        return $this->phone_number;
    }

    public function setId(?int $id) : void{
        $this->id = $id;
    }

    public function setName(?string $name) : void{
        $this->name = $name;
    }

    public function setEmail(?string $email) : void{
        $this->email = $email;
    }

    public function setPhoneNumber(?string $phone_number) : void{
        $this->phone_number = $phone_number;
    }

    public function toString() : ?string{
        return "{$this->id} - {$this->name} - {$this->email} - {$this->phone_number}";
    }
}