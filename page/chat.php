<?php
session_start();

function getBetween(string $content = '', string $start = '', string $end = '', $trim = true): string
{
    $startPos = strstr($content, $start);
    if ($startPos === false) {
        return '';
    }
    $startPos = substr($startPos, strlen($start));
    $endPos = strstr($startPos, $end);
    if ($endPos === false) {
        return '';
    }
    $result = substr($startPos, 0, -strlen($endPos));
    return $result;
}

$person2;
$person1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Similar a WhatsApp (Dark Theme)</title>
    <link rel="stylesheet" href="../Css/chat.css">
</head>

<body>
    <div class="chat-container">
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


            if (!empty($person1)) {
                $tempDate =   $formattedDate;
            }else{
                $tempData = $formattedDate;
            }
            ?>
            <?php if ($name == $person1) : ?>
                <div class="message">
                    <div class="message-info user">
                        <span class="message-name"><?= $name ?></span>
                    </div>
                    <div class="user-message"><?= $messageContent ?></div>
                    <div class="message-info user">
                        <span class="message-date"><?= $formattedDate ?></span>  
                </div>
            <?php endif ?>

            <?php if ($name == $person2) : ?>
                <div class="message">
                    <div class="message-info other">
                        <span class="message-name"><?= $name ?></span>
                    </div>
                    <div class="other-user-message"><?= $messageContent ?></div>
                    <div class="message-info other">
                        <span class="message-date"><?= $formattedDate ?></span>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</body>

</html>