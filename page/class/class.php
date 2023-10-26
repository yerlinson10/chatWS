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
