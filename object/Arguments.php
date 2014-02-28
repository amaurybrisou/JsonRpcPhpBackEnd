<?php

namespace object;

use exception\EventerException;

class Arguments {

	private static $required_fields = array(
		"GetDetailsOccasion" => array(
				'name',
				'subject',
				'venue',
				'start_date',
				'end_date',
				'description',
				'seats_alloc',
				'seats'
			),
		"CancelOccasion" => array(
				'occasion_id'
			),
		"GetDetailsOccasion" => array(
				'occasion_id'
			),
		"AddAttendeesOccasion" => array(
				'occasion_id',
				'attendees'
			),
		"CreateAttendee" =>  array(
				'name',
				'surname',
				'mail',
				'accid_fk',
				'tel'
			),
		"CreateAccount" => array(
				'name'
			),
		"RemoveAttendeeOccasion" => array(
				'occasion_id',
				'attendee_id'
			),
		"CreateOccasion" => array(
				'name',
				'venue',
				'start_date',
				'end_date'/*,
				'seats',
				'subject',
				'seats_alloc',
				'description'*/
			)
		);


	

	public static function check($params, $caller = null){

		if(is_null($caller)){
			$callers=debug_backtrace();
			$caller = $callers[1]['function'];
		}

		foreach (self::$required_fields[$caller] as $value) {

			if(!array_key_exists($value, $params)){
				throw EventerException::$value();
			}
		}

		return true;
	}


}