SELECT DISTINCT TABLE_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE COLUMN_NAME='id_persona'
AND TABLE_SCHEMA='bd_tienda';