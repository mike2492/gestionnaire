<?php

// Entry point of the program: run it in a terminal with "php main.php".
// Available commands: list, detail <id>, create <name>, <email>, <phone>, delete <id>, quit
require 'Command.php';
$command = new Command();

// Keep asking for a command until the user quits
while (true) {
    // Wait for the user to type a line (readline returns false at the end of the input, e.g. Ctrl+D)
    $line = readline("Entrez votre commande : ");

    // "list": show all the contacts
    if ($line === "list") {
        $command->list();
    }

    // "quit": stop the program
    if ($line === "quit") {
        echo "Au revoir";
        break;
    }

    // No more input available: stop the program
    if ($line === false) {
        echo "Fin du programme";
        break;
    }

    // "detail 3": show the contact with id 3 (the id must be a number)
    if (preg_match("/^detail (\d+)$/", $line, $matches)) {
        $id = (int) $matches[1];
        $command->detail($id);
    }

    // "create Name, email@example.com, 0612345678"
    // The line is checked with a regular expression, and each part is captured:
    //   1. name: letters, spaces and hyphens only
    //   2. email: a basic email format (text@domain.ext)
    //   3. phone: 10 digits, starting with 0 followed by a digit from 1 to 9 (French number)
    if (preg_match("/^create ([A-Za-z -]+), ([A-Za-z0-9._+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}), (0[1-9]\d{8})$/", $line, $matches)) {
        $name = $matches[1];
        $email = $matches[2];
        $phone_number = $matches[3];

        $command->create($name, $email, $phone_number);
    }

    // "delete 3": remove the contact with id 3 (the id must be a number)
    if (preg_match("/^delete (\d+)$/", $line, $matches)) {
        $id = (int) $matches[1];
        $command->delete($id);
    }

    // Repeat what the user typed
    echo "Vous avez saisi : $line\n";
}
