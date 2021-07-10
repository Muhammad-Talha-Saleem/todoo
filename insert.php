<?php
require_once "vendor/autoload.php";

ORM::configure('mysql:host=localhost;dbname=test');
ORM::configure('username', 'root');
ORM::configure('password', '');
function insert(){
    //Insert into database
    if(isset($_POST['submit'])) {
        // Create a new contact object
        $contact = ORM::for_table('listitems')->create();

        // SHOULD BE MORE ERROR CHECKING HERE!

        // Set the properties of the object
        $contact->id=$_POST['id'];
        $contact->name = $_POST['name'];
        $contact->orderID = isset($_POST['orderID']) ? $_POST['orderID'] : '';

        // Save the object to the database
        $contact->save();
        
        // Redirect to self.
        header('Location:index.php');
        exit;
    }
}

return insert();
        
    
?>