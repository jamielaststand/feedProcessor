<?php
namespace Library\Db\Dao;
use PDOException;
use PDO;

/**
 * TblProductData class.=
 *
 * A class to handle Database Access for table tblProductData
 *
 * @package    Db
 * @subpackage Dao
 * @author      Jamie Greenway
 * @since       04/12/2014
 */
class TblProductDataDao extends Conn
{
    // Declare property of table name for use withing the class
    private $_tableName = 'tblProductData';
    
    /**
     * insert
     *
     *  Inserts a row into the Db table based on values in the Value Object
     *
     *  @param Class Library_Db_Vo_TblProductDataVo
     *  @throw PDOException
     */
    public function insert($vo) {
        //get instance of date to store in Db
        $date = date("Y-m-d h:m:s");
        // Prepare the insert statement SQL *Talked more on this in acompanying document*
        $stmt = $this->getPdo()->prepare(
        'INSERT INTO '.$this->_tableName.' ('.
            'strProductName,'.
            'strProductDesc,'.
            'strProductCode,'.
            'intStock,'.
            'dtmAdded,'.
            'dtmDiscontinued,'.
            'decPrice'.
        ') '.
        'VALUES ('.
            ':productName,'.
            ':productDesc,'.
            ':productCode,'.
            ':intStock,'.
            ':dtmAdded,'.
            ':dtmDiscontinued,'.
            ':decPrice'.
        ')'
        );
        // Set Params to insert
        //Set Datatype based on PDO param constants, Adds extra level of protection
        $stmt->bindParam(':productName', $vo->getStrProductName(), PDO::PARAM_STR);
        $stmt->bindParam(':productDesc', $vo->getStrProductDesc(), PDO::PARAM_STR);
        $stmt->bindParam(':productCode', $vo->getStrProductCode(), PDO::PARAM_STR);
        $stmt->bindParam(':intStock', $vo->getIntStock(), PDO::PARAM_INT);
        $stmt->bindParam(':dtmAdded', $date, PDO::PARAM_STR);
        $stmt->bindParam(':dtmDiscontinued', $vo->getDtmDiscontinued(), PDO::PARAM_STR);
        $stmt->bindParam(':decPrice', $vo->getDecPrice(), PDO::PARAM_STR);

        // Try to execute the statement, catch exception if fails.
        try {
            $stmt->execute();
        }
        // Catch and output any exceptions
        catch (PDOException $e)
        {
            var_Dump($e);
        }
    }
}
?>