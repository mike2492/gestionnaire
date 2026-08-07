<?php
require 'Command.php';
$command = new Command();

while (true) {
    $line = readline("Entrez votre commande : ");
    
    if($line === "list"){
        $command->list();      
    }

    if($line === "quit"){
        echo "Au revoir";
        break;
    }

    if($line === false){
        echo "Fin du programme";
        break;
    }

    if(preg_match("/^detail (\d+)$/", $line, $matches)){
        $id = (int) $matches[1];
        $command->detail($id);
    }

    if(preg_match("/^create ([A-Za-z -]+), ([A-Za-z0-9._+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}), (0[1-9]\d{8})$/", $line, $matches)){
        $name = $matches[1];
        $email = $matches[2];
        $phone_number = $matches[3];

        $command->create($name, $email, $phone_number);
    }

    if(preg_match("/^delete (\d+)$/", $line, $matches)){
        $id = (int) $matches[1];
        $command->delete($id);
    }

    echo "Vous avez saisi : $line\n";
}