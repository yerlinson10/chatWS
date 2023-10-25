<?php
class ArchivoClass
{
    public $file;
    
    public function Descomprimir() : array {
        $tmp_name = $this->file["zip"]['tmp_name'];
        $nameWS =  $this->file["zip"]['name'];
        $nameSpaceZip = str_replace(".zip", "", $nameWS);
        $directorio_destino = "../storage/";

        // Mover el archivo ZIP a su ubicación de destino
        $archivo_zip = $directorio_destino . $nameWS;
        if (move_uploaded_file($tmp_name, $archivo_zip)) {
            $zip = new ZipArchive;
            if ($zip->open($archivo_zip) === true) {
                $zip->extractTo($directorio_destino . $nameSpaceZip);
                $zip->close();
                return [
                    'success' => true,
                    'message' => "Archivo ZIP descomprimido con éxito."
                ];
            } else {
                return [
                    'success' => false,
                    'message' => "No se pudo abrir el archivo ZIP o hubo un error durante la extracción."
                ];
            }
        } else {
            return [
                'success' => true,
                'message' => "Archivo ZIP descomprimido con éxito.",
                'data' => compact('nameWS', 'nameSpaceZip')
            ];
        }
    }

    public function ExtractData($file) {
        $fp = fopen($file, "r"); // Abrir el archivo en modo de lectura
        $data = "";
        while (!feof($fp)) { // Leer los caracteres del archivo hasta llegar al final
            $data .= htmlspecialchars(fread($fp, 1));
        }
        fclose($fp); // Cerrar el archivo
    
        // Buscar datos de mensajes y adjuntos
        $messages = [];
        $pattern = "/\[\d{2}\/\d{2}\/\d{2}, \d{1,2}:\d{2}:\d{2}[^\]]*\][^\[]+/";
        $attachmentPattern = "/<adjunto: [^>]+>/";
    
        if (preg_match_all($pattern, $data, $matches)) {
            $messages = $matches[0];
        }
    
        // if (preg_match_all($attachmentPattern, $data, $attachmentMatches)) {
        //     $messages2 = array_merge($messages, $attachmentMatches[0]);
        // }
    
        return $messages;
    }
    



}
