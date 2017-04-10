<?php
namespace Library\FeedProccessor\File;
/**
 * FileTemplate Interface
 *
 * @package     FeedProccessor
 * @subpackage  File
 * @author      Jamie Greenway
 * @since       03/12/2014
 */
interface FileTemplate
{
    /**
    * Setter for options, provides a method for setting all options
    *
    * @param Array $options
    */
    public function setOptions($options);

    /**
    * Setter for format, allows providing the format as a string
    *
    * @param String $format
    */
    public function setFormat($format);
    
    /**
    * Getter for feed file location
    *
    * @return string
    */
    public function getLocation();
    
    /**
    * Setter for feed file location
    *
    * @param string $location
    */
    public function setLocation($location);
    
    /**
    * Getter for feed file name
    *
    * @return string
    */
    public function getName();
    /**
    * Setter for feed file name
    *
    * @param string $name
    */
    public function setName($name);
}
