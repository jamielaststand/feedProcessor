<?php
namespace Library\FeedProccessor\File\Format;
/**
 * Csv class.
 *
 * @package     FeedProccessor
 * @subpackage  File
 * @author      Jamie Greenway
 * @since       03/12/2014
 */
class Csv
{
    // Declare protected Property for file
    protected $_file;
    
    /**
     * Constructor
     * 
     *  Checks if file is is passed
     *
     *  @param Csv $file 
     *
     *  @throws Library\FeedProccessor\FeedProccessorException
     */
    public function __construct($file = null)
    {
        // Check file is not false and set the file
        if($file !== false) {
            $this->setFile($file);
        // Else throw Exception
        } elseif (!is_null($file)) {
            throw new Library\FeedProccessor\FeedProccessorException('Invalid file passed to constructor');
        }
    }

    /**
     * GetFile
     * 
     *  Checks if file is null, if not get the file
     *
     *  @return Csv $file 
     *
     *  @throws Library\FeedProccessor\FeedProccessorException
     */
    public function getFile()
    {
        //Checks if file if file is null, if not get the file
        if(!is_null($this->_file)) {
            return $this->_file;
        //Else throw Exception
        } else {
             throw new Library\FeedProccessor\FeedProccessorException('File is not set');
        }
    }

    /**
     * SetFile
     * 
     *  Checks if file is null, if not set the file
     *
     *  @param Csv $file 
     *
     *  @throws Library\FeedProccessor\FeedProccessorException
     */
    public function setFile($file) {
        //Checks if file if file is null, if not set the file
        if($file !== false) {
            $this->_file = $file;
            //Else throw Exception
        } else {
             throw new Library\FeedProccessor\FeedProccessorException('Cant open provided file');
        }
    }
    
    /**
     * parse
     * 
     *  Parses Csv file and checks for issues with data
     *
     *  @param String $voClassStr
     *  @return Array data
     */   
    public function parse($voClassStr = null)
    {
        // Declare arrays and variables for use within the class
        $rows     = array();
        $counter  = 0;
        $excluded = 0;
        //loops until the last line of the file has been reached
        while (feof($this->_file) === false) {
            //Assumes header is the first line of the CSV
            if ($counter == 0) {
                //Clense the data
                $header  = str_replace("\n","",str_replace(PHP_EOL,"",fgets($this->_file)));
                $headers = explode(',', $header);
            } else {
                //Clense the data
                
                $row = str_replace("'", "''",str_replace(PHP_EOL,"",fgets($this->_file)));
                $row = explode(',', $row);
                // Check if a row has any elements in it. !clears out rogue last row!
                if(count($row) > 1){
                    // Check to see if number of elemments in the array matches number of elements in headers
                    if (count($row) === count($headers)) {
                        // map row to headers
                        $row = array_combine ($headers, $row);
                        // Check to see if VO string is passed and call VO or add as array
                        $rows[] = ($voClassStr) ? new $voClassStr($row) : $row;
                    } else {
                        $excluded++;
                    }
                }
            }
           $counter++;
        }
        // Return number of excluded rows and array containing rows
        return array('data' => $rows, 'excluded' => $excluded);
    }
}
