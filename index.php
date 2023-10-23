<?php
require 'vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form enctype="multipart/form-data" action="page/process.php" method="post" >
        <input type="file" name="zip" id="zipInput">
        <br>
        <br>

        <button type="submit">Enviar</button>
    </form>    

</body>
</html>