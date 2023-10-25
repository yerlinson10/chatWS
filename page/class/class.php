<?php

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

function searchMessages($query) {
    // Crea una lista de mensajes vacíos
    $results = array();
  
    // Recorre todos los mensajes
    foreach ($_SESSION['chats'] as $message) {
      // Extrae el contenido del mensaje
      $messageContent = getBetween($message, ':', 'G*W*M');
  
      // Busca la cadena de búsqueda en el contenido del mensaje
      if (strpos($messageContent, $query) !== false) {
        // Añade el mensaje a la lista de resultados
        $results[] = $message;
      }
    }
  
    // Devuelve la lista de resultados
    return $results;
  }