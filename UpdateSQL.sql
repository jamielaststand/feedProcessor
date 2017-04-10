ALTER TABLE `ebuyertest`.`tblproductdata` 

ADD COLUMN `intStock` INT(10) NULL DEFAULT 0 AFTER `strProductCode`,

ADD COLUMN `decPrice` DECIMAL(10,2) NOT NULL AFTER `dtmAdded`;


CREATE USER 'feed'@'localhost' IDENTIFIED BY 'processor';
GRANT ALL PRIVILEGES ON ebuyerTest.tblProductData TO 'feed'@'localhost' 
IDENTIFIED BY 'processor';
