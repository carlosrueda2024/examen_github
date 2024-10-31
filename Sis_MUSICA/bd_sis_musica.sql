-- Active: 1719701291224@@127.0.0.1@3306@bd_sis_musica


-- CREATE DATABASE bd_sis_musica;

CREATE TABLE sistema_musica(
id_sistema_musica INT NOT NULL AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
logotipo VARCHAR(50) DEFAULT 'logo.png',
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_sistema_musica)
)ENGINE=INNODB;

INSERT INTO sistema_musica VALUES(1,'MUSICA MAGICA','logo.png',now(),now(),1,'A');

CREATE TABLE usuarios_visitas(
id_usuario_visita INT NOT NULL AUTO_INCREMENT,
id_sistema_musica INT NOT NULL,
nom_usuario VARCHAR(30) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_usuario_visita),
FOREIGN KEY(id_sistema_musica) REFERENCES sistema_musica(id_sistema_musica)
)ENGINE=INNODB;

INSERT INTO usuarios_visitas VALUES(1,1,'usuario miusic',now(),now(),1,'A');

CREATE TABLE lista_reproduccion(
id_lista_reproduccion INT NOT NULL AUTO_INCREMENT,
id_usuario_visita INT NOT NULL,
nombre VARCHAR(20) NOT NULL,
descripcion VARCHAR(50),
fec_creacion DATE NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_lista_reproduccion),
FOREIGN KEY(id_usuario_visita) REFERENCES usuarios_visitas(id_usuario_visita)
)ENGINE=INNODB;

INSERT INTO lista_reproduccion VALUES(1,1,'mix de todo','lista de reproduccion favorita','2024-04-20',now(),now(),1,'A');

CREATE TABLE instrumentos(
id_instrumento INT NOT NULL AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
tipo VARCHAR(25) NOT NULL,
descripcion VARCHAR(50),
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_instrumento)
)ENGINE=INNODB;

INSERT INTO instrumentos VALUES(1,'guitarra','cuerda','intrumento de cuerda',now(),now(),1,'A');

CREATE TABLE generos(
id_genero INT NOT NULL AUTO_INCREMENT,
nombre VARCHAR(20) NOT NULL,
anio_origen INT,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_genero)
)ENGINE=INNODB;

INSERT INTO generos VALUES(1,'reggaeton',1960,now(),now(),1,'A');

CREATE TABLE artistas(
id_artista INT NOT NULL AUTO_INCREMENT,
id_genero INT NOT NULL,
nombreA VARCHAR(25) NOT NULL,
nombre_artistico VARCHAR(30) NOT NULL,
pais VARCHAR(20) NOT NULL,
fec_creacion DATE,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_artista),
FOREIGN KEY(id_genero) REFERENCES generos(id_genero)
)ENGINE=INNODB;

INSERT INTO artistas VALUES(1,1,'carlos','charly flow','Bolivia','2012-09-25',now(),now(),1,'A');

CREATE TABLE instrumentos_artistas(
id_instrumento_artista INT NOT NULL AUTO_INCREMENT,
id_artista INT NOT NULL,
id_instrumento INT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_instrumento_artista),
FOREIGN KEY(id_instrumento) REFERENCES instrumentos(id_instrumento),
FOREIGN KEY(id_artista) REFERENCES artistas(id_artista)
)ENGINE=INNODB;

INSERT INTO instrumentos_artistas VALUES(1,1,1,now(),now(),1,'A');

CREATE TABLE albunes(
id_albun INT NOT NULL AUTO_INCREMENT,
id_artista INT NOT NULL,
nombre VARCHAR(30) NOT NULL,
anio_lanza YEAR NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_albun),
FOREIGN KEY(id_artista) REFERENCES artistas(id_artista)
)ENGINE=INNODB;

INSERT INTO albunes VALUES(1,1,'verano feliz',2014,now(),now(),1,'A');

CREATE TABLE canciones(
id_cancion INT NOT NULL AUTO_INCREMENT,
id_sistema_musica INT NOT NULL,
id_genero INT NOT NULL,
id_albun INT NOT NULL,
nombre VARCHAR(255) NOT NULL,
duracion TIME NOT NULL,
anio_lanza INT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_cancion),
FOREIGN KEY(id_sistema_musica) REFERENCES sistema_musica(id_sistema_musica),
FOREIGN KEY(id_genero) REFERENCES generos(id_genero),
FOREIGN KEY(id_albun) REFERENCES albunes(id_albun)
)ENGINE=INNODB;

INSERT INTO canciones VALUES(1,1,1,1,'despacito','00:02:00',2012,now(),now(),1,'A');

CREATE TABLE valoraciones(
id_valoracion INT NOT NULL AUTO_INCREMENT,
id_usuario_visita INT NOT NULL,
id_cancion INT NOT NULL,
valoracion INT NOT NULL,
comentario VARCHAR(50) NOT NULL,
fec_hora DATETIME DEFAULT CURRENT_TIMESTAMP,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_valoracion),
FOREIGN KEY(id_usuario_visita) REFERENCES usuarios_visitas(id_usuario_visita),
FOREIGN KEY(id_cancion) REFERENCES canciones(id_cancion)
)ENGINE=INNODB;

INSERT INTO valoraciones VALUES(1,1,1,7,'esta cancion me encanta',now(),now(),now(),1,'A');

CREATE TABLE detalles_reproduccion(
id_detalle_reproducion INT NOT NULL AUTO_INCREMENT,
id_lista_reproduccion INT NOT NULL,
id_cancion INT NOT NULL,
orden_reproduccion INT NOT NULL,
fec_hora_reproduccion DATETIME DEFAULT CURRENT_TIMESTAMP,
navegador VARCHAR(20),
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_detalle_reproducion),
FOREIGN KEY(id_lista_reproduccion) REFERENCES lista_reproduccion(id_lista_reproduccion),
FOREIGN KEY(id_cancion) REFERENCES canciones(id_cancion)
)ENGINE=INNODB;

INSERT INTO detalles_reproduccion VALUES(1,1,1,1,now(),'brave',now(),now(),1,'A');


-- BASE DE DATOS INCLUIDA

CREATE TABLE compania_limpieza(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(30) NOT NULL,
direccion VARCHAR(50) NOT NULL,
telefono INT,
logo_compania VARCHAR (100)  
)ENGINE=INNODB;


CREATE TABLE sucursales(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
compania_limpieza_id INT NOT NULL,
dpto VARCHAR(30) NOT NULL,
telefono INT,
dir_suc VARCHAR(40) NOT NULL,
FOREIGN KEY(compania_limpieza_id)REFERENCES compania_limpieza(id)
)ENGINE=INNODB;

