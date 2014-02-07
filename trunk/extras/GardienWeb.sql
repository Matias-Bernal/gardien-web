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
		ID bigint(20) NOT NULL, 
		ID_AGENTE bigint(20) NOT NULL, 
		ID_RECLAMANTE bigint(20) NOT NULL,
		CONSTRAINT pk_agente_reclamante PRIMARY KEY (ID),		
		CONSTRAINT fk_reclamante_web FOREIGN KEY (ID_RECLAMANTE) REFERENCES reclamante (ID),
		CONSTRAINT fk_agente_web FOREIGN KEY (ID_AGENTE) REFERENCES agente (ID)
);
DROP TABLE IF EXISTS vehiculo_reclamante;
CREATE TABLE vehiculo_reclamante (
		ID bigint(20) NOT NULL, 
		ID_RECLAMANTE bigint(20) NOT NULL,
		ID_VEHICULO bigint(20) NOT NULL, 
		CONSTRAINT pk_vehiculo_reclamante_web PRIMARY KEY (ID),		
		CONSTRAINT fk_VR_reclamante_web FOREIGN KEY (ID_RECLAMANTE) REFERENCES reclamante (ID),
		CONSTRAINT fk_VR_vehiculo_web FOREIGN KEY (ID_VEHICULO) REFERENCES vehiculo (ID)
);
