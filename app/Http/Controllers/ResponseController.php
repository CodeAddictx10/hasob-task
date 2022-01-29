<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResponseController extends Controller
{
    
      /**
     * Response handler
     *
     * @return json
     */
    public static function response ($status, $message, $status_code){
        return response()->json([
            'status'=>$status,
            'payload'=>$message
        ], $status_code);
    }
}
