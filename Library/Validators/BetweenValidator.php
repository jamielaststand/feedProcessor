<?php
namespace Library\Validators;
/**
 * BetweenValidator class 
 *
 * @package     Validator
 * @author      Jamie Greenway
 * @since       05/12/2014
 */
class BetweenValidator
{
	/* Declare properties, made protected so can be used in classes that extend this
       file without Getters and Setters */
	protected $_min;
	protected $_max;
	
	/**
	* Constructor
	* 
	*  Sets class properties bassed on param values
	*
	*  @param Int $min
	*  @param Int $max
	*/
	public function __construct($min = null, $max = null) {
		// Set Param values
		$this->setMin($min);
		$this->setMax($max);
	}
    	
	/**
	* Setter for Min
	*
	* @param String $min
	*/
	public function setMin($min) {
		$this->_min = $min;
	}
	
	/**
	* Getter for Min
	*
	* @return Int
	*/
	public function getMin() {
		return $this->_min;
	}
	
	/**
	* Setter for Max
	*
	* @param String $max
	*/
	public function setMax($max) {
		$this->_max = $max;
	}
	
	/**
	* Getter for Max
	*
	* @return Int
	*/
	public function getMax() {
		return $this->_max;
	}
	
	/**
	* isValid
	*
	* Checks if Row meets between rules
	*
	* @return Boolean 
	*/
	public function isValid($value) {
		// Checks to see if a min value has been set
		if($this->getMin() != null) {
			// Checks to see if value is less than min value
			//return false, its failed validation			
			if($value > $this->getMin()) {
				return false;
			}
		}
		// Checks to see if a min value has been set
		if($this->getMax() != null) {
			// Checks to see if value is greater than max value
			if($value > $this->getMax()) {
				//return false, its failed validation
				return false;
			}
		}
		//Return true, its passed validation
		return true;
	}
}