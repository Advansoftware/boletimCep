DROP TABLE IF EXISTS boletim;
DROP TABLE IF EXISTS turma_aluno;
DROP TABLE IF EXISTS aluno;
DROP TABLE IF EXISTS disciplina_curso;
DROP TABLE IF EXISTS turma_disciplina;
DROP TABLE IF EXISTS disciplina;
DROP TABLE IF EXISTS categoria;
DROP TABLE IF EXISTS turma;
DROP TABLE IF EXISTS curso;
DROP TABLE IF EXISTS usuario;

CREATE TABLE categoria(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(100)
);

CREATE TABLE curso (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(100),
	ativo BOOLEAN,
	data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE turma (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	ativo BOOLEAN,
	data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	nome VARCHAR(100),
	curso_id INT NOT NULL,
	CONSTRAINT fk_curso
		FOREIGN KEY(curso_id) REFERENCES curso(id)
);

CREATE TABLE disciplina (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(100),
	ativo BOOLEAN,
	data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	categoria_id INT NOT NULL,
	CONSTRAINT fk_categoria
		FOREIGN KEY(categoria_id) REFERENCES categoria(id)
);

CREATE TABLE turma_disciplina (
	turma_id INT NOT NULL,
	disciplina_id INT NOT NULL,
	CONSTRAINT pk_turma_disciplina 
		PRIMARY KEY (turma_id, disciplina_id),
	CONSTRAINT fk_turma
		FOREIGN KEY (turma_id) REFERENCES turma(id),
	CONSTRAINT fk_disciplina
		FOREIGN KEY (disciplina_id) REFERENCES disciplina(id)
);

CREATE TABLE disciplina_curso (
	disciplina_id INT NOT NULL,
	curso_id INT NOT NULL,
	CONSTRAINT pk_disciplina_curso 
		PRIMARY KEY(disciplina_id,curso_id),
	CONSTRAINT fk_disciplina_disciplina_curso
		FOREIGN KEY (disciplina_id) REFERENCES disciplina(id),
	CONSTRAINT fk_curso_disciplina_curso
		FOREIGN KEY(curso_id) REFERENCES curso(id)
);

CREATE TABLE aluno (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	ativo BOOLEAN,
	data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	matricula INT,
	nome VARCHAR(100),
	sexo char(1),
	data_nascimento DATE,
	numero_chamada INT,
	turma_id INT,
	curso_id INT NOT NULL,
	CONSTRAINT fk_turma_aluno
		FOREIGN KEY (turma_id) REFERENCES turma(id),
	CONSTRAINT fk_curso_aluno
		FOREIGN KEY (curso_id) REFERENCES curso(id)
);

CREATE TABLE turma_aluno(
	turma_id INT,
	aluno_id INT,
	data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CONSTRAINT pk_turma_aluno 
		PRIMARY KEY (turma_id,aluno_id),
	CONSTRAINT fk_turma_turma_aluno 
		FOREIGN KEY (turma_id) REFERENCES turma(id),
	CONSTRAINT fk_aluno_turma_aluno 
		FOREIGN KEY (aluno_id) REFERENCES aluno(id)
);

CREATE TABLE boletim (
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	ativo BOOLEAN,
	data_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	nota1 DOUBLE DEFAULT NULL,
	falta1 INT DEFAULT NULL,
	nota2 DOUBLE DEFAULT NULL,
	falta2 INT DEFAULT NULL,
	nota3 DOUBLE DEFAULT NULL,
	falta3 INT DEFAULT NULL,
	nota4 DOUBLE DEFAULT NULL,
	falta4 INT DEFAULT NULL,
	bimestre INT,
	aluno_id INT NOT NULL,
	disciplina_id INT NOT NULL,
	turma_id INT NOT NULL,
	nota_final DOUBLE DEFAULT NULL,
	status VARCHAR(11),
	exame DOUBLE DEFAULT NULL,
	CONSTRAINT fk_aluno_boletim
		FOREIGN KEY (aluno_id) REFERENCES aluno(id),
	CONSTRAINT fk_disciplina_boletim
		FOREIGN KEY (disciplina_id) REFERENCES disciplina(id),
	CONSTRAINT fk_turma_boletim
		FOREIGN KEY (turma_id) REFERENCES turma(id)
);

CREATE TABLE usuario(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(50) NOT NULL,
	senha VARCHAR(200) NOT NULL
);

CREATE TABLE configuracoes_geral(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    media double NOT NULL,
    itens_por_pagina INT NOT NULL
);

INSERT INTO grupo(nome,ativo) VALUES('Administrador',1);
INSERT INTO usuario (nome,email,senha,ativo,grupo_id) VALUES(
					'Admin','admin@dominio.com.br','admin123',1,1);

INSERT INTO menu(ativo,nome,ordem) VALUES(1,'Administrativo',1);
INSERT INTO modulo(ativo,nome,ordem,descricao,icone,menu_id,url) VALUES(1,'Módulos',1,'Lista de módulos','fa fa-list-alt',1,'Modulo');
INSERT INTO modulo(ativo,nome,ordem,descricao,icone,menu_id,url) VALUES(1,'Menus',1,'Lista de menus','fa fa-navicon',1,'Menu');
INSERT INTO modulo(ativo,nome,ordem,descricao,icone,menu_id,url) VALUES(1,'Grupos',1,'Lista de grupos','fa fa-th-large',1,'Grupo');
INSERT INTO modulo(ativo,nome,ordem,descricao,icone,menu_id,url) VALUES(1,'Usuários',1,'Lista de usuários','glyphicon glyphicon-user',1,'Usuario');
INSERT INTO acesso(modulo_id,criar,visualizar,atualizar,apagar,grupo_id) VALUES(3,1,1,1,1,1);

INSERT INTO categoria(nome) VALUES('Matérias Técnicas');
INSERT INTO categoria(nome) VALUES('Matérias Ensino Médio');