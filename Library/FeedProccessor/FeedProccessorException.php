<?php
namespace Library\FeedProccessor;
use Exception;
/**
 * FeedProccessorException Class
 *
 * @package     FeedProccessor
 * @author      Jamie Greenway
 * @since       03/12/2014
 */
class FeedProccessorException extends Exception
{
     /**
     * Construct the exception
     *
     * @param  string $msg
     * @param  int $code
     * @param  Exception $previous
     * @return void
     */
    public function __construct($msg = '', $code = 0, Exception $previous = null)
    {
        //Call Parent Constricter
        parent::__construct($msg, (int) $code, $previous);
    }
}