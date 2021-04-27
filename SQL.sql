CREATE DATABASE IF NOT EXISTS CousyDB;

USE CousyDB;

#////////////////////////////////
#TABLAS PRIMARIOAS
#////////////////////////////////

CREATE TABLE IF NOT EXISTS Imagenes(
	IDImagen INT PRIMARY KEY AUTO_INCREMENT,
    Imagen MEDIUMBLOB COMMENT 'Imagen',
    Nombre VARCHAR(50) COMMENT 'Nombre de la imagen',
    Extension VARCHAR(10) COMMENT 'Extension de la imagen'
);

CREATE TABLE IF NOT EXISTS Usuarios(
	IDUsuario INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100),
    Usuario VARCHAR(50) UNIQUE,
    Correo VARCHAR(50),
    Contraseña VARCHAR(50),
    Rol INT DEFAULT 0 COMMENT 'Rol de usuario 0=Alumno, 1=Profesor',
    UltimaActualizacion TIMESTAMP COMMENT 'Fecha de ultimo cambio realizado',
    IDImagenFK INT,
    FOREIGN KEY (IDImagenFK) REFERENCES Imagenes(IDImagen)
);

CREATE TABLE IF NOT EXISTS Categorias(
	IDCategoria INT PRIMARY KEY AUTO_INCREMENT,
    Categoria VARCHAR(50),
    Fecha TIMESTAMP COMMENT 'Fecha en que se creo la categoria',
    IDUsuarioFK INT,
    FOREIGN KEY (IDUsuarioFK) REFERENCES Usuarios(IDUsuario)
);

CREATE TABLE IF NOT EXISTS Cursos(
	IDCurso INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100),
    Precio FLOAT,
    Descripcion VARCHAR(100),
    TipoCompra INT DEFAULT 0 COMMENT 'Define si el curso se compra completo (0) o por capitulo (1)',
    PromedioCalificacion FLOAT,
    Publico BOOLEAN DEFAULT FALSE COMMENT 'Define si el curso esta publicado',
    IDUsuarioFK INT,
    IDImagenFK INT,
    IDCategoriaFK INT,
    FOREIGN KEY (IDUsuarioFK) REFERENCES Usuarios(IDUsuario),
    FOREIGN KEY (IDImagenFK) REFERENCES Imagenes(IDImagen),
    FOREIGN KEY (IDCategoriaFK) REFERENCES Categorias(IDCategoria)
);

CREATE TABLE IF NOT EXISTS Capitulos(
	IDCapitulo INT PRIMARY KEY AUTO_INCREMENT,
    Nombre VARCHAR(100),
    Precio FLOAT DEFAULT 0,
    Gratis BOOLEAN DEFAULT FALSE COMMENT 'Define si el capitulo es gratis'
);

CREATE TABLE IF NOT EXISTS Recursos(
	IDRecurso INT PRIMARY KEY AUTO_INCREMENT,
    Recurso MEDIUMBLOB,
    Nombre VARCHAR(100) COMMENT 'Nombre del recurso',
    Extension VARCHAR(10) COMMENT 'Extension del recurso',
    IDCapituloFK INT,
    FOREIGN KEY (IDCapituloFK) REFERENCES Capitulos(IDCapitulo)
);

CREATE TABLE IF NOT EXISTS Chats(
	IDChat INT PRIMARY KEY AUTO_INCREMENT,
    Destinatario INT NOT NULL COMMENT 'ID del usuario destino',
    IDUsuarioFK INT,
	FOREIGN KEY (IDUsuarioFK) REFERENCES Usuarios(IDUsuario)
);

CREATE TABLE IF NOT EXISTS Mensajes(
	IDMensaje INT PRIMARY KEY AUTO_INCREMENT,
    Contenido VARCHAR(100),
    Fecha TIMESTAMP,
    IDChatFK INT,
    IDUsuarioFK INT,
	FOREIGN KEY (IDChatFK) REFERENCES Chats(IDChat),
    FOREIGN KEY (IDUsuarioFK) REFERENCES Usuarios(IDUsuario)
);

#////////////////////////////////
#TABLAS SECUNDARIAS
#////////////////////////////////
CREATE TABLE IF NOT EXISTS Usuario_Capitulo(
	Disponible BOOLEAN DEFAULT FALSE COMMENT 'Define si el capitulo disponible para estudiar',
    Estudiado BOOLEAN DEFAULT FALSE COMMENT 'Define si el capitulo ya se studio',
	IDUsuarioFK INT,
    IDCapituloFK INT,
	FOREIGN KEY (IDCapituloFK) REFERENCES Capitulos(IDCapitulo),
    FOREIGN KEY (IDUsuarioFK) REFERENCES Usuarios(IDUsuario)
);

CREATE TABLE IF NOT EXISTS Usuario_Curso(
	FechaAprueba DATE COMMENT 'Fecha en la que termina el curso',
    Finalizado BOOLEAN DEFAULT FALSE COMMENT 'Define si el estudiante puede descargar el certificado',
	Comentario VARCHAR(200) COMMENT 'Reseña acerca del curso',
    Puntuacion INT COMMENT 'Puntuacion del curso',
    FechaReseña DATE COMMENT 'Fecha en la que se hizo la reseña',
    IDUsuarioFK INT,
    IDCursoFK INT,
	FOREIGN KEY (IDCursoFK) REFERENCES Cursos(IDCurso),
    FOREIGN KEY (IDUsuarioFK) REFERENCES Usuarios(IDUsuario)
);

