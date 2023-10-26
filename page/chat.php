<?php
session_start();
require 'class/class.php';

$person2;
$person1;
$tempDate;
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recreación de chat exportados</title>
    <link rel="stylesheet" href="../Css/chat.css">
</head>

<body>
    <script>
        window.addEventListener("load", function () {
            var loader = document.querySelector(".loader");
            loader.style.display = "none";
        });
    </script>
<div class="loader"></div>

    <div class="chat-container">
    <div class="menu">
            <a href="../index.php">volver subir zip</a>
        </div>

        <?php foreach ($_SESSION['chats'] as $message) : ?>
        <?php
            // Extraer la fecha y el contenido del mensaje
            $message = $message . "G*W*M";
            $dateTime = getBetween($message, '[', ']');

            if (strpos($message,"adjunto") !== false) {
                if (strpos($message,".opus") !== false) {

                    $got = trim(getBetween($message, 'adjunto:', '>'));
                    $erroaudio = "Tu navegador no soporta la reproducción de audio.";
                    $roorAudio = "../storage/".$_SESSION['nameSpaceZip'].'/'.$got;
                    $divAuio = '<div class="audio-player">';
                    $messageContent = $divAuio."<audio controls> <source src='$roorAudio' type='audio/mpeg'>".$erroaudio."</audio></div>";
                    
                }else if (strpos($message,".jpg") !== false || strpos($message,".png") !== false) {

                    $got = trim(getBetween($message, 'adjunto:', '>'));
                    $messageContent = "<img src='../storage/".$_SESSION['nameSpaceZip'].'/'.$got."' alt=''class='img'>";
                
                }else {
                    $messageContent = getBetween(str_replace($dateTime, "", $message), ':', 'G*W*M');
                }
            }else {
                $messageContent = getBetween(str_replace($dateTime, "", $message), ':', 'G*W*M');
            }

            
            $name = getBetween($message, '] ', ':');

            // Formatear la fecha
            $dateTime = str_replace("p. m.", "PM", $dateTime);
            $dateTime = str_replace("a. m.", "AM", $dateTime);
            $dateTime = explode(",", $dateTime);

            $hour = $dateTime[1];
            $fecha = $dateTime[0];
            $got = explode(":",$dateTime[1]);
            
            if (strpos($got[2],"PM") !== false) {
                $hour = $got[0].':'.$got[1].' PM';  
            }else if (strpos($got[2],"AM") !== false){
                $hour = $got[0].':'.$got[1].' AM';  
            }else{
                $hour = $got[0].':'.$got[1];  
            }

            if (empty($person1)) {
                $person1 =  $name;
            }
            if (empty($person2) && $name !=  $person1) {
                $person2 =  $name;
            }

            if (empty($tempDate)) {
                $tempDate =  [
                    'name' => '',
                    'date' => '',
                    'fecha' => ''
                ];
            }

            ?>
        <?php if (!($tempDate['fecha'] == $fecha)) : ?>
            <div class="fecha">
                <h1><?= $fecha ?></h1>  
            </div>
        <?php endif ?>
          
        <?php if ($name == $person1) : ?>
            <div class="message">
                <div class="message-info user">
                    <?php if (!($tempDate['name'] == $name)) : ?>
                        <span class="message-name"><?= $name ?></span><br>
                    <?php endif ?>
                </div>
                <div class="user-message"><?= $messageContent ?></div>
                <div class="message-info user">
                    <?php if (!($tempDate['date'] == $hour)) : ?>
                        <span class="message-date"><?= $hour ?></span>
                    <?php endif ?>
                </div>
            </div>
        <?php endif ?>
        
        <?php if (isset($person2)) : ?>
        <?php if ($name == $person2) : ?>
        <div class="message">
            <div class="message-info other">
                <?php if (!($tempDate['name'] == $name)) : ?>
                    <span class="message-name"><?= $name ?></span><br>
                <?php endif ?>
            </div>
            <div class="other-user-message"><?= $messageContent ?></div>
            <div class="message-info other">
                <?php if (!($tempDate['date'] == $hour)) : ?>
                    <span class="message-date"><?= $hour ?></span>
                <?php endif ?> 
            </div>
        </div>
        <?php endif ?>
        <?php endif ?>

        <?php
                $tempDate =  [
                    'name' => $name,
                    'date' => $hour,
                    'fecha' => $fecha
                ];
                ?>
        <?php endforeach ?>
    </div>
</body>

</html>