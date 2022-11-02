ALTER TABLE artscoms MODIFY 
COLUMN date_updated_artcom
TIMESTAMP DEFAULT CURRENT_TIMESTAMP
ON UPDATE CURRENT_TIMESTAMP;

SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'articles'; AND database_name='credifarma';

SELECT * FROM therapies;
UPDATE therapies SET date_created_therapy='2022-11-01';

SELECT * FROM laboratories;
UPDATE laboratories SET date_created_laboratory='2022-11-01';

SELECT * FROM substances;
UPDATE substances SET date_created_substance='2022-11-01';

SELECT * FROM categories;

SELECT * FROM articles;

SELECT * FROM artscoms;

SELECT * FROM artscoms;

SELECT @@global.time_zone, @@session.time_zone;
SET @@session.time_zone='-05:00';

SELECT NOW();

SELECT CURRENT_TIMESTAMP();