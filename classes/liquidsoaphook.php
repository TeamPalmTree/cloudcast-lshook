<?php

class LiquidsoapHook {

    private static function get_url($operation) {

        // load LS config
        Config::load('liquidsoap', true);
        // get configuration data
        $host = Config::get('liquidsoap.host');
        $port = Config::get('liquidsoap.port');
        $key = Config::get('liquidsoap.key');
        // set url & port
        return $host . ':' . $port . '/' . $operation . '?key=' . $key;

    }

    public static function restart() {

        // create a new curl resource
        $curl = curl_init();
        // set url & port
        curl_setopt($curl, CURLOPT_URL, self::get_url('restart'));
        // return as a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // tell liquidsoap to refresh
        curl_exec($curl);
        // close curl resource to free up system resources
        curl_close($curl);

    }

    public static function input($input, $enabled) {

        // create a new curl resource
        $curl = curl_init();
        // set url & port
        curl_setopt($curl, CURLOPT_URL, self::get_url('input') . '&input=' . $input . '&enabled=' . $enabled);
        // return as a string
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // tell liquidsoap to enable/disable input
        curl_exec($curl);
        // close curl resource to free up system resources
        curl_close($curl);

    }

}