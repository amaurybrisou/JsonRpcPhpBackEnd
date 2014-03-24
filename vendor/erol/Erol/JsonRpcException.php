<?php

namespace Erol;

class JsonRpcException extends \Exception {

    public static function raise($param, $code){
        if($code == -32823){
            return new self($param, $code);
        }
        return new self("'".$param."' argument is missing", 
            $code);
    }

    public function toArray(){
        return array("code" => $this->code, "message" => $this->message);   
    }
}