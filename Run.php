<?php
     // Config stores application constants and Include files
    include 'Config.php';
        
    // Get test param  
    $options = getopt("t::");
    // Check to See if test mode param has been set or not
    $testMode = (array_key_exists("t", $options) && $options["t"] == 'test') ? true : null;
    // Call instance of Worker StockCsvProccessor with param test mode
    $workerClass = new Library\Workers\StockCsvProccessor($testMode);
    // Call Method run to start the worker going
    $workerClass->run();
?>