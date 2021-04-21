<?php
  namespace App\Helpers;

  use Illuminate\Http\Request;
  
  class General {
    
    public static function resJson($res) {
      $msg = [
        'status' => [
          'code' => $res['response'] === 'success' ? 200 : ($res['response'] === 'failed' ? 500 : 400),
          'response' => $res['response'],
          'message' => !empty($res['message']) ? $res['message'] : ''
        ],
        'result' => !empty($res['result']) ? $res['result'] : []
      ];
      return response()->json($msg);
    }
    
  }
