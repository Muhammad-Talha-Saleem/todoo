<?php
require_once "vendor/autoload.php";


ORM::configure('mysql:host=localhost;dbname=test');
ORM::configure('username', 'root');
ORM::configure('password', '');
function delete(){
    if (!empty($_GET)) {
        $id=$_GET['id'];
    

        $person = ORM::for_table('listitems')
        ->where_equal('id', $id)
        ->delete_many()
        ->save;
        header('Location:index.php');
        exit;
    
    }
}
delete();

?>