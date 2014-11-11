<?php
/*
 *class  : Logger
 *author : Raj Kumar
*/
use Phalcon\Logger\Adapter\File as Logger;

class Logger
{
    private static $logger;

    private static $instance = null;
    
    /**
     * Protected constructor, prevent creating new instance of a class.
     * 
     */
    protected function __construct()
    {
    	self::$logger = new Logger(APP_PATH."/app/logs/request.log");	
        self::$logger->setLogLevel(3);
    }

    /**
     * Function to create logs
     *
     * @inputs Message and log type i.e. either log,notice,warning or error
     *
     * @staticvar Singleton $instance The *Singleton* instances of this class.
     *
     * @return bollean true.
     */
    public static function createLog($logMessage,$logType)
    {
        if (null === self::$instance) {
            self::$instance = new customLogger();
        }

        $logTypes = self::getLogTypes();

        if (in_array($logType,$logTypes))
            self::$logger->$logType($logMessage);   
        else
        	self::$logger->log($logMessage);
        
        return true;
    }
  
    /**
     * Function to get logs types array
     *
     * @return array of log types.
     */
    public static function getLogTypes(){
    	$logTypes = array ('log','debug','info','notice','warning','error','critical','alert','emergency');
    	return $logTypes;
    }
        
}
