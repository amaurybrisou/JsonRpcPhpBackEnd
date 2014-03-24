<?php

namespace src;

class ExampleException extends \Exception {
    

    
    const NAME = -32801;
    
    const CONSTRAINT_VIOLATION = -32809;
    
    const DELETING = -32811;
    const NO_ID = -32820;
    const NO_JSONRPC = -32821;
    const NO_METHOD = -32822;
    const PARSE_ERROR = -32823;

    public static function raise($err_number, $mess=null){
        if(!is_null($mess) && gettype($err_number) == 'integer'){
            return new self($mess, $err_number);
        }

        switch ($err_number) {
            case self::CONSTRAINT_VIOLATION:
                return new self("Constraint Violation", self::CONSTRAINT_VIOLATION);
                break;
            case self::NO_OCCASION:
            case self::NO_ATTENDEE:
                return new self("No Record(s)");
                break;
            case gettype($err_number) == "string":
                $code = strtoupper($err_number);
                return new self("'".$err_number."' argument is missing", constant('self::'.$code));
                break;
            default:
                return new self("Errot not handled ".$err_number);
                break;
        }
    }

    public function toArray(){
        return array("code" => $this->code, "message" => $this->message);   
    }
}