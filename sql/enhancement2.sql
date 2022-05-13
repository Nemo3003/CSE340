-- Query 1
-- SELECT QUERY
SELECT clientFirstname, clientLastname, clientEmail, clientPassword, comment FROM clients;
-- Query 2
-- INSERT QUERY
INSERT INTO clients(clientFirstname, clientLastname, clientEmail, clientPassword, comment) 
VALUES('Tony','Stark','tony@starkent.com','Iam1ronM@n',"I am the real Ironman");
-- Query 3
-- UPDATE QUERY
UPDATE clients SET clientLevel=3 WHERE clientFirstname='Tony';
-- Query 4
-- REPLACE QUERY
UPDATE inventory SET invDescription = REPLACE(invDescription,'small interior','spacious interior') WHERE invId=12;
-- Query 5
-- INNER JOIN QUERY
SELECT invModel FROM inventory AS i INNER JOIN carclassification AS c ON i.classificationId = c.classificationId
WHERE c.classificationName = 'SUV';
-- Query 6
-- DELETE QUERY
DELETE FROM inventory WHERE invId = 1;
-- Query 7
-- Update all records in the Inventory table
UPDATE inventory SET invImage = Concat('/phpmotors', invImage), invThumbnail = Concat('/phpmotors', invThumbnail);