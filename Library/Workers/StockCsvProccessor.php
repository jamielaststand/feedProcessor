<?php
namespace Library\Workers;
/**
 *  StockCsvProccessor class
 *
 * @package     Worker
 * @author      Jamie Greenway
 * @since       03/12/2014
 */
class StockCsvProccessor 
{
    /* Declare properties, made protected so can be used in classes that extend this
       file without Getters and Setters */
    protected $_testMode;
    
    /* Storing file data here. Could be expanded to be passed in as constructer if
    more proccessors are added */
    protected $_config = array(
        'format'   => 'csv',
        'location' => 'import',
        'name'     => 'stock',
    );
    
    /**
     * Construct
     *
     * Sets class property bassed on param values
     *
     * @param  Boolean $testmode
     */
    public function __construct($testmode=null)
    {
        // Check to see if we are running the script in test mode or not
        if(is_null($testmode)) {
            //Set test mode to false
            $this->setTestMode(false);
        } else {
            // Print to screen we are running in test mode
            echo 'Running in Test Mode!'. PHP_EOL;
            //Set test mode to true
            $this->setTestMode(true);
        }
    }
    
    /**
     * Run Method
     *
     * Runs our proccessor
     */
    public function run()
    {
        //set Reader class and pass in Config array as  param
        $reader = new \Library\FeedProccessor\Reader($this->getConfig());
        //Call the method to get instance of format class
        $formatClass = $reader->getFormatClass();
        
        //create string representation of Product Value Object
        $voClassStr  = '\\Library\\Db\\Vo\\TblProductDataVo';
        //Parse file and get results as Value Object
        $results = $formatClass->parse($voClassStr);
        // Declare variables to store information for reporting
        $report   = array();
        $included = 0;

        /* call instances of Validators,
          to  help validate values rules based on Import rules */
        $validateStock     = new \Library\Validators\BetweenValidator(10, null);
        $validatePrice5    = new \Library\Validators\BetweenValidator(5, null);
        $validatePrice1000 = new \Library\Validators\BetweenValidator(null, 1000);
        $ValidateCurrency  = new \Library\Validators\CurrencyValidator();
        
        //Get Instance of Product Data's Data Access Object
        $db = new \Library\Db\Dao\TblProductDataDao();
        
        //Iterate through results
        foreach($results['data'] as $vo) {
            //Check to see if Price is a decimal
            if($ValidateCurrency->isValid($vo->getDecPrice())) {
                // Checks to see if Product cost more that £1000
                if(!$validatePrice1000->isValid($vo->getDecPrice())) {
                    $report[$vo->getStrProductCode()] = 'Cost more than 1000 pouns.';
                    // Check to see if Product costs less than £5 and has less than 10 items of stock
                } elseif($validatePrice5->isValid($vo->getDecPrice())
                         && $validateStock->isValid($vo->getIntStock())
                        ) {
                    // Add string to report array letting us know what errors object has
                    $report[$vo->getStrProductCode()] = 'Cost less than 5 pounds and has less than 10 stock.';
                }
            } else {
                // Add string to report array letting us know what errors object has
                $report[$vo->getStrProductCode()] = 'Price is not a Valid Currency';
            }
            //Check to see if object has not broke validation
            if(!array_key_exists($vo->getStrProductCode(), $report)) {
                // Checks if in test mode before inserting rows to DB.
                if(!$this->getTestMode()) {
                    $db->insert($vo);
                }
                $included++;
            } 
        }
        $this->reportResults($included, $results['excluded'], $report);
    }
    
    public function reportResults($included, $excluded, $report)
    {
        //Produce and echo report
        echo $included. ' products have been inserted into the database'.PHP_EOL;
        if($excluded > 0) {
            echo $excluded.' results have been excluded as they are not formated correclty'.PHP_EOL; 
        }
    
        if(count($report) > 0) {
            echo 'The following '.count($report).' Products have not been inserted into the Database, as they don\'t meet import rules:'. PHP_EOL; 
            foreach($report as $stockId => $errors) {
                echo $stockId.' - '.$errors. PHP_EOL;
            }
        }
    }
    
    /**
    * Getter for config
    *
    * @return Array
    */
    public function getConfig()
    {
        return $this->_config;
    }
    
    /**
    * Getter for TestMode
    *
    * @return Boolean
    */
    public function getTestMode()
    {
        return $this->_testMode;
    }
    
    /**
    * Setter for TestMode
    *
    * @param Boolean $testMode
    */
    public function setTestMode($testMode)
    {
        $this->_testMode = $testMode;
    }

}