INSERT INTO compania_limpieza VALUES (1,'URRUTIBEHETY','C. Presbítero Medina–Sopocachi','22414038','ing.jpg');
INSERT INTO compania_limpieza VALUES (2,'ABC','C. JUNIN','3243555','abc.jpg');
INSERT INTO compania_limpieza VALUES (3,'LIMPIA-SUR','C. POTOSI','124444','limpia.jpg');


INSERT INTO sucursales VALUES (1,1,'Santa Cruz',33546868,'CUARTO ANILLO');
INSERT INTO sucursales VALUES (2,2,'Cochabamba',44243777, 'EL PRADO');
INSERT INTO sucursales VALUES (3,3,'La Paz',22414038, 'SOPOCACHI');
INSERT INTO sucursales VALUES (4,1,'Tarija',72118069, 'AV. LA PAZ');


CREATE TABLE heladeria_pasteleria(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
nombre_heladeria_pasteleria VARCHAR(30) NOT NULL,
direccion VARCHAR(60) NOT NULL,
telefono VARCHAR(30)
)ENGINE=INNODB;

CREATE TABLE tortas(
id INT AUTO_INCREMENT NOT NULL PRIMARY KEY,
heladeria_pasteleria_id INT NOT NULL,
nombre VARCHAR(30) NOT NULL,
cantidad INT NOT NULL,
precio FLOAT NOT NULL,
FOREIGN KEY(heladeria_pasteleria_id) REFERENCES heladeria_pasteleria (id)
)ENGINE=INNODB;

INSERT INTO heladeria_pasteleria VALUES(1,'ISCELA','BARRIO LAS PANOSAS CALLE LA MADRID','6669870');
INSERT INTO heladeria_pasteleria VALUES(2,'CAKE','COLON CASI INGAVI','7464644');
INSERT INTO heladeria_pasteleria VALUES(3,'DONUT','PLAZUELA SUCRE','2324449');



INSERT INTO tortas VALUES(1,1,'TORTA DE DULCE DE LECHE',20,140);
INSERT INTO tortas VALUES(2,2,'TORTA DE MOKKA',10,130);
INSERT INTO tortas VALUES(3,3,'TORTA DE TRES LECHES',15,150);
INSERT INTO tortas VALUES(4,1,'TORTA DE FRUTAS',12,160);
INSERT INTO tortas VALUES(5,2,'TORTA DE CHOCOLATE',25,140);

/*Utilizando el sistema web responsivo que están desarrollando y la siguiente base de datos:
  1.- Crear el grupo  
  2.- Dentro del grupo TERCER BIMESTRE-DWII crear una opción que se llame MENSAJES 
  3.- Visualizar el listado de PASTORES CON MENSAJES (BUSCADOR CON SELECT PARA LA HERENCIA E INPUTS
   PARA LA TABLA MENSAJES)
  4.- Insertar MENSAJES utilizando un buscador para la herencia

Nota.- Enviar lo solicitado (Sistema web y base de datos) en una carpeta comprimida con el nombre Ev_TERCERBI_CAMACHO_DW2.rar
*/
CREATE TABLE pastores(
   id_pastor INT NOT NULL AUTO_INCREMENT,
   especialidad VARCHAR(40) NOT NULL,
   sueldo FLOAT NOT NULL,
   fec_inicio_pa DATE NOT NULL,
   fec_fin_pa DATE,
   cargo VARCHAR(40) NOT NULL,
   fec_insercion TIMESTAMP NOT NULL,
   fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
   usuario INT NOT NULL,
   estado CHAR (1) NOT NULL,
   PRIMARY KEY(id_pastor)
 ) ENGINE=INNODB;

 INSERT INTO pastores VALUES(1,'LIC. TEOLOGIA EN MISIONES',5000,'2001-05-24','2005-05-24','PASTOR IGLESIA',now(),now(),1,'A');
    INSERT INTO pastores VALUES(2,'LIC. TEOLOGIA',4500,'2003-08-13','2006-08-13','PASTOR DE JOVENES',now(),now(),1,'A');
    INSERT INTO pastores VALUES(3,'TECNICO SUPERIOR EN TEOLOGIA',5000,'2005-06-15','2010-06-16','PASTOR IGLESIA',now(),now(),1,'A');
    INSERT INTO pastores VALUES(4,'LIC. TEOLOGIA EN MISIONES',4500,'2006-09-13','2010-09-13','PASTOR DE JOVENES',now(),now(),1,'A');
    INSERT INTO pastores VALUES(5,'LIC. TEOLOGIA',5000,'2010-09-18','2015-09-18','PASTOR IGLESIA',now(),now(),1,'A');
    INSERT INTO pastores VALUES(6,'LIC. TEOLOGIA',4500,'2010-10-25','2016-10-25','PASTOR DE JOVENES',now(),now(),1,'A');
    INSERT INTO pastores VALUES(7,'TECNICO SUPERIOR EN TEOLOGIA',5000,'2016-09-25','2021-09-25','PASTOR IGLESIA',now(),now(),1,'A');
    INSERT INTO pastores VALUES(8,'LIC. TEOLOGIA',4500,'2016-12-15','2020-12-15','PASTOR DE JOVENES',now(),now(),1,'A');
    INSERT INTO pastores VALUES(9,'LIC. TEOLOGIA',5000,'2021-10-12','2025-10-12','PASTOR IGLESIA',now(),now(),1,'A');
    INSERT INTO pastores VALUES(10,'TECNICO SUPERIOR EN TEOLOGIA',5000,'2021-01-22','2025-01-22','PASTOR DE JOVENES',now(),now(),1,'A');

