<?php
require '../src/ArchivoClass.php';


$ArchivoClass = new ArchivoClass();
    $ArchivoClass->file = $_FILES;
echo $ArchivoClass->Descomprimir()['success'];