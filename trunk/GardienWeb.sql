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
		ID_AGENTE bigint(20) NOT NULL, 
		ID_RECLAMANTE bigint(20) NOT NULL,
		CONSTRAINT pk_agente_reclamante PRIMARY KEY (ID_AGENTE,ID_RECLAMANTE),		
		CONSTRAINT fk_reclamante_web FOREIGN KEY (ID_RECLAMANTE) REFERENCES reclamante (ID),
		CONSTRAINT fk_agente_web FOREIGN KEY (ID_AGENTE) REFERENCES agente (ID)
);
