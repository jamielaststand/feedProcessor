
                          CSV Stock Importer Package

  About
  -----

   CSV Stock Importer is a package that allows a CSV file called stock.csv 
   to be imported to the table "tblproductdata" in the database "ebuyertest".
   The package checks to see if a CSV is valid and tests the parsed data against 
   Import rules, these are outlined in the worker Processor "StockCsvProccessor".
   The results of the importer are reported to the command line once running
   of the script is complete.

  Installation
  ------------

  1. Extract the Zipped file "Ebuyer DevTest.zip".
  2. Copy the extracted content to your working directory of webserver i.e. "Apache, IIS"
  3. Open instance of MySQL command Prompt
  4. Login to MySQL
  5. Run the command "source Path\\To\\File\\make_database.sql;"
  6. Run the command "source Path\\To\\File\\UpdateSQL.sql"
  
  Installation is now complete

  Run Package 
  ----------

  Optional Param 
  	--ttest	(Runs the Package in "Test Mode", which does not insert rows to the DB)

  1. Navigate to directory files are pasted to.
  2. Run Command "php run.php"
  3. Run Command in Test Mode "php run.php -ttest"

  Config File
  -----------
  
  The Config file contains package Constants, DB connection details and included classes that
  are used throughout the system.

  Library Packages
  ----------------
  CSV Stock Importer package utilises other included library packages.
  These have been designed to be used and extended elsewhere in a system.
  These library packages are as follows:
  
  1. Feed Processor
     
     The Feed Processor is a package which currently parses CSV formatted files.
     However this is designed to be expanded to parse other file format types if required.
     This package could also be extended to write to a file formatte by adding a writer Class
     and adding a writer method to the format Class. 

  2. DB 
     
     The DB library contains a connection wrapper Class (Conn) to the database "ebuyertest".
     It also contains Data Access Object(DAO) and Value Object(VO) Classes for table "tblproductdata".
     These currently handle the construction of a data object and the insertion of data to 
     the table. More DAO and VO Classes can be added if more tables are added to the DB.
     More Methods should be added if you require to 'Update', 'Fetch' and 'Delete' row(s) in table.

  3. Validator

     The Validator library contains validation Classes which can be used independently 
     to validate data by criteria. More validation Classes can be added if required.

  4. Worker

   The worker library can contain Classes to handle processing of Command Line Scripts.
   Currently there is a Class called "StockCsvProccessor" which handles the processing
   of stock.csv. More processor workers can be added if required. 
  
