SELECT DISTINCT TABLE_NAME
FROM INFORMATION_SCHEMA.COLUMNS
WHERE COLUMN_NAME='id_genero'
AND TABLE_SCHEMA='bd_sis_musica';
