<?php
namespace Library\Db\Dao;

use PDO;
use PDOException;

/**
* Conn class
*
* Acts as a connection wrapper for PHP PDO
*
* @package    Db
* @subpackage Dao
* @author     Jamie Greenway
* @since      04/12/2014
*/
class Conn
{
    // Declare class Properties
    // Set to Private as only required in this class
    private $_dbHost;
    private $_dbName;
    private $_dbUser;
    private $_dbPassword;
    // Set to Proteced So can be used in classes that extend this.
    protected $_pdo;

    /**
     * Constructor
     *
     *  Creates an instance of PDO connection class
     *
     *  @throws PDOException
     */
    function __construct() {
        //Set DB Properties from application constants
        $this->_dbHost     = DB_HOST;
        $this->_dbName     = DB_NAME;
        $this->_dbUser     = DB_USER;
        $this->_dbPassword = DB_PASSWORD;

        // Try to establish a connection to the Database or throw exception
        try
        {
            $this->_pdo = new PDO(
                "mysql:host=$this->_dbHost;dbname=$this->_dbName",
                $this->_dbUser,
                $this->_dbPassword
            );
        }
        catch (PDOException $e)
        {
            exit('Error Connecting To DataBase');
        }
    }

    /**
     * Getter for Pdo class
     *
     * @return Class PDO
     */
    function getPdo() {
        return $this->_pdo;
    }
}