CREATE DATABASE IF NOT EXISTS locacao;
USE locacao;

CREATE TABLE IF NOT EXISTS clientes(
	id int auto_increment unique,
    nome varchar(100),
    cpf varchar(20),
	telefone varchar(30)
);

CREATE TABLE IF NOT EXISTS veiculos(
	id int unique,
    marca varchar(100),
    modelo varchar(100),
	ano int,
    placa varchar(10),
    preco varchar(100)
);

CREATE TABLE IF NOT EXISTS enderecos(
	id int unique,
    id_cliente int unique,
    logradouro varchar(100),
    numero int,
	bairro varchar(40),
    cidade varchar(30),
    estado varchar(2),
	cep varchar(15)
);

CREATE TABLE IF NOT EXISTS pagamentos(
	id int unique,
    id_cliente int,
    id_veiculo int,
	preco varchar(100),
    data_pagamento varchar(20)
);