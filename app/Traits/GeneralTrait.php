<?php

namespace App\Traits;

trait GeneralTrait
{

    public function returnError( $msg)
    {
        return response()->json([
            // 'status' => false,
            'error' => $msg
        ]);
    }


    public function returnSuccessMessage($msg = "")
    {
        return [
            'status' => true,
            'msg' => $msg
        ];
    }

    public function returnData($key, $value, $msg = "")
    {
        return response()->json([
            'status' => true,
            'msg' => $msg,
            $key => $value
        ]);
    }

    public function returnValidateData($validate)
    {
        return response()->json([
            'status' => 422,
            'msg' => 'error',
            'validation errors' => $validate
        ]);
    }


    
    public function returnValidationError( $validator)
    {
        return $this->returnError( $validator);
    }


    
  
}
