DROP TABLE IF EXISTS usuarioweb;
CREATE TABLE usuarioweb (
		NOMBRE_USUARIO varchar(40) NOT NULL,
		CONTRASENIA varchar(40) NOT NULL,
		ID_AGENTE bigint(20) NOT NULL, 
		CONSTRAINT pk_nombre_usuario_web PRIMARY KEY (NOMBRE_USUARIO),
		CONSTRAINT fk_agente_usuario_web FOREIGN KEY (ID_AGENTE) REFERENCES agente (ID)
);
DROP TABLE IF EXISTS agente_reclamante;
CREATE TABLE agente_reclamante (
		ID bigint(20) NOT NULL AUTO_INCREMENT, 
		ID_AGENTE bigint(20) NOT NULL, 
		ID_RECLAMANTE bigint(20) NOT NULL,
		CONSTRAINT pk_agente_reclamante PRIMARY KEY (ID),		
		CONSTRAINT fk_reclamante_web FOREIGN KEY (ID_RECLAMANTE) REFERENCES reclamante (ID),
		CONSTRAINT fk_agente_web FOREIGN KEY (ID_AGENTE) REFERENCES agente (ID)
);
DROP TABLE IF EXISTS vehiculo_reclamante;
CREATE TABLE vehiculo_reclamante (
		ID bigint(20) NOT NULL AUTO_INCREMENT, 
		ID_RECLAMANTE bigint(20) NOT NULL,
		ID_VEHICULO bigint(20) NOT NULL, 
		CONSTRAINT pk_vehiculo_reclamante_web PRIMARY KEY (ID),		
		CONSTRAINT fk_VR_reclamante_web FOREIGN KEY (ID_RECLAMANTE) REFERENCES reclamante (ID),
		CONSTRAINT fk_VR_vehiculo_web FOREIGN KEY (ID_VEHICULO) REFERENCES vehiculo (ID)
);
DROP TABLE IF EXISTS reclamo_tagle;
CREATE TABLE reclamo_tagle (
		ID bigint(20) NOT NULL AUTO_INCREMENT, 
		FECHA_RECLAMO_TAGLE date NOT NULL,
		DESCRIPCION varchar(256) NOT NULL,
		REGISTRANTE_ID bigint(20) NOT NULL,
		CONSTRAINT pk_reclamo_tagle PRIMARY KEY (ID),
		CONSTRAINT fk_rt_registrante_web FOREIGN KEY (REGISTRANTE_ID) REFERENCES registrante (ID)

);
DROP TABLE IF EXISTS pedido_pieza_reclamo_tagle;
CREATE TABLE pedido_pieza_reclamo_tagle (
		ID bigint(20) NOT NULL AUTO_INCREMENT,
		RECLAMO_TAGLE_ID bigint(20) NOT NULL,
		PEDIDO_ID bigint(20) NOT NULL, 	
		PIEZA_ID bigint(20) NOT NULL,
		CONSTRAINT pk_pprt PRIMARY KEY (ID),
		CONSTRAINT fk_pprt_reclamo_tagle_web FOREIGN KEY (RECLAMO_TAGLE_ID) REFERENCES reclamo_tagle (ID),
		CONSTRAINT fk_pprt_pedido_web FOREIGN KEY (PEDIDO_ID) REFERENCES pedido (ID),
		CONSTRAINT fk_pprt_pieza_web FOREIGN KEY (PIEZA_ID) REFERENCES pieza (ID)
);
