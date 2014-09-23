<?php

class HeadersHelper{
    /**
     * Envía el objeto como JSON
     * @param  [Array]  $json Array asociativo que se enviará como JSON
     */
    public static function sendJSON($json){
        header('Content-type: application/json');
        ob_clean();
        echo json_encode($json);
    }

}

?>