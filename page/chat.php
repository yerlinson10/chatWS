<?php
session_start();
require 'class/class.php';

$person2;
$person1;
$tempDate;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recreación de chat exportados</title>
    <link rel="stylesheet" href="../Css/chat.css">
</head>

<body>

    <div class="chat-container">
    <div class="menu">
            <a href="../index.php">volver subir zip</a>
        </div>

        <?php foreach ($_SESSION['chats'] as $message) : ?>
        <?php
            // Extraer la fecha y el contenido del mensaje
            $message = $message . "G*W*M";
            $dateTime = getBetween($message, '[', ']');
            $messageContent = getBetween(str_replace($dateTime, "", $message), ':', 'G*W*M');
            $name = getBetween($message, '] ', ':');

            // Formatear la fecha
            $timestamp = strtotime($dateTime);
            $formattedDate = date('h:i A, d M', $timestamp);

            if (empty($person1)) {
                $person1 =  $name;
            }
            if (empty($person2) && $name !=  $person1) {
                $person2 =  $name;
            }

            if (empty($tempDate)) {
                $tempDate =  [
                    'name' => $name,
                    'date' => $formattedDate
                ];
            }

            ?>
        <?php if ($name == $person1) : ?>
            <div class="message">
                <div class="message-info user">
                    <?php if (!($tempDate['name'] == $name && $tempDate['date'] == $formattedDate)) : ?>
                        <span class="message-name"><?= $name ?></span><br>
                        <span class="message-date"><?= $formattedDate ?></span>
                    <?php endif ?>
                </div>
                <div class="user-message"><?= $messageContent ?></div>
            </div>
        <?php endif ?>

        <?php if (isset($person2)) : ?>
        <?php if ($name == $person2) : ?>
        <div class="message">
            <div class="message-info other">
                <?php if (!($tempDate['name'] == $name && $tempDate['date'] == $formattedDate)) : ?>
                    <span class="message-name"><?= $name ?></span><br>
                    <span class="message-date"><?= $formattedDate ?></span>
                <?php endif ?>
            </div>
            <div class="other-user-message"><?= $messageContent ?></div>
        </div>
        <?php endif ?>
        <?php endif ?>

        <?php
                $tempDate =  [
                    'name' => $name,
                    'date' => $formattedDate
                ];
                ?>
        <?php endforeach ?>
    </div>
</body>

</html>