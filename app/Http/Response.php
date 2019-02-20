<?php

namespace App\Http;

class Response {

    public static function errorMessage($msg)
    {
        return \response()->json([
            'status' => 0,
            'response_time' => time(),
            'error_msg' => $msg
        ]);
    }
}

?>