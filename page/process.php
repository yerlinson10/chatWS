<?php
require '../src/ArchivoClass.php';

session_start();
$AC = new ArchivoClass();
    $AC->file = $_FILES;
    $AC->Descomprimir();

    if ($AC->Descomprimir()['success']) {
        $nameSpaceZip = $AC->Descomprimir()['data']['nameSpaceZip'];
        $chat = $AC->ExtractData("../storage/$nameSpaceZip/_chat.txt");
        $_SESSION['chats'] = $chat;

        header('Location: chat.php');
    }else {
        echo '<script> alert("'.$AC->Descomprimir()['message'].'"); </script>';
    }


?>