CREATE TABLE IF NOT EXISTS Usuario_Curso_Capitulo(
	Monto FLOAT NOT NULL COMMENT 'Monto por capitulo',
    MetodoPago VARCHAR(30) COMMENT 'Metodo de pago',
	noCuenta VARCHAR(50) COMMENT 'Numero de tarjeta o cuenta con la que se realizo el pago',
    Fecha DATE COMMENT 'Fecha en la que se realizo la compra',
    IDUsuarioFK INT,
    IDCursoFK INT,
    IDCapituloFK INT,
	FOREIGN KEY (IDCursoFK) REFERENCES Cursos(IDCurso),
    FOREIGN KEY (IDCapituloFK) REFERENCES Capitulos(IDCapitulo),
    FOREIGN KEY (IDUsuarioFK) REFERENCES Usuarios(IDUsuario)
);



#////////////////////////////////
#	STORED PROCEDURES
#////////////////////////////////
DELIMITER $%
#DROP PROCEDURE IF EXISTS SP_UsuarioRepetido;
CREATE PROCEDURE SP_UsuarioRepetido
(
    IN pUsuario VARCHAR(50)
)
BEGIN
    SELECT Usuario
    FROM Usuarios 
    WHERE Usuario = pUsuario;
END $%
DELIMITER ;

CALL SP_UsuarioRepetido('')

DELIMITER $%
#DROP PROCEDURE IF EXISTS SP_AgregarUsuario;
CREATE PROCEDURE SP_AgregarUsuario
(
	IN pImagen MEDIUMBLOB,
    IN pNombreImagen VARCHAR(50),
    IN pTipoImagen VARCHAR(10),
	IN pNombre VARCHAR(100),
    IN pUsuario VARCHAR(50),
    IN pCorreo VARCHAR(50),
    IN pContraseña VARCHAR(50),
    IN pRol INT
)
BEGIN
	DECLARE idImagen INT;
    
    #INSERTAR IMAGEN
	INSERT INTO Imagenes (Imagen, Nombre, Extension) VALUES (pImagen, pNombreImagen, pTipoImagen);
    
    SET idImagen = LAST_INSERT_ID();
    #INSERTAR USUARIO
	INSERT INTO Usuarios (Nombre, Usuario, Correo, Contraseña, Rol, IDImagenFK) VALUES (pNombre, pUsuario, pCorreo,pContraseña, pRol, idImagen );
END $%
DELIMITER ;


DELIMITER $%
#DROP PROCEDURE IF EXISTS SP_IniciarSesion;
CREATE PROCEDURE SP_IniciarSesion
(
    IN pUsuario VARCHAR(50),
    IN pContraseña VARCHAR(50)
)
BEGIN
	SELECT U.IDUsuario, U.Nombre, U.Usuario, U.Correo, U.Contraseña, U.Rol, DATE_FORMAT(U.UltimaActualizacion, '%d-%m-%Y') 'UltimaActualizacion', U.IDImagenFK, 
		I.Imagen, I.Nombre 'NombreImagen', I.Extension
    FROM Usuarios U
    JOIN Imagenes I
    ON I.IDImagen = U.IDImagenFK
    WHERE (U.Correo = pUsuario OR U.Usuario = pUsuario) AND U.Contraseña = pContraseña ;

END $%
DELIMITER ;

CALL SP_IniciarSesion('Brumak','Metagross1677@');

#SP ACTUALIZAR IMAGEN
DELIMITER $%
#DROP PROCEDURE IF EXISTS SP_ActualizarUsuario;
CREATE PROCEDURE SP_ActualizarUsuario
(
	IN pIdUsuario INT,
	IN pNombre VARCHAR(100),
    IN pUsuario VARCHAR(50),
    IN pCorreo VARCHAR(50),
    IN pContraseña VARCHAR(50)
)
BEGIN
	SET @id_actualizado := 0;
    
	UPDATE Usuarios
	SET Nombre = pNombre, Usuario = pUsuario, Correo = pCorreo, Contraseña = pContraseña,
    IDUsuario = (SELECT @id_actualizado := IDUsuario)
	WHERE IDUsuario =pIdUsuario;

    SELECT U.IDUsuario, U.Nombre, U.Usuario, U.Correo, U.Contraseña, U.Rol, DATE_FORMAT(U.UltimaActualizacion, '%d-%m-%Y') 'UltimaActualizacion', U.IDImagenFK, 
		I.Imagen, I.Nombre 'NombreImagen', I.Extension
    FROM Usuarios U
    JOIN Imagenes I
    ON I.IDImagen = U.IDImagenFK
    WHERE U.IDUsuario = @id_actualizado 
	LIMIT 1;
	
END $%
DELIMITER ;

#SP ACTUALIZAR IMAGEN
DELIMITER $%
#DROP PROCEDURE IF EXISTS SP_ActualizarImagenUsuario;
CREATE PROCEDURE SP_ActualizarImagenUsuario
(
	IN pIdImagen INT,
	IN pImagen MEDIUMBLOB,
    IN pNombreImagen VARCHAR(50),
    IN pTipoImagen VARCHAR(10)
)
BEGIN
	SET @id_actualizado := 0;
    
	UPDATE Imagenes
	SET Imagen = pImagen, Nombre = pNombreImagen, Extension = pTipoImagen,
    IDImagen = (SELECT @id_actualizado := IDImagen)
	WHERE IDImagen =pIdImagen
    LIMIT 1;

    SELECT IDImagen, Imagen, Nombre, Extension 
    FROM Imagenes
    WHERE IDImagen = @id_actualizado;
	
END $%
DELIMITER ;

CALL SP_ActualizarImagenUsuario(4,'','','');

call SP_ActualizarUsuario(4,'Eliseo Estrada Covarrubias', 'Brumak', 'eliseo1677@hotmail.com','Metagross1677@');

SELECT * FROM USUARIOS;
SELECT * FROM IMAGENES;

DELETE FROM USUARIOS WHERE IDUsuario = 5;
DELETE FROM IMAGENES WHERE IDImagen = 8;
