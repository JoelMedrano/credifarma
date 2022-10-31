ALTER TABLE substances MODIFY 
COLUMN date_updated_substance 
TIMESTAMP DEFAULT CURRENT_TIMESTAMP
ON UPDATE CURRENT_TIMESTAMP;

SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'substances';

SELECT * FROM therapies;

SELECT * FROM laboratories;

SELECT * FROM substances;