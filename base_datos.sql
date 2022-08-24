dlm - SQL

CREATE DATABASE panaderia ;

CREATE TABLE usuario(
	id_usuario CHAR(11),
	nombres VARCHAR(30),
	apellidos VARCHAR(30),
	direccion VARCHAR(30),
	telefono VARCHAR(12),
	correo VARCHAR(30),
	contraseña VARCHAR(30),
	estado VARCHAR(20),
	tipo_usuario VARCHAR(20),
	PRIMARY KEY (id_usuario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE productos(
	codigo_producto CHAR(11),
	nombre_producto VARCHAR(30),
	marca VARCHAR(30),
	descripcion VARCHAR(50),
	precio INT,
	PRIMARY KEY (codigo_producto)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE permisos(
	codigo_permiso INT AUTO_INCREMENT,
	permiso INT,
	usuario VARCHAR(20),
	estado VARCHAR(20),
	PRIMARY KEY (codigo_permiso)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

CREATE TABLE permisos_tem(
	codigo_permiso_tem INT AUTO_INCREMENT,
	nombre_permiso VARCHAR(30),
	PRIMARY KEY (codigo_permiso_tem)
);

CREATE TABLE inventario(
	codigo_inventario INT AUTO_INCREMENT,
	codigo_producto CHAR(11),
	cantidad_actual INT,
	cantidad_minima INT,
	costo INT,
	PRIMARY KEY (codigo_inventario)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

ddl - SQL