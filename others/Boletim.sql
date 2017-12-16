DROP TABLE IF EXISTS Boletim;
DROP TABLE IF EXISTS Aluno;
DROP TABLE IF EXISTS Disciplina_Curso;
DROP TABLE IF EXISTS Turma_Disciplina;
DROP TABLE IF EXISTS Disciplina;
DROP TABLE IF EXISTS Categoria;
DROP TABLE IF EXISTS Turma;
DROP TABLE IF EXISTS Curso;
DROP TABLE IF EXISTS Usuario;

CREATE TABLE Categoria(
	Id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	Nome VARCHAR(100)
);

CREATE TABLE Curso (
	Id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	Nome VARCHAR(100)
);

CREATE TABLE Turma (
	Id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	Nome VARCHAR(100),
	CursoId INT NOT NULL,
	CONSTRAINT fk_Curso
		FOREIGN KEY(CursoId) REFERENCES Curso(Id)
);

CREATE TABLE Disciplina (
	Id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	Nome VARCHAR(100),
	ativo BOOLEAN,
	data_registro CURRENT_TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	CategoriaId INT NOT NULL,
	CONSTRAINT fk_Categoria
		FOREIGN KEY(CategoriaId) REFERENCES Categoria(Id)
);

CREATE TABLE Turma_Disciplina (
	Id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	TurmaId INT NOT NULL,
	DisciplinaId INT NOT NULL,
	CONSTRAINT fk_turma
		FOREIGN KEY (TurmaId) REFERENCES Turma(Id),
	CONSTRAINT fk_Disciplina
		FOREIGN KEY (DisciplinaId) REFERENCES Disciplina(Id)
);

CREATE TABLE Disciplina_Curso (
	Id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	DisciplinaId INT NOT NULL,
	CursoId INT NOT NULL,
	CONSTRAINT fk_Disciplina_Disciplina_Curso
		FOREIGN KEY (DisciplinaId) REFERENCES Disciplina(Id),
	CONSTRAINT fk_Curso_Disciplina_Curso
		FOREIGN KEY(CursoId) REFERENCES Curso(Id)
);

CREATE TABLE Aluno (
	Id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	Matricula INT,
	Nome VARCHAR(100),
	Sexo char(1),
	DataNascimento DATE,
	NumeroChamada INT,
	TurmaId INT NOT NULL,
	CursoId INT NOT NULL,
	CONSTRAINT fk_turmaAluno
		FOREIGN KEY (TurmaId) REFERENCES Turma(Id),
	CONSTRAINT fk_CursoAluno
		FOREIGN KEY (CursoId) REFERENCES Curso(Id)
);

CREATE TABLE Boletim (
	Id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	Nota FLOAT,
	Falta INT,
	Bimestre INT,
	AlunoId INT NOT NULL,
	DisciplinaId INT NOT NULL,
	CONSTRAINT fk_AlunoBoletim
		FOREIGN KEY (AlunoId) REFERENCES Aluno(Id),
	CONSTRAINT fk_DisciplinaBoletim
		FOREIGN KEY (DisciplinaId) REFERENCES Disciplina(Id)
);

CREATE TABLE Usuario(
	id INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(50) NOT NULL,
	senha VARCHAR(200) NOT NULL
);
INSERT INTO Usuario(nome,email,senha) VALUES('teste','teste@teste.com',sha2('teste',512));