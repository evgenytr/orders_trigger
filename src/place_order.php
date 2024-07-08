<?php
require_once ('storage.php');

if(isset($_POST['product'],$_POST['quantity'])) {
    $storage = new Storage();
    $storage->connect();
    $storage->saveOrder($_POST['product'],$_POST['quantity']);
    $storage->disconnect();
}

header('Location: /');
?>