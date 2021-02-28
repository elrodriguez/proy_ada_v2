-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-02-2021 a las 18:33:44
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_tramite`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE  PROCEDURE `PA_BUSCARADMINISTRADOR` (IN `codigo` INT)  BEGIN
SELECT
personal.pers_nombres,
personal.pers_apellidoPate,
personal.pers_apellidoMate,
usuario.usu_foto,
usuario.cod_usuario,
personal.pers_email,
personal.pers_telefono,
personal.pers_movil,
usuario.usu_clave,
personal.pers_direccion,
personal.pers_fechaNacimiento,
personal.pers_dni,
personal.pers_sexo
FROM
usuario
INNER JOIN personal ON personal.usuario_cod = usuario.cod_usuario
where personal.personal_cod = codigo;
END$$

CREATE  PROCEDURE `PA_CALCULARPAGOSDOCENTES` (`_flag` INT, `_fecha_inicio` DATE, `_fecha_fin` DATE)  BEGIN
	if _flag = 1 then
		begin
			DROP TEMPORARY TABLE IF EXISTS tmp_docentes;

			CREATE TEMPORARY TABLE tmp_docentes(
				contador INT(11) PRIMARY KEY AUTO_INCREMENT,
				modalidad varchar(15),
				descripcion varchar(500),
				docente_nombre varchar(500),
				tipo varchar(100),
				categoria varchar(200),
				por_pagar_fecha date,
				moda varchar(200),
				pago decimal(12,2),
				total_tesis int,
				mdp char(1),
				tip char(1),
				pagado char(1)
			);

			#insert revisor
			insert into tmp_docentes(
				modalidad,
				descripcion,
				docente_nombre,
				tipo,
				categoria,
				por_pagar_fecha,
				moda,
				pago,
				total_tesis,
				mdp,
				tip,
				pagado
			)  SELECT
				programa_academico.modalidad,
				programa_academico.descripcion,
				CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,
				IF(documento_revisor.tipo='I','Independiente',IF(documento_revisor.tipo='C','comisión','Docente del curso')) AS tipo,
				asesor.categoria,
				documento_revisor.por_pagar_fecha,
				IF(documento_revisor.modalidad='I','Investigador Asociado',IF(documento_revisor.modalidad='T','Titular','Ninguno')) as moda,
				f_calularpagos(1,documento_revisor.tipo,asesor.categoria,documento_revisor.modalidad,programa_academico.modalidad,SUM(1)) AS pago,
				SUM(1) AS total_tesis,
				documento_revisor.modalidad AS mdp,
				documento_revisor.tipo AS tip,
				documento_revisor.pagado
			FROM asesor
			INNER JOIN documento_revisor ON asesor.asesor_cod=documento_revisor.asesor_cod
			INNER JOIN documento ON documento_revisor.documento_cod=documento.documento_cod
			INNER JOIN programa_academico ON documento.grado=programa_academico.id
			where documento_revisor.por_pagar_fecha >=_fecha_inicio and documento_revisor.por_pagar_fecha<=_fecha_fin
			AND por_pagar='SI'
			GROUP BY documento_revisor.pagado,asesor.asesor_cod,asesor.categoria,documento_revisor.tipo,documento_revisor.modalidad
			ORDER BY asesor.asesor_cod DESC;

			#insert asesor
			INSERT INTO tmp_docentes(
				modalidad,
				descripcion,
				docente_nombre,
				tipo,
				categoria,
				por_pagar_fecha,
				moda,
				pago,
				total_tesis,
				mdp,
				tip,
				pagado
			)SELECT
				programa_academico.modalidad,
				programa_academico.descripcion,
				CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,
				IF(documento_asesor.tipo='I','Independiente',IF(documento_asesor.tipo='C','comisión','Docente del curso')) AS tipo,
				asesor.categoria,
				documento_asesor.por_pagar_fecha,
				IF(documento_asesor.modalidad='I','Investigador Asociado',IF(documento_asesor.modalidad='T','Titular','Ninguno')) as moda,
				f_calularpagos(3,documento_asesor.tipo,asesor.categoria,documento_asesor.modalidad,programa_academico.modalidad,SUM(1)) AS pago,
				SUM(1) AS total_tesis,
				documento_asesor.modalidad AS mdp,
				documento_asesor.tipo AS tip,
				documento_asesor.pagado
			FROM asesor
			INNER JOIN documento_asesor ON asesor.asesor_cod=documento_asesor.asesor_cod
			INNER JOIN documento ON documento_asesor.documento_cod=documento.documento_cod
			INNER JOIN programa_academico ON documento.grado=programa_academico.id
			where documento_asesor.por_pagar_fecha >=_fecha_inicio AND documento_asesor.por_pagar_fecha<=_fecha_fin
			AND por_pagar='SI'
			GROUP BY documento_asesor.pagado,asesor.asesor_cod,asesor.categoria,documento_asesor.tipo,documento_asesor.modalidad
			ORDER BY asesor.asesor_cod DESC;

			#insert jurado
			INSERT INTO tmp_docentes(
				modalidad,
				descripcion,
				docente_nombre,
				tipo,
				categoria,
				por_pagar_fecha,
				moda,
				pago,
				total_tesis,
				mdp,
				tip,
				pagado
			)SELECT
				programa_academico.modalidad,
				programa_academico.descripcion,
				CONCAT(asesor.nombre,' ',asesor.apellido_pater,' ',asesor.apellido_mater) AS nombre_completo,
				IF(documento_jurado.tipo='I','Independiente',IF(documento_jurado.tipo='C','comisión','Docente del curso')) AS tipo,
				asesor.categoria,
				documento_jurado.por_pagar_fecha,
				IF(documento_jurado.modalidad='I','Investigador Asociado',IF(documento_jurado.modalidad='T','Titular','Ninguno')) as moda,
				f_calularpagos(2,documento_jurado.tipo,asesor.categoria,documento_jurado.modalidad,programa_academico.modalidad,SUM(1)) AS pago,
				SUM(1) AS total_tesis,
				documento_jurado.modalidad AS mdp,
				documento_jurado.tipo AS tip,
				documento_jurado.pagado
			FROM asesor
			INNER JOIN documento_jurado ON asesor.asesor_cod=documento_jurado.asesor_cod
			INNER JOIN documento ON documento_jurado.documento_cod=documento.documento_cod
			INNER JOIN programa_academico ON documento.grado=programa_academico.id
			where documento_jurado.por_pagar_fecha >=_fecha_inicio AND documento_jurado.por_pagar_fecha<=_fecha_fin
			AND por_pagar='SI'
			GROUP BY documento_jurado.pagado,asesor.asesor_cod,asesor.categoria,documento_jurado.tipo,documento_jurado.modalidad
			ORDER BY asesor.asesor_cod DESC;

			select * from tmp_docentes order by docente_nombre;
		end;
	end if;
    END$$

CREATE  PROCEDURE `PA_CAMBIARCAMPODOCUMENTO` (`_flag` INT, `_documento` VARCHAR(80), `_valor` VARCHAR(500))  BEGIN
	if _flag = 1 then
		UPDATE documento SET
			anexo_catorce = _valor
		WHERE  documento_cod =  _documento ;
	end if;
	IF _flag = 2 THEN
		UPDATE documento SET
			anexo_quince = _valor
		WHERE  documento_cod =  _documento ;
	END IF;
    END$$

CREATE  PROCEDURE `PA_CORREOSUSTENTACIONDOCUMENTO` (`_iddocumento` VARCHAR(80), `_correo` VARCHAR(500), `_zoom` VARCHAR(500), `_lugar` VARCHAR(200), `_hora` VARCHAR(200))  BEGIN
	UPDATE documento SET
		zoom = _zoom,
		lugar = _lugar,
		hora = _hora,
		fecha_correo_etapa_siete = now(),
		correo_sustentacion = _correo
	WHERE  documento_cod =  _iddocumento ;
    END$$

CREATE  PROCEDURE `PA_EDITARAREA` (IN `CODIGO` INT, IN `AREA` VARCHAR(80), IN `ESTADO` VARCHAR(30))  BEGIN
UPDATE area SET
area_nombre = AREA,
area_estado = ESTADO
WHERE area_cod = CODIGO;
END$$

CREATE  PROCEDURE `PA_EDITARCIUDADANOTODOS` (IN `codigo` INT, IN `nombre` VARCHAR(100), IN `apePat` VARCHAR(50), IN `apeMat` VARCHAR(50), IN `tipopersona` VARCHAR(20), IN `telefo` VARCHAR(9), IN `movil` VARCHAR(9), IN `direc` VARCHAR(300), IN `fecha` DATE, IN `nrodocume` CHAR(8), IN `email` VARCHAR(100), IN `carrera` VARCHAR(250), `_clave` VARCHAR(80))  BEGIN
UPDATE ciudadano SET
ciud_nombres = nombre,
ciud_apellidoPate = apePat,
ciud_apellidoMate = apeMat,
ciud_email = email,
ciud_telefono = telefo,
ciud_movil = movil,
ciud_direccion = direc,
ciud_fechaNacimiento = fecha,
ciud_dni = nrodocume,
ciud_tipo=tipopersona,
ciud_carrera=carrera,
ciud_clave=if(_clave = '' or _clave is null,ciud_clave,MD5(_clave))
WHERE ciudadano_cod = codigo;
END$$

CREATE  PROCEDURE `PA_EDITARDOCENTE` (`_id` INT, `_nombre` VARCHAR(45), `_apePat` VARCHAR(45), `_apeMat` VARCHAR(40), `_telefo` INT, `_movil` INT, `_direcc` VARCHAR(200), `_fecnac` DATE, `_dni` INT, `_email` VARCHAR(30), `_genero` CHAR(1), `_estado` VARCHAR(15), `_tipos` VARCHAR(500), `_categoria` VARCHAR(200))  BEGIN
	DECLARE total INT;
	DECLARE counter INT DEFAULT 1;

	delete from asesor_tipo_detalle where id_asesor = _id;

	UPDATE asesor SET
		nombre = _nombre,
		apellido_pater = _apePat,
		apellido_mater = _apeMat,
		dni = _dni,
		mail_personal = _email,
		mail_institu = _email,
		celular = _movil,
		telephone = _telefo,
		asesor_estado = _estado,
		sexo = _genero,
		fechanacimiento = _fecnac,
		direccion = _direcc,
		categoria = _categoria
	WHERE asesor_cod = _id;


	SET total = (SELECT LENGTH(_tipos) - LENGTH( REPLACE (_tipos, "*", "") )+1);

	WHILE counter <= total DO
		INSERT INTO asesor_tipo_detalle (id_asesor,id_tipo) VALUES (_id,f_explode(_tipos,'*',counter));
		SET counter = counter + 1;
	END WHILE;

    END$$

CREATE  PROCEDURE `PA_EDITARINSTITUCION` (IN `codigo` INT, IN `institucion` VARCHAR(150), IN `tipo` VARCHAR(50), IN `estado` VARCHAR(20))  BEGIN
UPDATE institucion SET
inst_nombre = institucion,
inst_tipoinstitucion=tipo,
inst_estado=estado
WHERE institucion_cod = codigo;
END$$

CREATE  PROCEDURE `PA_EDITARPERSONAL` (IN `codigo` CHAR(10), IN `nombre` VARCHAR(100), IN `apePat` VARCHAR(50), IN `apeMat` VARCHAR(50), IN `email` VARCHAR(100), IN `telefo` CHAR(13), IN `movil` CHAR(13), IN `direc` VARCHAR(200), IN `fecha` VARCHAR(20), IN `dni` VARCHAR(13))  BEGIN
UPDATE personal SET
pers_nombres = nombre,
pers_apellidoPate = apePat,
pers_apellidoMate = apeMat,
pers_email = email,
pers_telefono = telefo,
pers_movil = movil,
pers_direccion = direc,
pers_fechaNacimiento = fecha,
pers_dni = dni
WHERE personal_cod = codigo;
END$$

CREATE  PROCEDURE `PA_EDITARPERSONALTODOS` (IN `codigo` INT, IN `nombre` VARCHAR(100), IN `apePat` VARCHAR(50), IN `apeMat` VARCHAR(50), IN `telefo` VARCHAR(9), IN `movil` VARCHAR(9), IN `direc` VARCHAR(300), IN `fecha` DATE, IN `nrodocume` CHAR(8), IN `email` VARCHAR(100), IN `estado` VARCHAR(20))  BEGIN
UPDATE personal SET
pers_nombres = nombre,
pers_apellidoPate = apePat,
pers_apellidoMate = apeMat,
pers_email = email,
pers_telefono = telefo,
pers_movil = movil,
pers_direccion = direc,
pers_fechaNacimiento = fecha,
pers_dni = nrodocume,
pers_estado = estado
WHERE personal_cod = codigo;
END$$

CREATE  PROCEDURE `PA_EDITARTIPODOCUMENTO` (IN `CODIGO` INT, IN `NOMBRE` VARCHAR(250), IN `ESTADO` VARCHAR(20))  BEGIN
UPDATE tipo_documento
SET
tipodo_descripcion = NOMBRE,
tipodo_estado = ESTADO
WHERE tipodocumento_cod = CODIGO;
END$$

CREATE  PROCEDURE `PA_EDITARUSUARIO` (IN `usuario` VARCHAR(30), IN `actual` VARCHAR(30), IN `nueva` VARCHAR(30))  BEGIN
UPDATE usuario u
SET
u.usu_clave = nueva
WHERE u.usu_nombre = usuario AND u.usu_clave = actual;
END$$

CREATE  PROCEDURE `PA_EDITAR_PASO_DOCUMENTO` (`_paso` VARCHAR(200), `_estado` VARCHAR(20), `_codigo` VARCHAR(80))  BEGIN
	UPDATE documento SET
		num_proceso=_paso,
		doc_estado = _estado,
		fecha_revisor_correo=now(),
		fecha_final = DATE_ADD(NOW(), INTERVAL 20 DAY)
	WHERE documento_cod = _codigo;
    END$$

CREATE  PROCEDURE `PA_LISTAR_REVISORES_DOCUMENTO` (`_codigo` VARCHAR(80))  BEGIN
	select
		t2.dni,
		concat(t2.nombre,' ',t2.apellido_pater,' ',t2.apellido_mater) as full_name
	from documento_revisor as t1
	inner join asesor as t2 on t1.asesor_cod=t2.asesor_cod
	where documento_cod=_codigo;
    END$$

CREATE  PROCEDURE `PA_MODIFICARFECHASDOCUMENTO` (`_flag` INT, `_documento` VARCHAR(80), `_fecha` DATE)  BEGIN
	if _flag = 1 then
		UPDATE documento SET
			fecha_aprobada = _fecha
		WHERE  documento_cod =  _documento;
	end if;
	if _flag = 2 then
		UPDATE documento SET
			fecha_entrega = _fecha
		WHERE  documento_cod =  _documento;
	end if;
	IF _flag = 3 THEN
		UPDATE documento SET
			fecha_sustentacion = _fecha
		WHERE  documento_cod =  _documento;
	END IF;
    END$$

CREATE  PROCEDURE `PA_obtenerporcentajeturniting` (`_codigo` VARCHAR(80))  BEGIN
	SELECT
		documento.*,
		ciudadano.ciud_carrera,
		CONCAT(ciud_nombres,' ',ciud_apellidoPate,' ',ciud_apellidoMate) AS ciudadano_full_name,
		concat(nombre,' ',apellido_pater,' ',apellido_mater) asesor_full_name
	FROM documento
	INNER JOIN detalle_ciudadano ON detalle_ciudadano.documento_cod=documento.documento_cod
	INNER JOIN ciudadano ON detalle_ciudadano.ciudadano_cod=ciudadano.ciudadano_cod
	WHERE documento.documento_cod = _codigo;
    END$$

CREATE  PROCEDURE `PA_REGISTRARAREA` (IN `NOMBRE` VARCHAR(50))  BEGIN
INSERT INTO area (area_nombre,area_estado) VALUES(NOMBRE,'ACTIVO');
END$$

CREATE  PROCEDURE `PA_REGISTRARCIUDADANO` (IN `nombre` VARCHAR(100), IN `apePat` VARCHAR(50), IN `apeMat` VARCHAR(50), IN `tipope` VARCHAR(50), IN `telefo` CHAR(9), IN `movil` CHAR(9), IN `direcc` VARCHAR(250), IN `fecnac` DATE, IN `dni` CHAR(8), IN `email` VARCHAR(30), IN `genero` CHAR(1), IN `carrera` VARCHAR(250))  BEGIN
INSERT INTO ciudadano(ciud_nombres,ciud_apellidoPate,ciud_apellidoMate,ciud_dni,ciud_sexo,ciud_fechaNacimiento,ciud_direccion,ciud_telefono,ciud_movil,ciud_email,ciud_estado,ciud_tipo,ciud_carrera,ciud_clave) VALUES
(nombre,apePat,apeMat,dni,genero,fecnac,direcc,telefo,movil,email,'ACTIVO',tipope,carrera,md5(dni));
END$$

CREATE  PROCEDURE `PA_REGISTRARDOCENTE` (`_nombre` VARCHAR(45), `_apePat` VARCHAR(45), `_apeMat` VARCHAR(40), `_telefo` INT, `_movil` INT, `_direcc` VARCHAR(200), `_fecnac` DATE, `_dni` INT, `_email` VARCHAR(30), `_genero` CHAR(1), `_estado` VARCHAR(15), `_tipos` VARCHAR(500), `_categoria` VARCHAR(200))  BEGIN
	DECLARE id_asesor INT;
	declare new_asesor int;
	DECLARE total INT;
	DECLARE counter INT DEFAULT 1;

	select max(asesor_cod)+1 INTO id_asesor from asesor;

	INSERT INTO asesor (
		asesor_cod,
		nombre,
		apellido_pater,
		apellido_mater,
		dni,
		mail_personal,
		mail_institu,
		celular,
		telephone,
		asesor_estado,
		sexo,
		fechanacimiento,
		direccion,
		categoria
	) VALUES (
		id_asesor,
		_nombre,
		_apePat,
		_apeMat,
		_dni,
		_email,
		_email,
		_movil,
		_telefo,
		_estado,
		_genero,
		_fecnac,
		_direcc,
		_categoria
	) ;

	#set new_asesor = (SELECT LAST_INSERT_ID());
	SET total = (SELECT LENGTH(_tipos) - LENGTH( REPLACE (_tipos, "*", "") )+1);

	WHILE counter <= total DO
		INSERT INTO asesor_tipo_detalle (id_asesor,id_tipo) VALUES (id_asesor,f_explode(_tipos,'*',counter));
		SET counter = counter + 1;
	END WHILE;
    END$$

CREATE  PROCEDURE `PA_REGISTRARDOCUMENTO` (IN `iddocumento` VARCHAR(80), IN `asunto` VARCHAR(150), IN `idnumero` VARCHAR(10), IN `idtipodocu` INT, IN `idasesor` INT, IN `idarea` INT, IN `idremitente` INT, IN `idusuario` INT, IN `opcion` VARCHAR(10))  BEGIN
INSERT INTO documento (documento_cod,doc_asunto,doc_ticket,tipoDocumento_cod,asesor_cod,area_cod,usu_cod,doc_estado,num_proceso,doc_tipo) VALUES
(iddocumento,asunto,idnumero,idtipodocu,idasesor,idarea,idusuario,'PENDIENTE','1',opcion);
IF opcion = 'C' THEN
INSERT INTO detalle_ciudadano (ciudadano_cod,documento_cod) VALUES (idremitente,iddocumento);
END IF;
IF opcion = 'I' THEN
INSERT INTO detalle_institucion(institucion_cod,documento_cod) VALUES (idremitente,iddocumento);
END IF;
END$$

CREATE  PROCEDURE `PA_REGISTRARDOCUMENTOARCHIVO` (IN `iddocumento` VARCHAR(80), IN `asunto` VARCHAR(150), IN `idnumero` VARCHAR(10), IN `idtipodocu` INT, IN `idasesor` VARCHAR(80), IN `idarea` INT, IN `idremitente` TEXT, IN `idusuario` INT, IN `opcion` VARCHAR(10), IN `archivo` VARCHAR(350), IN `cont` INT, `_modalidad` VARCHAR(20))  BEGIN
declare _documento_cod varchar(80) default f_crearcodigodocumento(_modalidad);
IF cont = 0 THEN
	INSERT INTO documento (
		documento_cod,
		doc_asunto,
		doc_ticket,
		tipoDocumento_cod,
		area_cod,
		usu_cod,
		doc_estado,
		num_proceso,
		doc_tipo,
		doc_documento,
		grado,
		anio
	) VALUES (
		_documento_cod,
		asunto,
		idnumero,
		idtipodocu,
		idarea,
		idusuario,
		'PENDIENTE',
		'1',
		opcion,
		CONCAT(archivo,'/',_documento_cod,'/',_documento_cod,'.',iddocumento),
		_modalidad,
		year(now())
	);
END IF;
IF cont = 1 THEN

	INSERT INTO documento (
		documento_cod,
		doc_asunto,
		doc_ticket,
		tipoDocumento_cod,
		area_cod,
		usu_cod,
		doc_estado,
		num_proceso,
		doc_tipo,
		doc_documento,
		grado,
		anio
	) VALUES(
		_documento_cod,
		asunto,
		idnumero,
		idtipodocu,
		idarea,
		idusuario,
		'PENDIENTE',
		'1',
		opcion,
		concat(archivo,'/',_documento_cod,'/',_documento_cod,'.',iddocumento),
		_modalidad,
		year(now())
	);
END IF;
IF opcion = 'C' THEN
	begin
		declare total int;
		DECLARE counter INT DEFAULT 1;
		DECLARE total_asesor INT;
		DECLARE counter_asesor INT DEFAULT 1;
		declare itemasesor varchar(500);

		set total = (select LENGTH(idremitente) - LENGTH( REPLACE (idremitente, "*", "") )+1);
		SET total_asesor = (SELECT LENGTH(idasesor) - LENGTH( REPLACE (idasesor, "*", "") )+1);

		WHILE counter <= total DO
			INSERT INTO detalle_ciudadano (ciudadano_cod,documento_cod) VALUES (f_explode(idremitente,'*',counter),_documento_cod);
			SET counter = counter + 1;
		END WHILE;

		WHILE counter_asesor<= total_asesor DO
			set itemasesor = (select f_explode(idasesor,'*',counter_asesor));
			INSERT INTO documento_asesor (documento_cod,asesor_cod,fecha_registro,tipo,modalidad) VALUES (_documento_cod,f_explode(itemasesor,'|',1),now(),f_explode(itemasesor,'|',2),f_explode(itemasesor,'|',3));
			SET counter_asesor = counter_asesor + 1;
		END WHILE;

		select _documento_cod as 'iddocumento';
	end;
END IF;
IF opcion = 'I' THEN
		INSERT INTO detalle_institucion(institucion_cod,documento_cod) VALUES (idremitente,_documento_cod);
END IF;
END$$

CREATE  PROCEDURE `PA_REGISTRARINSTITUCION` (IN `institucion` VARCHAR(150), IN `tipo` VARCHAR(50))  BEGIN
INSERT INTO institucion(inst_nombre,inst_tipoinstitucion,inst_estado) VALUES(institucion,tipo,'ACTIVO');
END$$

CREATE  PROCEDURE `PA_REGISTRARJURADODOCUMENTO` (`_iddocumento` VARCHAR(80), `_revisor` INT, `_tipo` CHAR(1), `_modalidad` CHAR(1))  BEGIN

	declare fec int;

	set fec = (select fecha_registro_jurado from documento where documento_cod = _iddocumento);
	INSERT INTO documento_jurado (documento_cod,asesor_cod,fecha_registro,tipo,modalidad)
	VALUES (_iddocumento,_revisor,now(),_tipo,_modalidad);

	if fec IS NULL then
		UPDATE documento SET
			fecha_registro_jurado = NOW(),
			fecha_final_jurado = DATE_ADD(NOW(), INTERVAL 21 DAY)
		WHERE  documento_cod =  _iddocumento;
	end if;
    END$$

CREATE  PROCEDURE `PA_REGISTRARPERSONAL` (IN `nombre` VARCHAR(100), IN `apePat` VARCHAR(50), IN `apeMat` VARCHAR(50), IN `telefo` CHAR(9), IN `movil` CHAR(9), IN `direcc` VARCHAR(250), IN `fecnac` DATE, IN `dni` CHAR(8), IN `email` VARCHAR(30), IN `genero` CHAR(1), IN `usuario` VARCHAR(50), IN `clave` VARCHAR(50), IN `tipousario` INT, IN `puesto` VARCHAR(30))  BEGIN
INSERT INTO usuario (usu_nombre,usu_clave,usu_estado,cod_tipousuario,usu_foto) VALUES(usuario,clave,'ACTIVO',tipousario,'Fotos/admin.png');
INSERT INTO personal(pers_nombres,pers_apellidoPate,pers_apellidoMate,pers_dni,pers_sexo,pers_fechaNacimiento,pers_direccion,pers_telefono,pers_movil,pers_email,pers_estado,usuario_cod,pers_puesto) VALUES
(nombre,apePat,apeMat,dni,genero,fecnac,direcc,telefo,movil,email,'ACTIVO',(SELECT MAX(cod_usuario) from usuario),puesto);
END$$

CREATE  PROCEDURE `PA_REGISTRARTIPODOCUMENTO` (IN `NOMBRE` VARCHAR(250))  BEGIN
INSERT INTO tipo_documento (tipodo_descripcion,tipodo_estado) VALUES (NOMBRE,"ACTIVO");
END$$

CREATE  PROCEDURE `PA_SUBIRARCHIVOANEXOS` (`_flag` INT, `_documento` VARCHAR(80), `_p_ruta_anexo` VARCHAR(500), `_s_ruta_anexo` VARCHAR(500), `_t_ruta_anexo` VARCHAR(500), `_c_ruta_anexo` VARCHAR(500))  BEGIN
	IF _flag = 1 THEN
		UPDATE documento SET
			doc_documento = _p_ruta_anexo
		WHERE  documento_cod =  _documento ;
	END IF;
	if _flag = 3 then
		if _c_ruta_anexo = 'r1' then
			UPDATE documento SET
				anexo_seis = if(_p_ruta_anexo = '0',anexo_seis,_p_ruta_anexo),
				anexo_seis_2 = IF(_s_ruta_anexo = '0',anexo_seis_2,_s_ruta_anexo),
				anexo_seis_3 = IF(_t_ruta_anexo = '0',anexo_seis_3,_t_ruta_anexo),
				fecha_subida_revisores = now()
			WHERE  documento_cod =  _documento ;
		end if;
		IF _c_ruta_anexo = 'r2' THEN
			UPDATE documento SET
				anexo_seis_uno_r2 = IF(_p_ruta_anexo = '0',anexo_seis_uno_r2,_p_ruta_anexo),
				anexo_seis_dos_r2 = IF(_s_ruta_anexo = '0',anexo_seis_dos_r2,_s_ruta_anexo),
				anexo_seis_tres_r2 = IF(_t_ruta_anexo = '0',anexo_seis_tres_r2,_t_ruta_anexo),
				fecha_subida_revisores = NOW()
			WHERE  documento_cod =  _documento ;
		END IF;
		IF _c_ruta_anexo = 'r3' THEN
			UPDATE documento SET
				anexo_seis_uno_r3 = IF(_p_ruta_anexo = '0',anexo_seis_uno_r3,_p_ruta_anexo),
				anexo_seis_dos_r3 = IF(_s_ruta_anexo = '0',anexo_seis_dos_r3,_s_ruta_anexo),
				anexo_seis_tres_r3 = IF(_t_ruta_anexo = '0',anexo_seis_tres_r3,_t_ruta_anexo),
				fecha_subida_revisores = NOW()
			WHERE  documento_cod =  _documento ;
		END IF;
	end if;
	IF _flag = 4 THEN
		UPDATE documento SET
			etica_anexo_uno = IF(_p_ruta_anexo = '0',etica_anexo_uno,_p_ruta_anexo),
			etica_anexo_cuatro = IF(_s_ruta_anexo = '0',etica_anexo_cuatro,_s_ruta_anexo),
			etica_anexo_cuatro_dos = IF(_t_ruta_anexo = '0',etica_anexo_cuatro_dos,_t_ruta_anexo),
			etica_anexo_cuatro_tres = IF(_c_ruta_anexo = '0',etica_anexo_cuatro_tres,_c_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 5 THEN
		UPDATE documento SET
			resolucion_firmada = _p_ruta_anexo
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 6 THEN
		UPDATE documento SET
			archivo_etapa1_v2 = _p_ruta_anexo,
			doc_estado = 'PENDIENTE'
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 7 THEN
		UPDATE documento SET
			archivo_etapa1_v3 = _p_ruta_anexo,
			doc_estado = 'PENDIENTE'
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 8 THEN
		UPDATE documento SET
			anexo_uno_etapa_tres = IF(_p_ruta_anexo = '0',anexo_uno_etapa_tres,_p_ruta_anexo),
			proyecto_etapa_tres = IF(_s_ruta_anexo = '0',proyecto_etapa_tres,_s_ruta_anexo),
			carta_etapa_tres = IF(_t_ruta_anexo = '0',carta_etapa_tres,_t_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 9 THEN
		UPDATE documento SET
			anexo_uno_etapa_cuatro = IF(_p_ruta_anexo = '0',anexo_uno_etapa_cuatro,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 10 THEN
		UPDATE documento SET
			carta_etapa_cuatro = IF(_p_ruta_anexo = '0',carta_etapa_cuatro,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 11 THEN
		UPDATE documento SET
			anexo_siete = IF(_p_ruta_anexo = '0',anexo_siete,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 12 THEN
		UPDATE documento SET
			anexo_ocho = IF(_p_ruta_anexo = '0',anexo_ocho,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 13 THEN
		UPDATE documento SET
			anexo_dies = IF(_p_ruta_anexo = '0',anexo_dies,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 14 THEN
		UPDATE documento SET
			anexo_dies_dos = IF(_p_ruta_anexo = '0',anexo_dies_dos,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 15 THEN
		UPDATE documento SET
			anexo_dies_tres = IF(_p_ruta_anexo = '0',anexo_dies_tres,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 16 THEN
		UPDATE documento SET
			anexo_trece = IF(_p_ruta_anexo = '0',anexo_trece,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 17 THEN
		UPDATE documento SET
			archivo_uno = IF(_p_ruta_anexo = '0',archivo_uno,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 18 THEN
		UPDATE documento SET
			archivo_dos = IF(_p_ruta_anexo = '0',archivo_dos,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 19 THEN
		UPDATE documento SET
			archivo_tres = IF(_p_ruta_anexo = '0',archivo_tres,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 20 THEN
		UPDATE documento SET
			archivo_cuatro = IF(_p_ruta_anexo = '0',archivo_cuatro,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 21 THEN
		UPDATE documento SET
			archivo_turnitin_etapa_nueve = IF(_p_ruta_anexo = '0',archivo_turnitin_etapa_nueve,_p_ruta_anexo),
			porcentaje_nueve = _s_ruta_anexo
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 22 THEN
		UPDATE documento SET
			repositorio = IF(_p_ruta_anexo = '0',repositorio,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 23 THEN
		UPDATE documento SET
			archivo_turnitin_dos_etapa_nueve = IF(_p_ruta_anexo = '0',archivo_turnitin_dos_etapa_nueve,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 24 THEN
		UPDATE documento SET
			porcentaje_turnitin_siete = _p_ruta_anexo
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 25 THEN
		UPDATE documento SET
			archivo_cinco = IF(_p_ruta_anexo = '0',archivo_cinco,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
	IF _flag = 26 THEN
		UPDATE documento SET
			constancia_firmada = IF(_p_ruta_anexo = '0',constancia_firmada,_p_ruta_anexo)
		WHERE  documento_cod =  _documento ;
	END IF;
    END$$

CREATE  PROCEDURE `PA_SUBIRARCHIVOTURNITING` (`_documento` VARCHAR(80), `_porcentaje` INT, `_ruta_archivo` VARCHAR(500))  BEGIN
	update documento SET
		porcentaje = _porcentaje,
		archivo_turniting = _ruta_archivo
	where  documento_cod =  _documento ;
    END$$

CREATE  PROCEDURE `PA_VERIFICARUSUARIO` (IN `_usu` VARCHAR(30), IN `_pass` VARCHAR(30))  SELECT
usuario.usu_nombre,
usuario.usu_clave,
CONCAT_WS(' ',personal.pers_nombres,personal.pers_apellidoPate,personal.pers_apellidoMate),
tipo_usuario.cod_tipousuario,
usuario.usu_foto,
personal.personal_cod,
tipo_usuario.tipusu_descripcion,
usuario.cod_usuario
FROM
personal
INNER JOIN usuario ON personal.usuario_cod = usuario.cod_usuario
INNER JOIN tipo_usuario ON usuario.cod_tipousuario = tipo_usuario.cod_tipousuario
WHERE usuario.usu_nombre = _usu AND usuario.usu_clave = _pass$$

CREATE  PROCEDURE `SP_LOGINCIUDADANO` (`_email` VARCHAR(80), `_password` VARCHAR(50))  BEGIN
	select
		ciudadano_cod,
		ciud_nombres,
		ciud_apellidoPate,
		ciud_apellidoMate,
		ciud_dni,
		ciud_email
	from ciudadano
	where ciud_email = _email and ciud_clave = md5(_password);
    END$$

CREATE  PROCEDURE `SP_MODIFICARTIPOPUBLICACIONDOCUMENTO` (`_documento` VARCHAR(80), `_tipo` INT, `_nombre` TEXT)  BEGIN
	UPDATE documento
	SET
	  tipo_publicacion = _tipo,
	  nombre_revista = _nombre
	WHERE documento_cod = _documento;
    END$$

CREATE  PROCEDURE `SP_PAGARDOCENTE` (`_flag` INT, `_codigo` INT, `_docente` INT, `_categoria` VARCHAR(200), `_tipo` CHAR(1), `_modalidad` CHAR(1))  BEGIN
	DECLARE v1 INT DEFAULT 1;

	if _flag = 1 then # revisores
		if _modalidad='I' AND REPLACE(_categoria, ' ', '') = 'parcial' then
			WHILE v1 <= 3 DO
				UPDATE documento_revisor INNER JOIN asesor ON documento_revisor.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_revisor.asesor_cod = _docente and tipo = _tipo and modalidad = _modalidad and asesor.categoria = _categoria;
				SET v1 = v1 + 1;
			END WHILE;
		elseIF _modalidad='I' AND REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			WHILE v1 <= 5 DO
				UPDATE documento_revisor INNER JOIN asesor ON documento_revisor.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_revisor.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
			SET v1 = v1 + 1;
			END WHILE;
		elseIF REPLACE(_categoria, ' ', '') = 'parcial' THEN
			WHILE v1 <= 3 DO
				UPDATE documento_revisor INNER JOIN asesor ON documento_revisor.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_revisor.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
			SET v1 = v1 - 1;
			END WHILE;
		else
			UPDATE documento_asesor INNER JOIN asesor ON documento_revisor.asesor_cod = asesor.asesor_cod
			SET
			  pagado = 1
			WHERE documento_revisor.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
		end if;
	end if;
	IF _flag = 2 THEN  #assesores
		IF _modalidad='I' AND REPLACE(_categoria, ' ', '') = 'parcial' THEN
			WHILE v1 <= 3 DO
				UPDATE documento_asesor INNER JOIN asesor ON documento_asesor.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_asesor.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
				SET v1 = v1 + 1;
			END WHILE;
		ELSEIF _modalidad='I' AND REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			WHILE v1 <= 5 DO
				UPDATE documento_asesor INNER JOIN asesor ON documento_asesor.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_asesor.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
			SET v1 = v1 + 1;
			END WHILE;
		ELSEIF REPLACE(_categoria, ' ', '') = 'parcial' THEN
			WHILE v1 <= 3 DO
				UPDATE documento_asesor INNER JOIN asesor ON documento_asesor.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_asesor.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
			SET v1 = v1 - 1;
			END WHILE;
		ELSE
			UPDATE documento_asesor INNER JOIN asesor ON documento_asesor.asesor_cod = asesor.asesor_cod
			SET
			  pagado = 1
			WHERE documento_asesor.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
		END IF;
	END IF;
	IF _flag = 3 THEN     #jurados
		IF _modalidad='I' AND REPLACE(_categoria, ' ', '') = 'parcial' THEN
			WHILE v1 <= 3 DO
				UPDATE documento_jurado INNER JOIN asesor ON documento_jurado.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_jurado.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
				SET v1 = v1 + 1;
			END WHILE;
		ELSEIF _modalidad='I' AND REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			WHILE v1 <= 5 DO
				UPDATE documento_jurado INNER JOIN asesor ON documento_jurado.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_jurado.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
			SET v1 = v1 + 1;
			END WHILE;
		ELSEIF REPLACE(_categoria, ' ', '') = 'parcial' THEN
			WHILE v1 <= 3 DO
				UPDATE documento_jurado INNER JOIN asesor ON documento_jurado.asesor_cod = asesor.asesor_cod
				SET
				  pagado = 1
				WHERE documento_jurado.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;
			SET v1 = v1 - 1;
			END WHILE;
		ELSE
			UPDATE documento_jurado INNER JOIN asesor ON documento_jurado.asesor_cod = asesor.asesor_cod
			SET
			  pagado = 1
			WHERE documento_jurado.asesor_cod = _docente AND tipo = _tipo AND modalidad = _modalidad AND asesor.categoria = _categoria;

		END IF;
	END IF;
    END$$

--
-- Funciones
--
CREATE  FUNCTION `f_calularpagos` (`_flag` INT, `_tipo` VARCHAR(2), `_categoria` VARCHAR(200), `_modalidad` VARCHAR(2), `_nivel` VARCHAR(20), `_cantidad` INT) RETURNS DECIMAL(12,2) BEGIN

	declare xpago decimal(12,2);
	if _flag = 1 then #si es revisor
		if (replace(_categoria, ' ', '') = 'tiempocompleto' or REPLACE(_categoria, ' ', '') = 'externo') and _modalidad <> 'I'then
			set xpago = 100;
		elseIF REPLACE(_categoria, ' ', '') = 'parcial-recibo' THEN
			SET xpago = 100;
		elseIF _modalidad = 'T' THEN
			SET xpago = 0;
		elseIF _modalidad = 'I' and REPLACE(_categoria, ' ', '') = 'parcial' THEN
			if _cantidad >=3 then
				SET xpago = 100;
			else
				SET xpago = 0;
			end if;
		elseIF _modalidad = 'I' AND REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			IF _cantidad >=5 THEN
				SET xpago = 100;
			ELSE
				SET xpago = 0;
			END IF;
		elseIF REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			IF _cantidad >=3 THEN
				SET xpago = 100;
			ELSE
				SET xpago = 0;
			END IF;
		else
			SET xpago = 100;
		END IF;
	end if;
	IF _flag = 2 THEN #si es jurado
		IF (REPLACE(_categoria, ' ', '') = 'tiempocompleto' OR REPLACE(_categoria, ' ', '') = 'externo') and _modalidad <> 'I' THEN
			if _nivel = 'POSGRADO' then
				SET xpago = 300;
			elseIF _nivel = 'PREGRADO' THEN
				SET xpago = 250;
			end if;
		elseif REPLACE(_categoria, ' ', '') = 'parcial-recibo' THEN
			IF _nivel = 'POSGRADO' THEN
				SET xpago = 300;
			ELSEIF _nivel = 'PREGRADO' THEN
				SET xpago = 250;
			END IF;
		elseIF _modalidad = 'T' THEN
			SET xpago = 0;
		elseIF _modalidad = 'I' AND REPLACE(_categoria, ' ', '') = 'parcial' THEN
			IF _nivel = 'POSGRADO' THEN
				IF _cantidad >=3 THEN
					SET xpago = 300;
				ELSE
					SET xpago = 0;
				END IF;
			ELSEIF _nivel = 'PREGRADO' THEN
				IF _cantidad >=3 THEN
					SET xpago = 250;
				ELSE
					SET xpago = 0;
				END IF;
			END IF;
		elseIF _modalidad = 'I' AND REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			IF _nivel = 'POSGRADO' THEN
				IF _cantidad >=5 THEN
					SET xpago = 300;
				ELSE
					SET xpago = 0;
				END IF;
			ELSEIF _nivel = 'PREGRADO' THEN
				IF _cantidad >=5 THEN
					SET xpago = 250;
				ELSE
					SET xpago = 0;
				END IF;
			END IF;
		elseIF REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			IF _nivel = 'POSGRADO' THEN
				IF _cantidad >=3 THEN
					SET xpago = 300;
				ELSE
					SET xpago = 0;
				END IF;
			ELSEIF _nivel = 'PREGRADO' THEN
				IF _cantidad >=3 THEN
					SET xpago = 250;
				ELSE
					SET xpago = 0;
				END IF;
			END IF;
		else
			IF _nivel = 'POSGRADO' THEN
				SET xpago = 300;
			ELSEIF _nivel = 'PREGRADO' THEN
				SET xpago = 250;
			END IF;
		END IF;
	END IF;
	IF _flag = 3 THEN #si es asesor
		IF (REPLACE(_categoria, ' ', '') = 'tiempocompleto' OR REPLACE(_categoria, ' ', '') = 'externo') and _modalidad <> 'I' THEN
			IF _nivel = 'POSGRADO' THEN
				SET xpago = 1000;
			ELSEIF _nivel = 'PREGRADO' THEN
				SET xpago = 650;
			END IF;
		elseIF REPLACE(_categoria, ' ', '') = 'parcial-recibo' THEN
			IF _nivel = 'POSGRADO' THEN
				SET xpago = 1000;
			ELSEIF _nivel = 'PREGRADO' THEN
				SET xpago = 650;
			END IF;
		elseIF _modalidad = 'T' THEN
			SET xpago = 10;
		elseIF _modalidad = 'I' AND REPLACE(_categoria, ' ', '') = 'parcial' THEN
			IF _nivel = 'POSGRADO' THEN
				IF _cantidad >=3 THEN
					SET xpago = 1000;
				ELSE
					SET xpago = 0;
				END IF;
			ELSEIF _nivel = 'PREGRADO' THEN
				IF _cantidad >=3 THEN
					SET xpago = 650;
				ELSE
					SET xpago = 0;
				END IF;
			END IF;
		elseIF _modalidad = 'I' AND REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			IF _nivel = 'POSGRADO' THEN
				IF _cantidad >=5 THEN
					SET xpago = 1000;
				ELSE
					SET xpago = 0;
				END IF;
			ELSEIF _nivel = 'PREGRADO' THEN
				IF _cantidad >=5 THEN
					SET xpago = 650;
				ELSE
					SET xpago = 0;
				END IF;
			END IF;
		elseIF REPLACE(_categoria, ' ', '') = 'tiempocompleto' THEN
			IF _nivel = 'POSGRADO' THEN
				IF _cantidad >=3 THEN
					SET xpago = 1000;
				ELSE
					SET xpago = 0;
				END IF;
			ELSEIF _nivel = 'PREGRADO' THEN
				IF _cantidad >=3 THEN
					SET xpago = 650;
				ELSE
					SET xpago = 0;
				END IF;
			END IF;
		else
			IF _nivel = 'POSGRADO' THEN
				SET xpago = 1000;
			ELSEIF _nivel = 'PREGRADO' THEN
				SET xpago = 650;
			END IF;
		END IF;
	END IF;
	return xpago;
    END$$

CREATE  FUNCTION `f_ciudadanosdocumento` (`_documento` VARCHAR(80)) RETURNS TEXT CHARSET utf8 COLLATE utf8_spanish_ci BEGIN
	declare _ciudadanos text;

	SELECT
		CONCAT('<p>',GROUP_CONCAT(CONCAT('<br>',ciud_nombres,' ',ciud_apellidoPate,' ',ciud_apellidoMate)),'</p>') into _ciudadanos
	FROM ciudadano
	INNER JOIN detalle_ciudadano ON ciudadano.ciudadano_cod=detalle_ciudadano.ciudadano_cod
	WHERE documento_cod=_documento;

	return _ciudadanos;
    END$$

CREATE  FUNCTION `f_crearcodigodocumento` (`_programa` INT) RETURNS VARCHAR(80) CHARSET utf8 COLLATE utf8_spanish_ci BEGIN
	DECLARE _correlativo INT;
	DECLARE _anio CHAR(4);
	DECLARE _codigo VARCHAR(80);
	declare _cadena char(3);
	DECLARE _nuevo_codigo VARCHAR(80);
	declare _grado varchar(20);


	set _grado = (SELECT modalidad FROM programa_academico WHERE id=_programa);
	set _cadena = LEFT(_grado,3);

	select max(documento_cod) into _codigo from documento where anio = YEAR(NOW());

	if _codigo is null then
		set _nuevo_codigo = concat(_cadena,'-',_programa,'-',YEAR(NOW()),'-',lpad('1',9,'0'));
	else
		set _correlativo = round(right(_codigo,9));
		SET _nuevo_codigo = CONCAT(_cadena,'-',_programa,'-',YEAR(NOW()),'-',LPAD(_correlativo+1,9,'0'));
	end if;

	RETURN _nuevo_codigo;
    END$$

CREATE  FUNCTION `f_explode` (`str` VARCHAR(255), `delim` VARCHAR(12), `pos` INT) RETURNS VARCHAR(255) CHARSET utf8 COLLATE utf8_spanish_ci BEGIN
	RETURN REPLACE(SUBSTRING(SUBSTRING_INDEX(str, delim, pos),LENGTH(SUBSTRING_INDEX(str, delim, pos-1)) + 1),delim, '');
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `area_cod` int(11) NOT NULL COMMENT 'Codigo auto-incrementado del movimiento del area',
  `area_nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'nombre del area',
  `area_fecha_registro` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'fecha del registro del movimiento',
  `area_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL COMMENT 'estado del area'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`area_cod`, `area_nombre`, `area_fecha_registro`, `area_estado`) VALUES
(1, 'DIGIDI', '2018-11-21 07:54:25', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor`
--

