<?php

namespace exception;

class EventerException extends \Exception {
	
	
	const DESCRIPTION = -32800;
	const NAME = -32801;
	const SUBJECT = -32802;
	const VENUE = -32803;
	const START_DATE = -32804;
	const END_DATE = -32805;
	const SEATS_ALLOC = -32807;
	const SEATS = -32808;
	const CONSTRAINT_VIOLATION = -32809;
	const FETCH_ERROR = -32810;
    const DELETING = -32811;
    const NO_ACCOUNT = -32812;
    const NO_OCCASION = -32813;
    const NO_ATTENDEE = -32814;
    const OCCASION_ID = -32815;
    const ATTENDEE_ID = -32816;
    const ACCOUNT_ID = -32817;
    const TELEPHONE = -32818;
    const NO_RELATION = -32819;


	 /**
     * @return EventerException
     */
    public static function name()
    {
        return new self("'name' argument is missing", self::NAME);
    }

    public static function account_id(){
         return new self("'account_id' argument is missing", self::ACCOUNT_ID);
    }

    public static function tel(){
         return new self("'tel' argument is missing", self::TELEPHONE);
    }

    public static function attendee_id(){
         return new self("'attendee_id' argument is missing", self::ATTENDEE_ID);
    }

    public static function occasion_id(){
         return new self("'occasion_id' argument is missing", self::OCCASION_ID);
    }

    public static function start_date()
    {
        return new self("start_date argument is not well formated", self::START_DATE);
    }

    public static function end_date()
    {
        return new self("end_date argument is not well formated", self::END_DATE);
    }

    public static function seats()
    {
        return new self("seats argument is missing", self::SEATS);
    }


    public static function seats_alloc()
    {
        return new self("seats_alloc argument missing", self::SEATS_ALLOC);
    }


    public static function venue()
    {
        return new self("venue argument is missing", self::VENUE);
    }

    public static function subject()
    {
        return new self("subject argument is missing", self::SUBJECT);
    }

    public static function description()
    {
        return new self("description argument is missing", self::DESCRIPTION);
    }

    public static function constraint_violation()
    {
        return new self(
        	"Integrity contraint violation", 
        	self::CONSTRAINT_VIOLATION);
    }


	public static function fetch()
    {
        return new self(
        	"Error Fetching", 
        	self::FETCH_ERROR);
    }

    public static function delete($oId, $aId)
    {
        $mess;
        if(!is_null($aId)){
            $mess = "Error Deleting record Object with Id ".$oId;
        } else {
            $mess = "Error Deleting record between Object with Id ".$oId.
            " and Object ".$aId;
        }

        return new self(
            $mess, 
            self::DELETING);
    }

    public static function no_rel($oId, $aId)
    {
        
        $mess = "No relation between Object with Id ".$oId.
            " and Object ".$aId;
        

        return new self(
            $mess, 
            self::NO_RELATION);
    }

    public static function no_account($account_id){
        return new self(
            "No Account with id ".$account_id,
            self::NO_ACCOUNT);
    }

    public static function no_occasion($occasion_id){
        return new self(
            "No Occasion with id ".$occasion_id,
            self::NO_OCCASION);
    }

    public static function no_attendee($attendee_id){
        return new self(
            "No Attendee with id ".$attendee_id,
            self::NO_ATTENDEE);
    }


	public function __toString() {
	    return  '{ "code" : ' . $this->code . ', "message" : "' . $this->message . '"}';
	}
}