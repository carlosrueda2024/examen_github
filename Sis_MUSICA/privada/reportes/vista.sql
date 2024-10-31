-- Active: 1716513176375@@127.0.0.1@3306@bd_sis_musica

CREATE VIEW vista_personas AS
SELECT ci, nombres, ap, am
FROM personas
WHERE estado = 'A';


CREATE VIEW vista_per_usu AS
SELECT CONCAT_WS(' ', pe.nombres, pe.ap, pe.am) AS persona, usu.usuario_principal
                FROM personas pe
                INNER JOIN usuarios usu ON pe.id_persona=usu.id_persona
                WHERE pe.estado ='A' 
                AND usu.estado = 'A' 
                ORDER BY usu.id_persona DESC ;

SELECT * FROM vista_per_usu;

CREATE VIEW vista_sistema_musica AS
SELECT nombre, logotipo
FROM sistema_musica
WHERE estado = 'A';

SELECT * FROM vista_sistema_musica;

/*
VISTA CANCIONES POR ARTISTA
*/
CREATE VIEW vista_canciones_artistas AS
SELECT c.nombre AS cancion, a.nombre_artistico AS artista, al.nombre AS album, g.nombre AS genero, c.duracion
FROM canciones c
JOIN albunes al ON c.id_albun = al.id_albun
JOIN artistas a ON al.id_artista = a.id_artista
JOIN generos g ON c.id_genero = g.id_genero
WHERE c.estado ='A' 
AND al.estado = 'A'
AND a.estado = 'A'
AND g.estado = 'A'
ORDER BY c.id_cancion DESC ;

SELECT * FROM vista_canciones_artistas;

/*
VALORACIONES CANCIONES
*/
CREATE VIEW vista_valoraciones_canciones AS
SELECT c.nombre AS cancion, v.valoracion, v.comentario, uv.nom_usuario
FROM valoraciones v
JOIN canciones c ON v.id_cancion = c.id_cancion
JOIN usuarios_visitas uv ON v.id_usuario_visita = uv.id_usuario_visita
WHERE v.estado ='A' 
AND c.estado = 'A'
AND uv.estado = 'A'
ORDER BY v.valoracion DESC;

SELECT * FROM vista_valoraciones_canciones;
