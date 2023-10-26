<?php
require '../src/ArchivoClass.php';

session_start();
$AC = new ArchivoClass();
    $AC->file = $_FILES;
    $AC->Descomprimir();

    if ($AC->Descomprimir()['success']) {
        $nameSpaceZip = $AC->Descomprimir()['data']['nameSpaceZip'];
        $chat = $AC->ExtractData("../storage/$nameSpaceZip/_chat.txt");
        $_SESSION['chats'] =  $chat;
        $_SESSION['nameSpaceZip'] = $nameSpaceZip;

        // foreach ($_SESSION['chats'] as $message){
        //     echo htmlspecialchars($message, ENT_QUOTES, 'UTF-8')."<br><hr><br>";
        //  }
        //  exit;

        header('Location: chat.php');
    }else {
        echo '<script> alert("'.$AC->Descomprimir()['message'].'"); </script>';
    }


?>