CREATE TABLE `asesor` (
  `asesor_cod` int(11) NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_pater` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `apellido_mater` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `dni` int(11) NOT NULL,
  `mail_personal` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `mail_institu` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `celular` int(11) NOT NULL,
  `telephone` int(11) NOT NULL,
  `asesor_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL,
  `tipo_id` int(11) DEFAULT NULL,
  `sexo` char(1) COLLATE utf8_spanish_ci DEFAULT 'M',
  `fechanacimiento` date DEFAULT NULL,
  `direccion` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `categoria` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asesor`
--

INSERT INTO `asesor` (`asesor_cod`, `nombre`, `apellido_pater`, `apellido_mater`, `dni`, `mail_personal`, `mail_institu`, `celular`, `telephone`, `asesor_estado`, `tipo_id`, `sexo`, `fechanacimiento`, `direccion`, `categoria`) VALUES
(1, 'SAUL', 'CHAVEZ ', 'AAA', 32432434, 'saul@gmail.com', 'saul@gmail.com', 45646445, 645646465, 'ACTIVO', NULL, 'M', '2021-01-15', 'DFDSFDSF', 'tiempo completo'),
(2, 'RAUL', 'RAMóN', 'PITMMAN', 45645453, 'raul@gmail.com', 'raul@gmail.com', 45444, 654653, 'ACTIVO', NULL, 'M', '2021-01-22', 'DIRECCIóNDW', 'tiempo completo'),
(3, 'DANIEL', 'RUIZ', 'JDASF', 43546456, 'daniel@gamil.com', 'daniel@gamil.com', 435435, 45345345, 'ACTIVO', NULL, 'M', '2021-01-07', 'DFDSF', 'tiempo completo'),
(4, 'ALEXANDER', 'DSFDS', 'DFSDF', 15456565, 'alexander@gmail.com', 'alexander@gmail.com', 4546, 54654, 'ACTIVO', NULL, 'M', '2021-01-22', 'DSFDSF', 'tiempo completo'),
(5, 'NATALY', 'DSFDS', 'DFSDF', 56456456, 'nataly@gmail.com', 'nataly@gmail.com', 4546, 54654, 'ACTIVO', NULL, 'M', '2021-01-01', 'DSFDSF', 'parcial-recibo'),
(6, 'JOSE', 'DSFDSF', 'DFSDF', 45423768, 'jose@gmail.com', 'jose@gmail.com', 454654654, 5656, 'ACTIVO', NULL, 'M', '2021-01-02', 'DFDSFSD', 'externo'),
(7, 'LESLY', 'DSFSDFDS', 'ASDFSDAFDS', 23432423, 'lesly@gmail.com', 'lesly@gmail.com', 456456456, 546546546, 'ACTIVO', NULL, 'M', '2021-01-05', 'SDFDSFASDF', 'tiempo completo'),
(8, 'JUAN', 'CASTILLO', 'FDFSDFSDF', 23432454, 'juan@gmail.com', 'juan@gmail.com', 456456456, 546546546, 'ACTIVO', NULL, 'M', '2021-01-05', 'YTYERTGDFG', 'parcial'),
(9, 'JUAN', 'PEDRO', 'TORRES', 77801124, 'derlo@gmail.com', 'derlo@gmail.com', 12221223, 123456789, 'ACTIVO', NULL, 'M', '2021-02-02', 'LIMA', 'parcial');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asesor_tipo_detalle`
--

CREATE TABLE `asesor_tipo_detalle` (
  `id` int(11) NOT NULL,
  `id_asesor` int(11) DEFAULT NULL,
  `id_tipo` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `asesor_tipo_detalle`
--

INSERT INTO `asesor_tipo_detalle` (`id`, `id_asesor`, `id_tipo`) VALUES
(23, 1, 1),
(24, 1, 2),
(25, 3, 3),
(26, 4, 1),
(27, 5, 2),
(28, 6, 3),
(29, 7, 2),
(30, 5, 3),
(36, 9, 1),
(37, 9, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ciudadano`
--

CREATE TABLE `ciudadano` (
  `ciudadano_cod` int(11) NOT NULL,
  `ciud_nombres` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_apellidoPate` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_apellidoMate` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_dni` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_sexo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_fechaNacimiento` date NOT NULL,
  `ciud_direccion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_telefono` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_movil` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `ciud_fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `ciud_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL,
  `ciud_tipo` enum('PREGRADO','POSGRADO') COLLATE utf8_spanish_ci NOT NULL,
  `ciud_carrera` int(11) DEFAULT NULL,
  `ciud_clave` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `ciudadano`
--

INSERT INTO `ciudadano` (`ciudadano_cod`, `ciud_nombres`, `ciud_apellidoPate`, `ciud_apellidoMate`, `ciud_dni`, `ciud_sexo`, `ciud_fechaNacimiento`, `ciud_direccion`, `ciud_telefono`, `ciud_movil`, `ciud_email`, `ciud_fecharegistro`, `ciud_estado`, `ciud_tipo`, `ciud_carrera`, `ciud_clave`) VALUES
(21, 'BETTY ELENA', 'MEZA', 'CHAVEZ', '4564523', 'F', '2021-01-20', 'dirección', '65465335', '45434', 'betty@gmail.com', '2021-01-21 06:39:34', 'ACTIVO', 'PREGRADO', 43, 'e10adc3949ba59abbe56e057f20f883e'),
(22, 'Luis', 'MEZA', 'Rosales', '4564545', 'M', '2021-01-13', 'direcciónff', '65465335', '4544443', 'luis@gmail.com', '2021-01-21 06:40:40', 'ACTIVO', 'PREGRADO', 43, 'e10adc3949ba59abbe56e057f20f883e'),
(23, 'Felix', 'Ramón', 'PITMMAN', '32447856', 'M', '2021-01-15', 'direccióndw', '65465335', '4544434', 'felix@gmail.com', '2021-01-21 06:41:12', 'ACTIVO', 'POSGRADO', 19, 'e10adc3949ba59abbe56e057f20f883e'),
(24, 'GIANELLA MELANIE ', 'SUARES', 'PITMMAN', '32447833', 'F', '2021-01-14', 'DIRECCIóNFF', '65465335', '4544443', 'gianella@gmail.com', '2021-01-21 06:41:49', 'ACTIVO', 'POSGRADO', 19, 'e10adc3949ba59abbe56e057f20f883e'),
(25, 'LUIS', 'DE LA CRUZ', 'FLORES', '12345678', 'M', '2020-12-28', 'LIMA', '12345678', '12345678', 'dersse@gmail.com', '2021-01-25 14:32:54', 'ACTIVO', 'PREGRADO', 64, '25d55ad283aa400af464c76d713c07ad'),
(26, 'eee', 'deee', 'eeee', '12347890', 'M', '2020-12-29', 'eeee', '123131231', '12312312', 'ere@gmail.com', '2021-01-25 14:36:04', 'ACTIVO', 'PREGRADO', 53, 'df6234833d7d4d76a96654a1c89ac08f'),
(27, 'PRUEBA', 'DEMO', 'JUAN', '44550912', 'M', '2021-02-08', 'LIMA', '123456', '123456', 'juan@gmail.com', '2021-02-04 22:47:08', 'ACTIVO', 'PREGRADO', 60, 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_ciudadano`
--

CREATE TABLE `detalle_ciudadano` (
  `detalleciudadano_cod` int(11) NOT NULL,
  `ciudadano_cod` int(11) NOT NULL,
  `documento_cod` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_ciudadano`
--

INSERT INTO `detalle_ciudadano` (`detalleciudadano_cod`, `ciudadano_cod`, `documento_cod`) VALUES
(178, 24, 'POS-19-2021-000000001'),
(179, 23, 'POS-19-2021-000000001'),
(180, 24, 'POS-19-2021-000000002'),
(181, 23, 'POS-19-2021-000000002'),
(182, 24, 'POS-19-2021-000000003'),
(183, 27, 'PRE-60-2021-000000004'),
(184, 27, 'PRE-60-2021-000000005'),
(185, 27, 'PRE-60-2021-000000006'),
(186, 27, 'PRE-60-2021-000000007'),
(187, 27, 'PRE-60-2021-000000008');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_institucion`
--

CREATE TABLE `detalle_institucion` (
  `detalleinstitucion_cod` int(11) NOT NULL,
  `institucion_cod` int(11) NOT NULL,
  `documento_cod` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento`
--

CREATE TABLE `documento` (
  `documento_cod` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Codigo auto-incrementado del documento',
  `doc_asunto` varchar(150) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Asunto del documento',
  `doc_ticket` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `doc_fecha_recepcion` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'fecha del registro del documento',
  `tipoDocumento_cod` int(11) NOT NULL COMMENT 'codigo del tipo de documentos',
  `asesor_cod` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `area_cod` int(11) NOT NULL COMMENT 'Destino del documento',
  `usu_cod` int(11) NOT NULL COMMENT 'Codigo de Usuario',
  `doc_estado` enum('PENDIENTE','ACEPTADO','RECHAZADO') COLLATE utf8_spanish_ci NOT NULL COMMENT 'estado del documento',
  `num_proceso` int(11) NOT NULL,
  `doc_tipo` enum('I','C') COLLATE utf8_spanish_ci NOT NULL,
  `doc_documento` varchar(350) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_etapa1_v2` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_etapa1_v3` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `grado` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `anio` char(4) COLLATE utf8_spanish_ci DEFAULT NULL,
  `porcentaje` int(11) DEFAULT NULL,
  `archivo_turniting` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `paso` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_revisor_correo` date DEFAULT NULL,
  `fecha_final` date DEFAULT NULL,
  `anexo_uno` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `anexo_seis` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_seis_2` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_seis_3` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `estado_paso_tres` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `etica_anexo_uno` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `etica_anexo_cuatro` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `etica_anexo_cuatro_dos` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `etica_anexo_cuatro_tres` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `etica_comite` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'H=COMITE HUMANOS,A=COMITE ANIMALES',
  `estado_paso_cuatro` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `resolucion_firmada` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `anexo_uno_etapa_tres` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `proyecto_etapa_tres` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `carta_etapa_tres` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_uno_etapa_cuatro` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `carta_etapa_cuatro` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `fecha_aprobada` date DEFAULT NULL,
  `fecha_entrega` date DEFAULT NULL,
  `anexo_siete` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_ocho` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `fecha_registro_jurado` date DEFAULT NULL,
  `fecha_final_jurado` date DEFAULT NULL,
  `anexo_dies` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_dies_dos` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_dies_tres` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `fecha_sustentacion` date DEFAULT NULL,
  `zoom` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `lugar` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `hora` varchar(200) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha_correo_etapa_siete` date DEFAULT NULL,
  `correo_sustentacion` varchar(500) COLLATE utf8_spanish_ci DEFAULT NULL,
  `anexo_trece` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_catorce` char(1) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_quince` char(1) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_uno` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_dos` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_tres` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_cuatro` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_cinco` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `retorno` char(1) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_turnitin_etapa_nueve` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `porcentaje_nueve` varchar(5) COLLATE utf8_spanish_ci DEFAULT '0',
  `repositorio` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `archivo_turnitin_dos_etapa_nueve` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_seis_uno_r2` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_seis_dos_r2` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_seis_tres_r2` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_seis_uno_r3` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_seis_dos_r3` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `anexo_seis_tres_r3` varchar(500) COLLATE utf8_spanish_ci DEFAULT '0',
  `porcentaje_turnitin_siete` int(11) DEFAULT 0,
  `tipo_publicacion` int(11) DEFAULT NULL,
  `nombre_revista` text COLLATE utf8_spanish_ci DEFAULT NULL COMMENT '1=Tradicional,2=Articulo no Publicado,3=Articulo publicado,4=Patente',
  `fecha_subida_revisores` date DEFAULT NULL,
  `constancia_firmada` text COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento`
--

INSERT INTO `documento` (`documento_cod`, `doc_asunto`, `doc_ticket`, `doc_fecha_recepcion`, `tipoDocumento_cod`, `asesor_cod`, `area_cod`, `usu_cod`, `doc_estado`, `num_proceso`, `doc_tipo`, `doc_documento`, `archivo_etapa1_v2`, `archivo_etapa1_v3`, `grado`, `anio`, `porcentaje`, `archivo_turniting`, `paso`, `fecha_revisor_correo`, `fecha_final`, `anexo_uno`, `anexo_seis`, `anexo_seis_2`, `anexo_seis_3`, `estado_paso_tres`, `etica_anexo_uno`, `etica_anexo_cuatro`, `etica_anexo_cuatro_dos`, `etica_anexo_cuatro_tres`, `etica_comite`, `estado_paso_cuatro`, `resolucion_firmada`, `anexo_uno_etapa_tres`, `proyecto_etapa_tres`, `carta_etapa_tres`, `anexo_uno_etapa_cuatro`, `carta_etapa_cuatro`, `fecha_aprobada`, `fecha_entrega`, `anexo_siete`, `anexo_ocho`, `fecha_registro_jurado`, `fecha_final_jurado`, `anexo_dies`, `anexo_dies_dos`, `anexo_dies_tres`, `fecha_sustentacion`, `zoom`, `lugar`, `hora`, `fecha_correo_etapa_siete`, `correo_sustentacion`, `anexo_trece`, `anexo_catorce`, `anexo_quince`, `archivo_uno`, `archivo_dos`, `archivo_tres`, `archivo_cuatro`, `archivo_cinco`, `retorno`, `archivo_turnitin_etapa_nueve`, `porcentaje_nueve`, `repositorio`, `archivo_turnitin_dos_etapa_nueve`, `anexo_seis_uno_r2`, `anexo_seis_dos_r2`, `anexo_seis_tres_r2`, `anexo_seis_uno_r3`, `anexo_seis_dos_r3`, `anexo_seis_tres_r3`, `porcentaje_turnitin_siete`, `tipo_publicacion`, `nombre_revista`, `fecha_subida_revisores`, `constancia_firmada`) VALUES
('POS-19-2021-000000001', 'TESIS 1', '5545454', '2021-01-21 02:26:14', 4, NULL, 1, 1, 'ACEPTADO', 5, 'C', 'Archivo/POS-19-2021-000000001/POS-19-2021-000000001.pdf', '0', '0', '19', '2021', 15, 'Archivo/6008f1a3c8321-resolucion-doc-PRE-2020-000000002.pdf', NULL, NULL, NULL, NULL, 'Archivo/POS-19-2021-000000001/601c7dce2de14-PeruOportunidadDesarrollo.pdf', '0', '0', 'APROBADO', 'Archivo/POS-19-2021-000000001/600f317a7f366-Algunas tesis sobre la tegnologia.pdf', 'Archivo/POS-19-2021-000000001/600f317a85208-Constancia - tesis reposiorio.pdf', 'Archivo/POS-19-2021-000000001/601c7e4d9caa6-PERU-INFO-ESP.pdf', '0', 'H', 'APROBADO', 'Archivo/601c7ed92fa15-PERU-INFO-ESP.pdf', 'Archivo/POS-19-2021-000000001/601c7dfb8ccb6-PERU-INFO-ESP.pdf', 'Archivo/POS-19-2021-000000001/601c7dfb9185a-Const-peru-oficial.pdf', 'Archivo/POS-19-2021-000000001/601c7dfb98bfd-PeruOportunidadDesarrollo.pdf', 'Archivo/POS-19-2021-000000001/601c7e81b561a-Constancia - tesis reposiorio.pdf', 'Archivo/POS-19-2021-000000001/601c7e915a480-Const-peru-oficial.pdf', '2021-02-21', '2021-02-28', 'Archivo/POS-19-2021-000000001/601c7efe4b57f-Const-peru-oficial.pdf', 'Archivo/POS-19-2021-000000001/601c7f06881a4-Const-peru-oficial.pdf', '2021-02-04', '2021-02-25', 'Archivo/POS-19-2021-000000001/601c7f65a48d7-Algunas tesis sobre la tegnologia.pdf', 'Archivo/POS-19-2021-000000001/601c7f85e84eb-Const-peru-oficial.pdf', '0', '2021-03-18', NULL, NULL, NULL, NULL, NULL, 'Archivo/POS-19-2021-000000001/601c7fd9a5da9-Const-peru-oficial.pdf', '1', '1', 'Archivo/POS-19-2021-000000001/601c800705a13-Constancia - tesis reposiorio.pdf', 'Archivo/POS-19-2021-000000001/601c801a5313b-PeruOportunidadDesarrollo.pdf', 'Archivo/POS-19-2021-000000001/601c80223f0e2-PERU-INFO-ESP.pdf', 'Archivo/POS-19-2021-000000001/601c8029e7f2b-resolucion-doc-POS-19-2021-000000003.doc', '0', '0', 'Archivo/POS-19-2021-000000001/601c8094efc07-PERU-INFO-ESP.pdf', '1', 'http://proyada.local/vistas/admin.php', 'Archivo/POS-19-2021-000000001/601c80b36d553-Const-peru-oficial.pdf', '0', '0', '0', '0', '0', '0', 0, NULL, NULL, NULL, '0'),
('POS-19-2021-000000002', 'DE PRYBA', '4443333', '2021-01-22 00:19:27', 4, NULL, 1, 1, 'PENDIENTE', 4, 'C', 'Archivo/POS-19-2021-000000002/POS-19-2021-000000002.pdf', '0', '0', '19', '2021', 5, 'Archivo/POS-19-2021-000000002/600a1afe09d4b-Libro.pdf', NULL, '2021-02-06', '2021-02-26', NULL, 'Archivo/POS-19-2021-000000002/6022a4853f957-Constancia - tesis reposiorio (1).pdf', '0', '0', 'APROBADO', '0', '0', '0', '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', '2021-01-30', '2021-01-31', '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, NULL, NULL, NULL, '0'),
('POS-19-2021-000000003', 'TESIS UNO', '455454', '2021-01-25 13:08:51', 4, NULL, 1, 1, 'PENDIENTE', 7, 'C', 'Archivo/POS-19-2021-000000003/POS-19-2021-000000003.pdf', '0', '0', '19', '2021', 10, 'Archivo/POS-19-2021-000000003/600ed94ba5965-Libro.pdf', NULL, '2021-02-23', '2021-03-15', NULL, 'Archivo/POS-19-2021-000000003/600eddf34e7c2-resolucion-doc-PRE-2020-000000002.pdf', '0', '0', 'APROBADO', 'Archivo/POS-19-2021-000000003/60352a35c208f-Const-peru-oficial.pdf', 'Archivo/POS-19-2021-000000003/60352a35c5f14-PeruOportunidadDesarrollo.pdf', 'Archivo/POS-19-2021-000000003/60352a35c806b-Algunas tesis sobre la tegnologia.pdf', 'Archivo/POS-19-2021-000000003/60352a35c806b-Algunas tesis sobre la tegnologia.pdf', 'H', 'APROBADO', 'Archivo/POS-19-2021-000000003/60352ee0955cc-PERU-INFO-ESP.pdf', 'Archivo/POS-19-2021-000000003/603529c887b73-PeruOportunidadDesarrollo.pdf', 'Archivo/POS-19-2021-000000003/603529c8899c2-Const-peru-oficial.pdf', 'Archivo/POS-19-2021-000000003/603529c88cb34-PERU-INFO-ESP.pdf', 'Archivo/POS-19-2021-000000003/60352a6e2a63c-PeruOportunidadDesarrollo.pdf', 'Archivo/POS-19-2021-000000003/60352a75f16d1-PERU-INFO-ESP.pdf', '2021-01-30', '2021-01-28', 'Archivo/POS-19-2021-000000003/600f1e859bb1e-Algunas tesis sobre la tegnologia.pdf', 'Archivo/POS-19-2021-000000003/600f1e8d7b75c-Constancia - tesis reposiorio.pdf', NULL, NULL, 'Archivo/POS-19-2021-000000003/601c75f3bf356-PERU-INFO-ESP.pdf', 'Archivo/POS-19-2021-000000003/601c76a957296-PeruOportunidadDesarrollo.pdf', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 14, NULL, NULL, NULL, '0'),
('PRE-60-2021-000000004', 'DFBDGDGDF', '123456', '2021-02-08 21:02:22', 4, NULL, 1, 1, 'PENDIENTE', 3, 'C', 'Archivo/PRE-60-2021-000000004/PRE-60-2021-000000004.pdf', '0', '0', '60', '2021', 3, 'Archivo/PRE-60-2021-000000004/6022a40fef331-PeruOportunidadDesarrollo.pdf', NULL, '2021-02-09', '2021-03-01', NULL, 'Archivo/PRE-60-2021-000000004/603a8202bd2aa-Constancia - tesis reposiorio (1).pdf', '0', '0', 'APROBADO', '0', '0', '0', '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', 'Archivo/PRE-60-2021-000000004/6039935d7a60f-Const-peru-oficial.pdf', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, 2, 'http://deprueba.com', '2021-02-27', 'Archivo/PRE-60-2021-000000004/603a7f2792644-Constancia - tesis reposiorio (1).pdf'),
('PRE-60-2021-000000005', 'DFBDGDGDF', '123456', '2021-02-08 21:02:50', 4, NULL, 1, 1, 'RECHAZADO', 6, 'C', 'Archivo/PRE-60-2021-000000005/PRE-60-2021-000000005.pdf', '0', '0', '60', '2021', 2, 'Archivo/PRE-60-2021-000000005/6022a402712ee-Const-peru-oficial.pdf', NULL, '2021-02-23', '2021-03-15', NULL, 'Archivo/PRE-60-2021-000000005/603525ecddf2a-Constancia - tesis reposiorio (1).pdf', 'Archivo/PRE-60-2021-000000005/6035268378c1d-Const-peru-oficial.pdf', '0', 'APROBADO', '0', '0', '0', '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 'Archivo/PRE-60-2021-000000005/603522a5d1af3-Constancia - tesis reposiorio (1).pdf', '0', '0', '0', '0', '0', 0, NULL, NULL, NULL, '0'),
('PRE-60-2021-000000006', 'SDDFGDF ER ERTERTERTE', '1221', '2021-02-08 22:26:15', 4, NULL, 1, 1, 'PENDIENTE', 5, 'C', 'Archivo/PRE-60-2021-000000006/PRE-60-2021-000000006.pdf', '0', '0', '60', '2021', 10, 'Archivo/PRE-60-2021-000000006/6022a3e15537c-Constancia - tesis reposiorio (1).pdf', NULL, '2021-02-09', '2021-03-01', NULL, '0', '0', '0', 'APROBADO', '0', '0', '0', '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, NULL, NULL, NULL, '0'),
('PRE-60-2021-000000007', 'SDDFGDF ER ERTERTERTE', '1221', '2021-02-08 22:26:27', 4, NULL, 1, 1, 'PENDIENTE', 4, 'C', 'Archivo/PRE-60-2021-000000007/PRE-60-2021-000000007.pdf', '0', '0', '60', '2021', 1, 'Archivo/PRE-60-2021-000000007/6021c054847bb-Constancia - tesis reposiorio (1).pdf', NULL, '2021-02-09', '2021-03-01', NULL, '0', '0', '0', 'APROBADO', '0', '0', '0', '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, NULL, NULL, NULL, '0'),
('PRE-60-2021-000000008', 'SDFEEFERER FDDFDF', '233223', '2021-02-09 15:00:44', 4, NULL, 1, 1, 'PENDIENTE', 4, 'C', 'Archivo/PRE-60-2021-000000008/PRE-60-2021-000000008.pdf', '0', '0', '60', '2021', 4, 'Archivo/PRE-60-2021-000000008/6022a3f08092e-Constancia - tesis reposiorio (1).pdf', NULL, '2021-02-09', '2021-03-01', NULL, '0', '0', '0', 'APROBADO', 'Archivo/PRE-60-2021-000000008/603527e345049-PERU-INFO-ESP.pdf', 'Archivo/PRE-60-2021-000000008/603527e348d6b-PERU-INFO-ESP.pdf', '0', '0', NULL, NULL, NULL, '0', '0', '0', '0', '0', NULL, NULL, '0', '0', NULL, NULL, '0', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL, '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_asesor`
--

CREATE TABLE `documento_asesor` (
  `id` int(11) NOT NULL,
  `documento_cod` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `asesor_cod` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `por_pagar` char(2) COLLATE utf8_spanish_ci DEFAULT 'NO',
  `por_pagar_fecha` date DEFAULT NULL,
  `modalidad` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pagado` char(1) COLLATE utf8_spanish_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento_asesor`
--

INSERT INTO `documento_asesor` (`id`, `documento_cod`, `asesor_cod`, `fecha_registro`, `tipo`, `por_pagar`, `por_pagar_fecha`, `modalidad`, `pagado`) VALUES
(40, 'POS-19-2021-000000001', 6, '2021-01-20', 'I', 'SI', '2021-02-04', 'T', '1'),
(41, 'POS-19-2021-000000002', 3, '2021-01-21', 'I', 'SI', NULL, 'I', '0'),
(42, 'POS-19-2021-000000002', 1, '2021-01-21', 'I', 'SI', NULL, 'I', '0'),
(43, 'POS-19-2021-000000003', 3, '2021-01-25', 'I', 'SI', NULL, 'T', '0'),
(45, 'PRE-60-2021-000000005', 9, '2021-02-08', '', 'SI', NULL, '', '0'),
(46, 'PRE-60-2021-000000006', 3, '2021-02-08', '', 'SI', NULL, '', '0'),
(47, 'PRE-60-2021-000000007', 3, '2021-02-08', '', 'SI', NULL, '', '0'),
(48, 'PRE-60-2021-000000008', 9, '2021-02-09', 'I', 'SI', NULL, 'I', '0'),
(49, 'PRE-60-2021-000000008', 6, '2021-02-09', 'I', 'SI', NULL, 'I', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_jurado`
--

CREATE TABLE `documento_jurado` (
  `id` int(11) NOT NULL,
  `documento_cod` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `asesor_cod` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `por_pagar` char(2) COLLATE utf8_spanish_ci DEFAULT 'NO',
  `por_pagar_fecha` date DEFAULT NULL,
  `modalidad` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pagado` char(1) COLLATE utf8_spanish_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento_jurado`
--

INSERT INTO `documento_jurado` (`id`, `documento_cod`, `asesor_cod`, `fecha_registro`, `tipo`, `por_pagar`, `por_pagar_fecha`, `modalidad`, `pagado`) VALUES
(9, 'POS-19-2021-000000001', 1, '2021-01-25', 'C', 'SI', '2021-02-04', 'I', '1'),
(10, 'POS-19-2021-000000003', 5, '2021-01-26', 'C', 'SI', NULL, 'I', '1'),
(11, 'POS-19-2021-000000003', 4, '2021-01-26', 'C', 'SI', NULL, 'I', '0'),
(12, 'POS-19-2021-000000001', 6, '2021-02-04', 'I', 'SI', '2021-02-04', 'I', '1');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documento_revisor`
--

CREATE TABLE `documento_revisor` (
  `id` int(11) NOT NULL,
  `documento_cod` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `asesor_cod` int(11) DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `tipo` char(1) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'I=Independiente,C=comisión,D= Docente del curso',
  `por_pagar` char(2) COLLATE utf8_spanish_ci DEFAULT 'NO',
  `por_pagar_fecha` date DEFAULT NULL,
  `modalidad` char(1) COLLATE utf8_spanish_ci DEFAULT NULL COMMENT 'I=Investigador asociado,T= titular,N=ninguno',
  `pagado` char(1) COLLATE utf8_spanish_ci DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `documento_revisor`
--

INSERT INTO `documento_revisor` (`id`, `documento_cod`, `asesor_cod`, `fecha_registro`, `tipo`, `por_pagar`, `por_pagar_fecha`, `modalidad`, `pagado`) VALUES
(27, 'POS-19-2021-000000002', 1, '2021-01-22', 'C', 'SI', '2021-02-09', 'T', '0'),
(28, 'POS-19-2021-000000002', 7, '2021-01-22', 'C', 'SI', '2021-02-09', 'N', '0'),
(29, 'POS-19-2021-000000003', 1, '2021-01-25', 'I', 'SI', '2021-01-25', 'I', '0'),
(30, 'POS-19-2021-000000003', 7, '2021-01-25', 'I', 'SI', '2021-01-25', 'I', '0'),
(31, 'POS-19-2021-000000001', 1, '2021-02-05', 'I', 'SI', '2021-02-04', 'I', '0'),
(32, 'POS-19-2021-000000001', 7, '2021-02-05', 'I', 'SI', '2021-02-04', 'I', '0'),
(33, 'PRE-60-2021-000000008', 1, '2021-02-09', 'I', 'SI', '2021-02-09', 'I', '0'),
(34, 'PRE-60-2021-000000007', 1, '2021-02-09', 'I', 'SI', '2021-02-09', 'I', '0'),
(35, 'PRE-60-2021-000000007', 7, '2021-02-09', 'I', 'SI', '2021-02-09', 'T', '0'),
(36, 'PRE-60-2021-000000006', 9, '2021-02-09', 'I', 'SI', '2021-02-09', 'T', '0'),
(37, 'PRE-60-2021-000000006', 7, '2021-02-09', 'I', 'SI', '2021-02-09', 'I', '0'),
(38, 'PRE-60-2021-000000005', 1, '2021-02-09', 'I', 'SI', '2021-02-09', 'T', '0'),
(39, 'PRE-60-2021-000000005', 7, '2021-02-09', 'I', 'SI', '2021-02-09', 'I', '0'),
(40, 'PRE-60-2021-000000004', 7, '2021-02-09', 'I', 'SI', '2021-02-09', 'T', '0');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `institucion`
--

CREATE TABLE `institucion` (
  `institucion_cod` int(11) NOT NULL,
  `inst_nombre` varchar(150) COLLATE utf8_spanish_ci NOT NULL,
  `inst_tipoinstitucion` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `inst_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `institucion`
--

INSERT INTO `institucion` (`institucion_cod`, `inst_nombre`, `inst_tipoinstitucion`, `inst_estado`) VALUES
(4, 'CIENTIFICA DEL SUR', 'SERVICIOS DE EDUCACIÓN', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `personal_cod` int(11) NOT NULL,
  `pers_nombres` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `pers_apellidoPate` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pers_apellidoMate` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pers_dni` char(8) COLLATE utf8_spanish_ci NOT NULL,
  `pers_sexo` char(1) COLLATE utf8_spanish_ci NOT NULL,
  `pers_fechaNacimiento` date NOT NULL,
  `pers_direccion` varchar(250) COLLATE utf8_spanish_ci NOT NULL,
  `pers_telefono` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `pers_movil` char(9) COLLATE utf8_spanish_ci NOT NULL,
  `pers_email` varchar(80) COLLATE utf8_spanish_ci NOT NULL,
  `pers_fecharegistro` timestamp NOT NULL DEFAULT current_timestamp(),
  `pers_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL,
  `usuario_cod` int(11) NOT NULL,
  `pers_puesto` enum('DIRECTOR','SECRETARIA') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`personal_cod`, `pers_nombres`, `pers_apellidoPate`, `pers_apellidoMate`, `pers_dni`, `pers_sexo`, `pers_fechaNacimiento`, `pers_direccion`, `pers_telefono`, `pers_movil`, `pers_email`, `pers_fecharegistro`, `pers_estado`, `usuario_cod`, `pers_puesto`) VALUES
(1, 'JHORDAN JONTER', 'RODRIGUEZ', 'APONTE', '71998919', 'M', '1997-11-18', 'LT. 1 MZ D SAN JUAN DE MIRAFLORES', '964970199', '0152456', 'jhordanjhonter07@gmail.com', '2018-11-14 07:27:52', 'ACTIVO', 1, 'DIRECTOR'),
(12, 'FRANCIS', 'MENDOZA', 'CHAVEZ', '75854685', 'M', '1989-02-05', 'CHORRILLOS', '965845236', '0125685', 'francis@cientifica.edu.pe', '2020-11-27 03:56:35', 'ACTIVO', 14, 'SECRETARIA'),
(13, 'JOSE', 'PERÉZ', 'HUERTA', '41524685', 'M', '1991-05-25', 'SURCO', '965845268', '0152652', 'jose@cientifica.edu.pe', '2020-11-27 03:57:40', 'ACTIVO', 15, 'SECRETARIA'),
(14, 'RUBEN', 'RAMOS', 'GRANADO', '54582653', 'M', '1986-03-25', 'SAN JUAN DE LURIGANCHO', '965854625', '0125648', 'ruben@gmail.com', '2020-11-27 03:59:40', 'ACTIVO', 16, 'SECRETARIA'),
(15, 'RUSAN', 'INOSTROZA', 'MENDEZ', '71546854', 'F', '1989-08-05', 'PUENTE PIEDRA - MZ D', '964523655', '0152456', 'susan@gmail.com', '2020-11-27 04:01:14', 'ACTIVO', 17, '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programa_academico`
--

CREATE TABLE `programa_academico` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `modalidad` varchar(15) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8_spanish_ci DEFAULT NULL,
  `adicional` varchar(255) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `programa_academico`
--

INSERT INTO `programa_academico` (`id`, `descripcion`, `modalidad`, `estado`, `adicional`) VALUES
(1, 'Diseño, Gestión y Dirección de Proyectos', 'POSGRADO', '1', NULL),
(2, 'Direccion Estrategica', 'POSGRADO', '1', NULL),
(3, 'Administración de Negocios', 'POSGRADO', '1', NULL),
(4, 'Desarrollo de Proyectos de Innovación y Producto', 'POSGRADO', '1', NULL),
(5, 'Auditoría y Gestión Empresarial', 'POSGRADO', '1', NULL),
(6, 'Recursos Humanos y Gestión del Conocimiento', 'POSGRADO', '1', NULL),
(7, 'Dirección Estratégica en Tecnologías de la Información', 'POSGRADO', '1', NULL),
(8, 'Salud Ocupacional con mención en Medicina Ocupacional y Medio Ambiente', 'POSGRADO', '1', NULL),
(9, 'Medicina Ocupacional y del Medio Ambiente', 'POSGRADO', '1', NULL),
(10, 'Ergonomía Laboral', 'POSGRADO', '1', NULL),
(11, 'Psicosociología Laboral', 'POSGRADO', '1', NULL),
(12, 'Alta Gerencia de Clínicas y Hospitales', 'POSGRADO', '1', NULL),
(13, 'Alta Gerencia de Servicios de Salud', 'POSGRADO', '1', NULL),
(14, 'Epidemiología Clínica y Bioestadística', 'POSGRADO', '1', NULL),
(15, 'Gerontología', 'POSGRADO', '1', NULL),
(16, 'Maestria en Prevencion de Riesgos Laborales', 'POSGRADO', '1', NULL),
(17, 'Ingeniería de Innovación Tecnológica', 'POSGRADO', '1', NULL),
(18, 'Dirección Estratégica en Marketing', 'POSGRADO', '1', NULL),
(19, 'Estomatología', 'POSGRADO', '1', NULL),
(20, 'Carielogía y Endodoncia', 'POSGRADO', '1', NULL),
(21, 'Implantología Oral', 'POSGRADO', '1', NULL),
(22, 'Odontopediatría', 'POSGRADO', '1', NULL),
(23, 'Odontología Estética y Restauradora', 'POSGRADO', '1', NULL),
(24, 'Periodoncia e Implantes', 'POSGRADO', '1', NULL),
(25, 'Odontología Forense', 'POSGRADO', '1', NULL),
(26, 'Ortodoncia y Ortopedia Maxilar', 'POSGRADO', '1', NULL),
(27, 'Rehabilitación Oral', 'POSGRADO', '1', NULL),
(28, 'Radiología Bucal y Maxilofacial', 'POSGRADO', '1', NULL),
(29, 'Docencia en Educación Superior', 'POSGRADO', '1', NULL),
(30, 'Educación Superior con mención en Docencia e Investigación Universitaria', 'POSGRADO', '1', NULL),
(31, 'Dirección Estratégica en Telecomunicaciones', 'POSGRADO', '1', NULL),
(32, 'Comunicación con mención en Periodismo y Comunicación Social', 'POSGRADO', '1', NULL),
(33, 'Comunicación con mención en Audiovisual y Multimedia', 'POSGRADO', '1', NULL),
(34, 'Resolución de Conflictos y Mediación', 'POSGRADO', '1', NULL),
(35, 'Dirección y Consultoría Turística', 'POSGRADO', '1', NULL),
(36, 'Energías Renovables', 'POSGRADO', '1', NULL),
(37, 'Cambio Climático', 'POSGRADO', '1', NULL),
(38, 'Ingeniería y Tecnología Ambiental', 'POSGRADO', '1', NULL),
(39, 'Gestión Integrada del Medio Ambiente, Calidad y Prevención', 'POSGRADO', '1', NULL),
(40, 'Gestión y Auditorías Ambientales', 'POSGRADO', '1', NULL),
(41, 'Internacional en Seguridad y Salud en el Trabajo', 'POSGRADO', '1', NULL),
(42, 'Proyectos de Arquitectura y Urbanismo', 'POSGRADO', '1', NULL),
(43, 'Administración de Empresas', 'PREGRADO', '1', NULL),
(44, 'Administración de Negocios Internacionales', 'PREGRADO', '1', NULL),
(45, 'Medicina Humana', 'PREGRADO', '1', NULL),
(46, 'Ingeniería de Sistemas Empresariales', 'PREGRADO', '1', NULL),
(47, 'Administración de redes y Seguridad Informática', 'PREGRADO', '1', NULL),
(48, 'Ingeniería Económica y de Negocios', 'PREGRADO', '1', NULL),
(49, 'Contabilidad y Finanzas', 'PREGRADO', '1', NULL),
(50, 'Marketing y Administración', 'PREGRADO', '1', NULL),
(51, 'Marketing y Publicidad', 'PREGRADO', '1', NULL),
(52, 'Estomatología', 'PREGRADO', '1', NULL),
(53, 'Derecho', 'PREGRADO', '1', NULL),
(54, 'Turismo', 'PREGRADO', '1', NULL),
(55, 'Artes', 'PREGRADO', '1', NULL),
(56, 'Comunicación y Publicidad', 'PREGRADO', '1', NULL),
(57, 'Ingeniería Ambiental', 'PREGRADO', '1', NULL),
(58, 'Arquitectura y Urbanismo Ambiental', 'PREGRADO', '1', NULL),
(59, 'Veterinaria y Zootecnia', 'PREGRADO', '1', NULL),
(60, 'Psicología', 'PREGRADO', '1', NULL),
(61, 'Enfermería', 'PREGRADO', '1', NULL),
(62, 'Obstetricia', 'PREGRADO', '1', NULL),
(63, 'Biología Marinas', 'PREGRADO', '1', NULL),
(64, 'Ingeniería Agroforestal', 'PREGRADO', '1', NULL),
(65, 'Ingeniería Acuicola', 'PREGRADO', '1', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_asesor`
--

CREATE TABLE `tipo_asesor` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_asesor`
--

INSERT INTO `tipo_asesor` (`id`, `descripcion`, `estado`) VALUES
(1, 'asesor', 1),
(2, 'revisor', 1),
(3, 'Jurado', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `tipodocumento_cod` int(11) NOT NULL COMMENT 'Codigo auto-incrementado del tipo documento',
  `tipodo_descripcion` varchar(50) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Descripcion del  tipo documento',
  `tipodo_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL COMMENT 'estado del tipo de documento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`tipodocumento_cod`, `tipodo_descripcion`, `tipodo_estado`) VALUES
(4, 'PROYECTO TESIS', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_usuario`
--

CREATE TABLE `tipo_usuario` (
  `cod_tipousuario` int(11) NOT NULL,
  `tipusu_descripcion` varchar(40) COLLATE utf8_spanish_ci NOT NULL,
  `tipusu_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_usuario`
--

INSERT INTO `tipo_usuario` (`cod_tipousuario`, `tipusu_descripcion`, `tipusu_estado`) VALUES
(1, 'ADMINISTRADOR', 'ACTIVO'),
(2, 'ASISTENTE', 'ACTIVO'),
(3, 'COORDINADOR', 'ACTIVO'),
(4, 'REVISOR', 'ACTIVO'),
(5, 'COBRANZA', 'ACTIVO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL,
  `usu_nombre` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `usu_clave` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `usu_estado` enum('ACTIVO','INACTIVO') COLLATE utf8_spanish_ci DEFAULT NULL,
  `cod_tipousuario` int(11) NOT NULL,
  `usu_foto` varchar(350) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `usu_nombre`, `usu_clave`, `usu_estado`, `cod_tipousuario`, `usu_foto`) VALUES
(1, 'admin', '123456', 'ACTIVO', 1, 'Fotos/admin.png'),
(14, 'francis', '123456', 'ACTIVO', 2, 'Fotos/admin.png'),
(15, 'jose', '123456', 'ACTIVO', 3, 'Fotos/admin.png'),
(16, 'ruben', '123456', 'ACTIVO', 4, 'Fotos/admin.png'),
(17, 'susan', '123456', 'ACTIVO', 5, 'Fotos/admin.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`area_cod`),
  ADD UNIQUE KEY `unico` (`area_nombre`);

--
-- Indices de la tabla `asesor`
--
ALTER TABLE `asesor`
  ADD PRIMARY KEY (`asesor_cod`),
  ADD UNIQUE KEY `dni_UNIQUE` (`dni`);

--
-- Indices de la tabla `asesor_tipo_detalle`
--
ALTER TABLE `asesor_tipo_detalle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_asesor` (`id_asesor`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Indices de la tabla `ciudadano`
--
ALTER TABLE `ciudadano`
  ADD PRIMARY KEY (`ciudadano_cod`),
  ADD KEY `cod_ciudona` (`ciud_nombres`);

--
-- Indices de la tabla `detalle_ciudadano`
--
ALTER TABLE `detalle_ciudadano`
  ADD PRIMARY KEY (`detalleciudadano_cod`),
  ADD KEY `ciudadano_cod` (`ciudadano_cod`),
  ADD KEY `fd` (`documento_cod`);

--
-- Indices de la tabla `detalle_institucion`
--
ALTER TABLE `detalle_institucion`
  ADD PRIMARY KEY (`detalleinstitucion_cod`),
  ADD KEY `institucion_cod` (`institucion_cod`),
  ADD KEY `sd` (`documento_cod`);

--
-- Indices de la tabla `documento`
--
ALTER TABLE `documento`
  ADD PRIMARY KEY (`documento_cod`),
  ADD KEY `area_cod` (`area_cod`),
  ADD KEY `tipoDocumento_cod` (`tipoDocumento_cod`),
  ADD KEY `usu_cod` (`usu_cod`),
  ADD KEY `asesor_cod` (`asesor_cod`);

--
-- Indices de la tabla `documento_asesor`
--
ALTER TABLE `documento_asesor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documento_cod` (`documento_cod`),
  ADD KEY `asesor_cod` (`asesor_cod`);

--
-- Indices de la tabla `documento_jurado`
--
ALTER TABLE `documento_jurado`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documento_cod` (`documento_cod`),
  ADD KEY `asesor_cod` (`asesor_cod`);

--
-- Indices de la tabla `documento_revisor`
--
ALTER TABLE `documento_revisor`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documento_cod` (`documento_cod`),
  ADD KEY `asesor_cod` (`asesor_cod`);

--
-- Indices de la tabla `institucion`
--
ALTER TABLE `institucion`
  ADD PRIMARY KEY (`institucion_cod`),
  ADD UNIQUE KEY `unico` (`inst_nombre`) USING BTREE;

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`personal_cod`),
  ADD KEY `cod_persona` (`pers_nombres`),
  ADD KEY `personal_ibfk_1` (`usuario_cod`);

--
-- Indices de la tabla `programa_academico`
--
ALTER TABLE `programa_academico`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_asesor`
--
ALTER TABLE `tipo_asesor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`tipodocumento_cod`),
  ADD UNIQUE KEY `IU_COD_TIPDOCUMENTO` (`tipodocumento_cod`) USING BTREE COMMENT 'EL CODIGO SERA UNICO',
  ADD KEY `IX_NOMBRE` (`tipodo_descripcion`) USING BTREE COMMENT 'SE ORDENARA LOS DATOS POR LA DESCRIPCION';

--
-- Indices de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  ADD PRIMARY KEY (`cod_tipousuario`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD KEY `cod_tipousuario` (`cod_tipousuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `area_cod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo auto-incrementado del movimiento del area', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `asesor_tipo_detalle`
--
ALTER TABLE `asesor_tipo_detalle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `ciudadano`
--
ALTER TABLE `ciudadano`
  MODIFY `ciudadano_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `detalle_ciudadano`
--
ALTER TABLE `detalle_ciudadano`
  MODIFY `detalleciudadano_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT de la tabla `detalle_institucion`
--
ALTER TABLE `detalle_institucion`
  MODIFY `detalleinstitucion_cod` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `documento_asesor`
--
ALTER TABLE `documento_asesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `documento_jurado`
--
ALTER TABLE `documento_jurado`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `documento_revisor`
--
ALTER TABLE `documento_revisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de la tabla `institucion`
--
ALTER TABLE `institucion`
  MODIFY `institucion_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `personal_cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `programa_academico`
--
ALTER TABLE `programa_academico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de la tabla `tipo_asesor`
--
ALTER TABLE `tipo_asesor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `tipodocumento_cod` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Codigo auto-incrementado del tipo documento', AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tipo_usuario`
--
ALTER TABLE `tipo_usuario`
  MODIFY `cod_tipousuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `asesor_tipo_detalle`
--
ALTER TABLE `asesor_tipo_detalle`
  ADD CONSTRAINT `asesor_tipo_detalle_ibfk_2` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_asesor` (`id`),
  ADD CONSTRAINT `asesor_tipo_detalle_ibfk_3` FOREIGN KEY (`id_asesor`) REFERENCES `asesor` (`asesor_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_ciudadano`
--
ALTER TABLE `detalle_ciudadano`
  ADD CONSTRAINT `detalle_ciudadano_ibfk_1` FOREIGN KEY (`ciudadano_cod`) REFERENCES `ciudadano` (`ciudadano_cod`),
  ADD CONSTRAINT `detalle_ciudadano_ibfk_2` FOREIGN KEY (`documento_cod`) REFERENCES `documento` (`documento_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_institucion`
--
ALTER TABLE `detalle_institucion`
  ADD CONSTRAINT `detalle_institucion_ibfk_1` FOREIGN KEY (`institucion_cod`) REFERENCES `institucion` (`institucion_cod`),
  ADD CONSTRAINT `detalle_institucion_ibfk_2` FOREIGN KEY (`documento_cod`) REFERENCES `documento` (`documento_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento`
--
ALTER TABLE `documento`
  ADD CONSTRAINT `documento_ibfk_1` FOREIGN KEY (`area_cod`) REFERENCES `area` (`area_cod`),
  ADD CONSTRAINT `documento_ibfk_2` FOREIGN KEY (`tipoDocumento_cod`) REFERENCES `tipo_documento` (`tipodocumento_cod`),
  ADD CONSTRAINT `documento_ibfk_3` FOREIGN KEY (`usu_cod`) REFERENCES `usuario` (`cod_usuario`);

--
-- Filtros para la tabla `documento_asesor`
--
ALTER TABLE `documento_asesor`
  ADD CONSTRAINT `documento_asesor_ibfk_1` FOREIGN KEY (`documento_cod`) REFERENCES `documento` (`documento_cod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_asesor_ibfk_2` FOREIGN KEY (`asesor_cod`) REFERENCES `asesor` (`asesor_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento_jurado`
--
ALTER TABLE `documento_jurado`
  ADD CONSTRAINT `documento_jurado_ibfk_1` FOREIGN KEY (`documento_cod`) REFERENCES `documento` (`documento_cod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_jurado_ibfk_2` FOREIGN KEY (`asesor_cod`) REFERENCES `asesor` (`asesor_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documento_revisor`
--
ALTER TABLE `documento_revisor`
  ADD CONSTRAINT `documento_revisor_ibfk_1` FOREIGN KEY (`asesor_cod`) REFERENCES `asesor` (`asesor_cod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `documento_revisor_ibfk_2` FOREIGN KEY (`documento_cod`) REFERENCES `documento` (`documento_cod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_ibfk_1` FOREIGN KEY (`usuario_cod`) REFERENCES `usuario` (`cod_usuario`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`cod_tipousuario`) REFERENCES `tipo_usuario` (`cod_tipousuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
