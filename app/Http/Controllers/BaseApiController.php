<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class BaseApiController extends Controller
{
    private $_statusCode = true ;
    private $_code = 200;
    private $_error = null;
    private $data = null ;
    private $message = null ;

    CONST CODE_SUCCESS = true;
    CONST CODE_FAIL    = false;

    public function setCode ($code) {
        $this->_code = $code;
        return $this;
    }
    
    public function setStatusCode ($statusCode) {
        $this->_statusCode = $statusCode;
        return $this;
    }

    public function setMessage ($message) {
        $this->message = $message;
        return $this;
    }

    public function setData ($data) {
        $this->data = $data;
        return $this;
    }

    public function setError ($error) {
        $this->_error = $error;
        return $this;
    }

    public function respone () {
        $data = [
            "success"     => $this->_statusCode,
            "code"        => $this->_code,
            "messsage"    => $this->message,
            "data"        => $this->data,
            "error"       => $this->_error
        ];
       return Response::json($data , $this->_code);
    }

    public function sendDataSuccess ($data =  null ,$code = 200, $message = null )
    {
        return $this->setCode($code)
                    ->setStatusCode(self::CODE_SUCCESS)
                    ->setMessage($message)
                    ->setData($data)
                    ->respone();
    }

    public function sendError ($code, $message, $error) {
        return $this->setCode($code)
                    ->setStatusCode(self::CODE_SUCCESS)
                    ->setMessage($message)
                    ->setError($error)
                    ->respone();
    }

    
}