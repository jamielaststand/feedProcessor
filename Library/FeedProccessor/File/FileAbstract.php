<?php
namespace Library\FeedProccessor\File;
/**
 * FileAbstract class.
 *
 * @package     FeedProccessor
 * @subpackage  File
 * @author      Jamie Greenway
 * @since       03/12/2014
 */
abstract class FileAbstract implements FileTemplate
{
    /* Declare properties, made protected so can be used in classes that extend this
       file without Getters and Setters */
    protected $_format;
    protected $_location;
    protected $_name;
    protected $_formatClass;
    protected $_file;
    
    /**
     * Constructor 
     * 
     *  Checks if an array Options has been passed and calls set Options
     *
     *  @param Array $options
     *
     *  @throws PDOException
     */
    public function __construct($options = null)
    {
        //Check If Options is Array
        if (is_array($options)) {
            // Call Set Optiona
            $this->setOptions($options);
        // Else throw Exceptions
        } elseif (!is_null($options)) {
            throw new Library\FeedProccessor\FeedProccessorException('Invalid parameter to constructor');
        }
    }
   
    /**
     * setOptions
     * 
     *  Checks and sets Properties from array Options
     *
     *  @param Array $options
     *
     *  @throws PDOException
     */
    public function setOptions($options) {
        // Check if Options is an array.
        if (is_array($options)) {
            // Check to see if Option exists in array options
            if(array_key_exists('location', $options)) {
                $this->setLocation($options['location']);
            // Else throw Exception    
            } else {
                throw new Library\FeedProccessor\FeedProccessorException('Location is not provided in options array and is required');
            }
            // Check to see if Option exists in array options
            if(array_key_exists('name', $options)) {
                $this->setName($options['name']);
            // Else throw Exception      
            } else {
                throw new Library\FeedProccessor\FeedProccessorException('Name is not provided in options array and is required');
            }
            // Check to see if Option exists in array options
            if(array_key_exists('format', $options)) {
               //Set Format and Format Class 
               $this->setFormat($options['format']);
               $this->setFile();
               $this->setFormatClass($options['format']);
               // Else throw Exception  
            } else {
                throw new Library\FeedProccessor\FeedProccessorException('Format is not provided in options array and is required');
            }
        } else {
            throw new Library\FeedProccessor\FeedProccessorException('Invalid options passed to setOptions()');
        }
    }

    /**
    * Getter for feed file format
    *
    * @return string
    */
    public function getFormat()
    {
        return $this->_format;
    }

    /**
    * Setter for format, allows providing the format as a string
    *
    * @param String $format
    */
    public function setFormat($format)
    {
        $this->_format = $format;
    }
    
    /**
    * Getter for format class
    *
    * @return string
    */
    public function getFormatClass()
    {
        return $this->_formatClass;
    }

    /**
    * Setter for format Class
    *
    * @param String $format
    */
    public function setFormatClass($format)
    {
        // Creates class Dynamically from $format Param
        $class = 'Library\\FeedProccessor\\File\\Format\\'.ucwords(strtolower($format));
        $this->_formatClass = new $class($this->getFile());
    }
    
    
    /**
    * Getter for feed file location
    *
    * @return string
    */
    public function getLocation()
    {
        return $this->_location;
    }
    
    /**
    * Setter for feed file location
    *
    * @param string $location
    */
    public function setLocation($location)
    {
        $this->_location = $location;
    }
    
    /**
    * Getter for feed file name
    *
    * @return string
    */
    public function getName()
    {
        return $this->_name;
    }
    /**
    * Setter for feed file name
    *
    * @param string $name
    */
    public function setName($name)
    {
        $this->_name = $name;
    }
    
   /**
    * Getter for file 
    *
    * @return string
    * @throw Library\FeedProccessor\FeedProccessorException
    */
    public function getFile()
    {
        // Check if File is null
        if(!is_null($this->_file)) {
            return $this->_file;
        // Else throw exception
        } else {
             throw new Library\FeedProccessor\FeedProccessorException('File is not set');
        }
    }

   /**
    * Setter for file 
    *
    * Gets the file from folder and sets it to property
    *
    * @throw Library\FeedProccessor\FeedProccessorException
    */
    public function setFile() {
        //Create file string
        $fileString = $this->getLocation().DS.$this->getName().'.'.$this->getformat();
        // Check to see if file ecists on system
        if(file_exists($fileString)) {
            //Open the file
            $file = fopen($fileString, "r");
            //Check file has Opened
            if($file !== false) {
                //Set File to property
                $this->_file = $file;
            //Else throw exception    
            } else {
                 throw new Library\FeedProccessor\FeedProccessorException('Cant open provided file');
            }
            //Else throw exception 
        } else {
            throw new Library\FeedProccessor\FeedProccessorException('Provided File does not exist');
        }
    }
    /*
     * Close File
     *
     * Closes file after it has been opened
     */
    public function closeFile() {
        //Check file is not null
        if(!is_null($this->_file)) {
            //Close file
            fclose($this->_file);
        }
    }
}
