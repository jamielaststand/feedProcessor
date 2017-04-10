<?php
namespace Library\Validators;
/**
 * CurrencyValidator class.
 *
 * @package     Validator
 * @author      Jamie Greenway
 * @since       06/12/2014
 */
class CurrencyValidator
{
	
	/**
	* isValid
	*
	* Checks if value is currency or not
	*
	* @return Boolean
	*/
	public function isValid($value) {
		/* Used regex as it returns more acurate results
		and allows me to manipulate exsact requirments */
		if(preg_match('/^[0-9]+(?:\.[0-9]{2}){0,1}$/',$value)) {
			return true;
		}
		return false;
	}
}