CREATE TABLE mensajes (
    id_mensaje INT NOT NULL AUTO_INCREMENT,
    id_pastor INT NOT NULL,
    nombre_mensaje VARCHAR (40) NOT NULL,
    nombre_evento VARCHAR (30) NOT NULL,
    fecha DATETIME NOT NULL,  
    fec_insercion TIMESTAMP NOT NULL,
    fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario INT NOT NULL,
    estado CHAR (1) NOT NULL,
    PRIMARY KEY(id_mensaje),
    FOREIGN KEY (id_pastor) REFERENCES pastores(id_pastor)
 )ENGINE=INNODB;

    INSERT INTO mensajes VALUES (1,1,'HUIR DEL PECADO','CULTO DOMINICAL','2022-06-22',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (2,2,'TENTACIONES JUVENILES','CULTO JUVENIL','2022-06-21',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (3,3,'MUJER CONSAGRADA','CULTO FEMENIL','2022-06-24',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (4,4,'SIGUIENDO LOS PASOS DE JESÚS','CULTO JUVENIL','2022-06-28',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (5,5,'LA ORACION','CULTO DE ORACION','2022-06-27',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (6,6,'COMO AGRADAR A DIOS','CULTO FEMENIL','2022-06-24',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (7,7,'EL AMOR DE DIOS','CULTO JUVENIL','2022-06-28',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (8,8,'JESÚS ES EL CAMINO','CULTO JUVENIL','2022-06-29',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (9,9,'LA VENIDA DEL SEÑOR ','CULTO DOMINICAL','2022-06-30',now(),now(),1,'A');
    INSERT INTO mensajes VALUES (10,10,'LA PROMESA DE DIOS','CULTO FEMENIL','2022-07-01',now(),now(),1,'A');


-- HASTA AQUI

CREATE TABLE personas(
id_persona INT NOT NULL AUTO_INCREMENT,
id_sistema_musica INT NOT NULL,
nombres VARCHAR(25) NOT NULL,
ap VARCHAR(15),
am VARCHAR(15),
genero CHAR(1) NOT NULL,
telefono VARCHAR(15) NOT NULL,
direccion VARCHAR(50) NOT NULL,
ci VARCHAR(20) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_persona),
FOREIGN KEY(id_sistema_musica) REFERENCES sistema_musica (id_sistema_musica)
)ENGINE=INNODB;


INSERT INTO personas VALUES(1,1,'ROBERTO CARLOS','RUEDA','CUENCA','M','68683487','B. EL TEJAR AV. EDMUNDO TORREJON','10625213',now(),now(),1,'A');


CREATE TABLE usuarios(
id_usuario INT NOT NULL AUTO_INCREMENT,
id_persona INT NOT NULL,
usuario_principal VARCHAR(15) NOT NULL,
clave VARCHAR(100) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY (id_usuario),
FOREIGN KEY(id_persona) REFERENCES personas(id_persona)
)ENGINE=INNODB;

INSERT INTO usuarios VALUES(1,1,'admin','$2y$10$HxB1sZ3p/ok/Aa3cyATcsuGZoUrZzW5.TtmaiYh61S38axFgKVmXK',now(),now(),1,'A');

CREATE TABLE roles(
id_rol INT NOT NULL AUTO_INCREMENT,
rol VARCHAR(20) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY (id_rol)
)ENGINE=INNODB;

INSERT INTO roles VALUES(1,'ADMINISTRADOR',now(),now(),1,'A');
INSERT INTO roles VALUES(2,'EDITOR',now(),now(),1,'A');
INSERT INTO roles VALUES(3,'CONTADOR',now(),now(),1,'A');

CREATE TABLE usuarios_roles(
id_usuario_rol INT NOT NULL AUTO_INCREMENT,
id_usuario INT NOT NULL,
id_rol INT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_usuario_rol),
FOREIGN KEY(id_rol) REFERENCES roles(id_rol),
FOREIGN KEY(id_usuario) REFERENCES usuarios(id_usuario)
)ENGINE=INNODB;

INSERT INTO usuarios_roles VALUES(1,1,1,now(),now(),1,'A');

CREATE TABLE grupos(
id_grupo INT NOT NULL AUTO_INCREMENT,
grupo VARCHAR(30) NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_grupo)
)ENGINE=INNODB;

INSERT INTO grupos VALUES(1,'HERRAMIENTAS',now(),now(),1,'A');
INSERT INTO grupos VALUES(2,'SISTEMA_MUSICA',now(),now(),1,'A');
INSERT INTO grupos VALUES(3,'REPORTES',now(),now(),1,'A');
INSERT INTO grupos VALUES(4,'TERCER BIMESTRE-BDII',now(),now(),1,'A');
INSERT INTO grupos VALUES(5,'TERCER BIMESTRE-DWII',now(),now(),1,'A');
INSERT INTO grupos VALUES(6,'CUARTO BIMESTRE-DWII',now(),now(),1,'A');

CREATE TABLE opciones(
id_opcion INT NOT NULL AUTO_INCREMENT,
id_grupo INT NOT NULL,
opcion VARCHAR(50) NOT NULL,
contenido VARCHAR(80) NOT NULL,
orden INT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_opcion),
FOREIGN KEY(id_grupo) REFERENCES grupos(id_grupo)
)ENGINE=INNODB;

INSERT INTO opciones VALUES(1,1,'Personas','../privada/personas/personas.php',10,now(),now(),1,'A');

CREATE TABLE accesos(
id_acceso INT NOT NULL AUTO_INCREMENT,
id_opcion INT NOT NULL,
id_rol INT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_acceso),
FOREIGN KEY(id_rol) REFERENCES roles(id_rol),
FOREIGN KEY(id_opcion) REFERENCES opciones(id_opcion)
)ENGINE=INNODB;

INSERT INTO accesos VALUES(1,1,1,now(),now(),1,'A');

INSERT INTO usuarios_visitas VALUES(2, 1, 'Melomanito23', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(3, 1, 'RitmoLatino', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(4, 1, 'AmanteDeSonidos', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(5, 1, 'MelodiaEterna', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(6, 1, 'BailarinDelViento', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(7, 1, 'CantanteDeAlma', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(8, 1, 'NotasMagicas', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(9, 1, 'ArmoniaSerena', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(10, 1, 'SonidosDelCorazon', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(11, 1, 'EcoMelodico', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(12, 1, 'SintoníaNatural', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(13, 1, 'VibracionPositiva', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(14, 1, 'SonidoVital', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(15, 1, 'CadenciaPerfecta', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(16, 1, 'MelodíaInfinita', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(17, 1, 'CantoCelestial', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(18, 1, 'RitmoEterno', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(19, 1, 'ArmoníaDivina', now(), now(), 1, 'A');
INSERT INTO usuarios_visitas VALUES(20, 1, 'SonidoEterno', now(), now(), 1, 'A');


INSERT INTO lista_reproduccion VALUES(2, 2, 'rock clásico', 'canciones legendarias de rock', '2024-05-01', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(3, 3, 'pop en español', 'éxitos pop en idioma español', '2024-05-02', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(4, 4, 'música electrónica', 'ritmos electrónicos para bailar', '2024-05-03', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(5, 5, 'jazz instrumental', 'melodías relajantes de jazz', '2024-05-04', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(6, 6, 'banda sonora películas', 'música de películas famosas', '2024-05-05', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(7, 7, 'reggaeton latino', 'éxitos de reggaeton latino', '2024-05-06', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(8, 8, 'folklore nacional', 'música tradicional del país', '2024-05-07', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(9, 9, 'soul y R&B', 'canciones soul y R&B', '2024-05-08', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(10, 10, 'clásicos del siglo XX', 'canciones icónicas del siglo XX', '2024-05-09', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(11, 11, 'hip hop old school', 'clásicos del hip hop', '2024-05-10', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(12, 12, 'indie alternativo', 'éxitos indie y alternativo', '2024-05-11', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(13, 13, 'country moderno', 'lo mejor del country actual', '2024-05-12', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(14, 14, 'blues clásico', 'canciones clásicas de blues', '2024-05-13', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(15, 15, 'rock alternativo', 'lo mejor del rock alternativo', '2024-05-14', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(16, 16, 'música clásica', 'obras maestras de la música clásica', '2024-05-15', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(17, 17, 'salsa y merengue', 'ritmos tropicales para bailar', '2024-05-16', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(18, 18, 'k-pop', 'éxitos del pop coreano', '2024-05-17', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(19, 19, 'reggae vibes', 'vibraciones relajantes del reggae', '2024-05-18', now(), now(), 1, 'A');
INSERT INTO lista_reproduccion VALUES(20, 20, 'baladas románticas', 'las mejores baladas románticas', '2024-05-19', now(), now(), 1, 'A');


INSERT INTO instrumentos VALUES(2, 'batería', 'percusión', 'instrumento de percusión', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(3, 'piano', 'teclado', 'instrumento de teclado', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(4, 'violín', 'cuerda', 'instrumento de cuerda', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(5, 'saxofón', 'viento', 'instrumento de viento', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(6, 'trompeta', 'viento', 'instrumento de viento', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(7, 'bajo', 'cuerda', 'instrumento de cuerda', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(8, 'flauta', 'viento', 'instrumento de viento', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(9, 'arpa', 'cuerda', 'instrumento de cuerda', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(10, 'ukulele', 'cuerda', 'instrumento de cuerda', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(11, 'guitarra', 'cuerda', 'instrumento de cuerda', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(12, 'clarinete', 'viento', 'instrumento de viento', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(13, 'trombón', 'viento', 'instrumento de viento', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(14, 'marimba', 'percusión', 'instrumento de percusión', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(15, 'xilófono', 'percusión', 'instrumento de percusión', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(16, 'oboe', 'viento', 'instrumento de viento', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(17, 'tuba', 'viento', 'instrumento de viento', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(18, 'mandolina', 'cuerda', 'instrumento de cuerda', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(19, 'banjo', 'cuerda', 'instrumento de cuerda', NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos VALUES(20, 'acordeón', 'teclado', 'instrumento de teclado', NOW(), NOW(), 1, 'A');


INSERT INTO generos VALUES(2, 'electrónica', 1960, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(3, 'hip hop', 1970, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(4, 'jazz', 1910, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(5, 'blues', 1890, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(6, 'country', 1910, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(7, 'reggae', 1960, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(8, 'salsa', 1960, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(9, 'rock', 1950, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(10, 'pop', 1950, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(11, 'clásica', 1750, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(12, 'folk', 1920, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(13, 'metal', 1960, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(14, 'punk', 1970, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(15, 'funk', 1960, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(16, 'soul', 1950, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(17, 'R&B', 1940, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(18, 'disco', 1970, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(19, 'gospel', 1930, NOW(), NOW(), 1, 'A');
INSERT INTO generos VALUES(20, 'latino', 1950, NOW(), NOW(), 1, 'A');


INSERT INTO artistas VALUES(2, 2, 'John Lennon', 'Lennon', 'Reino Unido', '1957-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(3, 3, 'Daft Punk', 'Daft Punk', 'Francia', '1993-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(4, 4, 'Eminem', 'Eminem', 'Estados Unidos', '1988-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(5, 5, 'Louis Armstrong', 'Armstrong', 'Estados Unidos', '1922-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(6, 6, 'B King', 'B King', 'Estados Unidos', '1946-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(7, 7, 'Johnny Cash', 'Cash', 'Estados Unidos', '1954-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(8, 8, 'Bob Marley', 'Marley', 'Jamaica', '1962-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(9, 9, 'Celia Cruz', 'Celia Cruz', 'Cuba', '1948-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(10, 2, 'Paul McCartney', 'McCartney', 'Reino Unido', '1957-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(11, 9, 'Elvis Presley', 'Presley', 'Estados Unidos', '1954-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(12, 10, 'Madonna', 'Madonna', 'Estados Unidos', '1982-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(13, 4, 'Miles Davis', 'Davis', 'Estados Unidos', '1944-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(14, 5, 'B.B. King', 'King', 'Estados Unidos', '1949-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(15, 6, 'Dolly Parton', 'Parton', 'Estados Unidos', '1967-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(16, 7, 'Shakira', 'Shakira', 'Colombia', '1990-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(17, 8, 'Marc Anthony', 'Anthony', 'Estados Unidos', '1988-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(18, 3, 'Kanye West', 'West', 'Estados Unidos', '2004-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(19, 10, 'Michael Jackson', 'Jackson', 'Estados Unidos', '1964-01-01', NOW(), NOW(), 1, 'A');
INSERT INTO artistas VALUES(20, 2, 'George Harrison', 'Harrison', 'Reino Unido', '1957-01-01', NOW(), NOW(), 1, 'A');


INSERT INTO instrumentos_artistas VALUES(2,2,2, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(3,3,3, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(4,4,4, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(5,5,5, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(6,6,6, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(7,7,7, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(8,8,8, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(9,9,9, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(10,10,10, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(11, 11, 11, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(12, 12, 12, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(13, 13, 13, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(14, 14, 14, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(15, 15, 15, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(16, 16, 16, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(17, 17, 17, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(18, 18, 18, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(19, 19, 19, NOW(), NOW(), 1, 'A');
INSERT INTO instrumentos_artistas VALUES(20, 20, 20, NOW(), NOW(), 1, 'A');


INSERT INTO albunes VALUES(2, 2, 'Verano Feliz', 2014, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(3, 3, 'Recuerdos de Otoño', 2012, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(4, 4, 'Noches de Invierno', 2019, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(5, 5, 'Primavera en París', 2015, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(6, 6, 'Melodías de Verano', 2018, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(7, 7, 'Canciones de la Playa', 2016, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(8, 8, 'Sueños de Música', 2020, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(9, 9, 'Voces del Alma', 2013, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(10, 10, 'Ritmos del Corazón', 2017, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(11, 11, 'Sonidos de la Noche', 2021, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(12, 12, 'Ecos del Pasado', 2011, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(13, 13, 'Vibraciones Positivas', 2019, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(14, 14, 'Armonías de la Vida', 2010, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(15, 15, 'Melodías Eternas', 2016, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(16, 16, 'Notas de la Naturaleza', 2014, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(17, 17, 'Ritmos Tropicales', 2018, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(18, 18, 'Canciones del Corazón', 2015, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(19, 19, 'Instrumentales del Alma', 2013, NOW(), NOW(), 1, 'A');
INSERT INTO albunes VALUES(20, 20, 'Baladas Románticas', 2022, NOW(), NOW(), 1, 'A');


INSERT INTO canciones VALUES(2, 1, 1, 2, 'recuerdame', '00:02:00', 2017, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(3, 1, 1, 3, 'Recuerdos', '00:03:45', 2012, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(4, 1, 2, 4, 'Noche de Estrellas', '00:04:20', 2019, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(5, 1, 2, 5, 'Flores en el Aire', '00:03:15', 2015, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(6, 1, 3, 6, 'Bajo el Sol', '00:05:30', 2018, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(7, 1, 3, 7, 'Arena y Mar', '00:04:10', 2016, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(8, 1, 4, 8, 'Sueño Dorado', '00:03:55', 2020, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(9, 1, 4, 9, 'Voces del Viento', '00:03:40', 2013, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(10, 1, 5, 10, 'Latidos del Alma', '00:04:45', 2017, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(11, 1, 5, 11, 'Notas de Amor', '00:03:30', 2014, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(12, 1, 6, 12, 'Sinfonía No. 5', '00:07:20', 2021, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(13, 1, 6, 13, 'Melodía de Ensueño', '00:06:10', 2011, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(14, 1, 7, 14, 'Ritmo Caliente', '00:03:50', 2022, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(15, 1, 7, 15, 'Fuego Latino', '00:04:30', 2020, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(16, 1, 8, 16, 'Cantos de mi Tierra', '00:05:00', 2018, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(17, 1, 8, 17, 'Raíces', '00:04:50', 2015, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(18, 1, 9, 18, 'Alma Soul', '00:03:25', 2016, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(19, 1, 9, 19, 'R&B Vibes', '00:04:05', 2019, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(20, 1, 10, 20, 'Recuerdos del Pasado', '00:04:35', 2023, NOW(), NOW(), 1, 'A');
INSERT INTO canciones VALUES(21, 1, 10, 20, 'Cancion de prueba', '00:04:35', 2024, NOW(), NOW(), 1, 'A');


INSERT INTO valoraciones VALUES(2, 2, 2, 8, 'Una canción increíblemente pegajosa', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(3, 3, 3, 9, 'Esta canción me recuerda a tiempos más felices', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(4, 4, 4, 7, 'Me encanta la atmósfera que crea esta canción', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(5, 5, 5, 6, 'Hermosa melodía, perfecta para la primavera', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(6, 6, 6, 8, 'Me hace recordar los días calurosos de verano', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(7, 7, 7, 7, 'Una canción relajante para escuchar en la playa', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(8, 8, 8, 9, 'Perfecta para escuchar antes de dormir', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(9, 9, 9, 8, 'Me transporta a lugares lejanos', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(10, 10, 10, 7, 'Canción emocionante, con un gran ritmo', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(11, 11, 11, 9, 'Una joya musical que no me canso de escuchar', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(12, 12, 12, 8, 'Llena de energía, perfecta para animarse', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(13, 13, 13, 7, 'Una balada conmovedora', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(14, 14, 14, 6, 'Un clásico que nunca pasa de moda', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(15, 15, 15, 9, 'Evocadora y llena de nostalgia', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(16, 16, 16, 8, 'Ritmo contagioso, no puedo dejar de moverme', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(17, 17, 17, 7, 'Me lleva a una época diferente', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(18, 18, 18, 6, 'Pura magia en cada nota', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(19, 19, 19, 9, 'Una obra maestra musical', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(20, 20, 20, 8, 'Llena de pasión y energía', NOW(), NOW(), NOW(), 1, 'A');
INSERT INTO valoraciones VALUES(21, 20, 20, 8, 'Llena de pasión y energía', NOW(), NOW(), NOW(), 1, 'A');


INSERT INTO detalles_reproduccion VALUES(2, 2, 2, 2, NOW(), 'Chrome', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(3, 3, 3, 3, NOW(), 'Firefox', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(4, 4, 4, 4, NOW(), 'Safari', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(5, 5, 5, 5, NOW(), 'Edge', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(6, 6, 6, 6, NOW(), 'Brave', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(7, 7, 7, 7, NOW(), 'Opera', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(8, 8, 8, 8, NOW(), 'Chrome', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(9, 9, 9, 9, NOW(), 'Firefox', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(10, 10, 10, 10, NOW(), 'Safari', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(11, 11, 11, 11, NOW(), 'Edge', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(12, 12, 12, 12, NOW(), 'Brave', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(13, 13, 13, 13, NOW(), 'Opera', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(14, 14, 14, 14, NOW(), 'Chrome', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(15, 15, 15, 15, NOW(), 'Firefox', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(16, 16, 16, 16, NOW(), 'Safari', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(17, 17, 17, 17, NOW(), 'Edge', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(18, 18, 18, 18, NOW(), 'Brave', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(19, 19, 19, 19, NOW(), 'Opera', NOW(), NOW(), 1, 'A');
INSERT INTO detalles_reproduccion VALUES(20, 20, 20, 20, NOW(), 'Chrome', NOW(), NOW(), 1, 'A');


INSERT INTO personas VALUES (2, 1, 'CARLOS', 'RUEDA', 'FIQUEROA', 'M', '68683487', 'B. EL TEJAR AV. EDMUNDO TORREJON', '10625213', now(), now(), 1, 'A');
INSERT INTO personas VALUES (3, 1, 'MARIA', 'PEREZ', 'GARCIA', 'F', '68473629', 'C. LOS CLAVELES #123', '23487656', now(), now(), 2, 'A');
INSERT INTO personas VALUES (4, 1, 'JUAN', 'RAMIREZ', 'GOMEZ', 'M', '68492374', 'AV. LOS ANDES #456', '19876543', now(), now(), 2, 'A');
INSERT INTO personas VALUES (5, 1, 'ANA', 'LOPEZ', 'MARTINEZ', 'F', '68573462', 'CALLE 7 #789', '15678923', now(), now(), 3, 'A');
INSERT INTO personas VALUES (6, 1, 'LUCAS', 'GONZALEZ', 'HERNANDEZ', 'M', '68645238', 'AV. LIBERTADOR #321', '14567234', now(), now(), 3, 'A');
INSERT INTO personas VALUES (7, 1, 'MARTA', 'SANCHEZ', 'RAMOS', 'F', '68756429', 'B. LAS FLORES #654', '17894567', now(), now(), 4, 'A');
INSERT INTO personas VALUES (8, 1, 'PEDRO', 'TORRES', 'DOMINGUEZ', 'M', '68672345', 'AV. DEL SOL #987', '16789542', now(), now(), 4, 'A');
INSERT INTO personas VALUES (9, 1, 'ELENA', 'FERNANDEZ', 'ORTEGA', 'F', '68823456', 'C. DE LA PAZ #123', '13579246', now(), now(), 5, 'A');
INSERT INTO personas VALUES (10, 1, 'JORGE', 'ALVAREZ', 'RIOS', 'M', '68734567', 'B. SANTA CRUZ #456', '12457896', now(), now(), 5, 'A');
INSERT INTO personas VALUES (11, 1, 'ISABEL', 'GOMEZ', 'FERREIRA', 'F', '68645678', 'AV. LA PLATA #789', '14589673', now(), now(), 6, 'A');
INSERT INTO personas VALUES (12, 1, 'DANIEL', 'NAVARRO', 'ESPINOZA', 'M', '68934567', 'C. BELGRANO #321', '13794568', now(), now(), 6, 'A');
INSERT INTO personas VALUES (13, 1, 'SARA', 'HERRERA', 'MORALES', 'F', '68845679', 'B. CENTRAL #654', '15489673', now(), now(), 7, 'A');
INSERT INTO personas VALUES (14, 1, 'VICTOR', 'MARTINEZ', 'PEREIRA', 'M', '68756789', 'AV. SAN MARTIN #987', '12456789', now(), now(), 7, 'A');
INSERT INTO personas VALUES (15, 1, 'NATALIA', 'SUAREZ', 'AGUIRRE', 'F', '68956789', 'C. TARIJA #123', '19876543', now(), now(), 8, 'A');
INSERT INTO personas VALUES (16, 1, 'ENRIQUE', 'RODRIGUEZ', 'MARTINEZ', 'M', '68678901', 'AV. COCHABAMBA #456', '16783945', now(), now(), 8, 'A');
INSERT INTO personas VALUES (17, 1, 'GABRIELA', 'DELGADO', 'LOPEZ', 'F', '68789012', 'C. LA PAZ #789', '13579024', now(), now(), 9, 'A');
INSERT INTO personas VALUES (18, 1, 'RAUL', 'VARGAS', 'MORALES', 'M', '68890123', 'B. LAS AMERICAS #321', '14689573', now(), now(), 9, 'A');
INSERT INTO personas VALUES (19, 1, 'PAULA', 'RAMIREZ', 'SANTOS', 'F', '68901234', 'AV. BOLIVAR #654', '14567983', now(), now(), 10, 'A');
INSERT INTO personas VALUES (20, 1, 'HUGO', 'ESPINOZA', 'GUTIERREZ', 'M', '68612345', 'C. SUCRE #987', '16789324', now(), now(), 10, 'A');

INSERT INTO usuarios VALUES(2,2,'admin2','$2y$10$Kp7mk0W3EepnPOtABdVZuOG1M1hYpM5SYgP4gynzI0lGSRN.x5bXC',now(),now(),1,'A');
INSERT INTO usuarios VALUES(3,3,'admin3','$2y$10$vWTPR0xLwQLBsCBsab4daeqkBs1N3U.BWxm2Evwq7DDTqsyJwrB5e',now(),now(),1,'A');

INSERT INTO usuarios_roles VALUES(2,2,2,now(),now(),1,'A');
INSERT INTO usuarios_roles VALUES(3,3,3,now(),now(),1,'A');


INSERT INTO opciones VALUES(2,1,'Usuarios','../privada/usuarios/usuarios.php',20,now(),now(),1,'A');
INSERT INTO opciones VALUES(3,1,'Grupos','../privada/grupos/grupos.php',30,now(),now(),1,'A');
INSERT INTO opciones VALUES(4,1,'Roles','../privada/roles/roles.php',40,now(),now(),1,'A');
INSERT INTO opciones VALUES(5,1,'Usuarios Roles','../usuarios_roles/usuarios_roles.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(6,1,'Opciones','../privada/opciones/opciones.php',60,now(),now(),1,'A');
INSERT INTO opciones VALUES(7,1,'Accesos','../privada/accesos/accesos.php',70,now(),now(),1,'A');
INSERT INTO opciones VALUES(8,2,'Sistema Musica','../privada/sistema_musica/sistema_musica_modificar.php',10,now(),now(),1,'A');
INSERT INTO opciones VALUES(9,2,'Usuarios Visitas','../privada/usuarios_visitas/usuarios_visitas.php',20,now(),now(),1,'A');
INSERT INTO opciones VALUES(10,2,'Lista Reproduccion','../privada/lista_reproduccion/lista_reproduccion.php',30,now(),now(),1,'A');
INSERT INTO opciones VALUES(11,2,'Canciones','../privada/canciones/canciones.php',40,now(),now(),1,'A');
INSERT INTO opciones VALUES(12,2,'Valoraciones','../privada/valoraciones/valoraciones.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(13,2,'Instrumentos','../privada/instrumentos/instrumentos.php',60,now(),now(),1,'A');
INSERT INTO opciones VALUES(14,2,'Artistas','../privada/artistas/artistas.php',70,now(),now(),1,'A');
INSERT INTO opciones VALUES(15,2,'Instrumentos Artistas','../privada/instrumentos/instrumentos.php',80,now(),now(),1,'A');
INSERT INTO opciones VALUES(16,2,'Albunes','../privada/albunes/albunes.php',80,now(),now(),1,'A');
INSERT INTO opciones VALUES(17,2,'Generos','../privada/generos/generos.php',80,now(),now(),1,'A');
INSERT INTO opciones VALUES(18,2,'Detalles Reproduccion','../privada/detalles_reproduccion/detalles_reproduccion.php',80,now(),now(),1,'A');
INSERT INTO opciones VALUES(19,3,'Rpt Personas con Usuarios','../privada/reportes/personas_usuarios.php',10,now(),now(),1,'A');
INSERT INTO opciones VALUES(20,3,'Rpt Personas por fechas','../privada/reportes/personas_fechas.php',20,now(),now(),1,'A');
INSERT INTO opciones VALUES(21,3,'Rpt Canciones por Artista','../privada/reportes/canciones_artistas.php',30,now(),now(),1,'A');
INSERT INTO opciones VALUES(22,3,'Rpt Valoraciones de Canciones','../privada/reportes/valoraciones_canciones.php',40,now(),now(),1,'A');
INSERT INTO opciones VALUES(23,3,'Rpt Albunes por Artista','../privada/reportes/albunes_artistas.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(24,3,'Rpt Persona por Genero','../privada/reportes/personas_genero.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(25,3,'Rpt Canciones por Genero','../privada/reportes/canciones_genero.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(26,3,'Ficha Tecnica Artistas por Genero','../privada/reportes1/ficha_artistas_genero.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(27,3,'Ficha Tecnica de Personas','../privada/reportes1/ficha_tec_personas.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(28,4,'Rpt SUCURSALES POR COMPAÑIA','../privada/reportes1/sucursales_compania.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(29,4,'Ficha Tecnica Sucursales','../privada/reportes1/ficha_sucursales.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(30,3,'Reportes Estadisticos','../privada/reportes1/reportes_estadisticos.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(31,5,'TORTAS','../privada/reportes2/tortas.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(32,5,'MENSAJES','../privada/mensajes/mensajes.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(33,4,'Ev. Bimestral','../privada/reportes1/reportes_estadisticos2.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(34,6,'API GEOLOCALIZACION','../privada/api/api.php',50,now(),now(),1,'A');
INSERT INTO opciones VALUES(35,6,'Formulario Dinamico','../privada/formulario_dinamico/formu_dinamico.php',50,now(),now(),1,'A');


INSERT INTO accesos VALUES(2,2,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(3,3,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(4,4,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(5,5,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(6,6,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(7,7,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(8,8,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(9,9,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(10,10,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(11,11,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(12,12,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(13,13,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(14,14,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(15,15,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(16,16,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(17,17,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(18,18,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(19,19,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(20,20,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(21,21,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(22,22,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(23,23,1,now(),now(),1,'A');

-- ACCESO PARA USUARIO 2
INSERT INTO accesos VALUES(24,8,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(25,9,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(26,10,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(27,11,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(28,12,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(29,13,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(30,14,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(31,15,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(32,16,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(33,17,2,now(),now(),1,'A');
INSERT INTO accesos VALUES(34,18,2,now(),now(),1,'A');

-- ACCESO PARA USUARIO 3
INSERT INTO accesos VALUES(35,19,3,now(),now(),1,'A');
INSERT INTO accesos VALUES(36,20,3,now(),now(),1,'A');
INSERT INTO accesos VALUES(37,21,3,now(),now(),1,'A');
INSERT INTO accesos VALUES(38,22,3,now(),now(),1,'A');
INSERT INTO accesos VALUES(39,23,3,now(),now(),1,'A');
INSERT INTO accesos VALUES(40,24,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(41,25,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(42,26,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(43,27,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(44,28,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(45,29,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(46,30,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(47,31,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(48,32,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(49,33,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(50,34,1,now(),now(),1,'A');
INSERT INTO accesos VALUES(51,35,1,now(),now(),1,'A');
/*VISTAS*/

CREATE VIEW vista_per_usu AS
SELECT CONCAT_WS(' ', pe.nombres, pe.ap, pe.am) AS persona, usu.usuario_principal
                FROM personas pe
                INNER JOIN usuarios usu ON pe.id_persona=usu.id_persona
                WHERE pe.estado ='A' 
                AND usu.estado = 'A' 
                ORDER BY usu.id_persona DESC ;

CREATE VIEW vista_sistema_musica AS
SELECT nombre, logotipo
FROM sistema_musica
WHERE estado = 'A';

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

/*seleccionar los artistas que se crearon entre 1985 y 2024, mostrar el nombre y el nombre artistioco en una sola tabla*/
CREATE VIEW vista_artistas_generos AS
SELECT a.nombreA, CONCAT(a.nombreA,' ', a.nombre_artistico) AS nombre_completo_artista, g.nombre AS nombre_genero, a.fec_creacion
FROM artistas a
JOIN generos g ON a.id_genero = g.id_genero
WHERE a.estado = 'A'
AND g.estado = 'A'
AND a.fec_creacion BETWEEN '1985-01-01' AND '2024-12-31';


/*Obtener la lista de reproducción con el mayor número de canciones, ordenar de mayor a menor y el total de canciones en ella*/
CREATE VIEW vista_lista_detalles_reproduccion AS
SELECT lr.nombre AS Lista_Reproduccion,
COUNT(dr.id_cancion) AS Total_Canciones
FROM lista_reproduccion lr
JOIN detalles_reproduccion dr ON lr.id_lista_reproduccion = dr.id_lista_reproduccion
GROUP BY lr.nombre
ORDER BY Total_Canciones DESC;


-- INDICES

CREATE TABLE canciones_indices(
id_cancion INT NOT NULL AUTO_INCREMENT,
id_sistema_musica INT NOT NULL,
id_genero INT NOT NULL,
id_albun INT NOT NULL,
nombre VARCHAR(25) NOT NULL,
duracion TIME NOT NULL,
anio_lanza INT NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_cancion),
FOREIGN KEY(id_sistema_musica) REFERENCES sistema_musica(id_sistema_musica),
FOREIGN KEY(id_genero) REFERENCES generos(id_genero),
FOREIGN KEY(id_albun) REFERENCES albunes(id_albun)
)ENGINE=INNODB;

-- INDEX

CREATE TABLE artistas_indices(
id_artista INT NOT NULL AUTO_INCREMENT,
id_genero INT NOT NULL,
nombre VARCHAR(25) NOT NULL,
nombre_artistico VARCHAR(30) NOT NULL,
pais VARCHAR(20) NOT NULL,
fec_creacion DATE,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_artista),
FOREIGN KEY(id_genero) REFERENCES generos(id_genero),
INDEX i_nombre(nombre),
INDEX i_nombre_artistio(nombre_artistico)
)ENGINE=INNODB;

-- UNIQUE

CREATE TABLE lista_reproduccion_indices(
id_lista_reproduccion INT NOT NULL AUTO_INCREMENT,
id_usuario_visita INT NOT NULL,
nombre VARCHAR(20) NOT NULL,
descripcion VARCHAR(50),
fec_creacion DATE NOT NULL,
fec_insercion TIMESTAMP NOT NULL,
fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
usuario INT NOT NULL,
estado CHAR(1) NOT NULL,
PRIMARY KEY(id_lista_reproduccion),
FOREIGN KEY(id_usuario_visita) REFERENCES usuarios_visitas(id_usuario_visita),
UNIQUE i_nombre(nombre)
)ENGINE=INNODB;

-- FUNCIONES

DELIMITER //
    CREATE FUNCTION contar_registros()
        RETURNS INT
        BEGIN 
            DECLARE resultado INT;

            SELECT COUNT (id_persona) INTO resultado
            FROM personas
            WHERE estado ='A';

            RETURN resultado;
        END //
DELIMITER;

DELIMITER //
CREATE FUNCTION contar_canciones_por_anio() 
RETURNS INT
    BEGIN
        DECLARE resultado INT;
        SELECT COUNT(c.id_cancion) INTO resultado
        FROM canciones c
        JOIN generos g ON c.id_genero = g.id_genero
        WHERE c.anio_lanza > 2000
        AND c.estado = 'A'
        AND g.estado = 'A';

        RETURN resultado;
    END //
DELIMITER;

DELIMITER //
CREATE FUNCTION duracion_total_lista()
RETURNS TIME
BEGIN
    DECLARE total_duracion TIME;
    SELECT SEC_TO_TIME(SUM(TIME_TO_SEC(c.duracion))) INTO total_duracion
    FROM detalles_reproduccion dr
    JOIN canciones c ON dr.id_cancion = c.id_cancion
    WHERE dr.estado = 'A'
    AND c.estado='A';
    RETURN total_duracion;
END; //
DELIMITER ;

-- PROCEDIMIENTOS
DELIMITER //
CREATE PROCEDURE listado_personas_fechas(IN fec_inicio DATE, IN fec_fin DATE)
    BEGIN
    SELECT *
    FROM personas
    WHERE DATE(fec_insercion) BETWEEN fec_inicio AND fec_fin
    AND estado = 'A';
END //
DELIMITER ;
-- CALL listado_personas_fechas('2018-06-01', '2024-06-30');




DELIMITER //

CREATE PROCEDURE listado_usuarios(IN inicio VARCHAR(6))
BEGIN
    SELECT *
    FROM usuarios_visitas
    WHERE nom_usuario LIKE CONCAT(inicio, '%')
    AND estado = 'A';
END //

DELIMITER ;
-- CALL listado_usuarios('A')



DELIMITER //
CREATE PROCEDURE listado_detalles_reproduccion_con_canciones(IN navegador VARCHAR(10))
BEGIN
    SELECT dr.navegador, c.nombre AS Nombre_cancion
    FROM detalles_reproduccion dr
    JOIN canciones c ON dr.id_cancion = c.id_cancion
    WHERE dr.navegador = navegador
    AND dr.estado = 'A'
    AND c.estado = 'A';
END;
 //
DELIMITER ;

-- CALL listado_detalles_reproduccion_con_canciones('brave')

/*TRIGGERS*/

-- TABLA DE RESPALDO DE CANCIONES
CREATE TABLE respaldo_canciones(
id_respaldo_cancion INT NOT NULL AUTO_INCREMENT,
id_cancion INT,
id_sistema_musica INT,
id_genero INT,
id_albun INT,
nombre VARCHAR(25),
duracion TIME,
anio_lanza INT,
estado CHAR(1),
tipo_operacion VARCHAR(10),
fec_operacion TIMESTAMP,
PRIMARY KEY(id_respaldo_cancion)
)ENGINE=INNODB;

-- TRIGGER PARA GUARDAR UN RESPALDO DE LAS ELIMINACION Y MODIFICACION EN TABLA CANCIONES

DELIMITER //
CREATE TRIGGER respaldo_update_canciones
AFTER UPDATE ON canciones
FOR EACH ROW
BEGIN
    INSERT INTO respaldo_canciones (
        id_cancion, 
        id_sistema_musica, 
        id_genero, id_albun, 
        nombre, 
        duracion,
        anio_lanza, 
        estado, 
        tipo_operacion, 
        fec_operacion
    )
    VALUES (
        NEW.id_cancion, NEW.id_sistema_musica, NEW.id_genero, NEW.id_albun, NEW.nombre, NEW.duracion,
        NEW.anio_lanza, NEW.estado,
        IF(OLD.estado != NEW.estado AND NEW.estado = 'X', 'DELETE', 'UPDATE'), NOW()
    );
END//
DELIMITER ;

-- TABLA DE HISTORIAL DE USUARIOS VISITAS

CREATE TABLE usuarios_visitas_historial(
    id_historial INT NOT NULL AUTO_INCREMENT,
    id_usuario_visita INT,
    nom_usuario VARCHAR(15),
    usuario INT,
    fec_modificacion_historial TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY(id_historial)
)ENGINE=INNODB;

-- TRIGGER PARA GUARDAR HISTORIAL DE MODIFICACION DE USUARIOS VISITAS
DELIMITER //

CREATE TRIGGER usuarios_visitas_historial
AFTER UPDATE ON usuarios_visitas
FOR EACH ROW
BEGIN
    INSERT INTO usuarios_visitas_historial (
        id_usuario_visita,
        nom_usuario,
        usuario
    ) VALUES (
        OLD.id_usuario_visita,
        OLD.nom_usuario,
        OLD.usuario
    );
END//

DELIMITER ;

CREATE TABLE rubros(
    id_rubro INT NOT NULL AUTO_INCREMENT,
    rubro VARCHAR(30)NOT NULL,
    vida_util INT NOT NULL,
    porcen_depreciacion FLOAT NOT NULL,
    depreciacion VARCHAR(10)NOT NULL,
    fec_insercion TIMESTAMP NOT NULL,
    fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario INT NOT NULL,
    estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_rubro)
)ENGINE=INNODB;

INSERT INTO rubros VALUES (1, 'Terrenos', 10, 10.00, 'NO', NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (2, 'Edificaciones', 40, 2.5, 'SI', NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (3, 'Muebles y Enseres de oficina', 10, 10.00, 'SI',  NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (4, 'Equipos de Computacion', 4, 25.00, 'SI',  NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (5, 'Vehiculo Automotores', 5, 20.00, 'SI',  NOW(), NOW(), 1, 'A');
INSERT INTO rubros VALUES (6, 'Herramientas en Generales', 4, 25.00, 'SI', NOW(), NOW(), 1, 'A');

CREATE TABLE categorias(
    id_categoria INT NOT NULL AUTO_INCREMENT,
    id_rubro INT NOT NULL,
    categoria_rubro VARCHAR(30)NOT NULL,
    fec_insercion TIMESTAMP NOT NULL,
    fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario INT NOT NULL,
    estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_categoria),
    FOREIGN KEY(id_rubro)REFERENCES rubros(id_rubro)
)ENGINE=INNODB;

INSERT INTO categorias VALUES (1, 1,'Terreno', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (2, 2,'Edificacion',  NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (3, 2,'Vivienda',  NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (4, 3,'Pupitre', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (5, 3,'Silla', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (6, 3,'Mesa de Escritorio', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (7, 3,'Casillero Metalico', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (8, 3,'Casillero Madera', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (9, 3,'Ventilador', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (11, 4,'Computadora', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (12, 4,'Impresora', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (13, 4,'Proyector', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (14, 5,'Vehiculo', NOW(), NOW(), 1, 'A');
INSERT INTO categorias VALUES (15, 6,'Taladro', NOW(), NOW(), 1, 'A');

CREATE TABLE activos_fijos(
    id_activo_fijo INT NOT NULL AUTO_INCREMENT,
    id_categoria INT NOT NULL,
    descripcion VARCHAR(100) NOT NULL,
    fecha_adquisicion DATE NOT NULL, 
    fecha_activacion DATE, 
    fotografia VARCHAR(30),
    nro_documento VARCHAR(50),
    valor FLOAT,
    valor_residual FLOAT,
    responsable VARCHAR(50),
    depreciacion VARCHAR(50), /*del id_categoria 4 al 15*/
    marca_del_activo VARCHAR(25),  /*del id_categoria 9 al 15*/
    nro_serie_placa VARCHAR(20),  /*solo id_categoria 14*/
    fec_insercion TIMESTAMP NOT NULL,
    fec_modificacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    usuario INT NOT NULL,
    estado CHAR(1) NOT NULL,
    PRIMARY KEY(id_activo_fijo),
    FOREIGN KEY(id_categoria) REFERENCES categorias(id_categoria)
)ENGINE=INNODB;



