<?php
namespace Library\Db\Vo;
/**
 * blProductDataVo class
 *
 * @package     Db
 * @subpackage  Vo
 * @author      Jamie Greenway
 * @since       04/12/2014
 */
class TblProductDataVo
{
    /* Declare properties, made protected so can be used in classes that extend this
       file without Getters and Setters */
    protected $_strProductName;
    protected $_strProductDesc;
    protected $_strProductCode;
    protected $_intStock;
    protected $_decPrice;
    protected $_dtmAdded;
    protected $_dtmDiscontinued;
    
    /**
     * Constructor
     * 
     *  Checks if an array row has been passed and sets the values
     *
     *  @param Array $row
     *
     *  @throws PDOException
     */
    public function __construct($row = null)
    {
        // Check if row is an an array, then check to see if array key was set.
        if (is_array($row)) {
            if(array_key_exists('Product Name', $row)) {
                $this->setStrProductName(trim($row['Product Name']));
            }
            if(array_key_exists('Product Description', $row)) {
                $this->setStrProductDesc(trim($row['Product Description']));
            }
            if(array_key_exists('Product Code', $row)) {
                $this->setStrProductCode(trim($row['Product Code']));
            }
            if(array_key_exists('Stock', $row)) {
                $this->setIntStock(trim(trim($row['Stock'])));
            }
            if(array_key_exists('Cost in GBP', $row)) {
                $this->setDecPrice(trim($row['Cost in GBP']));
            }
            if(array_key_exists('Discontinued', $row)) {
                $this->setDtmDiscontinued(trim($row['Discontinued']));
            }
            // If row is not null or an array, we throw an exception
        } elseif (!is_null($row)) {
            throw new Library\FeedProccessor\FeedProccessorException('Invalid parameter passed to constructor');
        }
    }
    
    /**
    * Getter for Product Name
    *
    * @return String
    */
    public function getStrProductName()
    {
        return $this->_strProductName;
    }
    
    /**
    * Setter for Product Name
    *
    * @param String $strProductName
    */
    public function setStrProductName($strProductName)
    {
        $this->_strProductName = $strProductName;
    }
    
    /**
    * Getter for Product Description
    *
    * @return String
    */
    public function getStrProductDesc()
    {
        return $this->_strProductDesc;
    }
    
    /**
    * Setter for Product Description
    *
    * @param String $strProductDesc
    */
    public function setStrProductDesc($strProductDesc)
    {
        $this->_strProductDesc = $strProductDesc;
    }
    
    /**
    * Setter for Product Code
    *
    * @param String $strProductCode
    */
    public function setStrProductCode($strProductCode)
    {
        $this->_strProductCode = $strProductCode;
    }
    
    /**
    * Getter for Product Code 
    *
    * @return String
    */
    public function getStrProductCode()
    {
        return $this->_strProductCode;
    }
    
    /**
    * Setter for Stock
    *
    * @param int $intStock
    */
    public function setIntStock($intStock)
    {
        $this->_intStock = intval($intStock);
    }
    
    /**
    * Getter for Stock 
    *
    * @return Int
    */
    public function getIntStock()
    {
        return $this->_intStock;
    }
    
    /**
    * Setter for Price
    *
    * @param Decimal $decPrice
    */
    public function setDecPrice($decPrice)
    {
        $this->_decPrice = $decPrice;
    }
    
    /**
    * Getter for Price 
    *
    * @return Decimal
    */
    public function getDecPrice()
    {
        return $this->_decPrice;
    }
    
    /**
    * Setter for Discontinued
    *
    * @param DateTime $dtmDiscontinued
    */
    public function setDtmDiscontinued($dtmDiscontinued)
    {
        /*Checks to see if Discontinued is set to yes, if so sets
          discontinued as todays date*/
        if($dtmDiscontinued == 'yes') {
            $this->_dtmDiscontinued = \date("Y-m-d h:m:s");
        } else {
            $this->_dtmDiscontinued = null;
        }
    }
    
    /**
    * Getter for Discontinued 
    *
    * @return DateTime
    */
    public function getDtmDiscontinued()
    {
        return $this->_dtmDiscontinued;
    }
}