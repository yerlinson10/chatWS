<?php
class ArchivoClass
{
    public $file;
    
    public function Descomprimir () : array {
        // $archivo_zip = $this->file->tmp_name; // Reemplaza con el nombre de tu archivo ZIP
        var_dump($this->file["zip"]);
        $zip = zip_open('$archivo_zip');
        
        // if ($zip) {
        //     while ($entrada = zip_read($zip)) {
        //         $nombre = zip_entry_name($entrada);
        //         $destino = "../storage/temp/compressed/" . $nombre; // Reemplaza con la ubicación donde deseas descomprimir los archivos
        
        //         if (zip_entry_open($zip, $entrada, "r")) {
        //             $contenido = zip_entry_read($entrada, zip_entry_filesize($entrada));
        //             file_put_contents($destino, $contenido);
        //             zip_entry_close($entrada);
        //         }
        //     }
        
        //     zip_close($zip);
        //     echo "Archivo ZIP descomprimido con éxito.";
        // } else {
        //     echo "No se pudo abrir el archivo ZIP.";
        // }
                

        return [];
    }

    public function saludar() : string {
        
        return "Hola";
    }
}
